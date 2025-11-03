<?php
spl_autoload_register(function ($class) {
  require_once "classes/{$class}.class.php";
});

$Usuario = new Usuario();

if (filter_has_var(INPUT_POST, "btnRegistrar")):

  $Usuario->setNome(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING));
  $Usuario->setTelefone(filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_STRING));
  $Usuario->setEmail(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING));
  $Usuario->setSenha(filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING));

  $idUsuario = filter_input(INPUT_POST, "IdUsuario", FILTER_SANITIZE_NUMBER_INT);

  if (empty($idUsuario)):
    if ($Usuario->add()) {
      echo "<script>
                  window.alert('Usuário cadastrado com sucesso.');
                  window.location.href = 'usuario.php';
                </script>";
    } else {
      echo "<script>
                  window.alert('Erro ao cadastrar Usuário');
                  window.history.back();
                </script>";
    }
  else:
    if ($Usuario->update('id_usuario', $idUsuario)) {
      echo "<script>
                  window.alert('Usuário alterado com sucesso.');
                  window.location.href = 'Usuario.php';
                </script>";
    } else {
      echo "<script>
                  window.alert('Erro ao alterar Usuário.');
                  window.history.back();
                </script>";
    }
  endif;

elseif (filter_has_var(INPUT_POST, 'btnDeletar')):
  $idUsuario = intval(filter_input(INPUT_POST, 'idUsuario'));


  if ($Usuario->delete("id_usuario", $idUsuario)) {
    header("Location: Usuario.php");
  } else {
    echo "<script>alert('Erro ao excluir usuário.'); window.open(document.referrer, '_self');</script>";
  }

elseif (filter_has_var(INPUT_POST, "efetuarlogin")):
  $usuario = new Usuario();
  $usuario->setNome(filter_input(INPUT_POST, "usuario"));
  $usuario->setSenha(filter_input(INPUT_POST, "senha"));
  $mensagem = $usuario->login();
  echo "<script>
        window.alert('$mensagem');
        window.open(document.referrer,'_self');
    </script>";
endif;