<nav class="navbar navbar-expand-lg text-bg-warning">
    <div class="container-fluid container">
      <a class="navbar-brand text-white fw-medium fs-4 mx-2">
        General Invasion
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto"></ul>
        <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-white fs-5 mx-2" href="{{ route('dashboard.index') }}">Transactions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white fs-5 mx-2" href="{{ route('dashboard.getcreatetransaction') }}">Obtenir un lien</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white fs-5 mx-2" href="#">Ajouter un admin</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white fs-5 mx-2 disabled" aria-disabled="true">Deconnexion</a>
            </li>
          </ul>
      </div>
    </div>
</nav>