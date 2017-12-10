<?php 

namespace App\Controller;

use App\Model\Produtos;
use Framework\View\View;
use Framework\Database\Database;
use Framework\Helper\Helper;
use Framework\Router\Route;
use GD;

class Controller {

    public static function welcome(){
        $produtos = new Produtos();

        $produtos = $produtos->all();

        foreach($produtos as $p){
            $p->preco_desconto = $p->preco - ($p->preco / 100 * $p->desconto);
        }

        return View::make('welcome', ['produtos' => $produtos]);
    }

    public static function adicionarView(){
        return View::make('adicionar');
    }

    public static function adicionar($request){
        $produto = new Produtos();

        $produto->insert(['produto' => $request->produto,
                          'preco' => $request->preco,
                          'desconto' => $request->desconto,
                          'vendas' => $request->vendas]);

        $imagemTmp = imagecreatefromjpeg($_FILES['foto']['tmp_name']);
        imagejpeg($imagemTmp, $_SERVER['DOCUMENT_ROOT'] . Helper::getUrlRoot() . '/public/img/produtos/' . $produto->lastedId() . '.jpg', 100);
        imagedestroy($imagemTmp);

        return Route::redirect('home');
    }

    public static function editarGet($id){
        $produto = new Produtos();

        $produto = $produto->find($id);

        if(!$produto){
            return View::make('404');
        }

        return View::make('editar', ['produto' => $produto]);
    }

    public static function editar($request){
        $produto = new Produtos();

        $produto->update(['produto' => $request->produto,
                          'preco' => $request->preco,
                          'estoque' => $request->estoque,
                          'vendas' => $request->vendas])->where('id', '=', $request->id)->get();

        return Route::redirect('home');
    }

    public static function excluir($id){
        $produto = new Produtos();

        $produto->excluir($id);

        return Route::redirect('home');
    }

    public static function visualizar($id){
        $produto = new Produtos();

        $produto = $produto->find($id);

        if(!$produto){
            return View::make('404');
        }

        return View::make('visualizar', ['produto' => $produto]);
    }

    public static function adicionarVenda($id){
        $produto = new Produtos();

        $venda= $produto->find($id);

        $vendas = (int)$venda->vendas;

        $vendas++;

        $produto->update(['vendas' => $vendas])->where('id', '=', $id)->get();

        return Route::redirect('home');
    }
}