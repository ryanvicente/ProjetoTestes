<?php

    namespace App\controllers;
    
    use Config\Controller\Action;

    class HomeController extends Action
    {
        protected $dados = null;
        
        public function Index()
        {
            //chamando a função para renderizar;
            $this->render("Index/Index.phtml", "LayoutSite");
        }
    }
