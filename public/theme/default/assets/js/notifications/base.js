$(document).ready(function(){
    function getNotificacao(){
        $.ajax({
            url: 'getter/notificacao',
            method: 'GET',
            dataType: 'json', // Espera uma resposta JSON
            success: function(response) {
                // Verifica se a resposta é diferente de 0, null ou false
                if (response && response.status !== 0 && response.status !== null && response.status !== false) {
                    // Faça algo se a resposta for diferente de 0, null ou false
                    alert('Notificação encontrada:', response);
                    // Por exemplo, exibir a notificação para o usuário
                    alert('Você tem uma nova notificação!');
                } else {
                    alert('Nenhuma notificação encontrada.');
                }
            },
            error: function(xhr, status, error) {
                // Trata erros de requisição
                alert('Erro ao obter notificação:', error);
            }
        });
    }

    setInterval(function() {
        getNotificacao();
    }, 2000);
});
