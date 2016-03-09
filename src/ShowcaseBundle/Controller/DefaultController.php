<?php

namespace ShowcaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $router = $this->get('router');
        $routes = $router->getRouteCollection();
        
        $appRoutes = [];
        foreach ($routes as $routeName => $route) {
            if(strpos($route->getPath(), '/_') !== false) continue;
            $url = $router->generate($routeName, $route->getDefaults());
            $appRoutes[] = $route;
            $appUrls[] = $url;
        }
        
        return $this->render('ShowcaseBundle:Default:index.html.twig', [
            'routes' => $appRoutes,
            'urls' => $appUrls,
        ]);
    }
}
