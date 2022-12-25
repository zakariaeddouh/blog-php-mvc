<?php

class CategoryManager extends Model
{
    /**
     * Retrieve categorie function by id
     * @param [type] $id
     * @return void
     */
    public function getCategory($id)
    {
        return $this->getCategoryById('category', $id);
    }

    /**
     * Retrieve all categories function
     * @return void
     */
    public function getAllCategory()
    {
        return $this->getAllCategories('category');
    }

    /**
     * Retrieve categorie function by id
     * @param [type] $table
     * @param [type] $id
     * @return void
     */
    private function getCategoryById($table, $id)
    {
        $this->getBdd();

        $req = self::$bdd->prepare("SELECT * FROM $table WHERE id = ? ");
        $req->execute(array($id));
        $category = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $category;
    }

    /**
     * Retrieve all categories function
     * @param [type] $table
     * @return void
     */
    private function getAllCategories($table)
    {
        $this->getBdd();
        $result = [];
        
        $req = self::$bdd->prepare("SELECT * FROM $table");  
        $req->execute();      
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $data;
        }
        $req->closeCursor();

        return $result;
    }
}