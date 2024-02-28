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
                toastr.success("Bem-vindo de volta", 'A redirecionar');
                setTimeout(function() {
                    location.reload();
                }, 5000);
            },
            error: function(xhr, status, error) {
                // Trata os erros de validação retornados pelo servidor
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';

                console.log(xhr);

                if (xhr.responseJSON.codigo == "csrf") {
                    toastr.warning("Esteve inativo por muito tempo. Por favor aguarde.", 'Algo deu errado');
                    setTimeout(function() {
                        location.reload();
                    }, 4000);
                }else{
                    if (errors) {
                        // Percorre os erros e os concatena em uma única string
                        $.each(errors, function (key, value) {
                            errorMessage += value[0] + '<br>';
                        });
                    }else{
                        if (xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        }
                        errorMessage = xhr.responseJSON.message;
                    }
                    toastr.error(errorMessage, 'Erro');
                }
            }
        });
    });
});


