<?php

require_once 'views/View.php';

class ControllerHome
{
    private $postManager;
    private $view;

    public function __construct()
    {
        if (isset($url) && count($url) > 1) {
            throw new \Exception("Page introuvable", 1);
        } else {
            $this->posts();
        }
    }

    /**
     * Function to retrieve all posts on the homepage
     * @return void
     */
    private function posts(): void
    {
        $this->postManager = new PostManager();
        $posts = $this->postManager->getPosts();
        $this->view = new View('Home', 'Home');
        $this->view->generate(array('posts' => $posts));
    }
}














 ?>
