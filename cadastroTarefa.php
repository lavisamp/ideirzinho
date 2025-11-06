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

  <main class="container">
    <?php
    spl_autoload_register(function ($class) {
      require_once "classes/{$class}.class.php";
    });
    if (filter_has_var(INPUT_POST, "idTarefa")) {
      $edtTarefa = new Tarefa();
      $idTarefa = intval(filter_input(INPUT_POST, "idTarefa"));
      $tf = $edtTarefa->search("id_tarefa", $idTarefa);

    if (filter_has_var(INPUT_POST, 'idTarefa')) {
      $edtTarefa = new Tarefa();
      $idTarefa = intval(filter_input(INPUT_POST, 'idTarefa'));
      $t = $edtTarefa->search('id_tarefa', $idTarefa);
    }
    ?>
    <form action="bdTarefa.php" method="post" class="row g-4 mt-3">
      <input type="hidden" value="<?php echo $tf->id_tarefa ?? null; ?>" name="idTarefa">

      <div class="col-12 mt-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" name="titulo" id="titulo" value="<?php echo $tf->titulo ?? ''; ?>"
          placeholder="Título da Tarefa" required class="form-control">
      </div>

      <div class="col-12 mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea class="form-control" name="descricao" id="descricao" rows="6"
          placeholder="Descreva a Tarefa"><?php echo $tf->descricao ?? ''; ?></textarea>
      </div>

      <div class="col-12 mt-4">
        <label for="status" class="form-label">Status</label>
        <select name="status" class="form-select" value="<?php echo $tf->status ?? ''; ?>"
          aria-label="Default select example">
          <option selected>Selecione o Status da Tarefa</option>
          <option value="Valor Normal">Pendente</option>
          <option value="Produto Promocao">Concluído</option>
        </select>
      </div>

        <div class="col-12 mt-4">
          <button type="submit" class="btn btn-outline-secondary" name="btnRegistrar">Registrar</button>
        </div>
    </form>
  </main>

  <footer>
    <?php require_once "_parts/_footer.php"; ?>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>