<?php

require_once 'views/View.php';

class ControllerAdmin
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
        } elseif (isset($_GET['userManagement']) && $_SESSION['role'] == 1) {
            $this->userManagement();
        } elseif (isset($_GET['postManagement']) && $_SESSION['role'] == 1) {
            $this->postManagement();
        } elseif (isset($_GET['commentManagement']) && $_SESSION['role'] == 1) {
            $this->commentManagement();
        } elseif (isset($_GET['deleteUser']) && $_SESSION['role'] == 1) {
            $this->deleteUserAction();
        } elseif (isset($_GET['modifyUser']) && $_SESSION['role'] == 1) {
            $this->modifyUserAction();
        } elseif (isset($_GET['deletePost']) && $_SESSION['role'] == 1) {
            $this->deletePostAction();
        } elseif (isset($_GET['validateComment']) && $_SESSION['role'] == 1) {
            $this->validateCommentAction();
        } elseif (isset($_GET['deleteComment']) && $_SESSION['role'] == 1) {
            $this->deleteCommentAction();
        } elseif (isset($_GET['newPost']) && $_SESSION['role'] == 1) {
            $this->newPost();
        } elseif (isset($_GET['addPost']) && $_GET['addPost'] == "action" && $_SESSION['role'] == 1) {
            $this->addPostAction();
        } elseif (isset($_GET['modifyPost']) && $_SESSION['role'] == 1) {
            $this->modifyPost();
        } elseif (isset($_GET['editPost']) && $_GET['editPost'] == "action" && $_SESSION['role'] == 1) { 
            $this->editPostAction();
        } else {
            header('Location: home');
        }
    }

    /**
     * Retrieve all users for admin function
     * @return void
     */
    private function userManagement(): void
    {
        $this->userManager = new UserManager();
        $users = $this->userManager->getAllUsers();
        $this->view = new View('UserManagement');
        $this->view->generate(array('users' => $users));
    }

    /**
     * Retrieve all posts for admin function
     * @return void
     */
    private function postManagement(): void
    {
        $this->postManager = new PostManager();
        $posts = $this->postManager->getPosts();
        $this->view = new View('PostManagement');
        $this->view->generate(array('posts' => $posts));
    }

    /**
     * Retrieve all comments for admin function
     * @return void
     */
    private function commentManagement(): void
    {
        $this->commentManager = new CommentManager();
        $comments = $this->commentManager->getCommentsNotActived();
        $this->view = new View('CommentManagement');
        $this->view->generate(array('comments' => $comments));
    }

    /**
     * Delete user function
     * @return void
     */
    private function deleteUserAction(): void
    {
        if (isset($_GET['id'], $_GET['id'])) {
            $this->userManager = new UserManager();
            $result = $this->userManager->deleteUser($_GET['id']);
            header('Location: admin&userManagement');
        }
    }

    /**
     * Edit role user function
     * @return void
     */
    private function modifyUserAction(): void
    {
        if (isset($_GET['id'], $_GET['id'])) {
            $this->userManager = new UserManager();
            $result = $this->userManager->modifyUser($_GET['id']);
            header('Location: admin&userManagement');
        }
    }

    /**
     * Delete post function
     * @return void
     */
    private function deletePostAction(): void
    {
        if (isset($_GET['id'], $_GET['id'])) {
            $this->postManager = new PostManager();
            $result = $this->postManager->deletePost($_GET['id']);
            header('Location: admin&postManagement');
        }
    }

    /**
     * Validate comment function
     * @return void
     */
    private function validateCommentAction(): void
    {
        if (isset($_GET['id'], $_GET['id'])) {
            $this->commentManager = new CommentManager();
            $result = $this->commentManager->validateComment($_GET['id']);
            header('Location: admin&commentManagement');
        }
    }

    /**
     * Delete comment function
     * @return void
     */
    private function deleteCommentAction(): void
    {
        if (isset($_GET['id'], $_GET['id'])) {
            $this->commentManager = new CommentManager();
            $result = $this->commentManager->deleteComment($_GET['id']);
            header('Location: admin&commentManagement');
        }
    }

    /**
     * Create a new post function
     * @return void
     */
    private function newPost(): void
    {
        $this->categoryManager = new CategoryManager();
        $categories = $this->categoryManager->getAllCategory();
        $this->view = new View('NewPost');
        $this->view->generate(array('categories' => $categories));
    }

    /**
     * Create a new post action function
     * @return void
     */
    private function addPostAction(): void
    {
        if (!empty($_POST)) {
            $this->postManager = new PostManager();
            $result = $this->postManager->addPost();
            header('Location: admin&postManagement');
        } else {
            header('Location: admin&newPost');
        }
    }

    /**
     * Edit post function
     * @return void
     */
    private function modifyPost(): void
    {
        if (isset($_GET['id'], $_GET['id'])) {
            $this->postManager = new PostManager();
            $post = $this->postManager->modifyPost($_GET['id']);
            $this->categoryManager = new CategoryManager();
            $categories = $this->categoryManager->getAllCategory();
            $this->view = new View('ModifyPost');
            $this->view->generate(array('post' => $post, 'categories' => $categories));
            header('Location: admin&postManagement');
        }
    }

    /**
     * Edit post action function
     * @return void
     */
    private function editPostAction(): void
    {
        if (!empty($_POST)) {
            $this->postManager = new PostManager();
            $result = $this->postManager->editPostAction($_POST['idPost']);
            header('Location: admin&postManagement');
        } else {
            header('Location: admin&modifyPost&id='.$_GET['id']);
        }
    }
}