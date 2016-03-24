<?php

namespace BanqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BanqueBundle\Entity\Agent;
use BanqueBundle\Form\AgentType;

class AgentsController extends Controller
{
    public function indexAction() {
        $agent_repository = $this->getDoctrine()
          ->getRepository('BanqueBundle:Agent');
        $agents = $agent_repository->findAll();
        
        return $this->render('BanqueBundle:Agents:index.html.twig', [
            'agents' => $agents,
        ]);
    }
    public function addAction() {
        
        $form = $this->createForm(AgentType::class, null, [
            'action' => $this->generateUrl('agents_create'),
            'method' => 'PUT',
        ]);
        
        return $this->render('BanqueBundle:Agents:add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    public function showAction($id) {
        $agent_repository = $this->getDoctrine()
          ->getRepository('BanqueBundle:Agent');
        $agent = $agent_repository->find($id);
        if(!$agent) {
            throw $this->createNotFoundException('Agent not found');
        }
        
        return $this->render('BanqueBundle:Agents:show.html.twig', [
            'agent' => $agent,
        ]);
    }
    public function modifyAction($id) {
        $agent_repository = $this->getDoctrine()
          ->getRepository('BanqueBundle:Agent');
        $agent = $agent_repository->find($id);
        if(!$agent) {
            throw $this->createNotFoundException('Agent not found');
        }
        
        $form = $this->createForm(AgentType::class, $agent, [
            'action' => $this->generateUrl('agents_update', ['id' => $id]),
            'method' => 'POST',
        ]);
        
        return $this->render('BanqueBundle:Agents:modify.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    public function createAction(Request $request) {
        
        $form = $this->createForm(AgentType::class);
        $form->handleRequest($request);
        
        $agent = $form->getData();
        
        if (!$form->isValid()) {
            return $this->render('BanqueBundle:Agents:add.html.twig', [
                'form' => $form->createView(),  
            ]);
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($agent);
        $em->flush();
        
        $this->addFlash('notice', 'Succès');
        return $this->redirectToRoute('agents_index');
    }
    public function updateAction(Request $request) {
        $form = $this->createForm(AgentType::class);
        $form->handleRequest($request);
        
        $agent = $form->getData();
        
        if (!$form->isValid()) {
            return $this->render('BanqueBundle:Agents:add.html.twig', [
                'form' => $form->createView(),
            ]);
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($agent);
        $em->flush();
        
        $this->addFlash('notice', 'Succès');
        return $this->redirectToRoute('agents_index');
    }
    public function deleteAction($id) {
        $agent_repository = $this->getDoctrine()
          ->getRepository('BanqueBundle:Agent');
        $agent = $agent_repository->find($id);
        if(!$agent) {
            throw $this->createNotFoundException('Agent not found');
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($agent);
        $em->flush();
        
        $this->addFlash('notice', 'Succès');
        return $this->redirectToRoute('agents_index');
    }
}
