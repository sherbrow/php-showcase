<?php

namespace ShowcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TransController extends Controller
{
    public function welcomeAction()
    {
        return $this->render('ShowcaseBundle:Trans:welcome.html.twig');
    }

}
