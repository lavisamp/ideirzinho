<?php
spl_autoload_register(function ($class) {
  require_once "classes/{$class}.class.php";
});

$animal = new Animal();

if (filter_has_var(INPUT_POST, "btnRegistrar")) {

  $animal->setNomeAnimal(filter_input(INPUT_POST, "nome_animal", FILTER_SANITIZE_STRING));
  $animal->setEspecie(filter_input(INPUT_POST, "especie", FILTER_SANITIZE_STRING));
  $animal->setIdade(filter_input(INPUT_POST, "idade", FILTER_SANITIZE_NUMBER_INT));
  $animal->setPeso(filter_input(INPUT_POST, "peso", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
  $animal->setIdFazenda(filter_input(INPUT_POST, "id_fazenda", FILTER_SANITIZE_NUMBER_INT));

  $idAnimal = filter_input(INPUT_POST, "idAnimal", FILTER_SANITIZE_NUMBER_INT);

  if (empty($idAnimal)) {
    if ($animal->add()) {
      echo "<script>alert('Animal cadastrado com sucesso!'); window.location.href='Animal.php';</script>";
    } else {
      echo "<script>alert('Erro ao cadastrar animal.'); history.back();</script>";
    }
  } else {
    if ($animal->update('id_animal', $idAnimal)) {
      echo "<script>alert('Animal atualizado com sucesso!'); window.location.href='Animal.php';</script>";
    } else {
      echo "<script>alert('Erro ao atualizar animal.'); history.back();</script>";
    }
  }

} elseif (filter_has_var(INPUT_POST, 'btnDeletar')) {
  $idAnimal = intval(filter_input(INPUT_POST, 'idAnimal'));
  if ($animal->delete("id_animal", $idAnimal)) {
    header("Location: Animal.php");
  } else {
    echo "<script>alert('Erro ao excluir animal.'); history.back();</script>";
  }
}
