<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tela de Cadastro - Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Boldonse&family=Gravitas+One&family=Overpass:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <div class="collapse navbar-collapse " id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Tela de Cadastro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="consultar.php?acao=consultar">Consultar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div>&nbsp;</div>
            <h2>Cadastro</h2>

            <div class="row">
                <div class="col-md-6">
                    <form id="formCadastro" action="/cadastrar-pessoa" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome:">
                        </div>
                        <div>&nbsp;</div>
                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite o telefone:">
                        </div>
                        <div>&nbsp;</div>
                        <div class="form-group">
                            <label for="origem">Origem:</label>
                            <select class="form-select" id="origem" name="origem">
                                <option value="1">Celular</option>
                                <option value="2">WhatsApp</option>
                                <option value="3">Telefone</option>
                            </select>
                        </div>
                        <div>&nbsp;</div>
                        <div class="form-group">
                            <label for="data">Data do Contato:</label>
                            <input type="date" class="form-control" id="data" name="data_contato">
                        </div>
                        <div>&nbsp;</div>
                        <div class="form-group">
                            <label for="comentarios">Observação:</label>
                            <textarea class="form-control" id="comentarios" name="comentarios" rows="4" placeholder="Escreva seu comentário aqui..."></textarea>
                        </div>
                        <div>&nbsp;</div>
                        <button type="submit" class="btn btn-outline-warning">Cadastrar</button>
                    </form>
                </div>

                <div class="col-md-6">
                    <img src="{{ asset('images/user.png') }}" alt="Imagem Descritiva" class="img-fluid">
                </div>
            </div>
        </div>

        <!-- Script do SweetAlert -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.getElementById('formCadastro').addEventListener('submit', function(event) {
                    event.preventDefault(); // Impede o envio automático do formulário

                    // Pegando os valores digitados nos campos
                    let nome = document.getElementById('nome').value.trim();
                    let telefone = document.getElementById('telefone').value.trim();
                    let origem = document.getElementById('origem').value.trim();
                    let data = document.getElementById('data').value.trim();
                    let comentarios = document.getElementById('comentarios').value.trim();

                    // Verificando se os campos estão preenchidos
                    if (!nome || !telefone || !origem || !data || !comentarios) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Atenção!',
                            text: 'Preencha todos os campos antes de cadastrar.',
                            confirmButtonColor: '#ffc107'
                        });
                        return;
                    }

                    // Exibe a caixa de diálogo de confirmação
                    Swal.fire({
                        title: "Confirmar o cadastro?",
                        html: `
                            👤 <b>Nome:</b> ${nome}<br>
                            📞 <b>Telefone:</b> ${telefone}<br>
                            🌍 <b>Origem:</b> ${origem === '1' ? 'Celular' : origem === '2' ? 'WhatsApp' : 'Telefone'}<br>
                            📅 <b>Data do Contato:</b> ${data}<br>
                            📝 <b>Observação:</b> ${comentarios}
                        `,
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Sim, cadastrar!",
                        cancelButtonText: "Cancelar",
                        confirmButtonColor: "#28a745",
                        cancelButtonColor: "#d33"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('formCadastro').submit();
                        }
                    });
                });
            });
        </script>

        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
