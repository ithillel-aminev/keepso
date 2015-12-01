<?php

namespace BlogRestApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class PostController extends FOSRestController
{
    public function getPostAction($id)
    {
        $post = $this->getDoctrine()->getRepository('BlogBundle:Post')->find($id);
        $view = $this->view($post, 200);
        return $this->handleView($view);
    }
}