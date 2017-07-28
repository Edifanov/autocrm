<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations;

/**
 * Class ApiController
 * @package AppBundle\Controller
 * @Annotations\RouteResource("api")
 */
class ApiController extends FOSRestController implements ClassResourceInterface
{
    public function indexAction()
    {
        $data = array("hello" => "world1");
        $view = $this->view($data);
        return $this->handleView($view);
    }

    public function getAction()
    {
        $data = array("hello" => "world2");
        $view = $this->view($data);
        return $this->handleView($view);
    }
}