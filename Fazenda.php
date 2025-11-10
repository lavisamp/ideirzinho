<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazendas Cadastradas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/baseSite.css">
</head>

<body>
    <header>
        <?php require_once "_parts/_menu.php"; ?>
    </header>

    <main class="container mt-4">
        <h3 class="mb-3">Fazendas</h3>
        <div class="mb-3">
            <a href="CadastroDeFazenda.php" class="btn btn-outline-secondary">Nova Fazenda</a>
        </div>

        <table class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>Nome da Fazenda</th>
                    <th>Proprietário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Autoload para carregar classes automaticamente
                spl_autoload_register(function ($class) {
                    $file = __DIR__ . "/classes/{$class}.class.php";
                    if (file_exists($file)) {
                        require_once $file;
                    } else {
                        die("Erro: Classe {$class} não encontrada.");
                    }
                });

                try {
                    // Instanciar a classe Fazenda
                    $fazenda = new Fazenda();
                    $fazendas = $fazenda->all();

                    // Exibir as fazendas cadastradas
                    foreach ($fazendas as $f): ?>
                        <tr>
                            <td><?= htmlspecialchars($f->nome_fazenda) ?></td>
                            <td><?= htmlspecialchars($f->proprietario) ?></td>
                            <td class="d-flex gap-1">
                                <!-- Editar -->
                                <form action="CadastroDeFazenda.php" method="post">
                                    <input type="hidden" name="idFazenda" value="<?= (int)$f->id_fazenda ?>">
                                    <button class="btn btn-primary btn-sm" type="submit"
                                        onclick="return confirm('Deseja editar esta fazenda?')">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </form>

                                <!-- Excluir -->
                                <form action="bdCadastroDeFazenda.php" method="post">
                                    <input type="hidden" name="idFazenda" value="<?= (int)$f->id_fazenda ?>">
                                    <button class="btn btn-danger btn-sm" type="submit" name="btnDeletar"
                                        onclick="return confirm('Tem certeza que deseja excluir esta fazenda?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach;
                } catch (Exception $e) {
                    echo "<tr><td colspan='3' class='text-center text-danger'>Erro ao carregar fazendas: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>
</body>

</html>