<nav class="navbar navbar-expand-lg bg-body-tertiary" id="nav-bar">
    <div class="container-fluid">
      @auth
      <div class="dropdown">
        <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{ auth()->user()->name }}
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/dashboard">Meus registros</a></li>
          <form action="/logout" method="POST">
            @csrf
            <li>
              <a class="dropdown-item" href="/logout" onclick="event.preventDefault(); this.closest('form').submit();">
                Logout
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                  <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
                  <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117M11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z"/>
                </svg>
              </a>
          </form>
        </ul>
      </div>
      @endauth
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          @auth
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Página principal</a>
          </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Serviços
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/fichaTecnica">Ficha Técnica</a></li>
                <li><a class="dropdown-item" href="/internamentos">Pacientes Internados</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Telefone de hospitais</a></li>
                <li><a class="dropdown-item" href="#">Listagem de medicamento</a></li>
                <li><a class="dropdown-item" href="#">Dosagem de medicação</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a id="ghost-text" class="nav-link disabled" aria-disabled="true">Olá, seja bem vindo a nossa central de atendimento</a>
            </li>
            <form class="d-flex" role="search" method="GET" action="/">
              <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" name="search">
              <button class="btn btn-outline-success" type="submit">Pesquisar</button>
            </form>
          @endauth
          @guest    
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/login">Entrar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/register">Cadastrar</a>
            </li>
          @endguest
        </ul>
      </div>
    </div>
</nav>