<?php

spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
});
$Produto = new Tarefa();

if (filter_has_var(INPUT_POST, "btnRegistrar")):

    $idTarefa = filter_input(INPUT_POST, "idTarefa", FILTER_SANITIZE_NUMBER_INT);

    $Produto->setTitulo(filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_STRING));
    $Produto->setdescricao(filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRING));
    $Produto->setStatus(filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING));
    $Produto->setpromocao(filter_input(INPUT_POST, "promocao", FILTER_SANITIZE_STRING));

    if (empty($idProduto)):
        if ($Produto->add()) {
            echo "<script>
                    window.alert('Produto adicionado com sucesso.');
                    window.location.href = 'Produto.php';
                  </script>";
        } else {
            echo "<script>
                    window.alert('Erro ao adicionar Produto');
                    window.history.back();
                  </script>";
        }
    else:
        if ($Produto->update('id_produto', $idProduto)) {
            echo "<script>
                    window.alert('Produto alterado com sucesso.');
                    window.location.href = 'Produto.php';
                  </script>";
        } else {
            echo "<script>
                    window.alert('Erro ao alterar Produto.');
                    window.history.back();
                  </script>";
        }
    endif;

elseif (filter_has_var(INPUT_POST, 'btnDeletar')):
    $idProduto = intval(filter_input(INPUT_POST, 'idProduto'));

    if ($Produto->delete("id_produto", $idProduto)) {
        header("Location: Produto.php");
    } else {
        echo "<script>alert('Erro ao excluir produto.'); window.open(document.referrer, '_self');</script>";
    }

endif;
