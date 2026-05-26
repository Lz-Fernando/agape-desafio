<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>
    <div class="container-principal">
        
        <div class="painel-esquerdo">
        </div>

        <div class="painel-direito">
            
            <div class="logo-container">
                <img src="{{ asset('assets/logo.png') }}" alt="Ágape Sistemas" style="height: 60px;">
            </div>

            <div class="area-erro">
                <span 
                    class="alerta-erro" 
                    style="display: {{ $errors->any() ? 'block' : 'none' }};" 
                    id='span-exclusivo'
                >
                    {{ $errors->first() }}
                </span>
            </div>

            <form method="POST" action="/login" id='form-login'>
                @csrf

                <div class="grupo-input">
                    <label for="identifier">Identificação do usuário: *</label>
                    <input type="text" name="identifier" id="identifier" maxlength="8" class="input-estilizado" value="{{ old('identifier') }}">
                </div>

                <div class="grupo-input">
                    <label for="password">Senha: *</label>
                    <div class="linha-senha">
                        <input type="password" name="password" id="password" class="input-estilizado" minlength="8" maxlength="16">
                        <label class="checkbox-container" for="visualizate">
                            <input type="checkbox" name="visualizate" id="visualizate">
                            Visualizar
                        </label>
                    </div>
                </div>

                <div class="botoes-container">
                    <button type="submit" class="btn">Acessar</button>
                    <button type="reset" class="btn">Cancelar</button>
                </div>
            </form>

            <span class="aviso-rodape" style="display: none;" id="alerta-campos">
                * campos obrigatórios
            </span>
        </div>
    </div>
    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>