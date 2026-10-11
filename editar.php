<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Login e Senha</title>
    <link rel="stylesheet" href="assets/css/style-editar.css"> 
</head>
<body>
    <main>
        <h1>CRUD - Login e Senha</h1>
        <div class="container">
            <div class="box">
                <h2>Editar Usuario</h2>
                <table class="tabela-editar">

                    <tr class="linha-titulo">
                        <th class="id">ID</th>
                        <th class="email">Email</th>
                        <th class="usuario">Usuário</th>
                        <th class="senha">Senha</th>
                        <th class="acoes">Ações</th>
                    </tr>
                    <?php
                    require 'config/conexao.php';

                    if (isset($_POST['usuario_id'])) {

                        $usuario_id = $_POST['usuario_id'];
                        $sql = "SELECT * FROM logins WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $usuario_id);
                        $stmt->execute();
                        $resultado = $stmt->get_result();
                        $usuario = $resultado->fetch_assoc();

                        if ($usuario > 0) {

                    ?>
                    <form class="formulario-editar" action="acoes.php" method="post">
                        <input type="hidden" name="usuario_id" value="<?=$usuario['id']; ?>">
                        <tr class="linha-editar">
                            <td class="id"><?=$usuario['id']; ?></td>
                            <td class="email"><input type="email" name="email" value="<?=$usuario['email']; ?>" required></td>
                            <td class="usuario"><input type="text" name="usuario" value="<?=$usuario['usuario']; ?>" required></td>
                            <td class="senha"><input type="password" name="senha" value="<?=$usuario['senha']; ?>" required></td>
                            <td>
                                <button class="botao-editar" type="submit" name="editar">Editar</button>
                                <button class="botao-excluir" type="submit" name="excluir" value="<?=$usuario['id']; ?>">Excluir</button>
                                <a class="btn-voltar" href="pagina.php">Voltar</a>
                            </td>
                        </tr>
                    </form>

                    <?php
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