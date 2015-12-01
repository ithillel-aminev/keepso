<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function indexAction($username)
    {
        $postRepository = $this->getDoctrine()->getRepository('BlogBundle:Post');
        $userRepository = $this->getDoctrine()->getRepository('BlogBundle:User');

        $user = NULL;
        $error = NULL;

        if ( $username ){
            $user = $userRepository->findOneBy(array('username' => $username));
        } elseif ($user = $this->getUser()) {

        } else {
            $user = $userRepository->findOneBy(array('limit' => 1));
        }

        $posts = array();
        if ( $user ){
            $posts = $postRepository->findBy(array('user' => $user->getId()));
        }

        return $this->render('BlogBundle:Post:index.html.twig', array('posts' => $posts, 'user'=> $user ));
    }

    public function newAction(Request $request)
    {
        $post = new Post();

        $form = $this->createFormBuilder($post)
            ->add('title', 'text')
            ->add('description', 'textarea')
            ->add('save', 'submit', array('label' => 'Create Post'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $user = $this->getUser();
            $post->setUser($user->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();


            return $this->redirectToRoute('posts');
        }

        return $this->render('BlogBundle:post:new.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}
