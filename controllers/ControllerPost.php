<?php

require_once 'views/View.php';

class ControllerPost
{
    private $postManager;
    private $userManager;
    private $commentManager;
    private $categoryManager;
    private $view;

    public function __construct()
    {
        if (isset($url) && count($url) < 1) {
            throw new \Exception("Page Introuvable");
        } elseif (isset($_GET['home'])) {
            $this->getPosts();
        } elseif (isset($_GET['addComment']) && $_GET['addComment'] == "action") {
            $this->addCommentAction();
        } elseif (isset($_GET['id'])) {
            $this->getPost();
        } else {
            $this->view = new View('Error');
            $this->view->generate(array());
        }
    }

    /**
     * Function to retrieve all posts on the homepage
     * @return void
     */
    private function getPosts(): void
    {
        $this->postManager = new PostManager;
        $posts = $this->postManager->getPosts();
        $this->view = new View('Home');
        $this->view->generate(array('posts' => $posts));
    }

    /**
     * Retrieve post page detail function
     * @return void
     */
    private function getPost($infos = null): void
    {
        if (isset($_GET['id'], $_GET['id'])) {
            $this->postManager = new PostManager;
            $post = $this->postManager->getPost($_GET['id']);
        
            $this->userManager = new UserManager;
            $user = $this->userManager->getUser($post['id_user']);

            $this->categoryManager = new CategoryManager;
            $category = $this->categoryManager->getCategory($post['id_category']);

            $this->commentManager = new CommentManager;
            $comments = $this->commentManager->getCommentsPost($_GET['id']);
        
            $this->view = new View('SinglePost');
            $this->view->generatePost(array('infos' => $infos ,'post' => $post, 'user' => $user, 'category' => $category, 'comments' => $comments));
        }
    }

    /**
     * Add comment page detail function
     * @return void
     */
    private function addCommentAction(): void
    {
        if (!empty($_POST)) {
            $this->commentManager = new CommentManager();
            $result = $this->commentManager->addCommentAction();
            $_SESSION['success'] = "Merci! votre commentaire est en attente d'approbation";
            header('Location: post&id='.$_POST['id_post']);
        } else {
            header('Location: post&id='.$_POST['id_post']);
        }
    }
}
