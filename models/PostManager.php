<?php

class PostManager extends Model
{
    /**
     * Retrieve all posts function
     * @return void
     */
    public function getPosts()
    {
        return $this->getAll('post', 'Post');
    }

    /**
     * Retrieve one post function
     * @param [type] $id
     * @return void
     */
    public function getPost($id)
    {
        return $this->getOne('post', 'Post', $id);
    }

    /**
     * Delete post function
     * @param [type] $id
     * @return void
     */
    public function deletePost($id)
    {
        return $this->deletePostById('post', $id);
    }

    /**
     * Create post function
     * @return void
     */
    public function addPost()
    {
        return $this->addPostAction('post');
    }

    /**
     * Retrieve post for edit function
     * @param [type] $id
     * @return void
     */
    public function modifyPost($id)
    {
        return $this->modifyPostById('post', $id);
    }

    /**
     * Edit post function
     * @param [type] $id
     * @return void
     */
    public function editPostAction($id)
    {
        return $this->modifyPostByIdAction('post', $id);
    }

    /**
     * Retrieve all posts function
     * @param [type] $table
     * @param [type] $obj
     * @return void
     */
    private function getAll($table)
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
     * Retrieve one post function
     * @param [type] $table
     * @param [type] $obj
     * @param [type] $id
     * @return void
     */
    private function getOne($table, $obj, $id)
    {
        $this->getBdd();

        $req = self::$bdd->prepare("SELECT * FROM $table WHERE id = ?");
        $req->execute(array($id));

        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $result = $data;
        }
        $req->closeCursor();

        return $result;
    }

    /**
     * Delete post function
     * @param [type] $table
     * @param [type] $id
     * @return void
     */
    private function deletePostById($table, $id)
    {
        $this->getBdd();
        $result = "L'article a été supprimé avec succès";

        $req = self::$bdd->prepare("DELETE FROM $table WHERE id = ? ");
        $req->execute(array($id));
        $req->closeCursor();

        return $result;
    }

    /**
     * Retrieve post for edit function
     * @param [type] $table
     * @param [type] $id
     * @return void
     */
    private function modifyPostById($table, $id) 
    {
        $this->getBdd();

        $req = self::$bdd->prepare("SELECT * FROM $table WHERE id = ? ");
        $req->execute(array($id));
        $post = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $post;
    }

    /**
     * Edit post function
     * @param [type] $table
     * @param [type] $id
     * @return void
     */
    private function modifyPostByIdAction($table, $id)
    {
        $this->getBdd();
        $newFields = array_map ('htmlspecialchars' , $_POST);
        $result = "L'article a été modifié avec succès";

        $req = self::$bdd->prepare("UPDATE $table SET id_category = ?, title = ?, content = ?, chapo = ?, dateUpdated = ? WHERE id = ?");
        $req->execute(array($newFields['category'], $newFields['title'], $newFields['content'], $newFields['chapo'], date("Y-m-d H:i:s"), $id));
        $req->closeCursor();

        return $result;
    }

    /**
     * Create post function
     * @param [type] $table
     * @return void
     */
    private function addPostAction($table)
    {
        $this->getBdd();
        $newFields = array_map ('htmlspecialchars' , $_POST);
        $result = "L'article a été ajouté avec succès";

        $req = self::$bdd->prepare("INSERT INTO $table (id_user, id_category, title, content, chapo, dateCreated) VALUES (?, ?, ?, ?, ?, ?)");
        $req->execute(array($newFields['idUser'], $newFields['category'], $newFields['title'], $newFields['content'], $newFields['chapo'], date("Y-m-d H:i:s")));
        $req->closeCursor();

        return $result;
    }
}