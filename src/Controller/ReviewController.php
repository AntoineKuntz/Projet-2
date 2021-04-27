<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Controller\CheckForm;

class ReviewController extends AbstractController
{
     /**
    * secure form
    */
    public function validData($data)
    {
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);

           return $data;
    }

    public function checkReviewForm(): array
    {
        $errors = array();

        if (!isset($_POST['comment']) || $_POST['comment'] == "") {
            $errors['comment1'] = "Veuillez laisser un commentaire pour votre helper";
        }

        if (!isset($_POST['rate'])) {
            $errors['rate1'] = " - La note minimum doit être de 1 étoile .";
        }

        return $errors;
    }

  /**
     * Add a review
     */
    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviewDatas = array_map(array($this, "validData"), $_POST);

            if (count($this->checkReviewForm()) == 0) {
                //A voirs
            } else {
              // var_dump($this->checkReviewForm()); die();
                return $this->twig->render('Review/add.html.twig', [
                  'review' => $reviewDatas,
                  'errors' => $this->checkReviewForm()
                ]);
            }
        }

        return $this->twig->render('Review/add.html.twig');
    }
}
