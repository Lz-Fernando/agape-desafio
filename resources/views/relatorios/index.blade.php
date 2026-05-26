<x-layout>
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/relatorio.css') }}">
    @endpush

    <x-slot:title>
        Relatórios de Clientes
    </x-slot:title>

    <x-slot:caminho>
        <i class="fas fa-chevron-right seta-bread"></i>
        Relatórios
        <i class="fas fa-chevron-right seta-bread"></i>
        Clientes
    </x-slot:caminho>

    <div class="cabecalho-pagina">
        <h1>Relação de clientes</h1>
    </div>

    <div class="barra-ferramentas-relatorio">
        <form method="GET" action="{{ route('relatorios.imprimir') }}" class="form-relatorio" target="_blank">
            
            <div class="grupo-busca">
                <label for="busca-cliente">Cliente:</label>
                
                <select name="cliente_id" id="busca-cliente" autocomplete="off">
                    <option value="">SELECIONE OU CONSULTE UMA OPÇÃO</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">
                            {{ $cliente->codigo_formatado }}, {{ $cliente->name }}, {{ $cliente->cnpj_formatado }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-estilizado btn-imprimir">
                <i class="fas fa-print"></i> Imprimir
            </button>
            
        </form>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new TomSelect("#busca-cliente",{
                    create: true,
                    createOnBlur: true,
                    persist: true,
                    sortField: { field: "text", direction: "asc" },
                    hideSelected: true,
                    placeholder: "SELECIONE OU CONSULTE UMA OPÇÃO"
                });
            });
        </script>
    @endpush
</x-layout>