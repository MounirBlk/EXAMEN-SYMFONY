<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="default_home", methods={"GET"})
     */
    public function home(EntityManagerInterface $entityManager)
    {
        return $this->render('default/home.html.twig');
    }
}
