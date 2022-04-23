<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/todo', name: 'app_todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has(name: 'todos')) {

            $todos = ['achat' => 'acheter clé usb',
                'cours' => 'Finaliser mon cours',
                'correction' => 'corriger mes examens'];
            $session->set('todos', $todos);
        }

        return $this->render('todo/index.html.twig',);
    }

    #[Route('/todo/add/{name}/{content}', name: 'todo.add')]
    public function addtodo(Request $request, $name, $content):RedirectResponse
    {
        $session = $request->getSession();
        if ($session->has(name: 'todos')) {
            $todos = $session->get('todos');
            if (isset($todos[$name])) {
                $this->addFlash(type: 'error', message: " le todo d'id $name existe déja");
            } else {
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash(type: 'success', message: " le todo d'id $name a été ajouté avec succés");

            }


        } else {
            $this->addFlash(type: 'error', message: " la liste de todo n'existe pas");
        }
        return $this->redirectToRoute('app_todo');
    }
    #[Route('/todo/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(Request $request, $name, $content):RedirectResponse
    {
        $session = $request->getSession();
        if ($session->has(name: 'todos')) {
            $todos = $session->get('todos');
            if (!isset($todos[$name])) {
                $this->addFlash(type: 'error', message: " le todo d'id $name n'existe pas");
            } else {
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash(type: 'success', message: " le todo d'id $name a été modifié avec succés");

            }


        } else {
            $this->addFlash(type: 'error', message: " la liste de todo n'existe pas");
        }
        return $this->redirectToRoute('app_todo');
    }
    #[Route('/todo/delete/{name}', name: 'todo.delete')]
    public function deleteTodo(Request $request, $name):RedirectResponse
    {
        $session = $request->getSession();
        if ($session->has(name: 'todos')) {
            $todos = $session->get('todos');
            if (!isset($todos[$name])) {
                $this->addFlash(type: 'error', message: " le todo d'id $name n'existe pas");
            } else {
                unset($todos[$name]);
                $session->set('todos', $todos);
                $this->addFlash(type: 'success', message: " le todo d'id $name a été supprimé avec succés");

            }


        } else {
            $this->addFlash(type: 'error', message: " la liste de todo n'existe pas");
        }
        return $this->redirectToRoute('app_todo');
    }
    #[Route('/todo/reset', name: 'todo.reset')]
    public function resetTodo(Request $request):RedirectResponse
    {
        $session = $request->getSession();

        $session->remove('todos');

        return $this->redirectToRoute('app_todo');
    }
}


