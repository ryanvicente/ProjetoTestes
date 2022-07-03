<?php

    namespace App\controllers;

    class Erro_404Controller
    {
        public function erro404()
        {
            //chamando a view
            require_once("../App/Views/Error/Index.phtml");
        }
    }
