<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/second')]
class SecondController extends AbstractController
{
    #[Route('/{name}/{age?39}', name: 'app_second',
       requirements: ['age'=>'[01]?\d{1,2}']
       //defaults:['age'=>39]
    )]
    public function index($name,$age,Request $request, SessionInterface $session): Response
    {  if(!$session->has(name: 'number')){
        $session->set('number',1);}
        else{
            $session->set('number',$session->get(name:'number')+1);
        }
        dump($request);
        return $this->render('second/index.html.twig', [
            'controller_name' => 'SecondController',
            'esm'=>$name,
            'age'=>$age,
        ]);
    }
}
