<?php
require 'config/conexao.php';

// verifica se o usuário clicou no botão de login
if (isset($_POST['login'])) {

    // recebe usuário e remove espaços em branco
    $usuario = mysqli_real_escape_string($conn, trim($_POST['usuario']));

    // recebe senha e a transforma em string, remove espaços em branco usando trim
    $senha = $_POST['senha'];
    

    // verifica se o usuário e a senha estão vazios
    if (empty($usuario) || empty($senha)) {
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

            session_start();

            // inicia a sessão e armazena o usuário na sessão 
            $_SESSION['usuario'] = $usuario_bd['usuario'];
            $_SESSION['id'] = $usuario_bd['id'];
            $_SESSION['mensagem'] = "Login realizado com sucesso!";
            
            header('Location: pagina.php');
            echo "Login realizado com sucesso!";
            exit;

        } else {

            // se a senha estiver incorreta, exibe uma mensagem de erro
            $_SESSION['mensagem'] = "Senha incorreta!";
            //header('Location: index.php');
            echo "Senha incorreta!";
            var_dump($usuario_bd['senha']);
            var_dump($senha);
            var_dump(password_verify($senha, $usuario_bd['senha']));
            exit;
        }

    } else {
        
        // se o usuário não for encontrado, exibe uma mensagem de erro
        $_SESSION['mensagem'] = "Usuário não encontrado!";
        //header('Location: index.php');
        echo "Usuário não encontrado!";
        exit;
    }
}   

// verifica se o usuário clicou no botão de logout
if (isset($_POST['logout'])) {

    // destrói a sessão e redireciona para a página de login
    header('Location: index.php');
    echo "Logout realizado com sucesso!";
    session_destroy();
    exit;
}

// verifica se o usuário clicou no botão de cadastro
if (isset($_POST['cadastrar'])) {

    // recebe os dados do formulário e remove espaços em branco
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $usuario = mysqli_real_escape_string($conn, trim($_POST['usuario']));
    $senha_login = mysqli_real_escape_string($conn, trim($_POST['senha']));

    // criptografa a variavel $senha_login com password_hash
    $senhahash = password_hash($senha_login, PASSWORD_DEFAULT); 

    // insere os dados do usuário no banco de dados
    $sql = "INSERT INTO logins (email, usuario, senha) VALUES ('$email', '$usuario', '$senhahash')";
    $resultado = mysqli_query($conn, $sql);


    // verifica se a inserção foi bem-sucedida e redireciona para a página de login com uma mensagem de sucesso ou erro
    if ($resultado) {
        $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
        header('Location: index.php');
        exit;
    } else {

        // se houver algum erro na inserção, exibe uma mensagem de erro
        $_SESSION['mensagem'] = "Erro ao cadastrar: " . mysqli_error($conn);
        header('Location: index.php');
        exit;
    }
}

// verifica se o usuário clicou no botão de editar
if (isset($_POST['editar'])) {

    // recebe os dados do formulário e remove espaços em branco
    $usuario_id = mysqli_real_escape_string($conn, $_POST['usuario_id']);
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $usuario = mysqli_real_escape_string($conn, trim($_POST['usuario']));

    //$senha = ($_POST['senha']);

    // criptografa a variavel $senha com password_hash
    //$senhahash = password_hash($senha, PASSWORD_DEFAULT);

    // atualiza os dados do usuário no banco de dados
    $sql = "UPDATE logins SET email = '$email', usuario = '$usuario' WHERE id = '$usuario_id'";
    $resultado = mysqli_query($conn, $sql);

    // verifica se a atualização foi bem-sucedida e redireciona para a página principal com uma mensagem de sucesso ou erro
   if ($resultado && mysqli_affected_rows($conn) > 0) {

        $_SESSION['mensagem'] = "Usuário atualizado com sucesso!";

        // Se quiser que o usuário continue logado:
        //header('Location: pagina.php');
        // Se quiser que ele volte para o login e entre de novo:
        header('Location: index.php');
        exit;
    }
    else {

        // se houver algum erro na atualização, exibe uma mensagem de erro
        $_SESSION['mensagem'] = "Erro ao atualizar usuário: " . mysqli_error($conn);
        header('Location: editar.php');
        echo "Erro ao atualizar usuário: " . mysqli_error($conn);
        exit;
    }
}

// verifica se o usuário clicou no botão de excluir
if (isset($_POST['excluir'])) {

    // recebe o ID do usuário a ser excluído e remove espaços em branco
    $usuario_id = mysqli_real_escape_string($conn, $_POST['excluir']);

    // exclui o usuário do banco de dados
    $sql = "DELETE FROM logins WHERE id = '$usuario_id'";
    $resultado = mysqli_query($conn, $sql);

    // verifica se a exclusão foi bem-sucedida e redireciona para a página principal com uma mensagem de sucesso ou erro
    if ($resultado && mysqli_affected_rows($conn) > 0) {
        $_SESSION['mensagem'] = "Usuário excluído com sucesso!";
        header('Location: pagina.php');
        exit;
    } else {

        // se houver algum erro na exclusão, exibe uma mensagem de erro
        $_SESSION['mensagem'] = "Erro ao excluir usuário: " . mysqli_error($conn);
        header('Location: pagina.php');
        exit;
    }
}

?>