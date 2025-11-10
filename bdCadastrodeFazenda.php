<?php
spl_autoload_register(function ($class) {
  require_once "classes/{$class}.class.php";
});

$fazenda = new Fazenda();

if (filter_has_var(INPUT_POST, "btnRegistrar")) {

  $fazenda->setNomeFazenda(filter_input(INPUT_POST, "nome_fazenda", FILTER_SANITIZE_STRING));
  $fazenda->setLocalizacao(filter_input(INPUT_POST, "localizacao", FILTER_SANITIZE_STRING));
  $fazenda->setProprietario(filter_input(INPUT_POST, "proprietario", FILTER_SANITIZE_STRING));
  $fazenda->setTamanhoHectares(filter_input(INPUT_POST, "tamanho_hectares", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
  $fazenda->setDataRegistro(filter_input(INPUT_POST, "data_registro"));
  $fazenda->setApresentacao(filter_input(INPUT_POST, "apresentacao", FILTER_SANITIZE_STRING));
  $fazenda->setProducaoPrincipal(filter_input(INPUT_POST, "producao_principal", FILTER_SANITIZE_STRING));

  $idFazenda = filter_input(INPUT_POST, "idFazenda", FILTER_SANITIZE_NUMBER_INT);

  if (empty($idFazenda)) {
    if ($fazenda->add()) {
      echo "<script>alert('Fazenda cadastrada com sucesso!'); window.location.href='Fazenda.php';</script>";
    } else {
      echo "<script>alert('Erro ao cadastrar fazenda.'); history.back();</script>";
    }
  } else {
    if ($fazenda->update('id_fazenda', $idFazenda)) {
      echo "<script>alert('Fazenda atualizada com sucesso!'); window.location.href='Fazenda.php';</script>";
    } else {
      echo "<script>alert('Erro ao atualizar fazenda.'); history.back();</script>";
    }
  }

} elseif (filter_has_var(INPUT_POST, 'btnDeletar')) {

  $idFazenda = intval(filter_input(INPUT_POST, 'idFazenda'));
  if ($fazenda->delete("id_fazenda", $idFazenda)) {
    header("Location: Fazenda.php");
  } else {
    echo "<script>alert('Erro ao excluir fazenda.'); history.back();</script>";
  }
}
