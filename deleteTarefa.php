<?php
require_once __DIR__ . '/../database.php';

require_once "verifica_usuario.php";
if (session_status() === PHP_SESSION_NONE) session_start();

spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
});

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);
    $t = new Tarefa();
    $tarefa = $t->searchById($id);

    if (!$tarefa || $tarefa->user_id != $_SESSION['user_id']) {
        header('Location: tarefas.php');
        exit;
    }

    if ($t->delete('id', $id)) {
        header('Location: tarefas.php');
        exit;
    } else {
        echo "<script>alert('Erro ao excluir tarefa'); window.location='tarefas.php';</script>";
        exit;
    }
} else {
    header('Location: tarefas.php');
    exit;
}
