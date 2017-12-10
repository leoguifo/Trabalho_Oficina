<?php include 'header.php'?>
<body class="fundo-body">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 mt-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h5>Editar <?php echo $produto->produto?></h5>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo self::route('editar-post')?>" method="post" id="form-editar">
                            <input type="number" hidden name="id" value="<?php echo $produto->id?>">
                            <div class="form-group">
                                <label>Produto</label>
                                <input type="text" class="form-control" name="produto" value="<?php echo $produto->produto?>">
                            </div>
                            <div class="form-group">
                                <label>Preço</label>
                                <input type="text" class="form-control" name="preco" value="<?php echo $produto->preco?>">
                            </div>
                            <div class="form-group">
                                <label>Desconto (%)</label>
                                <input type="number" class="form-control" name="desconto" value="<?php echo $produto->desconto?>">
                            </div>
                            <div class="form-group">
                                <label>Vendas</label>
                                <input type="number" class="form-control" name="vendas" value="<?php echo $produto->vendas?>">
                            </div>
                    </div>
                    <div class="panel-footer">
                            <button type="submit" class="btn btn-primary w-100">Editar</button>
                        </form>
                    </div>
					<div class="panel-footer">
                        <a href="<?php echo self::route('home')?>" class="btn btn-primary w-100">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>