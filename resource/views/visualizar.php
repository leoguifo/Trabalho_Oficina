<?php include 'header.php'?>
<body class="fundo-body">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 mt-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h5>Visualizando: <?php echo $produto->produto?></h5>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="centralizar img-miniatura">Foto</th>
                                    <th class="centralizar img-miniatura">Produto</th>
                                    <th class="centralizar img-miniatura">Preço</th>
                                    <th class="centralizar img-miniatura">Vendas</th>
                                    <th class="centralizar img-miniatura">Desconto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="<?php echo self::asset('img/produtos/') . $produto->id . '.jpg'?>" class="centralizar img-miniatura"></td>
                                    <td class="centralizar img-miniatura"><?php echo $produto->produto?></td>
                                    <td class="centralizar img-miniatura"><?php echo "R$ " . number_format($produto->preco, 2, ',', '.')?></td>
                                    <td class="centralizar img-miniatura"><?php echo $produto->vendas?></td>
                                    <td class="centralizar img-miniatura"><?php echo $produto->desconto . '%'?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer">
                        <a href="<?php echo self::route('home')?>" class="btn btn-sm btn-primary w-100">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>