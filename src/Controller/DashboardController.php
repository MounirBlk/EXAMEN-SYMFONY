<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Realisateur;
use App\Form\FilmType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class DashboardController extends AbstractController
{

    /**
     * @Route("/dashboard", name="show_dashboard", methods={"GET"})
     */
    public function showDashboard(EntityManagerInterface $entityManager)
    {
        $films = $entityManager->getRepository(Film::class)->findBy([]);
        $realisateurs = $entityManager->getRepository(Realisateur::class)->findBy([]);

        return $this->render('dashboard/tableau_de_bord.html.twig', [
            "films" => $films,
            "realisateurs" => $realisateurs
        ]);
    }

    /**
     * @Route("/dashboard/create/film", name="create_film", methods={"GET|POST"})
     * @param Request $request
     * @return Response
     */
    public function createFilm(Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {
        # Nouvelle instance de la classe
        $film = new Film();

        # Matérialisation du formulaire déclaré dans FilmType.php
        $form = $this->createForm(FilmType::class, $film);

        # handleRequest() sert à récupérer les données du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //$film->setAuthor($this->getUser());

            # Récupération des données du formulaire
            $film = $form->getData();

            # Création du conteneur et insertion en base de données grâce à Doctrine et l'outil entityManager.
            $entityManager->persist($film);

            # On vide l'entity manager des données précédement contenues.
            $entityManager->flush();

            $this->addFlash('success', 'Vous avez créé un nouuveau film !');

            # Redirection sur la page d'accueil
            return $this->redirectToRoute('show_dashboard');
        }

        return $this->render('dashboard/form_tableau_de_bord.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
