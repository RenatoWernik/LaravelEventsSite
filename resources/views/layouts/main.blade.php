<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

       
        <!-- fonte do google -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,900&family=Roboto" rel="stylesheet">
      <!-- css bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


        
      
         <!-- css da aplicação -->
        <link rel="stylesheet" href="/css/styles.css">
         <!-- js da aplicação -->
        <script src="/js/scripts.js"></script>
        
    </head> 
    <body class="antialiased">
        <header><nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse" id="navbar">
                <a href="/" class="navbar-brand">
                    <img src="/img/goods.png" alt="logo">
                </a>
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link">Meus eventos</a>
                    </li>
                    <li class="nav-item">
                        <a href="/events/create" class="nav-link">Criar Eventos</a>
                    </li>
                    <li class="nav-item">
                        <form action="/logout" method="POST">
                            @csrf
                            <a href="/logout"
                                class="nav-link"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                Sair
                            </a>
                        </form>

                    </li>
                    @endauth
                    @guest
                    <li class="nav-item">
                        <a href="/login" class="nav-link">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a href="/register" class="nav-link">Cadastrar</a>
                    </li>
                    @endguest
                </ul>

            </div>
        </nav>
</header>
      
<main>
    <div class="container-fluid">
        <div class="row">
            @if(session("msg"))
            <p class="msg">{{ session("msg") }}</p>
            @endif
            @yield("content")
        </div>

    </div>



</main>
    <!-- Yield/section para conteudos dinamicos. -->
    <!--Extends/layout para conteudos "iguais"/que vão se repetir-->
    <footer>
        <p>RenatoWernik &copy; 2024</p>
    </footer>
    

     
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
</html>
