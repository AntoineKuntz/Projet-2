<?php

// Controlleur du crud Annonce.  

namespace App\Controller;

use App\Model\AdvertHelpManager;

class AdvertHelpController extends AbstractController
{
   // montre les informations disponibles pour une annonces spécifiques

   public function show(int $id): string
   {
       $adverthelpManager = new AdvertHelpManager();
       $adverthelp = $adverthelpManager->selectOneById($id);

       return $this->twig->render('AdvertHelp/show.html.twig', ['adverthelp' => $adverthelp]);
   }

   
     

// Ajouter une nouvelle annonce via un form

   public function add(): string
   {
       
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           // clean $_POST data
          
           $adverthelp = array_map('trim', $_POST);
          
           //envoie la date précise au moment ou le message est poster 

           if (!isset($_POST['date'] ))
           {
               $adverthelp['date'] = date('Y , m , H:i:s');
           }
           
           //sécurisation du formulaire
           $errors = "";

           
           if (empty($adverthelp['message'])) {
               $errors = 'merci de rajouter des informations supplémentaire a votre message.';
               return $errors;
           }

           // possibilité lors du form

           // cloture de l'annonce 
            if (!empty($_POST['isValidate']))
            {
              $adverthelp['isValidate'] = 1;  
            
            // transmissions des informations et redirections sur la page index
            } else { 
                $adverthelp['isValidate'] = 0;
            }
            $adverthelpManager = new AdvertHelpManager();
            $id = $adverthelpManager->insert($adverthelp);
            header('Location:/advertHelp/show/'. $id);  
       }
       
       return $this->twig->render('AdvertHelp/add.html.twig');
       
   }

}

   

