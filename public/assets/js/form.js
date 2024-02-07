$(document).ready(function () {
    $('form#cadastrar').submit(function (e) {
        e.preventDefault(); // Impede o envio padrão do formulário

        // Serialize o formulário para enviar os dados
        var formData = $(this).serialize();

        // Enviar solicitação AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'), // URL para o endpoint do formulário
            data: formData,
            success: function (response) {
                // Manipular a resposta bem-sucedida
                location.reload();
            },
            error: function (xhr, status, error) {
                // Converte a resposta JSON em um objeto JavaScript
                var errors = JSON.parse(xhr.responseText);

                // Inicializa uma variável para armazenar a mensagem de erro formatada
                var errorMessage = '';

                // Percorre os erros retornados
                $.each(errors.errors, function (key, value) {
                    // Adiciona a mensagem de erro formatada à variável errorMessage
                    errorMessage += value[0] + '\n';
                });

                // Exibe a mensagem de erro formatada
                alert(errorMessage);
            }
        });
    });
});

$(document).ready(function() {
    $('#login-form').submit(function(e) {
        e.preventDefault(); // Impede o envio padrão do formulário

        var formData = $(this).serialize(); // Serializa os dados do formulário

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                // Manipula erros
                //console.error(xhr.responseText);
                //alert('Erro ao fazer login. Verifique suas credenciais.');
                alert(xhr.responseText);
            }
        });
    });
});
