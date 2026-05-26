<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/clients.css') }}">
        <link rel="stylesheet" href="{{ asset('css/modal-client.css') }}">
    @endpush
    
    <x-slot:title>
        Cadastro de Clientes
    </x-slot:title>

    <x-slot:caminho>
        <i class="fas fa-chevron-right seta-bread"></i>
        Cadastro
        <i class="fas fa-chevron-right seta-bread"></i>
        Clientes
    </x-slot:caminho>

    <div class="cabecalho-pagina">
        <h1>Cliente</h1>
        <p>Cadastrar, consultar, alterar e excluir um cliente</p>
    </div>

    <div class="barra-ferramentas">
        <button id="btn-novo" class="btn-estilizado btn-novo">
            <i class="fas fa-plus-circle"></i> Novo
        </button>

        <x-modal-client
            idModal="modalCriar"
            titulo="Cadastrar Novo Cliente"
            action="{{ route('clientes.store') }}"
            :proximoId="$proximoIdFormatado"
        />

        <form method="GET" action="{{ route('clientes.index') }}" class="form-filtros">
            <span class="label-filtro">Filtrar por:</span>
            
            <div class="grupo-filtro">
                <label for="codigo">Código:</label>
                <input type="text" name="codigo" id="codigo" class="input-estilizado input-curto mascara-codigo" maxlength="7" value="{{ request('codigo') }}">
            </div>

            <div class="grupo-filtro">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="input-estilizado input-longo" value="{{ request('nome') }}">
            </div>
            
            <div class="grupo-filtro">
                <label for="cnpj_filtro">CNPJ:</label>
                <input type="text" name="cnpj" id="cnpj_filtro" class="input-estilizado mascara-cnpj" maxlength="18" value="{{ request('cnpj') }}">
            </div>

            <div class="botoes-filtro">
                <button type="submit" class="btn-icone" title="Filtrar"><i class="fas fa-search"></i></button>
                <button type="button" id="btn-limpar" class="btn-icone" title="Limpar"><i class="fas fa-ban"></i></button>
            </div>
        </form>
    </div>

    <div class="tabela-container">
        <table class="tabela-clientes">
            <thead>
                <tr>
                    <th class="{{ request('sort') === 'id' ? 'th-ativo' : '' }}">
                        @php
                            $idDirection = request('sort') === 'id' && request('direction') === 'asc' ? 'desc' : 'asc';

                            $iconeId = 'fa-sort';
                            if (request('sort') === 'id') {
                                $iconeId = request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down';
                            }
                        @endphp
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => $idDirection]) }}" class="link-ordenacao{{ request('sort') === 'id' ? 'link-ativo' : '' }}">
                            Código <i class="fas {{ $iconeId }}"></i>
                        </a>
                    </th>
                    <th class="{{ request('sort') === 'name' ? 'th-ativo' : '' }}">
                        @php
                            $nomeDirection = request('sort') === 'name' && request('direction') === 'asc' ? 'desc' : 'asc';

                            $iconeNome = 'fa-sort';
                            if (request('sort') === 'name') {
                                $iconeNome = request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down';
                            }
                        @endphp
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => $nomeDirection]) }}" class="link-ordenacao{{ request('sort') === 'name' ? 'link-ativo' : '' }}">
                            Nome <i class="fas {{ $iconeNome }}"></i>
                        </a>
                    </th>
                    <th class="{{ request('sort') === 'cnpj' ? 'th-ativo' : '' }}">
                        @php
                            $cnpjDirection = request('sort') === 'cnpj' && request('direction') === 'asc' ? 'desc' : 'asc';

                            $iconeCnpj = 'fa-sort';
                            if (request('sort') === 'cnpj') {
                                $iconeCnpj = request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down';
                            }
                        @endphp
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'cnpj', 'direction' => $cnpjDirection]) }}" class="link-ordenacao{{ request('sort') === 'cnpj' ? 'link-ativo' : '' }}">
                            CNPJ <i class="fas {{ $iconeCnpj }}"></i>
                        </a>
                    </th>
                    <th class="col-acao">Alterar</th>
                    <th class="col-acao">Excluir</th>
                </tr>
            </thead>
            <tbody>
                @if ($clients->isNotEmpty())
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->codigo_formatado }}</td>
                            <td class="text-left">{{ $client->name }}</td>
                            <td> {{ $client->cnpj_formatado }}</td>
                            <td class="col-acao">
                                <button class="btn-tabela btn-editar" data-target="modalEditar-{{ $client->id }}"><i class="fas fa-edit"></i></button>
                            </td>
                            <td class="col-acao">
                                <button style="color: red;" class="btn-tabela btn-excluir-trigger"
                                    data-id="{{ $client->id }}" 
                                    data-nome="{{ $client->name }}" 
                                    data-cnpj="{{ $client->cnpj }}">
                                <i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>

                        <x-modal-client
                            idModal="modalEditar-{{ $client->id }}"
                            titulo="Editar Cliente"
                            action="{{ route('clientes.update', $client->id) }}"
                            :client="$client"
                        />
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 20px;">
                            Nenhum registro encontrado
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="paginacao-container">
            {{ $clients->links('components.paginacao') }}
        </div>
    </div>

    <div class="modal-overlay" id="modal-exclusao" style="display: none;">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Excluir Cliente</h3>
                <button type="button" class="btn-fechar-modal id-fechar-exclusao"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="alerta-vermelho" style="font-weight: bold; font-size: 16px; margin-bottom: 20px;">
                    Atenção, deseja realmente excluir o cliente <span id="texto-cnpj-exclusao"></span> - <span id="texto-nome-exclusao"></span>?
                </div>
            </div>
            <div class="modal-footer">
                <form id="form-exclusao" class="form-exclusao" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-estilizado" style="background-color: #d9534f; color: white;">
                        <i class="fas fa-check"></i> SIM
                    </button>
                    <button type="button" class="btn-estilizado id-fechar-exclusao">
                        <i class="fas fa-times"></i> NÃO
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/client.js') }}"></script>
        <script src="{{ asset('js/modal-client.js') }}"></script>
    @endpush
</x-layout>