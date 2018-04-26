<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Repository\CategoryRepository;
use App\Repository\NewsRepository;


class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(CategoryRepository $categoryRepository, NewsRepository $newsRepository)
    {
        return $this->render('index/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'news' => $newsRepository->findAll()
        ]);
    }
}
