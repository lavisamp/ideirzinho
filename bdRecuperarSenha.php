<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (filter_has_var(INPUT_POST, "btnRecuperar")) {

    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

    if (!$email) {
        echo "<script>alert('E-mail inválido!'); window.history.back();</script>";
        exit;
    }

    // 1 — Verificar se o usuário existe
    $sql = $conn->prepare("SELECT id_usuario, nome FROM usuario WHERE email = :email LIMIT 1");
    $sql->bindValue(":email", $email);
    $sql->execute();

    if ($sql->rowCount() === 0) {
        echo "<script>alert('E-mail não encontrado!'); window.history.back();</script>";
        exit;
    }

    $user = $sql->fetch(PDO::FETCH_OBJ);

    // 2 — Criar token de recuperação
    $token = bin2hex(random_bytes(32));
    $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));

    // 3 — Salvar token no banco
    $sqlToken = $conn->prepare("
        INSERT INTO recuperar_senha (id_usuario, token, expira_em)
        VALUES (:id_usuario, :token, :expira)
    ");

    $sqlToken->bindValue(":id_usuario", $user->id_usuario);
    $sqlToken->bindValue(":token", $token);
    $sqlToken->bindValue(":expira", $expira);
    $sqlToken->execute();

    // 4 — Criar link de redefinição
    $link = "http://localhost/ideirzinho/redefinirSenha.php?token=$token";

    // 5 — Enviar email
    $assunto = "Recuperação de Senha - LJMC Beauty";
    $mensagem = "
        Olá, {$user->nome}!<br><br>
        Você solicitou a recuperação de senha.<br>
        Clique no link abaixo para redefinir:<br><br>
        <a href='$link'>$link</a><br><br>
        Caso não tenha solicitado, ignore este e-mail.
    ";

    // Envio simples usando mail()
    $headers = "MIME-Version: 1.1\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: noreply@seusite.com\r\n";

    if (mail($email, $assunto, $mensagem, $headers)) {
        echo "<script>
                alert('Um link de recuperação foi enviado para seu e-mail.');
                window.location.href = 'login.php';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao enviar e-mail. Tente novamente.');
                window.history.back();
              </script>";
    }

} else {
    header("Location: recuperarSenha.php");
    exit;
}
?>