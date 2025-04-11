<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edição de Pessoa - Laravel</title>

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
        <h2>Edição de Dados da Pessoa</h2>
    </div>

    <!-- Formulário de Edição -->
    <form action="/atualizar-pessoa/{{ $pessoa->id }}" method="POST">
        @csrf

        <!-- Nome -->
        <div class="mb-3">
            <label for="campoNome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="campoNome" name="nome" value="{{ $pessoa->nome }}" required>
        </div>

        <!-- Telefone -->
        <div class="mb-3">
            <label for="campoTelefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="campoTelefone" name="telefone" value="{{ $pessoa->telefone }}" required>
        </div>

        <!-- Origem -->
        <div class="mb-3">
            <label for="campoOrigem" class="form-label">Origem</label>
            <select class="form-select" id="campoOrigem" name="origem" required>
                <option value="1" {{ $pessoa->origem == 1 ? 'selected' : '' }}>Celular</option>
                <option value="2" {{ $pessoa->origem == 2 ? 'selected' : '' }}>WhatsApp</option>
                <option value="3" {{ $pessoa->origem == 3 ? 'selected' : '' }}>Telefone</option>
            </select>
        </div>

        <!-- Data do Contato -->
        <div class="mb-3">
            <label for="campoDataContato" class="form-label">Data do Contato</label>
            <input type="date" class="form-control" id="campoDataContato" name="data_contato" value="{{ \Carbon\Carbon::parse($pessoa->data_contato)->format('Y-m-d') }}" required>
        </div>

        <!-- Observações -->
        <div class="mb-3">
            <label for="campoComentarios" class="form-label">Observações</label>
            <textarea class="form-control" id="campoComentarios" name="comentarios" rows="3" required>{{ $pessoa->comentarios }}</textarea>
        </div>

        <!-- Botões -->
        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="button" class="btn btn-danger" id="btnExcluir" onclick="confirmDelete({{ $pessoa->id }})">Excluir</button>
        </div>
    </form>

</div>

<!-- Bootstrap e SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Você quer realmente excluir esta pessoa?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Criar um formulário de exclusão e enviá-lo para a rota de exclusão
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/excluir-pessoa/' + id;

                // Adiciona o token CSRF
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                // Adiciona o método DELETE via campo "_method"
                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                form.appendChild(method);

                // Submete o formulário para excluir a pessoa
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

</body>
</html>
