<ul class="nav">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="/">Inicio</a>
    </li>
    @guest
      <li class="nav-item">
        <a class="nav-link" href="/login">Iniciar sesión</a>
      </li>
    @else
      <li class="nav-item">
        <a class="nav-link" href="/home">Home</a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Catálogos</a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/clientes">Clientes</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <form style="display: inline" action="/logout" method="post">
          @csrf
          <a class="nav-link" href="#" onclick="this.closest('form').submit()">Salir</a>
        </form>
      </li>
    @endguest
</ul>
