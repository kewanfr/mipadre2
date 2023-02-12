<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <link rel="stylesheet" href="<?= Router::webroot("css/style.css") ?>">

  <title>
  Administration | <?php echo isset($title_for_layout) ? $title_for_layout : Conf::$siteName; ?>
  </title>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?= Router::url("") ?>">
      <img src="<?= Router::webroot("img/logo.png") ?>" class="nav-logo" alt="<?= Conf::$siteName ?>">
      <span class="nav-brand">Administration</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item <?= $pageName == 'clients' ? 'active' : '' ?>">
          <a class="nav-link" href="<?= Router::url("admin/clients/") ?>">Liste des Clients</a>
        </li>
      </ul>
      <ul class="navbar-nav mr-right">
        <?php if($this->Session->isLogged()): ?>
        <li class="nav-item">
          <a class="nav-link">Connecté en tant que <?= $this->Session->user("login") ?></a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="<?= Router::url("users/logout") ?>">Déconnexion</a>
        </li>
        <?php else: ?>
        <li class="nav-item <?= $pageName == 'login' ? 'active' : '' ?>">
          <a class="nav-link" href="<?= Router::url("users/login") ?>">Connexion</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>

  <div class="container py-4 h-100">
    <?= $this->Session->flash(); ?>
    <?php echo $content_for_layout; ?>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script defer>
  $(document).ready(function() {
    $("#cavistes-table").DataTable({
      language: {
        "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/French.json"
      },
      // ordering: false,
      pageLength: 25,
      columns: [
        {
          name: "id",
          orderable: true,
        },
        {
          name: "name",
          orderable: true,
        },
        {
          name: "bouteilles",
          orderable: true,
        },
        {
          name: "adresse",
          orderable: false,
        },
        {
          name: "actions",
          orderable: false,
        },
        
      ],
      order: [[ 1, "desc" ]]
    });
  });
</script>

</body>

</html>