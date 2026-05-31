<x-layout>
    @push('styles')
        
    @endpush

    <x-slot:title>
        Cadastro de Produtos
    </x-slot:title>

    <x-slot:caminho>
        <i class="fas fa-chevron-right seta-bread"></i>
        Cadastro
        <i class="fas fa-chevron-right seta-bread"></i>
        Produtos
    </x-slot:caminho>

    <div class="cabecalho-pagina">
        <h1>Produtos</h1>
        <p>Cadastrar, consultar, alterar e excluir um produto</p>
    </div>

    <div class="barra-ferramentas">
        <button id="btn-novo" class="btn-estilizado btn-novo">
            <i class="fas fa-plus-circle"></i> Novo
        </button>

        <x-modal-product
            idModal="modalCriar"
            titulo="Cadastrar Novo Produto"
        />

        <form method="GET" action="{{ route('products.index') }}" class="form-filtros">
            <span class="label-filtro">Filtrar por:</span>
            
            <div class="grupo-filtro">
                <label for="codigo">Código:</label>
                <input type="text" name="codigo" id="codigo" class="input-estilizado input-curto mascara-codigo" maxlength="7" value="{{ request('codigo') }}">
            </div>

            <div class="grupo-filtro">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="input-estilizado input-longo" value="{{ request('nome') }}">
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
                    <th>
                        Imagem <i class="fas"></i>
                    </th>
                    <th class="{{ request('sort') === 'code' ? 'th-ativo' : '' }}">
                        @php
                            $codeDirection = request('sort') === 'code' && request('direction') === 'asc' ? 'desc' : 'asc';

                            $iconeCode = 'fa-sort';
                            if (request('sort') === 'code') {
                                $iconeCode = request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down';
                            }
                        @endphp
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'code', 'direction' => $codeDirection]) }}" class="link-ordenacao{{ request('sort') === 'code' ? 'link-ativo' : '' }}">
                            Código <i class="fas {{ $iconeCode }}"></i>
                        </a>
                    </th>
                    <th class="{{ request('sort') === 'name' ? 'th-ativo' : '' }}">
                        @php
                            $nameDirection = request('sort') === 'name' && request('direction') === 'asc' ? 'desc' : 'asc';

                            $iconeName = 'fa-sort';
                            if (request('sort') === 'name') {
                                $iconeName = request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down';
                            }
                        @endphp
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => $nameDirection]) }}" class="link-ordenacao{{ request('sort') === 'name' ? 'link-ativo' : '' }}">
                            Nome <i class="fas {{ $iconeName }}"></i>
                        </a>
                    </th>
                    <th class="{{ request('sort') === 'price' ? 'th-ativo' : '' }}">
                        @php
                            $priceDirection = request('sort') === 'price' && request('direction') === 'asc' ? 'desc' : 'asc';

                            $iconePrice = 'fa-sort';
                            if (request('sort') === 'price') {
                                $iconePrice = request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down';
                            }
                        @endphp
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'price', 'direction' => $priceDirection]) }}" class="link-ordenacao{{ request('sort') === 'price' ? 'link-ativo' : '' }}">
                            Preço <i class="fas {{ $iconePrice }}"></i>
                        </a>
                    </th>
                    <th class="{{ request('sort') === 'stock' ? 'th-ativo' : '' }}">
                        @php
                            $stockDirection = request('sort') === 'stock' && request('direction') === 'asc' ? 'desc' : 'asc';

                            $iconeStock = 'fa-sort';
                            if (request('sort') === 'stock') {
                                $iconeStock = request('direction') === 'asc' ? 'fa-sort-up' : 'fa-sort-down';
                            }
                        @endphp
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'stock, 'direction' => $stockDirection]) }}" class="link-ordenacao{{ request('sort') === 'stock' ? 'link-ativo' : '' }}">
                            Estoque <i class="fas {{ $iconeStock }}"></i>
                        </a>
                    </th>
                    <th class="col-acao">Alterar</th>
                    <th class="col-acao">Excluir</th>
                </tr>
            </thead>
            <tbody>
                @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->image }}</td>
                            <td>{{ $product->code }}</td>
                            <td class="text-left">{{ $product->name }}</td>
                            <td> {{ $product->price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td class="col-acao">
                                <button class="btn-tabela btn-editar" data-target="modalEditar-{{ $product->code }}"><i class="fas fa-edit"></i></button>
                            </td>
                            <td class="col-acao">
                                <button style="color: red;" class="btn-tabela btn-excluir-trigger"
                                    data-code="{{ $client->code }}" 
                                    data-name="{{ $client->name }}" >
                                <i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>

                        <x-modal-product
                            idModal="modalEditar-{{ $product->id }}"
                            titulo="Editar Produto"
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
            {{ $products->links('components.paginacao') }}
        </div>
    </div>

    <div class="modal-overlay" id="modal-exclusao" style="display: none;">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Excluir Produto</h3>
                <button type="button" class="btn-fechar-modal id-fechar-exclusao"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="alerta-vermelho" style="font-weight: bold; font-size: 16px; margin-bottom: 20px;">
                    Atenção, deseja realmente excluir o produto <span id="texto-code-exclusao"></span> - <span id="texto-name-exclusao"></span>?
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
        <script src="{{ asset('js/product.js') }}"></script>
        <script src="{{ asset('js/modal-product.js') }}"></script>
    @endpush
</x-layout>