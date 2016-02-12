<?php

namespace ShowcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FormController extends Controller
{
    public function rawAction()
    {
        return $this->render('ShowcaseBundle:Form:raw.html.twig');
    }

    public function rawSubmitAction(Request $request)
    {
        $field = $request->request->get('field');
        $this->addFlash('raw', $field);
        return $this->redirectToRoute('form_raw');
    }

}
