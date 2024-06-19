<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orçamento de Evento</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1 class="text-center">Orçamento de Evento</h1>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form id="quoteForm">
                <div class="form-group">
                    <label for="clientName">Nome do Cliente</label>
                    <input type="text" class="form-control" id="clientName" name="clientName" required>
                </div>
                <div class="form-group">
                    <label for="eventName">Nome do Evento</label>
                    <input type="text" class="form-control" id="eventName" name="eventName" required>
                </div>
                <div class="form-group">
                    <label for="eventDate">Data do Evento</label>
                    <input type="date" class="form-control" id="eventDate" name="eventDate" required>
                </div>
                <div class="form-group">
                    <label for="budget">Orçamento Disponível</label>
                    <input type="number" class="form-control" id="budget" name="budget" required>
                </div>
                <div class="form-group">
                    <label for="additionalInfo">Informações Adicionais</label>
                    <textarea class="form-control" id="additionalInfo" name="additionalInfo" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Enviar Orçamento</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Custom JavaScript -->
<script src="script.js"></script>

</body>
</html>
