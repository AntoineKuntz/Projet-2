<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Model\AuthManager;
use App\Controller\AuthController;
use DateTime;

class UserController extends AbstractController
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

    /**
     * Check all errors
     */
    public function checkEmptyErrors()
    {
        $errors = array();

        foreach($_POST as $key => $value){
            
            if(($value == '' || empty($key)) && ( $key !== 'phoneNumber' && $key !== 'id')){
                $errors[$key] = $key . "1";
            }
        }

        return $errors;
    }

    public function displayEmptyErrors()
    {
        $errorsMessages = [
            'lastName1' => " - Vous devez remplir votre Nom",
            'firstName1' => " - Vous devez entrer votre prénom",
            'age1' => " - Veuillez renseigner votre date de naissance",
            'adresseNumber1' => " - Veuillez rentrer une adresse valide",
            'adresseStreet1' => " - Veuillez rentrer une adresse valide",
            'adressePostal1' => " - Veuillez rentrer une adresse valide",
            'adresseCity1' => " - Veuillez rentrer une adresse valide",
            'mail1' => " - Veuillez saisir une adresse mail",
            'password1' => " - Entrez un mot de passe"
        ];

        $error = $this->checkEmptyErrors();
        $adresseError = ['adresseNumber1', 'adresseStreet1', 'adressePostal1', 'adresseCity1'];
        
        if (count($error) > 0){
            $errors = array();
            foreach($errorsMessages as $key => $value){
                if(in_array($key, $error) && !in_array($key, $adresseError)) {
                    $errors[$key] = $value;
                }elseif(in_array($key, $error) && in_array($key, $adresseError)) {
                    $errors['adress'] = " - Veuillez saisir une adresse valide";
                }
            }

            return $errors;
        }
    }
    
    public function displayAgeErrors(): array
    {
        $errors = array();
        if ($_POST['age']) {
            $age = new DateTime($_POST['age']);
            $now = new DateTime(date("Y-m-d"));

            if ($now->diff($age)->y < 18) {
                $errors['age2'] = " - Vous devez être majeur" ;
            }
        }
        return $errors;
    }

    public function displayMailPasswodErrors()
    {
        $errors = array();
        $authManager = new AuthManager();
        
        if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $errors['email2'] = " - mauvais format de l'adresse mail";
        }

        if ($authManager->checkMail($_POST['mail'])) {
            $errors['mail3'] = " - email déjà utilisé";
        }

        if (strlen($_POST['password']) < 6) {
            $errors['password2'] = " - Le mots de passe doit contenir 6 caractère au moins";
        }

        return $errors;
    }

    public function displayAvatarErrors()
    {
        $errors = array();

        if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
            $tailleMax = 2097152;
            $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
            $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
            
            if ($_FILES['avatar']['size'] >= $tailleMax) {
                $errors['avatar2'] = "Taille de l'image trop grande";
            }
            if (!in_array($extensionUpload, $extensionsValides)) {
                $errors['avatar1'] = "Format autorisé 'jpg', 'jpeg', 'gif', 'png' sont autoriser";
            }
        }elseif(!isset($_FILES['avatar']) || $_FILES['avatar']['size'] == 0){
            $errors['avatar3']= "Photo obligatoire";
        }
        
        return $errors;
    }

    /**
     * Check  userForm
     */
    public function checkUserForm(): array
    {
        $errors = [
            $this->displayEmptyErrors(),
            $this->displayAgeErrors(),
            $this->displayMailPasswodErrors(),
            $this->displayAvatarErrors()
        ];

        $allErrors = array();

        foreach($errors as $err => $value){
            if($value > 0 || $value !== null)
                $allErrors = array_merge($allErrors, $value);
        }
        return $allErrors;
    }

    public function uploadAvatar(array $userArray)
    {
        if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
            $tailleMax = 2097152;
            $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
            if ($_FILES['avatar']['size'] <= $tailleMax) {
                $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
                if (in_array($extensionUpload, $extensionsValides)) {
                    $avatarName = uniqid() . "." . $extensionUpload;
                    $avatarPath = "assets/images/membres/avatars/" . $avatarName;
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $avatarPath);
                    $userArray['avatar'] = $avatarName;
                }
            }
        }
        return $userArray;
    }

    /**
     * CRUD User
     */

    /**
     * List of all Users
     */
    public function allUsers()
    {
        $userManager = new UserManager();
        $allUser = $userManager->selectAll();
        if (!isset($_SESSION['user'])) {
            header('Location:../auth/logIn');
        } else {
            return $this->twig->render('User/allUserShow.html.twig', ['user' => $allUser]);
        }
    }

    /**
     * Show profil for a specific user
     */
    public function userShow(int $id)
    {
        $userManager = new UserManager();
        $user = $userManager->selectOneById($id);

        return $this->twig->render('User/userShow.html.twig', ['user' => $user]);
    }

    /**
     * Add a new user
     */
    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $userDatas = array_map(array($this, "validData"), $_POST);

            // if validation is ok, insert and redirection
            if (count($this->checkUserForm()) == 0) {
                //hash Password
                $userDatas['password'] = password_hash($userDatas['password'], PASSWORD_BCRYPT);
                $userDatas = $this->uploadAvatar($userDatas);
                $userManager = new UserManager();
                $userManager->insert($userDatas);
                $autController = new AuthController();
                $autController->log();
            } else {
                return $this->twig->render('User/add.html.twig', [
                    'user' => $userDatas,
                    'errors' => $this->checkUserForm()
                ]);
            }
        }
        return $this->twig->render('User/add.html.twig');
    }

    /**
     * Delete a specific user
     */
    public function delete(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userManager = new UserManager();
            $userManager->delete($id);
            header('Location:/user/allUsers');
        }
    }

    /**
     * Edit a specific item
     */
    public function edit(int $id): string
    {
        $userManager = new UserManager();
        $user = $userManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $user = array_map('trim', $_POST);

            foreach ($user as $data) {
                $this->validData($data);
            }
            // if validation is ok, update and redirection
            if (count( $this->checkUserForm()) == 0) {               
                $user = $this->uploadAvatar($user);
                if (!isset($user['avatar'])) {
                    $user['avatar'] = $userManager->selectOneById($id)['avatar'];
                }
                $userManager->update($user);
                header('Location: /user/userShow/' . $id);
            }
        }
        return $this->twig->render('User/edit.html.twig', [
            'user' => $user,
        ]);
    }
}
