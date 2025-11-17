<?php
session_start();

spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
});

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuarioPost = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    $senhaPost = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    if (empty($usuarioPost) || empty($senhaPost)) {
        echo "<script>alert('Preencha usuário e senha'); window.location='login.php';</script>";
        exit;
    }

    $usuario = new Usuario();
    $usuario->setNome($usuarioPost);
    $usuario->setSenha($senhaPost);

    $mensagem = $usuario->login();

    // SE CHEGOU AQUI, LOGIN FALHOU!
    echo "<script>alert('$mensagem'); window.location='login.php';</script>";
    exit;
}

header("Location: login.php");
exit;
?>