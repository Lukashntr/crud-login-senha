<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="assets/css/style-editar.css"> 
</head>
<body>
    <main>
        <h1>Micro - Editar Usuário</h1>
        <div class="container">
            <div class="box">
                <h2>Editar Usuario</h2>
                <table class="tabela-editar">

                <!-- Cabeçalho da tabela com os títulos das colunas -->
                    <tr class="linha-titulo">
                        <th class="id">ID</th>
                        <th class="email">Email</th>
                        <th class="usuario">Usuário</th>
                        <!-- <th class="senha">Senha</th> -->
                        <th class="acoes">Ações</th>
                    </tr>

                    <?php
                    // inclui o arquivo de conexão com o banco de dados
                    require 'config/conexao.php';

                    // Verifica se o ID do usuário foi enviado via POST
                    if (isset($_POST['usuario_id'])) {

                        $usuario_id = $_POST['usuario_id'];          // Obtem o ID do usuário a partir do formulário enviado
                        $sql = "SELECT * FROM logins WHERE id = ?";  // Consulta SQL para buscar o usuário com o ID fornecido
                        $stmt = $conn->prepare($sql);                // Prepara a consulta SQL para execução
                        $stmt->bind_param("i", $usuario_id);         // Vincula o parâmetro do ID do usuário à consulta SQL
                        $stmt->execute();                            // Executa a consulta SQL
                        $resultado = $stmt->get_result();            // Obtém o resultado da consulta SQL
                        $usuario = $resultado->fetch_assoc();        // Obtém os dados do usuário como um array associativo

                        // Verifica se o usuário foi encontrado
                        if ($usuario > 0) {

                    ?>
                    <!-- Formulário para editar os dados do usuário -->
                    <form class="formulario-editar" action="acoes.php" method="post">
                        <input type="hidden" name="usuario_id" value="<?=$usuario['id']; ?>">

                        <!-- Linha da tabela com os campos de edição do usuário -->
                        <tr class="linha-editar">
                            <td class="id"><?=$usuario['id']; ?></td>
                            <td class="email"><input type="email" name="email" value="<?=$usuario['email']; ?>" required></td>
                            <td class="usuario"><input type="text" name="usuario" value="<?=$usuario['usuario']; ?>" required></td>
                            <!-- <td class="senha"><input type="password" name="senha" value="<?=$usuario['senha']; ?>" required></td> -->
                            <td>

                                <!-- Botões para editar, excluir e voltar -->
                                <button class="botao-editar" type="submit" name="editar">Editar</button>
                                <button class="botao-excluir" type="submit" name="excluir" value="<?=$usuario['id']; ?>">Excluir</button>
                                <a class="btn-voltar" href="pagina.php">Voltar</a>
                            </td>
                        </tr>
                    </form>

                    <?php

                        // Se o usuário não for encontrado, exibe uma mensagem de erro
                        } else {
                            echo "<h5>Usuario não encontrado.<h5>";
                        }
                    }
                    ?>
                </table>
            </div>           
        </div>
    </main>
</body>
</html>