<?php

namespace App\Controller;

use App\Model\UserManager;
<<<<<<< HEAD
use App\Model\AdvertManager;
=======
>>>>>>> 735aa96326dd07637d9f08866bbb1c17df5e296a
use App\Controller\CheckForm;
use App\Controller\AuthController;

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

    public function checkUserForm(): array
    {
        $checkForm = new CheckForm();
        $errors = [
            $checkForm->displayEmptyErrors(),
            $checkForm->displayAgeErrors(),
            $checkForm->displayMailPasswodErrors(),
            $checkForm->displayAvatarErrors()
        ];

        $allErrors = array();

        foreach ($errors as $value) {
            if ($value > 0 || $value !== null) {
                $allErrors = array_merge($allErrors, $value);
            }
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
        $advertManager = new AdvertManager();
        $user = $userManager->selectOneById($id);
        $advert = $advertManager->selectByUserId($id);

        return $this->twig->render('User/userShow.html.twig', [
<<<<<<< HEAD
            'user' => $user,
            'advert' => $advert
=======
            'user' => $user
>>>>>>> 735aa96326dd07637d9f08866bbb1c17df5e296a
            ]);
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
            // if validation is ok, update and redirection
            if (count($this->checkUserForm()) == 0) {
<<<<<<< HEAD
                if (!isset($user['avatar'])) {
=======
                if (!isset($_FILES['avatar']) || $_FILES['avatar']['size'] === 0) {
>>>>>>> 735aa96326dd07637d9f08866bbb1c17df5e296a
                    $user['avatar'] = $userManager->selectOneById($id)['avatar'];
                } else {
                    $user = $this->uploadAvatar($user);
                }

                $userManager->update($user);
                header('Location: /user/userShow/' . $id);
            } else {
                if (!isset($user['avatar'])) {
                    $user['avatar'] = $userManager->selectOneById($id)['avatar'];
                } else {
                    $user = $this->uploadAvatar($user);
                }
                return $this->twig->render('User/edit.html.twig', [
                    'user' => $user,
                    'errors' => $this->checkUserForm()
                ]);
            }
        }
        return $this->twig->render('User/edit.html.twig', [
            'user' => $user,
        ]);
    }
}
