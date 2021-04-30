<?php

// Controlleur du crud Annonce.

namespace App\Controller;

use App\Model\AdvertHelpManager;
use App\Controller\CheckForm;

class AdvertHelpController extends AbstractController
{
    public function checkAdvertForm()
    {
        $checkForm = new CheckForm();

        if ($checkForm->displayEmptyErrors() <= 0) {
            return $errors = array();
        }
        $errors = $checkForm->displayEmptyErrors();
        return $errors;
    }

    public function show(string $id)
    {
        $adverthelpManager = new AdvertHelpManager();
        $adverthelp = $adverthelpManager->selectAllMessageByHelp($id);

        return $this->twig->render('AdvertHelp/show.html.twig', ['adverthelp' => $adverthelp]);
    }

    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adverthelp = array_map('trim', $_POST);

            if (!empty($_POST['isValidate'])) {
                $adverthelp['isValidate'] = 1;
            } else {
                $adverthelp['isValidate'] = 0;
            }

            if (count($this->checkAdvertForm()) == 0) {
                $adverthelp['advert_id'] = $_GET['advert_id'];
                $adverthelp['user_id'] = $_GET['user_id'];
                $adverthelp['date'] = date('Y , m ,d , H:i:s');
                $adverthelp['id_chat'] = uniqid();
                $adverthelp['id_author'] = $_SESSION['user']['id'];
                $id = $adverthelp['id_chat'];

                $adverthelpManager = new AdvertHelpManager();
                $adverthelpManager->insert($adverthelp);

                header('Location:/advertHelp/show/' . $id);
            } else {
                return $this->twig->render('advertHelp/add.html.twig', [
                    'advert' => $adverthelp,
                    'errors' => $this->checkAdvertForm()
                ]);
            }
        }
        return $this->twig->render('AdvertHelp/add.html.twig');
    }

    public function respond(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adverthelp = array_map('trim', $_POST);

            if (!empty($_POST['isValidate'])) {
                $adverthelp['isValidate'] = 1;
            } else {
                $adverthelp['isValidate'] = 0;
            }

            if (count($this->checkAdvertForm()) == 0) {
                $adverthelp['advert_id'] = $_GET['advert_id'];
                $adverthelp['user_id'] = $_GET['user_id'];
                $adverthelp['date'] = date('Y , m , H:i:s');
                $adverthelp['id_chat'] = $_GET['id_chat'];
                $id = $adverthelp['id_chat'];
                $adverthelp['id_author'] = $_SESSION['user']['id'];

                $adverthelpManager = new AdvertHelpManager();
                $adverthelpManager->insert($adverthelp);
                header('Location:/advertHelp/show/' . $id);
            } else {
                return $this->twig->render('advertHelp/add.html.twig', [
                    'advert' => $adverthelp,
                    'errors' => $this->checkAdvertForm()
                ]);
            }
        }
        return $this->twig->render('AdvertHelp/add.html.twig');
    }
}
