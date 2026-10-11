<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Login e Senha</title>
    <link rel="stylesheet" href="assets/css/style.css"> 
</head>
<body>
    <main>
        <h1>CRUD - Login e Senha</h1>
        <div class="container">
            <div class="box">
                <h2>Editar Usuario</h2>
                <table>

                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Usuário</th>
                        <th>Senha</th>
                        <th>Ações</th>
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
                    <form action="acoes.php" method="post">
                        <input type="hidden" name="usuario_id" value="<?=$usuario['id']; ?>">
                        <tr>
                            <td><?=$usuario['id']; ?></td>
                            <td><input type="email" name="email" value="<?=$usuario['email']; ?>" required></td>
                            <td><input type="text" name="usuario" value="<?=$usuario['usuario']; ?>" required></td>
                            <td><input type="password" name="senha" value="<?=$usuario['senha']; ?>" required></td>
                            <td>
                                <button type="submit" name="editar">Editar</button>
                                <button type="submit" name="excluir" value="<?=$usuario['id']; ?>">Excluir</button>
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