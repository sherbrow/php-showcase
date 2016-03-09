<?php

namespace ShowcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AnoTransController extends Controller
{
    /**
     * @Route("/welcome/{_locale}")
     */
    public function welcomeAction()
    {
        return $this->render('ShowcaseBundle:Trans:welcome.html.twig');
    }

}
