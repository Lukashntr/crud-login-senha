<?php
session_start();
require 'config/conexao.php';

if (isset($_POST['login'])) {

    $usuario = mysqli_real_escape_string($conn, trim($_POST['usuario']));
    $senha = mysqli_real_escape_string($conn, trim($_POST['senha']));

    if (empty($usuario) || empty($senha)) {
        $_SESSION['mensagem'] = "Por favor, preencha todos os campos!";
        header('Location: index.php');
        exit;
    }

    if (!filter_var($usuario, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9_]+$/', $usuario)) {
        $_SESSION['mensagem'] = "Usuário inválido!";
        header('Location: index.php');
        exit;
    }

    if (!preg_match('/^[a-zA-Z0-9_]+$/', $senha)) {
        $_SESSION['mensagem'] = "Senha inválida!";
        header('Location: index.php');
        exit;
    }

    $sql = "SELECT * FROM logins WHERE usuario = '$usuario' AND senha = '$senha'";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $_SESSION['usuario'] = $usuario;
        header('Location: pagina.php');
        exit;
    } else {
        $_SESSION['mensagem'] = "Usuário ou senha inválidos!";
        header('Location: index.php');
        exit;
    }

}   

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

?>