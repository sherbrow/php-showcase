<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Agent;
use AppBundle\Form\AgentType;

/**
 * Agent controller.
 *
 * @Route("/agent")
 */
class AgentController extends Controller
{
    /**
     * Lists all Agent entities.
     *
     * @Route("/", name="agent_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $agents = $em->getRepository('AppBundle:Agent')->findAll();

        return $this->render('agent/index.html.twig', array(
            'agents' => $agents,
        ));
    }

    /**
     * Creates a new Agent entity.
     *
     * @Route("/new", name="agent_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $agent = new Agent();
        $form = $this->createForm('AppBundle\Form\AgentType', $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agent);
            $em->flush();

            return $this->redirectToRoute('agent_show', array('id' => $agent->getId()));
        }

        return $this->render('agent/new.html.twig', array(
            'agent' => $agent,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Agent entity.
     *
     * @Route("/{id}", name="agent_show")
     * @Method("GET")
     */
    public function showAction(Agent $agent)
    {
        $deleteForm = $this->createDeleteForm($agent);

        return $this->render('agent/show.html.twig', array(
            'agent' => $agent,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Agent entity.
     *
     * @Route("/{id}/edit", name="agent_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Agent $agent)
    {
        $deleteForm = $this->createDeleteForm($agent);
        $editForm = $this->createForm('AppBundle\Form\AgentType', $agent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agent);
            $em->flush();

            return $this->redirectToRoute('agent_edit', array('id' => $agent->getId()));
        }

        return $this->render('agent/edit.html.twig', array(
            'agent' => $agent,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Agent entity.
     *
     * @Route("/{id}", name="agent_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Agent $agent)
    {
        $form = $this->createDeleteForm($agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($agent);
            $em->flush();
        }

        return $this->redirectToRoute('agent_index');
    }

    /**
     * Creates a form to delete a Agent entity.
     *
     * @param Agent $agent The Agent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Agent $agent)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agent_delete', array('id' => $agent->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
