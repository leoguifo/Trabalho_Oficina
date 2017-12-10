<?php include 'header.php'?>
<body class="fundo-body">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 mt-5">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h5>Adicionar Produto</h5>
                </div>
                <div class="panel-body">
                    <form action="<?php echo self::route('adicionar-post')?>" method="post" id="form-adicionar" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Produto</label>
                            <input type="text" class="form-control" name="produto" id="produto">
                        </div>
                        <div class="form-group">
                            <label>Preço</label>
                            <input type="text" class="form-control" name="preco" id="preco">
                        </div>
                        <div class="form-group">
                            <label>Desconto (%)</label>
                            <input type="number" class="form-control" name="desconto" id="desconto">
                        </div>
                        <div class="form-group">
                            <label>Vendas</label>
                            <input type="number" class="form-control" name="vendas" id="vendas">
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="foto">
                        </div>
                </div>
                <div class="panel-footer">
						<button type="submit" class="btn btn-primary w-100">Adicionar</button>
                    </form>
                </div>
				<div class="panel-footer">
						<a href="<?php echo self::route('home')?>" class="btn btn-primary w-100">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>