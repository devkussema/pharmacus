$(document).ready(function () {
	var idNotify = [];
	function getNotificacao() {
        // Verificar se a meta "is_ah" existe
        if (document.querySelector('meta[name="is_ah"]')) {
            // Obter o conteúdo da meta
            var isAhContent = document.querySelector('meta[name="is_ah"]').getAttribute('content');

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'getter/notificacao/' + isAhContent, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);

                    // Verifica se a resposta é diferente de 0, null ou false
                    if (response && response.length > 0) {
                        response.forEach(function (notification) {
                            if (!idNotify.includes(notification.chave)) {
                                idNotify.push(notification.chave); // Adiciona o valor no array
								var segundo = 0;
                                if (idNotify.length > 2) { // Se o array tiver mais de 2 valores
                                    idNotify.shift(); // Remove o primeiro (o mais antigo)
									segundo = 1;
                                }

                                var notificationHtml = `
                                    <div class="col-md-6 col-lg-6 d-flex flex-column">
                                        <div class="card mb-2">
                                            <div class="row no-gutters">
                                                <div class="col-md-6 col-lg-4">
                                                    <img src="/theme/default/assets/images/page-img/08.jpg" class="card-img" alt="#">
                                                </div>
                                                <div class="col-md-6 col-lg-8">
                                                    <div class="card-body">
                                                        <h4 class="card-title" id="titulo">${notification.titulo}</h4>
                                                        <p class="card-text" id="descricao">${notification.message}</p>
                                                        <p class="card-text"><small class="text-muted">Cerca de ${tempoDecorrido(notification.created_at)}</small>
														<a href="/estoque/confirmar/${notification.chave}/${isAhContent}" class="btn btn-outline-primary btn-sm ml-2">Confirmar</a>
														</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;

                                // Adiciona o HTML à div de notificação
                                $('#notification_content').append(notificationHtml);

                                // Exibe a div de notificação
                                $('#notification_content').removeClass('d-none');

                                // Faça algo se a resposta for diferente de 0, null ou false
                                toastr.info(notification.message, notification.titulo, {
                                    closeButton: true,
                                    progressBar: false
                                });
                            }
                        });
                    }
                } else {
                    //console.log('Erro ao obter notificação: ' + xhr.statusText);
                }
            };
            xhr.send();
        }
    }

	var idNotifier = [];
	function getNotificacaoGerente() {
        // Verificar se a meta "is_ah" existe
        if (document.querySelector('meta[name="is_ah_gerente"]')) {
            // Obter o conteúdo da meta
            var isAhContentGerente = document.querySelector('meta[name="is_ah_gerente"]').getAttribute('content');

            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/getter/notificacao/' + isAhContentGerente, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);

                    if (response && response.length > 0) {
                        response.forEach(function (notification) {
                            if (!idNotifier.includes(notification.chave)) {
                                idNotifier.push(notification.chave); // Adiciona o valor no array
                                var segundo = 0;
                                if (idNotifier.length > 2) { // Se o array tiver mais de 2 valores
                                    idNotifier.shift(); // Remove o primeiro (o mais antigo)
                                    segundo = 1;
                                }

                                if (idNotifier.length > 2) { // Se o array tiver mais de 2 valores
                                    idNotifier.shift(); // Remove o primeiro (o mais antigo)
									segundo = 1;
                                }

                                var notificationHtml = `
                                    <div class="col-md-6 col-lg-6 d-flex flex-column">
                                        <div class="card mb-2">
                                            <div class="row no-gutters">
                                                <div class="col-md-6 col-lg-4">
                                                    <img src="/theme/default/assets/images/page-img/08.jpg" class="card-img" alt="#">
                                                </div>
                                                <div class="col-md-6 col-lg-8">
                                                    <div class="card-body">
                                                        <h4 class="card-title" id="titulo">${notification.titulo}</h4>
                                                        <p class="card-text" id="descricao">${notification.message}</p>
                                                        <p class="card-text"><small class="text-muted">Cerca de ${tempoDecorrido(notification.created_at)}</small>
														<a href="/estoque/confirmar/${notification.chave}/${isAhContent}" class="btn btn-outline-primary btn-sm ml-2">Confirmar</a>
														</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;

                                // Adiciona o HTML à div de notificação
                                $('#notification_content').append(notificationHtml);

                                // Exibe a div de notificação
                                $('#notification_content').removeClass('d-none');

                                // Faça algo se a resposta for diferente de 0, null ou false
                                toastr.info(notification.message, notification.titulo, {
                                    timeOut: 0, // Define o tempo de duração como infinito
                                    extendedTimeOut: 0, // Define o tempo de duração estendido como infinito
                                    closeButton: true,
                                    progressBar: false
                                });
                            }
                        });
                    }
                }
            };
            xhr.send();
        }
    }

	function tempoDecorrido(data) {
		// Converte a data para um objeto Date
		var dataObj = new Date(data);

		// Calcula a diferença entre a data e o momento atual
		var diferencaSegundos = Math.floor((Date.now() - dataObj.getTime()) / 1000);
		var diferencaMinutos = Math.floor(diferencaSegundos / 60);
		var diferencaHoras = Math.floor(diferencaMinutos / 60);
		var diferencaDias = Math.floor(diferencaHoras / 24);

		// Define a string de retorno
		var strTempoDecorrido;

		// Se a diferença for menor que um minuto, retorna "agora mesmo"
		if (diferencaSegundos < 60) {
			strTempoDecorrido = "agora mesmo";
		} else if (diferencaMinutos < 60) {
			// Se a diferença for menor que uma hora, retorna a quantidade de minutos
			strTempoDecorrido = diferencaMinutos + " min atrás";
		} else if (diferencaHoras < 24) {
			// Se a diferença for menor que um dia, retorna a quantidade de horas
			strTempoDecorrido = diferencaHoras + " h atrás";
		} else {
			// Se a diferença for maior que um dia, retorna a quantidade de dias
			strTempoDecorrido = diferencaDias + " dias atrás";
		}

		return strTempoDecorrido;
	}

    if (document.querySelector('meta[name="is_ah"]')) {
	    setInterval(getNotificacao, 15000);
    }

    if (document.querySelector('meta[name="is_ah_gerente"]')) {
	    setInterval(getNotificacaoGerente, 15000);
    }
});
