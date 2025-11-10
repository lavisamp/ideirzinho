<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="CSS/baseAdmin.css">
  <link rel="stylesheet" href="CSS/baseSite.css">
  <title>Cadastro de Animais</title>
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

  $fazendaObj = new Fazenda();
  $fazendas = $fazendaObj->all();

  if (filter_has_var(INPUT_POST, "idAnimal")) {
    $animalObj = new Animal();
    $idAnimal = intval(filter_input(INPUT_POST, "idAnimal"));
    $animal = $animalObj->search("id_animal", $idAnimal);
  }
  ?>

  <form action="bdCadastroDeAnimal.php" method="post" class="row g-4 mt-3">
    <input type="hidden" value="<?= $animal->id_animal ?? null ?>" name="idAnimal">

    <div class="col-md-6">
      <label class="form-label">Nome do Animal</label>
      <input type="text" name="nome_animal" value="<?= $animal->nome_animal ?? null ?>" required class="form-control">
    </div>

    <div class="col-md-6">
      <label class="form-label">Espécie</label>
      <input type="text" name="especie" value="<?= $animal->especie ?? null ?>" required class="form-control">
    </div>

    <div class="col-md-4">
      <label class="form-label">Idade (anos)</label>
      <input type="number" name="idade" value="<?= $animal->idade ?? null ?>" required class="form-control">
    </div>

    <div class="col-md-4">
      <label class="form-label">Peso (kg)</label>
      <input type="number" step="0.01" name="peso" value="<?= $animal->peso ?? null ?>" required class="form-control">
    </div>

    <div class="col-md-4">
      <label class="form-label">Fazenda</label>
      <select name="id_fazenda" required class="form-select">
        <option value="">Selecione...</option>
        <?php foreach ($fazendas as $f): ?>
          <option value="<?= $f->id_fazenda ?>" <?= isset($animal) && $animal->id_fazenda == $f->id_fazenda ? 'selected' : '' ?>>
            <?= $f->nome_fazenda ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-outline-secondary" name="btnRegistrar">Salvar Animal</button>
    </div>
  </form>
</main>

<footer>
  <?php require_once "_parts/_footer.php"; ?>
</footer>
</body>
</html>
