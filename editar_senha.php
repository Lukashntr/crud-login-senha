<?php
include 'mensagem.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Senha</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style-editar.css">
</head>
<body>
    <main>
        <h1>Micro - Editar Senha</h1>
        <p class="paragrafo-editar-senha">Sua senha é criptografada, nunca a compartilhe com ninguém.</p>
        <div class="container">
            <div class="box">
                <h2>Editar Senha</h2>
                <table class="tabela-editar-senha">
                <!-- Cabeçalho da tabela com os títulos das colunas -->
                    <tr class="linha-titulo">
                        <th class="id-editar-senha">Usuario</th>
                        <th class="input-editar-senha">Nova Senha</th>
                        <th class="botoes">Ações</th>
                    <?php

                    // inicia a sessão para acessar as variáveis de sessão
                    session_start();

                    // inclui o arquivo de conexão com o banco de dados
                    require 'config/conexao.php';

                    // Verifica se o ID do usuário está na sessão
                    //var_dump($_SESSION['id']);
                    
                    // Verifica se o ID do usuário foi enviado via POST
                    if (isset($_SESSION['id'])) {

                        $usuario_id = $_SESSION['id'];               // Obtem o ID do usuário a partir do formulário enviado
                        $sql = "SELECT * FROM logins WHERE id = ?";  // Consulta SQL para buscar o usuário com o ID fornecido
                        $stmt = $conn->prepare($sql);                // Prepara a consulta SQL para execução
                        $stmt->bind_param("i", $usuario_id);         // Vincula o parâmetro do ID do usuário à consulta SQL
                        $stmt->execute();                            // Executa a consulta SQL
                        $resultado = $stmt->get_result();            // Obtém o resultado da consulta SQL
                        $usuario = $resultado->fetch_assoc();        // Obtém os dados do usuário como um array associativo

                        // Verifica se o usuário foi encontrado
                        if ($usuario > 0) {

                        //var_dump($_SESSION['id']);
                    ?>
                    <!-- Formulário para editar os dados do usuário -->
                    <form class="formulario-editar" action="acoes.php" method="post">
                        <input type="hidden" name="usuario_id" value="<?=$usuario['id']; ?>">

                        <!-- Linha da tabela com os campos de edição do usuário -->
                        <tr class="linha-editar">
                            <td class="id-editar-senha"><?=$usuario['usuario']; ?></td>
                            <td class="input-editar-senha"><input type="password" name="senhaeditada" placeholder="Digite a nova senha" required></td>
                            <!--<td class="senha"><input type="password" name="senha" value="" required></td>-->
                            <td>
                                <button class="botao-editar-senha" type="submit" name="editar-senha">Salvar</button>
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
        <a class="btn-voltar btn-voltar-senha" href="pagina.php">Voltar</a>
    </main>
</body>
</html>