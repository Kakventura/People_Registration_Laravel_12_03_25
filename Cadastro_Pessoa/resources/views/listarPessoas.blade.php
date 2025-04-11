<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listagem de Pessoas - Laravel</title>

    <!-- Fonts e Estilos -->
    <link href="https://fonts.googleapis.com/css2?family=Boldonse&family=Gravitas+One&family=Overpass:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/listar.css') }}">
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

<div class="container">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand">
                <img src="{{ asset('images/icone.png') }}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Tela de Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/listar-pessoas">Consultar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Título -->
    <div class="mt-4">
        <h2>Lista de Pessoas Cadastradas</h2>
    </div>

    <!-- Tabela de Pessoas -->
    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Origem</th>
                    <th>Data do Contato</th>
                    <th>Observações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pessoas as $pessoa)
                <tr>
                    <td><a href="/editar-pessoa/{{ $pessoa->id }}">{{ $pessoa->nome }}</a></td>
                    <td><a href="/editar-pessoa/{{ $pessoa->id }}">{{ $pessoa->telefone }}</a></td>
                    <td>
                        @if($pessoa->origem == 1)
                            <a href="/editar-pessoa/{{ $pessoa->id }}">Celular</a>
                        @elseif($pessoa->origem == 2)
                            <a href="/editar-pessoa/{{ $pessoa->id }}">WhatsApp</a>
                        @else
                            <a href="/editar-pessoa/{{ $pessoa->id }}">Telefone</a>
                        @endif
                    </td>
                    <td><a href="/editar-pessoa/{{ $pessoa->id }}">{{ \Carbon\Carbon::parse($pessoa->data_contato)->format('d/m/Y') }}</a></td>
                    <td><a href="/editar-pessoa/{{ $pessoa->id }}">{{ $pessoa->comentarios }}</a></td>
                </tr>
                @endforeach
                @if($pessoas->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">Nenhuma pessoa cadastrada.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap e SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Você quer mesmo excluir esta pessoa?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-delete-' + id).submit();
            }
        });
    }
</script>

</body>
</html>
