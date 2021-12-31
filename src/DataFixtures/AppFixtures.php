<?php

namespace App\DataFixtures;

use App\Entity\Film;
use App\Entity\Realisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        
        $realisateurNom = ['Uzumaki','Uchiha','Monkey D','JeSaisPas','De la street'];
        $realisateurPrenom = ['Naruto','Sasuke','Luffy','Sangoku','Iruma'];
        $realisateurPays = ['Espagne','France','Italie','Belgique','Allemagne'];
        
        $titre = ['L\'aventure du lion','Le monde du rêve','Symfony l\'éternel','Le monde grand','L\'illusion immaginaire'];
        $resume = [
            'Blah blah resume très bon film1',
            'Blah blah resume très bon film2',
            'Blah blah resume très bon film3',
            'Blah blah resume très bon film4',
            'Blah blah resume très bon film5'];
        $duree = ['127 mins','150 mins','120 mins','95 mins','134 mins'];
        $annee_sortie = [2021, 2005, 2000, 2007, 2018];
        $prix = [99, 157, 88, 999, 249];

        if(count($realisateurNom) == 5 && count($realisateurPrenom) == 5 && count($realisateurPays) == 5 && count($titre) == 5){
            for($index = 0; $index < 5; $index++){
                $realisateur = new Realisateur();
                $film = new Film();
    
                $realisateur->setNom($realisateurNom[$index]);
                $realisateur->setPrenom($realisateurPrenom[$index]);
                $realisateur->setPays($realisateurPays[$index]);
    
                $film->setRealisateurId($realisateur);
                $film->setTitre($titre[$index]);
                $film->setResume($resume[$index]);
                $film->setDuree($duree[$index]);
                $film->setAnneeSortie($annee_sortie[$index]);
                $film->setPrix($prix[$index]);

                $manager->persist($realisateur);
                $manager->persist($film);
            }
        }

        $manager->flush();
    }
}
