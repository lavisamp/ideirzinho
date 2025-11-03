<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="CSS/baseAdmin.css" />
  <link rel="stylesheet" href="CSS/baseSite.css" />
  <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
  <title>Cadastro de Usuário</title>
</head>

<body>
  
  <header>

  </header>

  <main class="container">
    <?php
    spl_autoload_register(function ($class) {
      require_once "classes/{$class}.class.php";
    });

    if (filter_has_var(INPUT_POST, 'IdUsuario')) {
      $edtUsuario = new Usuario();
      $idUsuario = intval(filter_input(INPUT_POST, 'IdUsuario'));
      $us = $edtUsuario->search('id_usuario', $idUsuario);
    }
    ?>

    <form action="bdCadastroDeUsuario.php" method="post" class="row g-3 mt-3">
      <input type="hidden" name="IdUsuario" value="<?= $us->id_usuario ?? '' ?>">

      <div class="col-12">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome"
        value="<?php echo $us->nome ?? null;?>" id="nome"  placeholder="Digite o nome do usuário" required class="form-control"
          >
      </div>

      <div class="col-6">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" name="telefone" id="telefone" value="<?= $us->telefone ?? '' ?>" placeholder="Digite o seu número de telefone" required
          class="form-control" >
      </div>

      <div class="col-6">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" 
        value="<?php echo $us->email ?? null;?>" id="email" placeholder="Digite o seu email" required class="form-control"
          >
      </div>

      <div class="col-12">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" name="senha" id="senha" placeholder="Digite a sua senha" required class="form-control">
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