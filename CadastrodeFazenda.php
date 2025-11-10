<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="CSS/baseAdmin.css">
  <link rel="stylesheet" href="CSS/baseSite.css">
  <title>Cadastro de Fazendas</title>
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

  if (filter_has_var(INPUT_POST, "idFazenda")) {
    $fazendaObj = new Fazenda();
    $idFazenda = intval(filter_input(INPUT_POST, "idFazenda"));
    $faz = $fazendaObj->search("id_fazenda", $idFazenda);
  }
  ?>

  <form action="bdCadastroDeFazenda.php" method="post" class="row g-4 mt-3">
    <input type="hidden" value="<?= $faz->id_fazenda ?? null ?>" name="idFazenda">

    <div class="col-md-6">
      <label class="form-label">Nome da Fazenda</label>
      <input type="text" name="nome_fazenda" value="<?= $faz->nome_fazenda ?? null ?>" required class="form-control">
    </div>

    <div class="col-md-6">
      <label class="form-label">Localização</label>
      <input type="text" name="localizacao" value="<?= $faz->localizacao ?? null ?>" required class="form-control">
    </div>

    <div class="col-md-6">
      <label class="form-label">Proprietário</label>
      <input type="text" name="proprietario" value="<?= $faz->proprietario ?? null ?>" required class="form-control">
    </div>

    <div class="col-md-3">
      <label class="form-label">Tamanho (ha)</label>
      <input type="number" step="0.01" name="tamanho_hectares" value="<?= $faz->tamanho_hectares ?? null ?>" required class="form-control">
    </div>

    <div class="col-md-3">
      <label class="form-label">Data de Registro</label>
      <input type="date" name="data_registro" value="<?= $faz->data_registro ?? null ?>" required class="form-control">
    </div>

    <div class="col-12">
      <label class="form-label">Apresentação</label>
      <textarea class="form-control" name="apresentacao" rows="4"><?= $faz->apresentacao ?? null ?></textarea>
    </div>

    <div class="col-12">
      <label class="form-label">Produção Principal</label>
      <textarea class="form-control" name="producao_principal" rows="4"><?= $faz->producao_principal ?? null ?></textarea>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-outline-secondary" name="btnRegistrar">Salvar Fazenda</button>
    </div>
  </form>
</main>

<footer>
  <?php require_once "_parts/_footer.php"; ?>
</footer>
</body>
</html>
