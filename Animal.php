<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animais Cadastrados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="CSS/baseSite.css">
</head>
<body>
<header>
  <?php require_once "_parts/_menu.php"; ?>
</header>

<main class="container mt-4">
  <h3 class="mb-3">Animais</h3>
  <div class="mb-3">
    <a href="CadastroDeAnimal.php" class="btn btn-outline-secondary">Novo Animal</a>
  </div>

  <table class="table table-bordered">
    <thead class="table-secondary">
      <tr>
        <th>Nome</th>
        <th>Espécie</th>
        <th>Fazenda</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php
      spl_autoload_register(function ($class) {
        require_once "classes/{$class}.class.php";
      });

      $animalObj = new Animal();
      $animais = $animalObj->allComFazenda();

      foreach ($animais as $a): ?>
        <tr>
          <td><?= $a->nome_animal ?></td>
          <td><?= $a->especie ?></td>
          <td><?= $a->nome_fazenda ?></td>
          <td class="d-flex gap-1">
            <!-- Editar -->
            <form action="CadastroDeAnimal.php" method="post">
              <input type="hidden" name="idAnimal" value="<?= $a->id_animal ?>">
              <button class="btn btn-primary btn-sm" type="submit" onclick="return confirm('Deseja editar este animal?')">
                <i class="bi bi-pencil-square"></i>
              </button>
            </form>

            <!-- Excluir -->
            <form action="bdCadastroDeAnimal.php" method="post">
              <input type="hidden" name="idAnimal" value="<?= $a->id_animal ?>">
              <button class="btn btn-danger btn-sm" type="submit" name="btnDeletar" onclick="return confirm('Tem certeza que deseja excluir este animal?')">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      <?php endforeach;
