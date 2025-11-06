<?php
spl_autoload_register(function ($class) {
  require_once "classes/{$class}.class.php";
});

$Tarefa = new Tarefa();

// Captura filtro (se existir)
$filter = filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_STRING);

// Monta consulta com filtro, se necessário
switch ($filter) {
  case 'pendentes':
    $lista = $Tarefa->listByStatus('pendente');
    break;
  case 'concluidas':
    $lista = $Tarefa->listByStatus('concluida');
    break;
  case 'all':
  default:
    $lista = $Tarefa->listAll();
    break;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="CSS/baseSite.css" />
  <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <title>Minhas Tarefas</title>
</head>

<body>
  <?php require_once "_parts/_menu.php"; ?>

  <main class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
      <h3>Minhas Tarefas</h3>
      <div>
        <a href="dashboard.php" class="btn btn-outline-secondary btn-sm">Dashboard</a>
        <a href="logout.php" class="btn btn-outline-danger btn-sm">Sair</a>
      </div>
    </div>

    <div class="mt-3 mb-3">
      <a href="cadastroTarefa.php" class="btn btn-outline-secondary">Nova Tarefa</a>
      <!-- Filtros -->
      <a href="tarefas.php?filter=all" class="btn btn-light btn-sm">Todas</a>
      <a href="tarefas.php?filter=pendentes" class="btn btn-light btn-sm">Pendentes</a>
      <a href="tarefas.php?filter=concluidas" class="btn btn-light btn-sm">Concluídas</a>
    </div>

    <table class="table mt-3 table-hover align-middle">
      <thead class="table-secondary">
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Status</th>
          <th>Criada em</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($lista)): ?>
          <?php foreach ($lista as $tf): ?>
            <tr>
              <td><?= $tf->id_tarefa ?></td>
              <td><?= htmlspecialchars($tf->titulo) ?></td>
              <td>
                <span class="badge bg-<?= $tf->status === 'concluida' ? 'success' : 'warning' ?>">
                  <?= ucfirst($tf->status) ?>
                </span>
              </td>
              <td><?= date('d/m/Y H:i', strtotime($tf->data_criacao)) ?></td>
              <td class="d-flex gap-1">
                <!-- Editar -->
                <form action="cadastroTarefa.php" method="post" class="m-0">
                  <input type="hidden" name="idTarefa" value="<?= $tf->id_tarefa ?>">
                  <button class="btn btn-primary btn-sm" type="submit" title="Editar">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                </form>

                <!-- Excluir -->
                <form action="bdTarefa.php" method="post" class="m-0">
                  <input type="hidden" name="idTarefa" value="<?= $tf->id_tarefa ?>">
                  <button class="btn btn-danger btn-sm" type="submit" name="btnDeletar" title="Excluir"
                    onclick="return confirm('Deseja realmente excluir esta tarefa?');">
                    <i class="bi bi-trash3-fill"></i>
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center text-muted">Nenhuma tarefa encontrada.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </main>

  <footer>
    <?php require_once "_parts/_footer.php"; ?>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>