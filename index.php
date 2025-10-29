    <?php
    include_once('viacep.php');
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Busca CEP</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="container">

            <form action="" method="post">
                <h1>Busca CEP</h1>
                <input type="text" name="cep" placeholder="Digite um CEP" value="<?php echo $adress->cep ?>">
                <input type="submit">
                <input type="text" placeholder="rua" name="rua" value="<?php echo $adress->logradouro ?>">
                <input type="text" placeholder="bairro" name="bairro" value="<?php echo $adress->bairro ?>">
                <input type="text" placeholder="cidade" name="cidade" value="<?php echo $adress->localidade ?>">
                <input type="text" placeholder="uf" name="uf" value="<?php echo $adress->uf ?>">

            </form>

        </div>
        </div>
    </body>

    </html>