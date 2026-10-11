<?php
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
                    session_start();
                    require 'config/conexao.php';

                    $sql = "SELECT * FROM logins";
                    $query = mysqli_query($conn, $sql);

                    $usuario = mysqli_fetch_assoc($query);
                    //echo "Dados do usuário: " . $usuario['id'] . " - " . $usuario['usuario'] . "<br>";
                    if ($usuario) {
                        echo "<form action='editar.php' method='post'>";
                        echo "<input type='hidden' name='usuario_id' value='" . $usuario['id'] . "'>";
                        echo "<button type='submit' name='editar'>Editar</button>";
                        echo "</form>";
                        echo "Usuário logado: " . $_SESSION['usuario'] . "<br>";
                    } else {
                        echo "Nenhum usuário logado.";
                    }
                ?>

            </div>
        </section>

    </main>
</body>
</html>