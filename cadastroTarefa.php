<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="CSS/baseSite.css" />
  <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
  <title>Editar Tarefa</title>
</head>

<body>
  <header>
    <?php require_once "_parts/_menu.php"; ?>
  </header>

  <main class="container mt-4">

  <?php
    spl_autoload_register(function ($class) {
      require_once "classes/{$class}.class.php";
    });

    if (filter_has_var(INPUT_POST, 'id')) {
      $edtTarefa = new Usuario();
      $idTarefa = intval(filter_input(INPUT_POST, 'id'));
      $t = $edtTarefa->search('id', $idTarefa);
    }
    ?>

    <form action="bdTarefa.php" method="post" class="row g-3 mt-3">
      <input type="hidden" name="idTarefa" value="<?= $t->idTarefa ?>">

      <div class="col-12">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Digite o título da tarefa"
          value="<?= htmlspecialchars($t->titulo) ?>" required>
      </div>

      <div class="col-12">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" id="descricao" class="form-control"
          placeholder="Digite a descrição da tarefa"><?= htmlspecialchars($t->descricao) ?></textarea>
      </div>

      <div class="col-4">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-control">
          <option value="pendente" <?= $t->status === 'pendente' ? 'selected' : '' ?>>Pendente</option>
          <option value="concluida" <?= $t->status === 'concluida' ? 'selected' : '' ?>>Concluída</option>
        </select>
      </div>

      <div class="col-12 mt-4">
        <button type="submit" class="btn btn-outline-secondary" name="btnSalvar">Salvar</button>
        <a href="tarefas.php" class="btn btn-light">Cancelar</a>
      </div>
    </form>
  </main>

  <footer>
    <?php require_once "_parts/_footer.php"; ?>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>