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
    <link rel="stylesheet" href="assets/css/style-pagina.css">
</head>
<body>
    <main>

        <h1 class="titulo-pagina"> BEM VINDO </h1>
        <section class="container">
            <div class="box">
                <p class="mensagem">
                    Bem vindo a micro, a sua rede social rapida e segura, aqui você pode compartilhar suas ideias, pensamentos e se conectar com pessoas de todo o mundo. Aproveite a experiência e divirta-se!
                </p>
                <p>
                    Seus dados são criptografados para garantir a sua privacidade e segurança.
                </p>
            </div>
            <div>
                <form action="acoes.php" method="post">
                    <button class="btn-pagina" type="submit" name="logout" value="Sair"> Sair</button>
                </form>
                <?php

                    // Inicia a sessão e inclui o arquivo de conexão com o banco de dados
                    session_start();
                    require 'config/conexao.php';
                    
                    // Consulta SQL para buscar o usuário logado no banco de dados
                    $sql = "SELECT * FROM logins";
                    $query = mysqli_query($conn, $sql);
                    $usuario = mysqli_fetch_assoc($query);


                    // Verifica se o usuário foi encontrado e exibe os dados na tela
                    if ($usuario) {
                        echo "<form class='formulario-editar' action='editar.php' method='post'>";
                        echo "<input class='input-hidden' type='hidden' name='usuario_id' value='" . $usuario['id'] . "'>";
                        echo "<button class='botao-editar' type='submit' name='editar'>Editar</button>";
                        echo "</form>";
                        echo "<form class='formulario-visualizar' action='visualizar.php' method='post'>";
                        echo "<input class='input-hidden' type='hidden' name='usuario_id' value='" . $usuario['id'] . "'>";
                        echo "<button class='botao-visualizar' type='submit' name='visualizar'>Visualizar</button>";
                        echo "</form>";
                        echo "<p>Usuário logado: " . $usuario['usuario'] . "</p>";
                        echo "<p>Email: " . $usuario['email'] . "</p>";
                        echo "<p>id: " . $usuario['id'] . "</p>";
                    } else {
                        echo "<p>Nenhum usuário logado.</p>";
                    }
                ?>

            </div>
        </section>

    </main>
</body>
</html>