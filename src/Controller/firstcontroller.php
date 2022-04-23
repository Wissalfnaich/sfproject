<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class firstcontroller
{
    /**
     * @Route("/first")
     */
public function first(){ return new Response(content: '<h1>Hello rt2/3</h1>');
}
}