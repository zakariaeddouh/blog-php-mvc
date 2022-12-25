<?php

require_once 'views/View.php';

class ControllerUser
{
    private $userManager;
    private $postManager;
    private $view;

    public function __construct()
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception("Page Introuvable");
        } elseif (isset($_GET['register'])) {
            $this->register();
        } elseif (isset($_GET['userRegister']) && isset($_GET['userRegister']) == "action") {
            $this->userRegisterAction();
        } elseif (isset($_GET['connect'])) {
            $this->connect();
        } elseif (isset($_GET['userConnect']) && isset($_GET['userConnect']) == "action") {
            $this->userConnectAction();
        } elseif (isset($_GET['disconnect'])) {
            $this->disconnectAction();
        } elseif (isset($_GET['profile'])) {
            $this->profile();
        } elseif (isset($_GET['userEditName']) && isset($_GET['userEditName']) == "action") {
            $this->userEditNameAction();
        } elseif (isset($_GET['userEditPassword']) && isset($_GET['userEditPassword']) == "action") {
            $this->userEditPasswordAction();
        } else {
            $this->view = new View('Error');
            $this->view->generate(array());
        }
    }

    /**
     * Register user show page function
     * @return void
     */
    private function register($infos = null): void
    {
        if (isset($_GET['register']) || isset($_GET['userRegister'])) {
            $this->view = new View('Register');
            $this->view->generate(array('errors' => $infos));
        }
    }

    /**
     * Register user action function
     * @return void
     */
    private function userRegisterAction(): void
    {
        if (!empty($_POST)) {
            $this->userManager = new UserManager();
            $result = $this->userManager->registerAction();
            if (null !== $result) {
                $this->register($result);
            } else {
                $success = "Merci de nous avoir rejoint!";
                $this->connect($success);
            }
        } else {
            $this->register();
        }
    }

    /**
     * Connect user show page connection function
     * @param [type] $infos
     * @return void
     */
    private function connect($infos = null): void
    {   
        if (isset($_GET['connect']) || isset($_GET['userRegister']) || isset($_GET['userConnect']) || isset($_GET['disconnect'])) {
            if (empty($_SESSION)) {
                $this->view = new View('Connect');
                $this->view->generate(array('success' => $infos));
            } else {
                header('Location: user&profile');
            }
        }
    }

    /**
     * Connect user action function
     * @return void
     */
    private function userConnectAction(): void
    {
        if (!empty($_POST)) {
            $this->userManager = new UserManager();
            $result = $this->userManager->connectAction();
            if (gettype($result) == 'array') {
                $this->postManager = new PostManager;
                $posts = $this->postManager->getPosts();
                $this->view = new View('Home');
                $this->view->generate(array('posts' => $posts));
            } else {
                $this->connect($result);
            }
        } elseif (empty($_SESSION)) { 
            $this->connect();
        } else {
            header('Location: post&home');
        }
    }
    
    /**
     * Logout function
     * @return void
     */
    private function disconnectAction(): void
    {
        session_destroy();
        header('Location: user&connect');
    }

    /**
     * Retrieve information user page profile function
     * @param [type] $infos
     * @return void
     */
    private function profile($infos = null, $user = null): void
    {
        if (isset($_GET['profile']) || isset($_GET['userEditName']) || isset($_GET['userEditPassword'])) {
            if (!empty($_SESSION)) {
                $this->userManager = new UserManager();
                $user = $this->userManager->profileAction();
                $this->view = new View('Profile');
                $this->view->generate(array('success' => $infos, 'user' => $user));
            } else {
                header('Location: user&connect');
            }
        }
    }

    /**
     * Edit information user function
     * @return void
     */
    private function userEditNameAction(): void
    {
        if (!empty($_POST)) {
            $this->userManager = new UserManager();
            $result = $this->userManager->userEditNameAction();
            $this->profile($result);
        } else {
            $this->profile();
        }
    }

    /**
     * Edit password user function
     * @return void
     */
    private function userEditPasswordAction(): void
    {
        if (!empty($_POST)) {
            $this->userManager = new UserManager();
            $result = $this->userManager->userEditPasswordAction();
            $this->profile($result);
        } else {
            $this->profile();
        }
    }
}