<?php
require_once "verifica_usuario.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
        <?php require_once "_parts/_menu.php"; 
        require_once __DIR__ . '/../database.php';
        ?>
    </header>

    <main class="container mt-4">
        <div class="profile-container">
            <img src="images/pote.png" alt="Pote" class="profile-photo">

            <div class="profile-info">
                <p><strong>Usuário:</strong> <?php echo $_SESSION['nome']; ?></p>
                <p><strong>E-mail:</strong> <?php echo $_SESSION['email']; ?></p>

                <a href="Usuario.php" class="btn btn-outline-secondary">Editar Perfil</a>
            </div>
        </div>
    </main>

    <footer>
        <?php require_once "_parts/_footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>