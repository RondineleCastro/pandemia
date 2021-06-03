<?php 
  $view = $view ?? 'home';
  $session = \Config\Services::session();
  $msgFlash = $session->getFlashdata('msgFlash') ?? null;
  $user_id = $session->get('user_id') ?? null;
  $user_cpf = $session->get('cpf') ?? null;
  $user_nome = $session->get('nome') ?? null;
  $user_perfil = $session->get('perfil') ?? null;
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Fontawesome -->
    <link href="assets/fonts/fontawesome/css/all.min.css" rel="stylesheet">
    <title>ImmuneSystem</title>
  </head>
  <body class="rs-background" style="background-image: url(<?= base_url() ?>/assets/img/teresina.jpg);">
    <header class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?= base_url() ?>">ImmuneSystem</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class="navbar-nav ml-auto my-2 my-lg-0 navbar-nav-scroll">
            <?php if ($user_perfil === 'Administrador'): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                Relatório de Entregas
              </a>
              <ul class="dropdown-menu bg-dark" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item text-muted" href="<?= base_url() ?>#">Concluídas</a></li>
                <li><a class="dropdown-item text-muted" href="<?= base_url() ?>#">Canceladas</a></li>
                <!-- <li><hr class="dropdown-divider"></li> -->
                <li><a class="dropdown-item text-muted" href="<?= base_url() ?>#">Pendentes</a></li>
              </ul>
            </li>
            <?php endif ?>

            <?php if (!$user_id): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="/" id="dropdown-login" role="button" data-toggle="dropdown" aria-expanded="false">
                Entrar
              </a>
              <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-login">
                <li class="px-3 my-2" style="min-width:300px;">
                  <form id="login-form" action="<?= base_url('/home/login') ?>" method="post" class="row">
                    <div class="col-12">
                      <h5>Acessar o Sistema</h5>
                      <div class="form-group">
                        <!-- <label for="cpf">Digite seu CPF</label> -->
                        <input type="text" id="cpf" class="form-control form-control-lg" name="cpf" placeholder="Digite seu CPF" pattern="[0-9]{11}" autofocus required>
                      </div>
                      <div class="form-group">
                        <input type="checkbox" id="loginform-rememberme" name="rememberMe" value="1" checked="">
                        <label for="loginform-rememberme">Lembre-se de mim</label>
                      </div>
                      <div class="form-row">
                        <div class="col-7 col-md-8">
                          <a class="btn btn-default btn-block" href="<?= base_url('/usuario/cadastrar') ?>" role="button">Nâo sou cadastrado</a>
                        </div>
                        <div class="col-5 col-md-4">
                          <button type="submit" class="btn btn-primary btn-block" name="login-button">Entrar</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </li>
              </ul>
            </li>
            <?php else: ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarLogado" role="button" data-toggle="dropdown" aria-expanded="false">
                <?= $user_nome ?>
              </a>
              <ul class="dropdown-menu bg-dark dropdown-menu-right" aria-labelledby="navbarLogado">
                <li><a class="dropdown-item text-muted" href="<?= base_url('/agendamento/agendar') ?>">Agendar</a></li>
                <li><a class="dropdown-item text-muted" href="<?= base_url('/agendamento/listar') ?>">Meus Agendamentos</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-muted" href="<?= base_url('/home/logout') ?>">Sair</a></li>
              </ul>
            </li>
            <?php endif ?>
          </ul>
        </div>
      </nav>
    </header>
    <?php if ($msgFlash): ?>
    <!-- alert -->
    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="position: fixed; top: 75px; left: 15px; right: 15px; z-index: 100;">
      <?= $msgFlash ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div> <!-- /alert -->
    <?php endif ?>

    <main class="container-md" style="background: rgba(250,250,250, 0.9); border-radius: 10px;  margin-top: 80px; margin-bottom: 60px; padding: 20px 15px; min-height: 75vh;">
      
      <?php echo $this->include($view) ?>

    </main>

    <footer class="fixed-bottom d-none d-md-block">
      <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">ImmuneSystem</span>
        <span style="color: rgba(255, 255, 255, 0.5);">Desenvolvido por Rondinele de Castro - 2021 ©</span>
      </nav>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
  <script>
    $('#btn-medicamento').on('click', function() {
      $('#div-input-check').show();
      $('#div-input-dt_contaminacao').show();
      $('#div-input-dt_recuperacao').show();
    });
    $('#btn-vacina').on('click', function() {
      $('#div-input-check').hide();
      $('#div-input-dt_contaminacao').hide();
      $('#div-input-dt_recuperacao').hide();
    });
  </script>
</html>