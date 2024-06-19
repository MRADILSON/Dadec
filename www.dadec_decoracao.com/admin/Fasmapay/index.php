<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FasmaPay - Validar Pagamento</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .response-section {
            display: none;
            margin-top: 20px;
        }

        .undefined {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">FasmaPay - Validar Pagamento</h2>
        <form id="paymentForm" action="https://api.fasma.ao/?sudopay_key=32y3103G41fl1aJZzfQurvBhbv0CekolQRHM7JUDkncmFHxlOKqAL11PG2M2540608" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="sudopay_file">Comprovativo de Pagamento (PDF):</label>
                <input type="file" class="form-control-file" id="sudopay_file" name="sudopay_file" accept="application/pdf" required>
                <div class="invalid-feedback">Por favor, envie um comprovativo de pagamento em PDF.</div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Validar</button>
        </form>
        <div id="response" class="response-section alert alert-info">
            <h4 class="alert-heading">Resposta da API:</h4>
            <div id="responseData"></div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script>
        if (form = document.querySelector('form')) {
            // Verifica se o botão do tipo submit foi pressionado
            form.addEventListener('submit', function(e) {
                // Cancela a ação normal do botão submit
                e.preventDefault();

                // Pega todos os dados do formulário e coloca na variável do tipo FormData
                var dados = new FormData(form);

                // Faz a requisição com o fetch
                fetch(form.action, {
                        method: form.method,
                        body: dados
                    })
                    .then(res => {
                        // Em caso de erro
                        if (!res.ok) throw new Error(res.status);
                        return res.json();
                    })
                    .then(data => {
                        // Limpa a resposta anterior
                        document.getElementById('responseData').innerHTML = "";

                        // Adiciona cada dado ao responseData
                        const fields = ['DESTINATARIO', 'IBAN', 'BANCO', 'MONTANTE', 'TRANSACAO', 'OPERACAO', 'TIPO'];
                        fields.forEach(field => {
                            const value = data[field] || 'undefined';
                            const p = document.createElement('p');
                            p.textContent = `${field}: ${value}`;
                            if (value === 'undefined') {
                                p.classList.add('undefined');
                            }
                            document.getElementById('responseData').appendChild(p);
                        });

                        // Tratar a data separadamente
                        const dataHora = data.DATA ? data.DATA.dataHora : 'undefined';
                        const p = document.createElement('p');
                        p.textContent = `DATA: ${dataHora}`;
                        if (dataHora === 'undefined') {
                            p.classList.add('undefined');
                        }
                        document.getElementById('responseData').appendChild(p);

                        document.getElementById('response').style.display = 'block';
                    })
                    .catch((error) => {
                        // Pegar o código de erro caso haja
                        const p = document.createElement('p');
                        p.textContent = "Erro: " + error.message;
                        p.classList.add('undefined');
                        document.getElementById('responseData').appendChild(p);
                        document.getElementById('response').style.display = 'block';
                    });
            });
        }

        // Bootstrap form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>
