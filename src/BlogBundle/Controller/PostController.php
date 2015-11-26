<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function indexAction()
    {
        $posts = array(
            array('title' => 'title1', 'desc' => 'desc1'),
            array('title' => 'title2', 'desc' => 'desc2'),
        );
        return $this->render('BlogBundle:Post:index.html.twig', array('posts' => $posts));
    }

    public function createAction()
    {
        $title = 'TestTitle';
        $desc = 'TestDesc';
        $user = 1;

        $post = new Post();
        $post->setTitle($title);
        $post->setDescription($desc);
        $post->setUser($user);

        $em = $this->getDoctrine()->getManager();

        $em->persist($post);
        $em->flush();

        return new Response('Created a post with id='.$post->getId());
    }
}
