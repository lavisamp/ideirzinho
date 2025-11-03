<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="CSS/baseSite.css" />
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <title>Usuários</title>
</head>

<header>

</header>

<body>

    <main class="container mt-4">
        <div>
            <h3>Usuários</h3>
        </div>

        <div class="mt-3">
            <a href="CadastroDeUsuario.php" class="btn btn-outline-secondary">Novo Usuário</a>
        </div>

        <table class="table mt-3">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                spl_autoload_register(function ($class) {
                    require_once "classes/{$class}.class.php";
                });

                $Usuario = new Usuario();
                $Usuarios = $Usuario->all();

                foreach ($Usuarios as $usuario):
                    ?>
                    <tr>
                        <td><?= $usuario->id_usuario ?></td>
                        <td><?= $usuario->nome ?></td>
                        <td><?= $usuario->email ?></td>
                        <td><?= $usuario->telefone ?></td>
                        <td class="d-flex gap-1">
                            <form action="CadastroDeUsuario.php" method="post">
                                <input type="hidden" name="IdUsuario" value="<?= $usuario->id_usuario ?>">
                                <button name="btnEditar" class="btn btn-primary btn-sm" type="submit"
                                    onclick="return confirm('Editar este usuário?');">
                                    <i class="bi bi-feather"></i>
                                </button>
                            </form>

                            <form action="bdCadastrodeUsuario.php" method="post">
                                <input type="hidden" name="idUsuario" value="<?= $usuario->id_usuario ?>">
                                <button name="btnDeletar" class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('Deseja deletar este usuário?');">
                                    <i class="bi bi-eraser-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>