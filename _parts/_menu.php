<nav class="navbar navbar-expand-lg nav-custom py-3" style="background-color: var(--cor-pessego);">
  <style>
    /* Links do menu */
    .navbar-nav .nav-link {
      position: relative;
      color: #e4ddddff; /* letra branca */
      font-weight: 500;
      padding: 5px 0;
      transition: color 0.3s ease;
    }

    /* Linha invisível */
    .navbar-nav .nav-link::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: -2px;
      width: 0;
      height: 2px;
      background-color: #fff; /* cor da linha */
      transition: width 0.3s ease;
    }

    /* Linha aparece no hover */
    .navbar-nav .nav-link:hover::after {
      width: 100%;
    }

    /* Opcional: mantém texto branco ao passar o mouse */
    .navbar-nav .nav-link:hover {
      color: #fff;
    }
  </style>

  <div class="container">
    <img src="images/logo.png" alt="logo" style="height: 50px; margin-right: 20px;" />
    
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
      <i class="bi bi-three-dots fs-2"></i>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item px-2">
          <a href="Tarefas.php" class="nav-link">Ir para a Agenda</a>
        </li>
        <li class="nav-item px-2">
          <a href="cadastroUsuario.php" class="nav-link">Cadastro de Usuário</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
