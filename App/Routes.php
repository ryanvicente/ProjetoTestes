<?php
    namespace App;

    use Config\Init\Boot;

    class Routes extends Boot
    {
        //Arrays de rotas existentes
        protected function initRoutes()
        {
            $routes['home'] = array
            (
                'route' => '/',
                'controller' => 'HomeController',
                'method' => 'Index'
            );

            $routes['produtos'] = array
            (
                'route' => '/produtos',
                'controller' => 'ProdutosController',
                'method' => 'Index'
            );
            $routes['cadastro'] = array
            (
                'route' => '/cadastro',
                'controller' => 'UsuarioController',
                'method' => 'Cadastro'
            );
            $routes['cadastrar'] = array
            (
                'route' => '/cadastrado',
                'controller' => 'UsuarioController',
                'method' => 'cadastrar'
            );
            $routes['login'] = array
            (
                'route' => '/login',
                'controller' => 'UsuarioController',
                'method' => 'login'
            );
            $routes['logando'] = array
            (
                'route' => '/logando',
                'controller' => 'UsuarioController',
                'method' => 'logar'
            );
            $routes['areausuario'] = array
            (
                'route' => '/minhaconta',
                'controller' => 'UsuarioController',
                'method' => 'Index'
            );
            $routes['desconectar'] = array
            (
                'route' => '/logout',
                'controller' => 'UsuarioController',
                'method' => 'deslogar'
            );
            $routes['editarinformacao'] = array
            (
                'route' => '/editarinformacao',
                'controller' => 'UsuarioController',
                'method' => 'editar'
            );
            $routes['editado'] = array
            (
                'route' => '/editado',
                'controller' => 'UsuarioController',
                'method' => 'editando'
            );

            //chamando  o metodo no pai
            parent::setRoutes($routes);
        }

    }