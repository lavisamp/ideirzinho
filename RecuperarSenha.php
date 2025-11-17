<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clientes Cadastrados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="CSS/baseSite.css">
</head>

<body>
  <header>
  <?php require_once "_parts/_menu.php"; ?>
  </header>
    <main>
        <h1 class="text-center">Recuperar Senha</h1>

        <form action="dbMudarSenha.php" method="post" class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control"
                    placeholder="Insira o E-mail de Recuperação" required>
                    </div>

                    <div class="text-center">
                    <a href="bdRecuperarSenha.php" class="btn btn-outline-secondary btn-sm mt-3">Enviar o Código</a>
            </div>

            <div class="senha-recupera">
            <a href="login.php" class="btn btn-outline-secondary btn-sm mt-3">Voltar para o Login</a>
            </div>
        </form>
</main>

    </main>

    <footer>
    <?php require_once "_parts/_footer.php"; ?>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>