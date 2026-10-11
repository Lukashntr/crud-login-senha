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
                    session_start();
                    require 'config/conexao.php';
                                         
                    if (isset($_GET['id'])) {
                        $alunos_id = mysqli_real_escape_string($conn, $_GET['id']);
                        $sql = "SELECT * FROM logins WHERE id = '$alunos_id'";
                        $query = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($query) > 0) {
                            $aluno = mysqli_fetch_array($query);
                    ?>
                    <form action="acoes.php" method="post">
                        <input type="hidden" name="usuario_id" value="<?=$aluno['id']; ?>">
                        <tr>
                            <td><?=$aluno['id']; ?></td>
                            <td><input type="email" name="email" value="<?=$aluno['email']; ?>" required></td>
                            <td><input type="text" name="usuario" value="<?=$aluno['usuario']; ?>" required></td>
                            <td><input type="password" name="senha" value="<?=$aluno['senha']; ?>" required></td>
                            <td>
                                <button type="submit" name="editar">Editar</button>
                                <button type="submit" name="excluir" value="<?=$aluno['id']; ?>">Excluir</button>
                            </td>
                        </tr>
                    </form>

                    <?php
                        } else {
                            echo "<h5>Aluno não encontrado.<h5>";
                            }
                        }
                    ?>
                </table>
            </div>           
        </div>
    </main>
</body>
</html>