<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Login e Senha</title>
    <link rel="stylesheet" href="assets/css/style-visualizar.css">
</head>
<body>
    <main>
        <section>
            <div>
                <h1>micro - visualizar</h1>
            </div>
            <div>
                <?php
                    session_start();
                    require 'config/conexao.php';

                    // Verifica se o usuário está logado
                    $id = $_POST['usuario_id'];                     // Obtem o ID do usuário a partir do formulário enviado
                    $sql = "SELECT * FROM logins WHERE id = $id";   // Consulta SQL para buscar o usuário com o ID fornecido
                    $query = mysqli_query($conn, $sql);             // Executa a consulta SQL no banco de dados
                    $usuario = mysqli_fetch_assoc($query);          // Obtém os dados do usuário como um array associativo

                    // Verifica se o usuário foi encontrado
                    if ($usuario) { // Verifica se o usuário foi encontrado

                        // Exibe os dados do usuário na tela
                        echo "<p class='p-visualizar'>ID: " . $usuario['id'] . "</p>";
                        echo "<p class='p-visualizar'>Usuário: " . $usuario['usuario'] . "</p>";
                        echo "<p class='p-visualizar'>Email: " . $usuario['email'] . "</p>";
                    } else {
                        echo "<p>Nenhum usuário encontrado.</p>";
                    }
                ?>
            </div>
            <div>
                
                <!-- Formulário para logout e botão de voltar -->
                <form action="acoes.php" method="post">
                    <button type="submit" name="logout" value="Sair"> Sair</button>
                </form>

                <!-- Botão de voltar para a página principal -->
                <a class="btn-voltar" href="pagina.php">Voltar</a>
            </div>
        </section>
    </main>
</body>