<?php

class View
{
    //Fichier vue
    private $file;

    //Titre de la page
    private $title;

    function __construct($action, /*$title*/)
    {
        $this->file = 'views/view'.$action.'.php';
        //$this->title = $title;
    }

    /**
     * Generate and display the view of all posts and pages function
     * @param [type] $data
     * @return void
     */
    public function generate($data)
    {
        //Définir le contenu à envoyer
        $content = $this->generateFile($this->file, $data);

        //Template
        $view = $this->generateFile('views/template.php', array('title' => $this->title, 'content' => $content));
        echo $view;
    }

    /**
     * Generate the view of an article template function
     * @param [type] $data
     * @return void
     */
    public function generatePost($data)
    {
        //Féfinir le contenu à envoyer
        $content = $this->generateFile($this->file, $data);

        //Template
        $view = $this->generateFile('views/templateSingle.php', array('title' => $this->title, 'content' => $content));
        echo $view;
    }

    /**
     * Generate template file and start&stop processing
     * @param [type] $file
     * @param [type] $data
     * @return void
     */
    private function generateFile($file, $data)
    {
        if (file_exists($file)) {
            extract($data);

            //Commencer la temporisation
            ob_start();
            require $file;

            //Arrêter la temporisation
            return ob_get_clean();
        } else {
            throw new \Exception("Fichier ".$file." introuvable", 1);
        }
    }
}

