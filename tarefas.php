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
  <?php require_once "_parts/_menu2.php"; ?>

  <main class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
      <h3>Minhas Tarefas</h3>
      <div>
        <a href="dashboard.php" class="btn btn-outline-secondary btn-sm">Dashboard</a>
        <a href="logout.php" class="btn btn-outline-danger btn-sm">Sair</a>
      </div>
    </div>

    <div class="mt-3 mb-3">
      <a href="add_tarefa.php" class="btn btn-outline-secondary">Nova Tarefa</a>
      <!-- Filtros -->
      <a href="tarefas.php?filter=all" class="btn btn-light btn-sm">Todas</a>
      <a href="tarefas.php?filter=pendentes" class="btn btn-light btn-sm">Pendentes</a>
      <a href="tarefas.php?filter=concluidas" class="btn btn-light btn-sm">Concluídas</a>
    </div>

    <table class="table mt-3">
      <thead class="table-secondary">
        <tr>
          <th>ID</th>
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
              <td><?= $t->id ?></td>
              <td><?= htmlspecialchars($t->titulo) ?></td>
              <td><?= ucfirst($t->status) ?></td>
              <td><?= date('d/m/Y H:i', strtotime($t->created_at)) ?></td>
              <td class="d-flex gap-1">
                <form action="edit_tarefa.php" method="get">
                  <input type="hidden" name="id" value="<?= $t->id ?>">
                  <button class="btn btn-primary btn-sm" type="submit" title="Editar">
                    <i class="bi bi-feather"></i>
                  </button>
                </form>

                <form action="delete_tarefa.php" method="post">
                  <input type="hidden" name="id" value="<?= $t->id ?>">
                  <button class="btn btn-danger btn-sm" type="submit" title="Excluir"
                    onclick="return confirm('Deseja deletar esta tarefa?');">
                    <i class="bi bi-eraser-fill"></i>
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center">Nenhuma tarefa encontrada.</td>
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