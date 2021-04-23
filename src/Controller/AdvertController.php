<?php

// Controlleur du crud Annonce.  

namespace App\Controller;

use App\Model\AdvertManager;

class AdvertController extends AbstractController
{
// liste les annonces disponibles

    public function index()
    {
        $advertManager = new AdvertManager();
        $advert = $advertManager->selectAll('title');
        return $this->twig->render('Advert/index.html.twig', ['advert' => $advert]);
    }

// montre les informations disponibles pour une annonces spécifiques

    public function show(int $id): string
    {
        $advertManager = new AdvertManager();
        $advert = $advertManager->selectOneById($id);

        return $this->twig->render('Advert/show.html.twig', ['advert' => $advert]);
    }

    
      

// Ajouter une nouvelle annonce via un form

    public function add(): string
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $advert = array_map('trim', $_POST);

            
            //sécurisation du formulaire
            $errors = "";

            if (empty($advert['title'])) {
                $errors = 'Nous avons besoin d\'un titre pour votre annonce !';
                return $errors;
            }
            if (empty($advert['description'])) {
                $errors = 'Décrivez en quelque mots votre annonce s\'il vous plait. ';
                return $errors;
            }
            if (empty($advert['comment'])) {
                $errors = 'merci de rajouter des informations supplémentaire a votre annonce.';
                return $errors;
            }
             // transmissions des informations et redirections sur la page index
             else{ 
            $advertManager = new AdvertManager();
            $id = $advertManager->insert($advert);
            header('Location:/advert/index/');
             }
        }
        
        return $this->twig->render('Advert/add.html.twig');
        
    }
    
// modiffication des annonces existantes

    public function edit(int $id): string
    {
        $advertManager = new AdvertManager();
        $advert = $advertManager->selectOneById($id);
            
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // clean $_POST data

            $advert = array_map('trim', $_POST);

            //sécurisation du formulaire
            $errors = "";

            if (empty($advert['title'])) {
                $errors = 'Nous avons besoin d\'un titre pour votre annonce !';
                return $errors;
            }
            if (empty($advert['description'])) {
                $errors = 'Décrivez en quelque mots votre annonce s\'il vous plait. ';
                return $errors;
            }
            if (empty($advert['comment'])) {
                $errors = 'merci de rajouter des informations supplémentaire a votre annonce.';
                return $errors;
            }
             
             //transmission des nouvelles informations et redirection sur la vue de l'annonce
             else {
            $advertManager->update($advert);
            header('Location: /Advert/show/' . $id);
             }
        }

        return $this->twig->render('Advert/edit.html.twig', [ 'advert' => $advert]);
    }
    // supression d'une annonce
   public function delete(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $advertManager = new AdvertManager();
            $advertManager->delete($id);
            header('Location:/Advert/index');
        }
    }
}