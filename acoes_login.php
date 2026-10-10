<?php
session_start();
require 'config/conexao.php';

if (isset($_POST['login'])) {

    // recebe usuário e remove espaços em branco
    $usuario = mysqli_real_escape_string($conn, trim($_POST['usuario']));

    // recebe senha e a transforma em string, remove espaços em branco usando trim
    $senha = mysqli_real_escape_string($conn, trim($_POST['senha']));

    // recebe senha e a criptografa usando password_hash
    $senhahash = password_hash($senha, PASSWORD_DEFAULT);
    

    // verifica se o usuário e a senha estão vazios
    if (empty($usuario) || empty($senhahash)) {
        $_SESSION['mensagem'] = "Por favor, preencha todos os campos!";
        //header('Location: index.php');
        echo "Por favor, preencha todos os campos!";
        exit;
    }

    // valida se o usuário é um email válido ou se contém apenas letras, números e underscores
    if (!filter_var($usuario, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9_]+$/', $usuario)) {
        $_SESSION['mensagem'] = "Usuário inválido!";
        echo "Usuário inválido!";
        //header('Location: index.php');
        exit;
    }

    // consulta apenas pelo usuário
    $sql = "SELECT * FROM logins WHERE usuario = ?";

    // prepara a consulta SQL
    $stmt = $conn->prepare($sql); 

    // vincula o parâmetro do usuário à consulta SQL
    $stmt->bind_param("s", $usuario); 

    // executa a consulta SQL
    $stmt->execute(); 

    // obtém o resultado da consulta
    $resultado = $stmt->get_result(); 
    
    // verifica se o usuário existe no banco de dados
    if ($resultado->num_rows > 0) {

        // obtém os dados do usuário do banco de dados
        $usuario_bd = $resultado->fetch_assoc();

        // verifica se a senha digitada corresponde à senha armazenada no banco de dados
        if (password_verify($senha, $usuario_bd['senha'])) {

            // inicia a sessão e armazena o usuário na sessão 
            $_SESSION['usuario'] = $usuario_bd['usuario'];
            $_SESSION['mensagem'] = "Login realizado com sucesso!";
            header('Location: pagina.php');
            echo "Login realizado com sucesso!";
            exit;

        } else {

            // se a senha estiver incorreta, exibe uma mensagem de erro
            $_SESSION['mensagem'] = "Senha incorreta!";
            header('Location: index.php');
            echo "Senha incorreta!";
            exit;
        }

    } else {
        
        // se o usuário não for encontrado, exibe uma mensagem de erro
        $_SESSION['mensagem'] = "Usuário não encontrado!";
        header('Location: index.php');
        echo "Usuário não encontrado!";
        exit;
    }
}   

// verifica se o usuário clicou no botão de logout
if (isset($_POST['logout'])) {

    // destrói a sessão e redireciona para a página de login
    header('Location: index.php');
    echo "Logout realizado com sucesso!";
    exit;
}

?>