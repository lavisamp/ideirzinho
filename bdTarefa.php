<?php
spl_autoload_register(function ($class) {
  require_once "classes/{$class}.class.php";
});

$Tarefa = new Tarefa();

// --- SALVAR (INSERIR OU EDITAR) ---
if (filter_has_var(INPUT_POST, "btnRegistrar")):

  $idTarefa = filter_input(INPUT_POST, "idTarefa", FILTER_SANITIZE_NUMBER_INT);
  $titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $Tarefa->setTitulo($titulo);
  $Tarefa->setDescricao($descricao);
  $Tarefa->setStatus($status);

  // Se houver ID, atualiza; caso contrário, insere
  if (empty($idTarefa)):
    if ($Tarefa->add()) {
      echo "<script>
              alert('Tarefa cadastrada com sucesso!');
              window.location.href = 'tarefas.php';
            </script>";
    } else {
      echo "<script>
              alert('Erro ao cadastrar tarefa.');
              window.history.back();
            </script>";
    }
  else:
    if ($Tarefa->update('id_tarefa', $idTarefa)) {
      echo "<script>
              alert('Tarefa alterada com sucesso!');
              window.location.href = 'tarefas.php';
            </script>";
    } else {
      echo "<script>
              alert('Erro ao alterar tarefa.');
              window.history.back();
            </script>";
    }
  endif;

  // --- DELETAR ---
elseif (filter_has_var(INPUT_POST, "btnDeletar")):
  $idTarefa = filter_input(INPUT_POST, "idTarefa", FILTER_SANITIZE_NUMBER_INT);

  if ($Tarefa->delete("id_tarefa", $idTarefa)) {
    echo "<script>
            alert('Tarefa excluída com sucesso!');
            window.location.href = 'tarefas.php';
          </script>";
  } else {
    echo "<script>
            alert('Erro ao excluir tarefa.');
            window.history.back();
          </script>";
  }

endif;
