<?php
// dashboard.php

session_start(); // ❗ Sempre no topo, antes de qualquer HTML

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit;
}

// Agora $_SESSION['nome'] e $_SESSION['email'] estão disponíveis
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/dashboard.css">
    <link rel="stylesheet" href="CSS/baseSite.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
</head>

<body>

    <header>
        <?php require_once "_parts/_menu.php"; ?>
    </header>

    <main class="container mt-4">
        <div class="profile-container">
            <img src="" alt="" class="profile-photo">

            <div class="profile-info">
                <p><strong>Usuário:</strong> <?php echo htmlspecialchars($_SESSION['nome']); ?></p>
                <p><strong>E-mail:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>

                <a href="usuario.php" class="btn btn-outline-secondary">Editar Perfil</a>
                <a href="logout.php" class="btn btn-outline-danger">Sair</a>
            </div>
        </div>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>