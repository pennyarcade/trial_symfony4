<?php

namespace App\Controller;

use App\Entity\News;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;


/**
 *
 */
class NewsApiController extends Controller
{
    /**
     * @FOSRest\Post("/api/news")
     */
    public function new(Request $request)
    {
        $news = new News();
        $news->setName($request->get('name'));


        $em = $this->getDoctrine()->getManager();
        $em->persist($news);
        $em->flush();

        return View::create($news, Response::HTTP_CREATED, []);
    }

    /**
     * @FOSRest\Get("/api/news")
     *
     */
    public function list(NewsRepository $newsRepository)
    {
        return View::create($newsRepository->findAll(), Response::HTTP_OK , []);
    }


    /**
     * @FOSRest\Get("/api/news/{id}")
     */
    public function show(News $news)
    {
        return View::create($news, Response::HTTP_OK , []);
    }

    /**
     * @FOSRest\Post("/api/news/{id}")
     */
    public function edit(Request $request, News $news)
    {
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return View::create($news, Response::HTTP_OK , []);
        }
    }

    /**
     * @FOSRest\Delete("/api/news/{id}")
     */
    public function delete(News $news)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($news);
        $em->flush();

        return View::create([], Response::HTTP_OK , []);
    }
}
