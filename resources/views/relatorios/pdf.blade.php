<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relação de Clientes</title>
    <style>
        /* RESET BÁSICO */
        body { 
            font-family: Arial, Helvetica, sans-serif; 
            font-size: 12px; 
            color: #000;
            margin: 0;
            padding: 0;
        }

        /* CABEÇALHO DO RELATÓRIO */
        .tabela-cabecalho {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .tabela-cabecalho td {
            border: none;
            padding: 0;
        }

        .titulo-relatorio {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: left;
        }

        .paginacao-relatorio {
            font-size: 10px;
            text-align: right;
            color: #333;
        }

        /* TABELA DE DADOS */
        .tabela-dados { 
            width: 100%; 
            border-collapse: collapse; 
        }

        .tabela-dados th, 
        .tabela-dados td { 
            border: none; 
            padding: 6px 10px; 
        }

        .tabela-dados th { 
            background-color: #cccccc; 
            font-weight: bold; 
            text-transform: uppercase;
        }

        /* LARGURA E ALINHAMENTO DAS COLUNAS */
        .col-codigo {
            width: 15%;
            text-align: center;
        }

        .col-nome {
            width: 55%;
            text-align: left;
        }

        .col-cnpj {
            width: 30%;
            text-align: center;
        }
    </style>
</head>
<body>

    <table class="tabela-cabecalho">
        <tr>
            <td class="titulo-relatorio">Relação de Cliente</td>
            <td class="paginacao-relatorio">Página 1 de 1</td>
        </tr>
    </table>
    
    <table class="tabela-dados">
        <thead>
            <tr>
                <th class="col-codigo">Código</th>
                <th class="col-nome">Nome</th>
                <th class="col-cnpj">CNPJ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientesParaRelatorio as $cliente)
                <tr>
                    <td class="col-codigo">{{ $cliente->codigo_formatado }}</td>
                    <td class="col-nome">{{ $cliente->name }}</td>
                    <td class="col-cnpj">{{ $cliente->cnpj_formatado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>