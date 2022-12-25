<?php

class UserManager extends Model
{
    /**
     * Register function
     * @return void
     */
    public function registerAction()
    {
        return $this->registerUser('user');
    }

    /**
     * Connection function
     * @return void
     */
    public function connectAction()
    {
        return $this->connectUser('user');
    }

    /**
     * Edit information user function
     * @return void
     */
    public function userEditNameAction()
    {
        return $this->editNameUser('user');
    }

    /**
     * Edit password user function
     * @return void
     */
    public function userEditPasswordAction()
    {
        return $this->userEditPassword('user');
    }

    /**
     * Retrieve information user function
     * @return void
     */
    public function profileAction()
    {
        return $this->profile('user');
    }

    /**
     * Retrieve user by id function
     * @param [type] $id
     * @return void
     */
    public function getUser($id)
    {
        return $this->getUserById('user', $id);
    }

    /**
     * Delete user by id function
     * @param [type] $id
     * @return void
     */
    public function deleteUser($id)
    {
        return $this->deleteUserById('user', $id);
    }

    /**
     * Modify user by id function
     * @param [type] $id
     * @return void
     */
    public function modifyUser($id)
    {
        return $this->modifyUserById('user', $id);
    }

    /**
     * Retrieve all user function
     * @return void
     */
    public function getAllUsers()
    {
        return $this->getAllUsersList('user');
    }

    /**
     * Register function
     * @param [type] $table
     * @return void
     */
    private function registerUser($table)
    {
        $this->getBdd();
        $newFields = array_map ('htmlspecialchars' , $_POST);
        $errors = [];

        if ($newFields['password'] != $newFields['confirmPassword']) {
            $errors['password'] = "Les 2 mots de passe sont différents!";
        }

        $checkEmail =  self::$bdd->prepare("SELECT * FROM $table WHERE email = ?");
        $checkEmail->execute(array($newFields['email']));

        if ($checkEmail->fetch(PDO::FETCH_ASSOC)) {
            $errors['email'] = "L'email existe déjà!";
        }

        if (empty($errors)) {
            $subscribe = self::$bdd->prepare("INSERT INTO $table (firstName, lastName, email, password, dateCreated) VALUES (?, ?, ?, ?, ?)");
            $subscribe->execute(array($newFields['firstName'], $newFields['lastName'], $newFields['email'], md5($newFields['password']),  date("Y-m-d H:i:s")));
            $subscribe->closeCursor();
        } else {
            return $errors;
        }
    }

    /**
     * Connection function
     * @param [type] $table
     * @return void
     */
    private function connectUser($table)
    {
        $this->getBdd();
        $newFields = array_map ('htmlspecialchars' , $_POST);
        $errors = "Identifiant ou mot de passe invalide";

        $req = self::$bdd->prepare("SELECT * FROM $table WHERE email = ? AND password = ?");
        $req->execute(array($newFields['email'], md5($newFields['password'])));
        $user = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        if ($user) {
            $this->openSession($user);
            return $user;
        } else {
            return $errors;
        }
    }

    /**
     * Edit information user function
     * @param [type] $table
     * @return void
     */
    private function editNameUser($table)
    {
        $this->getBdd();
        $newFields = array_map ('htmlspecialchars' , $_POST);
        $result = "Vos informations personnelles sont bien modifiées";

        if ($_FILES["userPicture"]["name"] != '') {
            $filename = $_FILES["userPicture"]["name"];
            $tempname = $_FILES["userPicture"]["tmp_name"];
            $folder = "./public/uploads/" . $filename;

            $req = self::$bdd->prepare("UPDATE $table SET firstName = ?, lastName = ?, picture = ?, dateUpdated = ? WHERE id = ?");
            $req->execute(array($newFields['firstName'], $newFields['lastName'], $filename, date("Y-m-d H:i:s"), $_SESSION['id']));
            $user = $req->fetch(PDO::FETCH_ASSOC);
            $req->closeCursor();
            move_uploaded_file($tempname, $folder);
            return $result;
        } else {
            $req = self::$bdd->prepare("UPDATE $table SET firstName = ?, lastName = ?, dateUpdated = ? WHERE id = ?");
            $req->execute(array($newFields['firstName'], $newFields['lastName'], date("Y-m-d H:i:s"), $_SESSION['id']));
            $user = $req->fetch(PDO::FETCH_ASSOC);
            $req->closeCursor();
            return $result;
        } 
    }

