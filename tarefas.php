<?php
$tarefa = new Tarefa();

// filtro via GET: all / concluidas / pendentes
$filter = $_GET['filter'] ?? 'all';
$filterParam = null;
if ($filter === 'concluidas') $filterParam = 'concluidas';
if ($filter === 'pendentes') $filterParam = 'pendentes';

$lista = $tarefa->listByUser($user_id, $filterParam);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Minhas Tarefas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="CSS/baseSite.css">
</head>
<body>
<?php require_once "_parts/_menu2.php"; ?>

<main class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Minhas Tarefas</h3>
    <div>
      <a href="dashboard.php" class="btn btn-outline-secondary btn-sm">Dashboard</a>
      <a href="logout.php" class="btn btn-outline-danger btn-sm">Sair</a>
    </div>
  </div>

  <!-- Form adicionar -->
  <div class="card mb-3">
    <div class="card-body">
      <form action="add_tarefa.php" method="post" class="row g-2">
        <div class="col-8">
          <input type="text" name="titulo" class="form-control" placeholder="Nova tarefa..." required>
        </div>
        <div class="col-3">
          <select name="status" class="form-control">
            <option value="pendente">Pendente</option>
            <option value="concluida">Concluída</option>
          </select>
        </div>
        <div class="col-1">
          <button class="btn btn-outline-secondary w-100" type="submit">Adicionar</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Filtros -->
  <div class="mb-3">
    <a href="tarefas.php?filter=all" class="btn btn-sm btn-light">Todas</a>
    <a href="tarefas.php?filter=pendentes" class="btn btn-sm btn-light">Pendentes</a>
    <a href="tarefas.php?filter=concluidas" class="btn btn-sm btn-light">Concluídas</a>
  </div>

  <!-- Lista -->
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Título</th>
          <th>Status</th>
          <th>Criada</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($lista)): ?>
          <?php foreach ($lista as $t): ?>
            <tr>
              <td><?= htmlspecialchars($t->titulo) ?></td>
              <td><?= htmlspecialchars($t->status) ?></td>
              <td><?= date('d/m/Y H:i', strtotime($t->created_at)) ?></td>
              <td>
                <a href="edit_tarefa.php?id=<?= $t->id ?>" class="btn btn-sm btn-outline-secondary">Editar</a>
                <form action="delete_tarefa.php" method="post" style="display:inline-block;">
                  <input type="hidden" name="id" value="<?= $t->id ?>">
                  <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir tarefa?')">Excluir</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="4" class="text-center">Nenhuma tarefa encontrada.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>

<footer><?php require_once "_parts/_footer.php"; ?></footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
