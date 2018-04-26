<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 *
 */
class CategoryApiController extends Controller
{
    /**
     * @FOSRest\Post("/api/category")
     *
     */
    public function new(Request $request)
    {
        $category = new Category();
        $category->setName($request->get('name'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();

        return View::create($category, Response::HTTP_CREATED, []);
    }

    /**
     * @FOSRest\Get("/api/category")
     *
     */
    public function list(CategoryRepository $categoryRepository)
    {
        return View::create($categoryRepository->findAll(), Response::HTTP_OK , []);
    }

    /**
     * @FOSRest\Get("/api/category/{id}")
     *
     */
    public function show(Category $category)
    {
        return View::create($category, Response::HTTP_OK , []);
    }
}
