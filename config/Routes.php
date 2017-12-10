<?php


    //rota, metodo(get ou post), controller@funcao, nome(opcional), middleware(opcional)
    $routes = [
        [
            '/', 'get', 'Controller@welcome', 'home'
        ],
        [
            '/adicionar', 'get', 'Controller@adicionarView', 'adicionar-get'
        ],
        [
            '/adicionar', 'post', 'Controller@adicionar', 'adicionar-post'
        ],
        [
            '/editar/{id}', 'get', 'Controller@editarGet', 'editar-get'
        ],
        [
            '/editar', 'post', 'Controller@editar', 'editar-post'
        ],
        [
            '/excluir/{id}', 'get', 'Controller@excluir', 'excluir'
        ],
        [
            '/visualizar/{id}', 'get', 'Controller@visualizar', 'visualizar'
        ],
        [
            '/adicionar_venda/{id}', 'get', 'Controller@adicionarVenda', 'adicionar-venda'
        ]
    ];