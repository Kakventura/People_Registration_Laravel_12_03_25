<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Boldonse&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <title>Produto Cadastrado</title>
    
    <style>
        body {
            background-color: rgb(73, 73, 73); /* Fundo cinza escuro */
            color: white; /* Texto branco */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Ocupa a tela inteira */
            text-align: center;
            font-family: "Boldonse", system-ui, sans-serif; 
        }
        .mensagem {
            font-size: 24px;
            font-weight: bold;
            font-family: "Boldonse", system-ui, sans-serif; 
        }
        .btn-voltar {
            margin-top: 20px;
            color: white;
            border-color::rgb(207, 197, 54);
            font-family: "Boldonse", system-ui, sans-serif; 
        }
        .btn-voltar:hover {
            background-color:rgb(207, 197, 54);
            color: white;
            font-family: "Boldonse", system-ui, sans-serif; 
        }
    </style>
</head>
<body>
    <div>
        <p class="mensagem">Pessoa cadastrada com sucesso!</p>
        <a href="/" class="btn btn-outline-warning btn-voltar">Voltar</a>
    </div>
</body>
</html>
