<nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <!--     
        <li><a class="nav-link" href="<?= hlien("database", "creer") ?>">Créer BDD</a></li>
        <li><a class="nav-link" href='<?= hlien("database", "dataset") ?>'>Jeu de données</a></li>
-->
        <li><a class="nav-link" href="<?= hlien("stagiaire", "prepa") ?>">Prépa</a></li>
        <li><a class="nav-link" href='<?= hlien("stagiaire", "tertiaire") ?>'>Tertiaire</a></li>
        <li><a class="nav-link" href='<?= hlien("stagiaire", "ifmk") ?>'>IFMK</a></li>
        <li><a class="nav-link" href='<?= hlien("stagiaire", "contact") ?>'>Nous Contacter</a></li>
      </ul>
    </div>
  </div>
</nav>