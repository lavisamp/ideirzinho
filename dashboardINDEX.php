<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel Principal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="CSS/baseSite.css">
  <link rel="stylesheet" href="CSS/dashboardINDEX.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<header>
  <?php require_once "_parts/_menu.php"; ?>
</header>

<main class="container text-center">

  <?php
  spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
  });

  $db = Database::getInstance()->getConnection();

  // Total de fazendas
  $totalFazendas = $db->query("SELECT COUNT(*) FROM fazenda")->fetchColumn();

  // Total de animais
  $totalAnimais = $db->query("SELECT COUNT(*) FROM animal")->fetchColumn();

  // Fazenda com mais animais
  $topFazenda = $db->query("
      SELECT f.nome_fazenda, COUNT(a.id_animal) AS total
      FROM fazenda f
      LEFT JOIN animal a ON f.id_fazenda = a.id_fazenda
      GROUP BY f.id_fazenda
      ORDER BY total DESC
      LIMIT 1
  ")->fetch(PDO::FETCH_OBJ);

  // Dados para o gráfico
  $dadosGrafico = $db->query("
      SELECT f.nome_fazenda, COUNT(a.id_animal) AS total_animais
      FROM fazenda f
      LEFT JOIN animal a ON f.id_fazenda = a.id_fazenda
      GROUP BY f.id_fazenda
      ORDER BY f.nome_fazenda
  ")->fetchAll(PDO::FETCH_ASSOC);

  $nomesFazendas = array_column($dadosGrafico, 'nome_fazenda');
  $qtdAnimais = array_column($dadosGrafico, 'total_animais');
  ?>

  <h2 class="titulo-dashboard">Painel Geral</h2>

  <div class="row mt-4 mb-4">
    <div class="col-md-4">
      <div class="card-info">
        <h4>Total de Fazendas</h4>
        <p class="numero"><?= $totalFazendas ?></p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-info">
        <h4>Total de Animais</h4>
        <p class="numero"><?= $totalAnimais ?></p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-info">
        <h4>Fazenda com Mais Animais</h4>
        <p class="nome-fazenda"><?= $topFazenda->nome_fazenda ?? 'Nenhuma' ?></p>
        <p><?= $topFazenda->total ?? 0 ?> animais</p>
      </div>
    </div>
  </div>

  <div class="grafico-container">
    <h4 class="mb-3">Animais por Fazenda</h4>
    <canvas id="graficoAnimais"></canvas>
  </div>

  <script>
    const ctx = document.getElementById('graficoAnimais');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?= json_encode($nomesFazendas) ?>,
        datasets: [{
          label: 'Quantidade de Animais',
          data: <?= json_encode($qtdAnimais) ?>,
          borderWidth: 1,
          backgroundColor: 'rgba(47, 125, 128, 0.6)',
          borderColor: 'rgb(47, 125, 128)'
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: { beginAtZero: true }
        }
      }
    });
  </script>

</main>

<footer>
  <?php require_once "_parts/_footer.php"; ?>
</footer>

</body>
</html>
