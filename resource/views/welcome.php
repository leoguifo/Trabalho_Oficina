<?php include 'header.php'?>
<body class="fundo-body">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <table class="table table-striped table-hover table-bordered mt-5">
                    <thead>
                        <tr>
                            <th class="centralizar img-miniatura">
                                Imagem
                            </th>
                            <th class="centralizar img-miniatura">
                                Produto
                            </th>
                            <th class="centralizar img-miniatura">
                                Preço
                            </th>
                            <th class="centralizar img-miniatura">
                                Desconto
                            </th>
                            <th class="centralizar img-miniatura">
                                Vendas
                            </th>
                            <th class="centralizar img-miniatura">
                                Preço com Desconto
                            </th>
                            <th class="centralizar img-miniatura">
                                <a href="<?php echo self::route('adicionar-get')?>" class="btn btn-success btn-xs w-100">Adicionar</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($produtos as $p):?>
                        <tr>
                            <td><img src="<?php echo self::asset('img/produtos/') . $p->id . '.jpg'?>" class="centralizar img-miniatura"></td>
                            <td class="centralizar img-miniatura">
                                <?php echo $p->produto?>
                            </td>
                            <td class="centralizar img-miniatura">
                                <?php echo "R$ " . number_format($p->preco, 2, ',', '.')?>
                            </td>
                            <td class="centralizar img-miniatura">
                                <?php echo $p->desconto . "%"?>
                            </td>
                            <td class="centralizar img-miniatura">
                                <?php echo $p->vendas. " un."?>
                            </td>
                            <td class="centralizar img-miniatura">
                                <?php echo "R$ " . number_format($p->preco_desconto, 2, ',', '.')?>
                            </td>
                            <td class="img-miniatura centralizar">
                                <a href="<?php echo self::route('editar-get') . $p->id?>" class="btn btn-warning btn-xs w-100">Editar</a>
                                <a href="<?php echo self::route('excluir') . $p->id?>" class="btn btn-danger btn-xs w-100">Excluir</a>
                                <a href="<?php echo self::route('visualizar') . $p->id?>" class="btn btn-info btn-xs w-100">Visualizar</a>
                                <a href="<?php echo self::route('adicionar-venda') . $p->id ?>" class="btn btn-default btn-xs w-100">Vender 1 Un.</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>