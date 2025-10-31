<nav class="navbar navbar-expand-lg" style="background-color: #D91656; color: black;">
  <div class="container">
    <!-- Marca i Logo -->
    <a class="navbar-brand" href="/" style="color: white;">
      <img src="{{ asset('img/logo1.png') }}" alt="Logo" style="max-width: 40px; margin-right: 10px;">
      ARTIISTC
    </a>

    <!-- Botó per a dispositius mòbils -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    @if(Auth::check())
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Opcions de la barra d'entrades -->
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ url('/esdevenimen') }}">
              <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Esdeveniments
            </a>
          </li>
          {{-- tot i que editar i crear un esdeveniment nomes siguin propietats que pot fer el administrador, 
          aixo fa que no sigui visible per al usuari --}}
          @if(Auth::user()->email === 'admin@admin.cat')
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ url('/esdevenimen/create') }}">
                <span>&#10010;</span> Nou Esdeveniment
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="adminDropdown" role="button"
                 data-bs-toggle="dropdown" aria-expanded="false">
                Categoria
              </a>
              <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                <li><a class="dropdown-item" href="{{ url('/categorias/create') }}">Crear Categoria</a></li>
                <li><a class="dropdown-item" href="{{ route('categorias.index') }}">Editar Categoria</a></li>
              </ul>
            </li>
          @endif
        </ul>

        <!-- Carrega les categories -->
        @php
          $categories = \App\Models\Categoria::all();
        @endphp

        <!-- Opcions de la barra a la dreta -->
        <ul class="navbar-nav ms-auto">
          <!-- Dropdown per a les categories per a usuaris -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="categoriesDropdown" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
              @foreach($categories as $category)
                <li>
                  <a class="dropdown-item" href="{{ route('esdevenimen.byCategory', $category->id) }}">
                    {{ $category->nom }}
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
          <!-- Navbar amb el menú -->
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                  <li><a class="dropdown-item" href="{{ route('profile.show') }}">Perfil</a></li>
                  <li>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Tancar sessió
                      </a>
                  </li>
              </ul>
          </li>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </ul>
      </div>
    @endif
  </div>
</nav>