<?php
require_once __DIR__ . '/../database.php';

require_once "verifica_usuario.php";
if (session_status() === PHP_SESSION_NONE) session_start();

spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
});

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING) ?: 'pendente';

    if (empty($titulo)) {
        header('Location: tarefas.php');
        exit;
    }

    $t = new Tarefa();
    $t->setUserId(intval($_SESSION['user_id']));
    $t->setTitulo($titulo);
    $t->setDescricao(''); // se quiser adicionar descrição no futuro
    $t->setStatus($status);

    if ($t->add()) {
        header('Location: tarefas.php');
        exit;
    } else {
        echo "<script>alert('Erro ao adicionar tarefa'); window.location='tarefas.php';</script>";
        exit;
    }
} else {
    header('Location: tarefas.php');
    exit;
}
