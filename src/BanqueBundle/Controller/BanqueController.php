<?php

namespace BanqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BanqueBundle\Entity\Account;
use BanqueBundle\Libraries\AccountUtils;

class BanqueController extends Controller
{
    public function accueilAction()
    {
        return $this->render('BanqueBundle:accueil.html.twig');
    }

    public function inscriptionAction(Request $request)
    {
        $account = new Account();
        $number = AccountUtils::generateAccountNumber();
        $account->setNumber($number);
        
        return $this->render('BanqueBundle:inscription.html.twig', compact('account'));
    }

    public function createAction(Request $request)
    {
        $number = $request->get('Number');
        $name = $request->get('Name');
        
        $account = new Account();
        $account->setName($name);
        $account->setNumber($number);
        $account->setCredits(1500);
        
        $validator = $this->get('validator');
        $errors = $validator->validate($account);
        
        if(count($errors) > 0) {
            return $this->render('BanqueBundle:inscription.html.twig'
                , compact('account', 'errors')
            );
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($account);
        $em->flush();
        
        $this->addFlash('success', true);
        
        return $this->redirectToRoute('banque_inscription');
    }

    public function adminAction()
    {
        $account_repository = $this->getDoctrine()
          ->getRepository('BanqueBundle:Account');
        $accounts = $account_repository->findAll();
        return $this->render('BanqueBundle:admin.html.twig', compact('accounts'));
    }

    public function gestionAction()
    {
        // TODO
        return $this->render('BanqueBundle:gestion.html.twig');
    }

    public function deleteAction($number)
    {
        $account_repository = $this->getDoctrine()
          ->getRepository('BanqueBundle:Account');
        $account = $account_repository->find($number);
        if(!$account) {
            throw $this->createNotFoundException('Account Not Found');
        }
        
        $number = $account->getNumber();
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($account);
        $em->flush();
        
        $this->addFlash('messages', sprintf('Compte %s supprimé avec succès', $number));
        
        return $this->redirectToRoute('banque_admin');
    }

}
