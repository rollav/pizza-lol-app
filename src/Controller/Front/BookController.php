<?php

namespace App\Controller\Front;

use App\Form\Front\BookSearchType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/rechercher', name: 'app_front_book_search')]
    public function search(Request $request, BookRepository $repository): Response
    {
        $form = $this->createForm(BookSearchType::class);

        $form->handleRequest($request);

        $books = $repository->findByCriteria($form->getData());

        return $this->render('front/book/search.html.twig', [
            'form' => $form->createView(),
            'books' => $books,
        ]);
    }
}