<?php

require_once 'views/View.php';

class ControllerService
{
    private $serviceManager;
    private $view;

    public function __construct()
    {
        if (isset($url) && count($url) > 1) {
            throw new \Exception("Page introuvable", 1);
        } elseif (isset($_GET['contact'])) {
            $this->contact();
        } elseif (isset($_GET['contactSend']) && $_GET['contactSend'] == 'action') {
            $this->contactAction();
        } else {
            $this->view = new View('Error');
            $this->view->generate(array());
        }
    }

    /**
     * Function displays the contact page
     * @return void
     */
    private function contact($infos = null): void
    {
        $this->serviceManager = new ServiceManager();
        $this->view = new View('Contact', 'Register');
        $this->view->generate(array());
    }

    /**
     * Function send the email of the contact form
     * @return void
     */
    private function contactAction(): void
    {
        if (!empty($_POST)) {
            $this->serviceManager = new ServiceManager();
            $result = $this->serviceManager->contactAction();
            $this->view = new View('Contact');
            $this->view->generate(array('result' => $result));
        } else {
            header('Location: service&contact');
        }
    }
}