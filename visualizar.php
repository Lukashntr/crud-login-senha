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
        <section>
            <div>
                <h1>micro - visualizar</h1>
            </div>
            <div>
                <?php
                    session_start();
                    require 'config/conexao.php';

                    $sql = "SELECT * FROM logins";
                    $query = mysqli_query($conn, $sql);
                    $usuario = mysqli_fetch_assoc($query);

                    if ($usuario) {
                        echo "<p>Usuário: " . $usuario['usuario'] . "</p>";
                        echo "<p>Email: " . $usuario['email'] . "</p>";
                    } else {
                        echo "<p>Nenhum usuário encontrado.</p>";
                    }
                ?>
            </div>
            <div>
                <form action="acoes.php" method="post">
                    <button type="submit" name="logout" value="Sair"> Sair</button>
                </form>
            </div>
        </section>
    </main>
</body>