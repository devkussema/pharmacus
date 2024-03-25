$(document).ready(function(){
    function getNotificacao(){
        // Verificar se a meta "is_ah" existe
        if (document.querySelector('meta[name="is_ah"]')) {
            // Obter o conteúdo da meta
            var isAhContent = document.querySelector('meta[name="is_ah"]').getAttribute('content');

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'getter/notificacao/' + isAhContent, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function() {
              if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);

                // Verifica se a resposta é diferente de 0, null ou false
                if (response && response.status !== 0 && response.status !== null && response.status !== false) {
                  // Faça algo se a resposta for diferente de 0, null ou false
                  toastr.info(response.message, response.titulo, {
                        closeButton: true,
                        progressBar: false
                    });
                } else {
                    //toastr.info('Nenhuma notificação encontrada.');
                }
              } else {
                console.log('Erro ao obter notificação: ' + xhr.statusText);
              }
            };
            xhr.send();
          }
    }

    setInterval(getNotificacao, 2000);
});
