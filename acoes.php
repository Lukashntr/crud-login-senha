<?php
session_start();
require 'config/conexao.php';


if (isset($_POST['cadastrar'])) {

    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $usuario = mysqli_real_escape_string($conn, trim($_POST['usuario']));
    $senha_login = mysqli_real_escape_string($conn, trim($_POST['senha']));

    $sql = "INSERT INTO logins (email, usuario, senha) VALUES ('$email', '$usuario', '$senha_login')";
    $resultado = mysqli_query($conn, $sql);


    if ($resultado) {
        $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['mensagem'] = "Erro ao cadastrar: " . mysqli_error($conn);
        header('Location: index.php');
        exit;
    }
}

if (isset($_POST['editar'])) {
    $usuario_id = mysqli_real_escape_string($conn, $_POST['usuario_id']);
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $usuario = mysqli_real_escape_string($conn, trim($_POST['usuario']));
    $senha = mysqli_real_escape_string($conn, trim($_POST['senha']));

    $sql = "UPDATE logins SET email = '$email', usuario = '$usuario', senha = '$senha' WHERE id = '$usuario_id'";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado && mysqli_affected_rows($conn) > 0) {
        $_SESSION['mensagem'] = "Usuário atualizado com sucesso!";
        header('Location: pagina.php');
        exit;
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar usuário: " . mysqli_error($conn);
        header('Location: editar.php');
        exit;
    }
}

if (isset($_POST['excluir'])) {
    $usuario_id = mysqli_real_escape_string($conn, $_POST['excluir']);

    $sql = "DELETE FROM logins WHERE id = '$usuario_id'";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado && mysqli_affected_rows($conn) > 0) {
        $_SESSION['mensagem'] = "Usuário excluído com sucesso!";
        header('Location: pagina.php');
        exit;
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir usuário: " . mysqli_error($conn);
        header('Location: pagina.php');
        exit;
    }
}


?>