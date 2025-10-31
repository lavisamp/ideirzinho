<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <link rel="stylesheet" href="_parts/menu.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
</head>

<body>
    <header>
        <?php require_once "_parts/_menu.php"; ?>
    </header>
    <main>
        <div class="container d-flex justify-content-center">
            <div class="login-container">
                <h3 class="text-center mb-4">Login</h3>
                <form action="validar_login.php" method="POST">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuário</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" required />
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required />
                    </div>
                    <button type="submit" class="btn btn-outline-secondary">Efetuar Login</button>
                </form>

                <div class="senha-recupera">
                    <a href="RecuperarSenha.php" class="btn btn-link"
                        style="color: black; text-decoration: none;">Esqueceu senha?</a>
                </div>

            </div>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>
    <script src="_parts/menu.js"></script>
</body>

</html>