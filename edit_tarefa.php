<?php
require_once __DIR__ . '/../database.php';

require_once "verifica_usuario.php";
if (session_status() === PHP_SESSION_NONE) session_start();

spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
});

$tarefaObj = new Tarefa();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = intval($_GET['id'] ?? 0);
    $t = $tarefaObj->searchById($id);
    if (!$t || $t->user_id != $user_id) {
        header('Location: tarefas.php');
        exit;
    }
    // mostra form
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
      <meta charset="utf-8">
      <title>Editar Tarefa</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="CSS/baseSite.css">
    </head>
    <body>
    <?php require_once "_parts/_menu2.php"; ?>
    <main class="container mt-4">
      <h3>Editar Tarefa</h3>
      <form action="edit_tarefa.php" method="post" class="row g-3">
        <input type="hidden" name="id" value="<?= $t->id ?>">
        <div class="col-12">
          <label class="form-label">Título</label>
          <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($t->titulo) ?>" required>
        </div>
        <div class="col-12">
          <label class="form-label">Descrição</label>
          <textarea name="descricao" class="form-control"><?= htmlspecialchars($t->descricao) ?></textarea>
        </div>
        <div class="col-4">
          <label class="form-label">Status</label>
          <select name="status" class="form-control">
            <option value="pendente" <?= $t->status === 'pendente' ? 'selected' : '' ?>>Pendente</option>
            <option value="concluida" <?= $t->status === 'concluida' ? 'selected' : '' ?>>Concluída</option>
          </select>
        </div>
        <div class="col-12">
          <button class="btn btn-outline-secondary">Salvar</button>
          <a href="tarefas.php" class="btn btn-light">Cancelar</a>
        </div>
      </form>
    </main>
    <?php require_once "_parts/_footer.php"; ?>
    </body>
    </html>
    <?php
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);
    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

    $t = $tarefaObj->searchById($id);
    if (!$t || $t->user_id != $user_id) {
        header('Location: tarefas.php');
        exit;
    }

    $tarefaObj->setTitulo($titulo);
    $tarefaObj->setDescricao($descricao);
    $tarefaObj->setStatus($status);

    if ($tarefaObj->update('id', $id)) {
        header('Location: tarefas.php');
        exit;
    } else {
        echo "<script>alert('Erro ao atualizar'); window.location='tarefas.php';</script>";
        exit;
    }
}
