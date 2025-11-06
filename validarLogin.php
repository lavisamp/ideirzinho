<?php
session_start();

spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
});

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // pegar os dados do POST (nome do input é 'usuario' no seu form)
    $usuarioPost = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    $senhaPost = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    if (empty($usuarioPost) || empty($senhaPost)) {
        echo "<script>alert('Preencha usuário e senha'); window.location='login.php';</script>";
        exit;
    }

    // Usar a classe Usuario para autenticar
    $usuario = new Usuario();
    $usuario->setNome($usuarioPost);
    $usuario->setSenha($senhaPost);

    // O método login da sua classe redireciona para dashboard se ok.
    // Vamos adaptar para devolver mensagem em vez de redirecionamento direto.
    $mensagem = $usuario->login();

    // Se login() redirecionou (header) já terá terminado o fluxo.
    // Caso contrário, retorna mensagem de erro ao usuário.
    echo "<script>alert('{$mensagem}'); window.location='login.php';</script>";
    exit;
} else {
    header("Location: login.php");
    exit;
}
?>