    /**
     * Edit password user function
     * @param [type] $table
     * @return void
     */
    private function userEditPassword($table)
    {
        $this->getBdd();
        $newFields = array_map ('htmlspecialchars' , $_POST);
        $result = "Vos informations personnelles sont bien modifiées";

        if ($newFields['password'] != $newFields['confirmPassword']) {
            $errors = "Les 2 mots de passe sont différents!";
        }

        if (empty($errors)) {
            $subscribe = self::$bdd->prepare("UPDATE $table SET password = ?, dateUpdated = ? WHERE id = ?");
            $subscribe->execute(array(md5($newFields['password']),  date("Y-m-d H:i:s"), $_SESSION['id']));
            $subscribe->closeCursor();
            return $result;
        } else {
            return $errors;
        }
    }

    /**
     * Retrieve information user function
     * @param [type] $table
     * @return void
     */
    private function profile($table)
    {
        $this->getBdd();

        $req = self::$bdd->prepare("SELECT * FROM $table WHERE email = ? ");
        $req->execute(array($_SESSION['email']));
        $user = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $user;
    }

    /**
     * Retrieve user by id function
     * @param [type] $table
     * @param [type] $id
     * @return void
     */
    private function getUserById($table, $id)
    {
        $this->getBdd();

        $req = self::$bdd->prepare("SELECT * FROM $table WHERE id = ? ");
        $req->execute(array($id));
        $user = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $user;
    }

    /**
     * Delete user by id function
     * @param [type] $table
     * @param [type] $id
     * @return void
     */
    private function deleteUserById($table, $id)
    {
        $this->getBdd();
        $result = "L'utilisateur a été supprimé avec succès";

        $req = self::$bdd->prepare("DELETE FROM $table WHERE id = ? ");
        $req->execute(array($id));
        $req->closeCursor();

        return $result;
    }

    /**
     * Modify user by id function
     * @param [type] $table
     * @param [type] $id
     * @return void
     */
    private function modifyUserById($table, $id)
    {
        $this->getBdd();
        $result = "L'utilisateur a été modifié avec succès";

        $req = self::$bdd->prepare("UPDATE $table SET role = 1, dateUpdated = ? WHERE id = ?");
        $req->execute(array(date("Y-m-d H:i:s"), $id));
        $req->closeCursor();

        return $result;
    }

    /**
     * Retrieve all user function
     * @param [type] $table
     * @return void
     */
    private function getAllUsersList($table)
    {
        $this->getBdd();
        $result = [];
        $req = self::$bdd->prepare("SELECT * FROM $table ORDER BY id desc");
        $req->execute();
    
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $data;
        }
        $req->closeCursor();
        
        return $result;
    }

    /**
     * We fill the sessions function
     * @param [type] $user
     * @return void
     */
    private function openSession($user): void
    {
        $_SESSION['id'] = $user['id'];
        $_SESSION['firstName'] = $user["firstName"];
        $_SESSION['lastName'] = $user["lastName"];
        $_SESSION['email'] = $user["email"];
        $_SESSION['password'] = $user["password"];
        $_SESSION['role'] = $user["role"];
        $_SESSION['picture'] = $user["picture"];
        $_SESSION['dateCreated'] = $user["dateCreated"];
        $_SESSION['dateUpdated'] = $user["dateUpdated"];
    }
}