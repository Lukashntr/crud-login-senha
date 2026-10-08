<!DOCTYPE html>
<ahtml lang="pt-br">
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
                <h2>Login</h2>
                <form action="/acoes/acoes_login.php" method="post">
                    <input type="text" name="usuario" placeholder="Usuário" required>
                    <input type="password" name="senha" placeholder="Senha" required>
                    <button type="submit" name="login">Entrar</button>
                </form>
                <p> não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
            </div>           
        </div>
    </main>
</body>
</html>