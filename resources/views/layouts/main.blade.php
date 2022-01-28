<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        {{-- Bootstrap link --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        {{-- ion icons link --}}
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

        <link rel="stylesheet" href="/css/styles.css">
        <script src="/js/scripts.js"></script>

    </head>
    <body class="antialiased">

    <header>
        <nav class="navbar">

            <div class="collapse.navbar-collapse" id="navbar">
                <a href="/" class="navbar-brand">
                <img src="/img/logo.jfif" alt="logo">
                </a>
                <ul class="nav justify-content-center">
                    <li class="nav-item"><a href="/" class="nav-link">Eventos</a></li>
                    <li class="nav-item"><a href="/events/create" class="nav-link">Criar Eventos</a></li>
                    @auth
                    <li class="nav-item"><a href="/dashboard" class="nav-link">Meus Eventos</a></li>

                    <li class="nav-item"><form action="/logout" method="POST">
                        @csrf
                        <a href="/logout" class="nav-link" onclick="event.preventDefault();
                        this.closest('form').submit();">Sair</a>
                    </form></li>

                    @endauth
                    @guest
                    <li class="nav-item"><a href="/login" class="nav-link">Entrar</a></li>
                    <li class="nav-item"><a href="/register" class="nav-link">Cadastrar</a></li>
                    @endguest
                </ul>
            </div> 
            
        </nav>
    </header>
    <main>
        <div class="container-fluid">
            <div class="row">
                @if( session('msg') )
                <p class="msg">{{ session('msg') }}</p>
                @endif
                @yield('content')
            </div>
        </div>
    </main>
    
    <footer>
        <p>HDC Events &copy; 2020</p>
    </footer>

    </body>
</html>
