<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 10px 0;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="content">
    <!-- Conteúdo principal da página -->
    <ul>
    @forelse ($pessoas as $pessoa)
            <li>ID: {{$pessoa->id}} -><span style="font-weight: bold"> {{ $pessoa->nome }}</span> <> {{ $pessoa->status->status  }} <span style="color: blue">||
            {{-- Pluck extrai os nomes dos tipos e implode junta eles em uma string --}}
            {{ $pessoa->tipos_pessoas->pluck('tipo')->implode(', ') }}||</span> </li>
        @empty
            <p style="font-weight: bold; color: #336699"> Não exitem Registros de pessoas a serem exibido!</p>
    @endforelse

    </ul>

</div>

<footer class="footer">
    <!-- Conteúdo do rodapé -->
    <p>CADASTRO DE PESSOAS</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
