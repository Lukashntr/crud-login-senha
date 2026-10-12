<?php
require 'acoes.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="assets/css/style-index.css">
</head>
<body>
    <main>
        <h1>Micro - Login</h1>
        <div class="container">
            <div class="box">
                <h2 class="titulo-form">Login</h2>

                <!-- Formulário de login -->
                <form action="acoes.php" method="post">
                    <input type="text" name="usuario"  placeholder="Usuário" required> 
                    <input type="password" name="senha" placeholder="Senha" required>
                    <button type="submit" name="login">Entrar</button>
                </form>

                <p> não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
            </div>           
        </div>
    </main>
</body>
</html>