<?php
session_start();
require 'acoes.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <main>

        <h1> BEM VINDO </h1>
        <section class="container">
            <div>
                <p>
                    blog teste, parabens consegui fazer o login!!
                </p>
            </div>
            <div>
                <form action="acoes.php" method="post">
                    <button class="btn-pagina" type="submit" name="logout" value="Sair"> Sair</button>
                </form>
                <?php

                    if (isset($_SESSION['id'])) {
                        echo '<a href="editar.php?id=' . $_SESSION['id'] . '">Editar</a>';
                    } else {
                        echo "ID não definido na sessão!";
                    }
                ?>

            </div>
        </section>

    </main>
</body>
</html>