<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="CSS/baseAdmin.css">
  <link rel="stylesheet" href="CSS/baseSite.css">
  <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
  <title>Cadastro de Tarefas</title>
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

    // Verifica se está editando (idTarefa foi enviado)
    $tf = null;
    if (filter_has_var(INPUT_POST, "idTarefa")) {
      $edtTarefa = new Tarefa();
      $idTarefa = intval(filter_input(INPUT_POST, "idTarefa"));
      $tf = $edtTarefa->search("id_tarefa", $idTarefa);
    }
    ?>

    <h1 class="mb-4"><?php echo $tf ? "Editar Tarefa" : "Nova Tarefa"; ?></h1>

    <form action="bdTarefa.php" method="post" class="row g-4">

      <input type="hidden" name="idTarefa" value="<?php echo $tf->id_tarefa ?? ''; ?>">

      <div class="col-12">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($tf->titulo ?? ''); ?>"
          placeholder="Título da Tarefa" required class="form-control">
      </div>

      <div class="col-12">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea class="form-control" name="descricao" id="descricao" rows="6"
          placeholder="Descreva a Tarefa"><?php echo htmlspecialchars($tf->descricao ?? ''); ?></textarea>
      </div>

      <div class="col-12">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
          <option value="" disabled <?php echo empty($tf->status) ? 'selected' : ''; ?>>Selecione o Status</option>
          <option value="pendente" <?php echo ($tf->status ?? '') === 'pendente' ? 'selected' : ''; ?>>Pendente</option>
          <option value="concluida" <?php echo ($tf->status ?? '') === 'concluida' ? 'selected' : ''; ?>>Concluída
          </option>
        </select>
      </div>

      <div class="col-12">
        <label for="data_criacao" class="form-label">Data de criação</label>
        <input type="date" name="data_criacao" id="data_criacao"
          value="<?php echo $tf->data_criacao ?? date('Y-m-d'); ?>" class="form-control" required>
      </div>

      <div class="col-12 mt-4">
      <button type="submit" class="btn btn-outline-secondary" name="btnRegistrar">Registrar</button>
      </div>

    </form>
  </main>

  <footer class="mt-5">
    <?php require_once "_parts/_footer.php"; ?>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>