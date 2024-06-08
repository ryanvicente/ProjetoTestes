<?php

    namespace App\controllers;

    use Config\Controller\Action;
    use App\Models\CamisaModel;

    class ProdutosController extends Action
    {

        public function Index()
        {
            //Arrumar para MODEL;
            $camisa = new CamisaModel();
            $this->render("Produto/ListaCamisa.phtml","LayoutSite");
        }

    }