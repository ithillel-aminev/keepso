<?php

namespace BlogBundle\Handler;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Symfony\Component\Security\Http\HttpUtils;

class AuthenticationSuccessHandler extends DefaultAuthenticationSuccessHandler
{
    protected $container;

    public function __construct(HttpUtils $httpUtils, ContainerInterface $cont, array $options)
    {
        parent::__construct($httpUtils, $options);
        $this->container=$cont;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        return $this->httpUtils->createRedirectResponse($request, $this->determineTargetUrl($request));
    }

} 