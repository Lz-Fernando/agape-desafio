@props([
    'idModal',
    'titulo',
    'action',
    'client' => null,
    'proximoId' => null
])

<div id="{{ $idModal }}" class="modal-overlay" style="display: none;">
    
    <div class="modal-box modal-box-grande">
        
        <div class="modal-header">
            <h3>{{ $titulo }}</h3>
            <button type="button" class="btn-fechar-modal btn-fechar"><i class="fas fa-times"></i></button>
        </div>

        <form method="POST" action="{{ $action }}">
            @csrf
            @if ($client)
                @method('PUT')
            @endif

            <div class="modal-body">
                
                <fieldset class="fieldset-custom">
                    <legend class="legend-custom">Dados do Cliente</legend>

                    @if ($errors->any())
                        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; font-weight: bold;">
                            <ul style="margin: 0; padding-left: 20px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalCriar').style.display = 'flex';
                            });
                        </script>
                    @endif

                    <div class="linha-form">
                        <div class="grupo-form-inline" style="flex: 1;">
                            <label for="inputCodigo-{{ $idModal }}">Código:</label>
                            <input type="text" id="inputCodigo-{{ $idModal }}" class="input-estilizado mascara-codigo" readonly style="background-color: #f0f0f0;" value="{{ $client ? $client->codigo_formatado : $proximoId }}">
                        </div>
                        <div class="grupo-form-inline" style="flex: 3;">
                            <label for="inputNome">Nome: <span class="asterisco">*</span></label>
                            <input type="text" id="inputNome" name="name" class="input-estilizado" value="{{ old('name', $client?->name ?? '') }}" maxlength="40" required>
                        </div>
                    </div>

                    <div class="linha-form">
                        <div class="grupo-form-inline" style="flex: 1.2;">
                            <label for="inputCnpj">CNPJ: <span class="asterisco">*</span></label>
                            <input type="text" id="inputCnpj" name="cnpj" class="input-estilizado mascara-cnpj" value="{{ old('cnpj', $client?->cnpj ?? '') }}" maxlength="18" required>
                        </div>
                        <div class="grupo-form-inline" style="flex: 1;">
                            <label for="inputRg">RG: <span class="asterisco">*</span></label>
                            <input type="text" id="inputRg" name="rg" class="input-estilizado mascara-rg" maxlength="17" value="{{ old('rg', $client?->rg ?? '') }}" required>
                        </div>
                        <div class="grupo-form-inline" style="flex: 1;">
                            <label for="inputNascimento">Nascimento:</label>
                            <input type="date" id="inputNascimento" name="born" class="input-estilizado" value="{{ old('born', $client?->born ?? '') }}">
                        </div>
                    </div>

                    <div class="linha-form">
                        <div class="grupo-form-inline" style="flex: 2;">
                            <label for="inputEndereco">Endereço: <span class="asterisco">*</span></label>
                            <input type="text" id="inputEndereco" name="address" class="input-estilizado" maxlength="40" value="{{ old('address', $client?->address?->address ?? '') }}" required>
                        </div>
                        <div class="grupo-form-inline" style="flex: 1;">
                            <label for="inputComplemento">Complemento:</label>
                            <input type="text" id="inputComplemento" name="complement" class="input-estilizado" maxlength="20" value="{{ old('complement', $client?->address?->complement ?? '') }}">
                        </div>
                    </div>

                    <div class="linha-form">
                        <div class="grupo-form-inline" style="flex: 2;">
                            <label for="inputBairro">Bairro: <span class="asterisco">*</span></label>
                            <input type="text" id="inputBairro" name="neighborhood" class="input-estilizado" maxlength="20" value="{{ old('neighborhood', $client?->address?->neighborhood ?? '') }}" required>
                        </div>
                        <div class="grupo-form-inline" style="flex: 1;">
                            <label for="inputCep">CEP:</label>
                            <input type="text" id="inputCep" name="cep" class="input-estilizado mascara-cep" maxlength="8" value="{{ old('cep', $client?->address?->cep ?? '') }}">
                        </div>
                        <div class="grupo-form-inline" style="flex: 2;">
                            <label for="inputCidade">Cidade: <span class="asterisco">*</span></label>
                            <input type="text" id="inputCidade" name="city" class="input-estilizado" maxlength="20" value="{{ old('city', $client?->address?->city ?? '') }}" required>
                        </div>
                        <div class="grupo-form-inline" style="flex: 0.65;">
                            <label for="inputUf">UF: <span class="asterisco">*</span></label>
                            <input type="text" id="inputUf" name="uf" class="input-estilizado" maxlength="2" value="{{ old('uf', $client?->address?->uf ?? '') }}" required>
                        </div>
                    </div>

                    <div class="linha-form">
                        <div class="grupo-form-inline" style="flex: 1;">
                            <label for="inputTelefone">Telefone:</label>
                            <input type="text" id="inputTelefone" name="telephone" class="input-estilizado mascara-telefone" maxlength="13" value="{{ old('telephone', $client?->contact?->telephone ?? '') }}">
                        </div>
                        <div class="grupo-form-inline" style="flex: 1;">
                            <label for="inputCelular">Celular: <span class="asterisco">*</span></label>
                            <input type="text" id="inputCelular" name="cellphone" class="input-estilizado mascara-celular" maxlength="14" value="{{ old('cellphone', $client?->contact?->cellphone ?? '') }}" required>
                        </div>
                        <div style="flex: 1.5;"></div>
                    </div>

                    <div class="linha-form align-top">
                        <div class="grupo-form-inline" style="flex: 1; align-items: flex-start;">
                            <label for="inputObservacao">Observação:</label>
                            <textarea id="inputObservacao" name="observation" rows="3" maxlength="150" class="input-estilizado">{{ old('observation', $client?->observation ?? '') }}</textarea>
                        </div>
                    </div>

                </fieldset>
            </div>

            <div class="modal-footer-left">
                <button type="submit" class="btn-estilizado"><i class="fas fa-check"></i> Salvar</button>
                <button type="button" class="btn-estilizado btn-fechar"><i class="fas fa-times"></i> Fechar</button>
            </div>
        </form>
    </div>
</div>