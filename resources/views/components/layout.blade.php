<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistema Ágape' }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">

    @stack('styles')
</head>
<body>

    <header class="topo-aplicacao">
        <div class="logo-container">
            <img src="{{ asset('assets/logo.png') }}" alt="Ágape Sistemas" style="height: 40px;">
        </div>
    </header>

    <div class="container-principal">
        
        <aside class="menu-lateral">
            
            <div class="menu-header">
                <i class="fas fa-list icone-amarelo"></i>
            </div>

            <ul class="lista-menu">
                
                <li>
                    <a href="{{ route('home') }}" class="menu-item">
                        <div class="item-esq">
                            <i class="fas fa-home icone-amarelo"></i>
                            <span>Início</span>
                        </div>
                    </a>
                </li>

                <li>
                    <div class="menu-item toggle-submenu" data-target="sub-cadastro">
                        <div class="item-esq">
                            <i class="fas fa-caret-square-down icone-amarelo"></i>
                            <span>Cadastro</span>
                        </div>
                        <i class="fas fa-chevron-down seta"></i>
                    </div>
                    <ul class="submenu" id="sub-cadastro">
                        <li><a href="{{ route('clientes.index') }}">Cliente</a></li>
                        <li><a href="#">Produto</a></li>
                    </ul>
                </li>

                <li>
                    <div class="menu-item toggle-submenu" data-target="sub-pedido">
                        <div class="item-esq">
                            <i class="fas fa-caret-square-down icone-amarelo"></i>
                            <span>Pedido</span>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="menu-item toggle-submenu" data-target="sub-relatorios">
                        <div class="item-esq">
                            <i class="fas fa-caret-square-down icone-amarelo"></i>
                            <span>Relatório</span>
                        </div>
                        <i class="fas fa-chevron-down seta"></i>
                    </div>
                    <ul class="submenu" id="sub-relatorios">
                        <li><a href="{{ route('relatorios.clientes') }}">Cliente</a></li>
                        <li><a href="#">Produto</a></li>
                        <li><a href="#">Pedido</a></li>
                    </ul>
                </li>

                <li>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="menu-item btn-sair">
                            <div class="item-esq">
                                <i class="fas fa-sign-out-alt icone-amarelo"></i>
                                <span>Sair</span>
                            </div>
                        </button>
                    </form>
                </li>

            </ul>
        </aside>

        <main class="conteudo-principal">
            
            <div class="breadcrumb d-flex align-items-center gap-2">
                <a href="{{ route('home') }}" style="text-decoration: none; color: #1f1f1f;"><i class="fas fa-home"></i></a>
                {{ $caminho ?? '' }}
            </div>

            <div class="area-slot">
                {{ $slot ?? '' }}
            </div>

        </main>
    </div>

    <script src="{{ asset('js/layout.js') }}"></script>
    @stack('scripts')
</body>
</html>