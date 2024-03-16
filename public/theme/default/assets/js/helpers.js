async function carregarConteudo(url, event, extra) {
    event.preventDefault(); // Impede o comportamento padrão do link

    try {
        // Busca o conteúdo HTML da URL especificada
        const response = await fetch(url);
        const html = await response.text();

        // Cria um novo elemento div para armazenar o conteúdo recebido
        const conteudoDiv = document.createElement('div');
        conteudoDiv.innerHTML = html;

        if (extra) {
            // Se extra for verdadeiro, carrega todo o conteúdo da página
            document.documentElement.innerHTML = html;
        } else {

            // Obtém o conteúdo da div #dadoPrincipal
            const dadoPrincipal = conteudoDiv.querySelector('#dadoPrincipal');

            if (dadoPrincipal) {
                // Adiciona o conteúdo da div #dadoPrincipal à div #addAqui
                const addAqui = document.getElementById('addAqui');
                addAqui.innerHTML = '';
                addAqui.appendChild(dadoPrincipal.cloneNode(true));

                // Altera a URL do navegador
                history.pushState(null, null, url);

                // Obtém o título da página da div #titulo e define como título da página
                const tituloDiv = document.getElementById('titulo');
                const titulo = tituloDiv.textContent.trim();
                document.title = titulo;

                console.log('Conteúdo carregado com sucesso.');
            } else {
                console.error('Erro: Não foi possível encontrar a div #dadoPrincipal.');
            }
        }
    } catch (error) {
        console.error('Erro ao carregar o conteúdo:', error);
    }
}

async function pager(url, event) {
    event.preventDefault(); // Impede o comportamento padrão do link

    try {
        // Busca o conteúdo HTML da URL especificada
        const response = await fetch(url);
        const html = await response.text();

        // Cria um novo elemento div para armazenar o conteúdo recebido
        const conteudoDiv = document.createElement('div');
        conteudoDiv.innerHTML = html;

        // Obtém o conteúdo da div #dadoPrincipal
        const dadoPrincipal = conteudoDiv.querySelector('#wer');

        if (dadoPrincipal) {
            // Adiciona o conteúdo da div #dadoPrincipal à div #addAqui
            const addAqui = document.getElementById('rd');
            addAqui.innerHTML = '';
            addAqui.appendChild(dadoPrincipal.cloneNode(true));

            // Altera a URL do navegador
            history.pushState(null, null, url);

            // Obtém o título da página da div #titulo e define como título da página
            const tituloDiv = document.getElementById('titulo');
            const titulo = tituloDiv.textContent.trim();
            document.title = titulo;
        } else {
            console.error('Erro: Não foi possível encontrar a div #wer.');
        }
    } catch (error) {
        console.error('Erro ao carregar o conteúdo:', error);
    }
}

document.querySelectorAll('a#aside-link').forEach(function (link) {
    link.addEventListener('click', function (event) {
        event.preventDefault(); // Impede o comportamento padrão do link

        // Obtém a URL do href do link clicado
        var url = link.getAttribute('href');

        // Chama a função carregarConteudo() com a URL obtida
        carregarConteudo(url, event);
    });
});

$(document).ready(function () {
    $('#formAddFarmacia').submit(function (e) {
        e.preventDefault(); // Evita o comportamento padrão do formulário
        showLoader();
        // Obtém os dados do formulário
        var formData = new FormData(this);

        // Envia a requisição AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                hideLoader();
                toastr.success(response.message);

                // Limpa o formulário
                $('#formAddFarmacia')[0].reset();

                // Oculta o modal
                $('#addFarmacia').modal('hide');
            },
            error: function (xhr, status, error) {
                hideLoader();
                // Trata os erros de validação retornados pelo servidor
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';

                // Percorre os erros e os concatena em uma única string
                $.each(errors, function (key, value) {
                    errorMessage += value[0] + '<br>';
                });

                // Exibe a mensagem de erro com Toastr.js
                toastr.error(errorMessage, 'Erro de validação');
            }
        });
    });

    $('#formAddCategoria').submit(function (e) {
        e.preventDefault(); // Evita o comportamento padrão do formulário
        showLoader();
        // Obtém os dados do formulário
        var formData = new FormData(this);

        // Envia a requisição AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                hideLoader();
                toastr.success(response.message);

                // Limpa o formulário
                $('#formAddCategoria')[0].reset();

                // Oculta o modal
                $('#addCategoria').modal('hide');
            },
            error: function (xhr, status, error) {
                hideLoader();
                // Trata os erros de validação retornados pelo servidor
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';

                // Percorre os erros e os concatena em uma única string
                $.each(errors, function (key, value) {
                    errorMessage += value[0] + '<br>';
                });

                // Exibe a mensagem de erro com Toastr.js
                toastr.error(errorMessage, 'Erro de validação');
            }
        });
    });

    $('#formaddGerenteFarmacia').submit(function (e) {
        e.preventDefault(); // Evita o comportamento padrão do formulário
        showLoader();
        // Obtém os dados do formulário
        var formData = new FormData(this);

        // Envia a requisição AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                hideLoader();
                toastr.success(response.message);

                // Limpa o formulário
                $('#formaddGerenteFarmacia')[0].reset();

                // Oculta o modal
                $('#addGerenteFarmacia').modal('hide');
            },
            error: function (xhr, status, error) {
                hideLoader();
                // Trata os erros de validação retornados pelo servidor
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';

                // Percorre os erros e os concatena em uma única string
                $.each(errors, function (key, value) {
                    errorMessage += value[0] + '<br>';
                });

                // Exibe a mensagem de erro com Toastr.js
                toastr.error(errorMessage, 'Erro de validação');
            }
        });
    });

    $('form#formAddAH').submit(function (e) {
        e.preventDefault(); // Evita o comportamento padrão do formulário
        showLoader();

        // Obtém os dados do formulário
        var formData = new FormData(this);

        // Envia a requisição AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                toastr.success(response.message);

                // Limpa o formulário
                $('#formAddAH')[0].reset();

                // Oculta o modal
                $('#area_hospitalar').modal('hide');
                hideLoader();
            },
            error: function (xhr, status, error) {
                hideLoader();
                // Trata os erros de validação retornados pelo servidor
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';

                // Percorre os erros e os concatena em uma única string
                $.each(errors, function (key, value) {
                    errorMessage += value[0] + '<br>';
                });

                // Exibe a mensagem de erro com Toastr.js
                toastr.error(errorMessage, 'Erro de validação');
            }
        });
    });

    $('#formBaixaEstoque').submit(function (e) {
        e.preventDefault(); // Evita o comportamento padrão do formulário
        showLoader();
        // Obtém os dados do formulário
        var formData = new FormData(this);

        // Envia a requisição AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                hideLoader();
                toastr.success(response.message);

                // Limpa o formulário
                $('#formBaixaEstoque')[0].reset();

                // Oculta o modal
                $('#estoqueOps').modal('hide');
            },
            error: function (xhr, status, error) {
                hideLoader();
                // Trata os erros de validação retornados pelo servidor
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';

                console.log(xhr);
                if (errors) {
                    // Percorre os erros e os concatena em uma única string
                    $.each(errors, function (key, value) {
                        errorMessage += value[0] + '<br>';
                    });

                    // Exibe a mensagem de erro com Toastr.js
                    toastr.error(errorMessage, 'Erro de validação');
                } else {
                    toastr.error(xhr.responseJSON.message, 'Erro');
                }
            }
        });
    });

    $('form#formEditarAH').submit(function (e) {
        e.preventDefault(); // Evita o comportamento padrão do formulário
        showLoader();
        // Obtém os dados do formulário
        var formData = new FormData(this);

        // Envia a requisição AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                hideLoader();
                toastr.success(response.message);

                // Limpa o formulário
                $('#formEditarAH')[0].reset();

                // Oculta o modal
                $('#editar_area_hospitalar').modal('hide');
            },
            error: function (xhr, status, error) {
                hideLoader();
                // Trata os erros de validação retornados pelo servidor
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';

                // Percorre os erros e os concatena em uma única string
                $.each(errors, function (key, value) {
                    errorMessage += value[0] + '<br>';
                });

                // Exibe a mensagem de erro com Toastr.js
                toastr.error(errorMessage, 'Erro de validação');
            }
        });
    });

    $('#formProdutoEstoque #cod_barrasq').change(function () {
        var codigoBarras = $('#cod_barras').val();
        var apiKey = 'f7aff0310a9b2aec516896d2c2950417d649073fbd7eae4f96d99197ef4c6b4b';
        var url = 'https://go-upc.com/api/v1/code/' + codigoBarras + '?key=' + apiKey + '&format=true';

        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                // Manipular a resposta JSON
                console.log(response);
                $('#formProdutoEstoque #designacao').val(response.product.name);
                //$('#resultado').html(JSON.stringify(response));
            },
            error: function (xhr, status, error) {
                alert('Erro: ' + error);
            }
        });
    });

    $('form#formEditFarmacia').submit(function (e) {
        e.preventDefault(); // Evita o comportamento padrão do formulário
        showLoader();
        // Obtém os dados do formulário
        var formData = new FormData(this);

        // Envia a requisição AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                hideLoader();
                toastr.success(response.message);

                // Limpa o formulário
                $('#formEditFarmacia')[0].reset();

                // Oculta o modal
                $('#modalEditarFarmacia').modal('hide');
            },
            error: function (xhr, status, error) {
                hideLoader();
                // Trata os erros de validação retornados pelo servidor
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';

                // Percorre os erros e os concatena em uma única string
                $.each(errors, function (key, value) {
                    errorMessage += value[0] + '<br>';
                });

                // Exibe a mensagem de erro com Toastr.js
                toastr.error(errorMessage, 'Erro de validação');
            }
        });
    });

    $('form#formAddCargoGrupo').submit(function (e) {
        e.preventDefault(); // Evita o comportamento padrão do formulário
        showLoader();
        // Obtém os dados do formulário
        var formData = new FormData(this);

        // Envia a requisição AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                hideLoader();
                toastr.success(response.message);

                // Limpa o formulário
                $('#formAddCargoGrupo')[0].reset();

                // Oculta o modal
                $('#addCargoGrupo').modal('hide');
                location.reload();
            },
            error: function (xhr, status, error) {
                hideLoader();
                // Trata os erros de validação retornados pelo servidor
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';

                // Percorre os erros e os concatena em uma única string
                $.each(errors, function (key, value) {
                    errorMessage += value[0] + '<br>';
                });

                // Exibe a mensagem de erro com Toastr.js
                toastr.error(errorMessage, 'Erro de validação');
            }
        });
    });

    $('form#formAddCargo').submit(function (e) {
        e.preventDefault(); // Evita o comportamento padrão do formulário
        showLoader();
        // Obtém os dados do formulário
        var formData = new FormData(this);

        // Envia a requisição AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                hideLoader();
                toastr.success(response.message);

                // Limpa o formulário
                $('#formAddCargo')[0].reset();

                // Oculta o modal
                $('#addCargo').modal('hide');
                location.reload();
            },
            error: function (xhr, status, error) {
                hideLoader();
                // Trata os erros de validação retornados pelo servidor
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';

                // Percorre os erros e os concatena em uma única string
                $.each(errors, function (key, value) {
                    errorMessage += value[0] + '<br>';
                });

                // Exibe a mensagem de erro com Toastr.js
                toastr.error(errorMessage, 'Erro de validação');
            }
        });
    });

    $('form#formAddCargoAH').submit(function (e) {
        e.preventDefault(); // Evita o comportamento padrão do formulário
        showLoader();
        // Obtém os dados do formulário
        var formData = new FormData(this);

        // Envia a requisição AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                hideLoader();
                toastr.success(response.message);

                // Limpa o formulário
                $('#formAddCargoAH')[0].reset();

                // Oculta o modal
                $('#addResponsavelAH').modal('hide');
                // location.reload();
            },
            error: function (xhr, status, error) {
                hideLoader();
                // Trata os erros de validação retornados pelo servidor
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';

                // Percorre os erros e os concatena em uma única string
                $.each(errors, function (key, value) {
                    errorMessage += value[0] + '<br>';
                });

                // Exibe a mensagem de erro com Toastr.js
                toastr.error(errorMessage, 'Erro de validação');
            }
        });
    });

    $('form#formProdutoEstoque').submit(function (e) {
        e.preventDefault(); // Evita o comportamento padrão do formulário

        // Obtém os dados do formulário
        var formData = new FormData(this);

        // Envia a requisição AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                toastr.success(response.message);

                // Limpa o formulário
                $('#formProdutoEstoque')[0].reset();

                // Oculta o modal
                $('#modalAddProdutoEstoque').modal('hide');
                // location.reload();
            },
            error: function (xhr, status, error) {
                // Trata os erros de validação retornados pelo servidor
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';

                if (errors) {
                    // Percorre os erros e os concatena em uma única string
                    $.each(errors, function (key, value) {
                        errorMessage += value[0] + '<br>';
                    });
                } else {
                    if (xhr.responseJSON.error) {
                        errorMessage = xhr.responseJSON.error;
                    }
                    errorMessage = xhr.responseJSON.message;
                }

                // Exibe a mensagem de erro com Toastr.js
                toastr.error(errorMessage, 'Erro de validação');
            }
        });
    });
});
function getDataFarma(url) {
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            // Preencher os campos do formulário com os dados recebidos
            $('#formEditFarmacia #nome_farmacia').val(response.nome);
            $('#formEditFarmacia #id_farmacia').val(response.id);
            // $('#formEditarAH').attr('action', 'areas_hospitalares/a_h/'+id);
            //$('#formEditFarmacia #nome_farmacia').prop('readonly', true);
            $('#formEditFarmacia #endereco').val(response.endereco);
            $('#formEditFarmacia #descricao').val(response.descricao);
            // Lógica para manipular outros campos, se necessário

            // Exibir o modal
            $('#modalEditarFarmacia').modal('show');
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            // Exibe a mensagem de erro com Toastr.js
            toastr.error(xhr.responseJSON.message, 'Erro de validação');
        }
    });
}

function preencherModalComFarmacia(url) {
    showLoader();
    // Requisição AJAX para buscar os dados da farmácia
    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            hideLoader();
            // Preencher o campo de nome da farmácia com os dados retornados
            $('#formaddGerenteFarmacia #nome_farmacia').val(response.nome);
            $('#formaddGerenteFarmacia #farmacia_id').val(response.id);

            // Tornar o campo de nome da farmácia somente leitura (readonly)
            $('#formaddGerenteFarmacia #nome_farmacia').prop('readonly', true);

            // Exibir o modal
            $('#addGerenteFarmacia').modal('show');
        },
        error: function (xhr, status, error) {
            hideLoader();
            // Tratar erros, se necessário
            //console.error(xhr.responseText);
            alert('Erro ao obter dados da farmácia.');
        }
    });
}

function modalAddProdutoEstoque() {
    $('#modalAddProdutoEstoque').modal('show');
}

function modalDarBaixa(id_produto, descritivo) { //formBaixaEstoque descritivo
    $('#estoqueOps #formBaixaEstoque #id_produto').val(id_produto);
    $('#estoqueOps #formBaixaEstoque #descritivo_').val(descritivo);
    $('#estoqueOps #formBaixaEstoque #descritivo_').attr('disabled', 'disabled');
    $('#estoqueOps').modal('show');
}

function modalAddCargoAH(area_id) {
    $('#area_hospitalar_id').val(area_id);
    $('#addResponsavelAH').modal('show');
}

function modalEditarAH(id) {
    showLoader();
    // Requisição AJAX para buscar os dados da farmácia
    $.ajax({
        url: 'api/get/area_hospitalar/' + id,
        type: 'GET',
        success: function (response) {
            hideLoader();
            $('#formEditarAH').attr('action', 'areas_hospitalares/a_h/' + id);
            $('h4#nome_area').val(response.nome);
            $('#formEditarAH #nome').val(response.nome);
            $('#formEditarAH #descricao').val(response.descricao);

            // Exibir o modal
            $('#editar_area_hospitalar').modal('show');
        },
        error: function (xhr, status, error) {
            hideLoader();
            // Tratar erros, se necessário
            //console.error(xhr.responseText);
            toastr.error("Erro ao obter dados da Área Hospitalar", 'Erro');
        }
    });
}

function modalEditarProdutoEstoque(id) {
    showLoader();
    // Requisição AJAX para buscar os dados da farmácia
    $.ajax({
        url: 'estoque/produto/' + id,
        type: 'GET',
        success: function (response) {
            hideLoader();
            $('#formEditProdutoEstoque').attr('action', 'estoque/produto/' + id);
            $('#modalEditProdutoEstoque h4#nome_produto').html(response.designacao);
            $('#formEditProdutoEstoque #designacao').val(response.designacao);
            $('#formEditProdutoEstoque #tipo_produto_estoque').val(response.tipo);
            if (response.tipo == "medicamento") {
                $('#formEditProdutoEstoque #dosagem_inp').css('display', 'block');

                $('#formEditProdutoEstoque #item_medicamento').css('display', 'block');
                $('#formEditProdutoEstoque #item_descartavel').css('display', 'none');
                $('#formEditProdutoEstoque #dosagem').val(response.dosagem);
                $('#formEditProdutoEstoque #qtd_estoque').val(response.saldo.qtd);
            }
            if (response.tipo == "descartável") {
                $('#formEditProdutoEstoque #dosagem_inp').css('display', 'none');

                $('#formEditProdutoEstoque #item_descartavel').css('display', 'block');
                $('#formEditProdutoEstoque #item_medicamento').css('display', 'none');
                $('#formEditProdutoEstoque #descritivo').val(response.descritivo);
                $('#formEditProdutoEstoque #qtd_total_estoque').val(response.saldo.qtd);
            }
            $('#formEditProdutoEstoque #num_lote').val(response.num_lote);
            $('#formEditProdutoEstoque #cod_barras').val(response.num_documento);
            $('#formEditProdutoEstoque #obs').val(response.obs);
            $('#formEditProdutoEstoque #data_producao').val(response.data_producao);
            $('#formEditProdutoEstoque #data_expiracao').val(response.data_expiracao);

            $('#formEditProdutoEstoque #forma').val(response.forma);
            $('#formEditProdutoEstoque #grupo_farmaco_id').val(response.grupo_farmaco_id);
            $('#formEditProdutoEstoque #origem_destino').val(response.origem_destino);
            $('#formEditProdutoEstoque #qtd_embalagem').val(response.qtd_embalagem);

            // Exibir o modal
            $('#modalEditProdutoEstoque').modal('show');
        },
        error: function (xhr, status, error) {
            hideLoader();
            // Tratar erros, se necessário
            //console.error(xhr.responseText);
            toastr.error("Erro ao obter dados do produto", 'Erro');
        }
    });

    $('#modalEditProdutoEstoque').on('hidden.bs.modal', function () {
        // Limpar todos os campos do formulário
        $('#formEditProdutoEstoque').trigger('reset');
      });
}

function addCargoGrupo(url) {
    showLoader();
    // Requisição AJAX para buscar os dados da farmácia
    $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
            hideLoader();
            // Preencher o campo de nome da farmácia com os dados retornados
            $('#formAddCargoGrupo #user_id').val(response.id);

            // Exibir o modal
            $('#addCargoGrupo').modal('show');
        },
        error: function (xhr, status, error) {
            hideLoader();
            // Tratar erros, se necessário
            //console.error(xhr.responseText);
            alert('Erro ao obter dados da farmácia.');
        }
    });
}

function modalEliminarFarmacia(id) {
    showLoader();
    // Requisição AJAX para buscar os dados da farmácia
    $.ajax({
        url: 'api/get/farmacia/' + id,
        type: 'GET',
        success: function (response) {
            hideLoader();
            $('#deleteFormFarmacia').attr('action', '/farmacia/apagar/' + id);
            $('#deleteFormFarmacia #texto-aviso').html('Tens a certeza que queres eliminar a farmácia <b>' + response.nome + '</b>');

            // Exibir o modal
            $('#modalEliminarFarmacia').modal('show');
        },
        error: function (xhr, status, error) {
            hideLoader();
            // Tratar erros, se necessário
            //console.error(xhr.responseText);
            toastr.error("Erro ao obter dados da Área Hospitalar", 'Erro');
        }
    });
}

function modalBloquearUsr(id, nome, urlBase) {
    $('#formBloquearUsr').attr('action', urlBase + '/bloquear/' + id);
    $('#formBloquearUsr #texto-aviso').html('Tens a certeza que queres bloquear ' + nome);

    // Exibir o modal
    $('#modalBloquearUsr').modal('show');
}

function modalEliminarAH(id) {
    showLoader();
    // Requisição AJAX para buscar os dados da farmácia
    $.ajax({
        url: 'api/get/area_hospitalar/' + id,
        type: 'GET',
        success: function (response) {
            hideLoader();
            $('#deleteFormAH').attr('action', '/areas_hospitalares/apagar/' + id);
            $('#deleteFormAH #texto-aviso').html('Tens a certeza que queres eliminar a área ' + response.nome);

            // Exibir o modal
            $('#modalEliminarAHp').modal('show');
        },
        error: function (xhr, status, error) {
            hideLoader();
            // Tratar erros, se necessário
            //console.error(xhr.responseText);
            toastr.error("Erro ao obter dados da Área Hospitalar", 'Erro');
        }
    });
}

function modalEditarFarmacia(id) {
    showLoader();
    // Requisição AJAX para buscar os dados da farmácia
    $.ajax({
        url: 'api/get/area_hospitalar/' + id,
        type: 'GET',
        success: function (response) {
            hideLoader();
            $('#formEditarAH').attr('action', 'areas_hospitalares/a_h/' + id);
            $('h4#nome_area').val(response.nome);
            $('#formEditarAH #nome').val(response.nome);
            $('#formEditarAH #descricao').val(response.descricao);

            // Exibir o modal
            $('#editar_area_hospitalar').modal('show');
        },
        error: function (xhr, status, error) {
            hideLoader();
            // Tratar erros, se necessário
            //console.error(xhr.responseText);
            toastr.error("Erro ao obter dados da Área Hospitalar", 'Erro');
        }
    });
}

// Função para buscar os dados da API e adicionar à tabela
function popularTabela(obj) {
    fetch('/api/get/area_hospitalar')
        .then(response => response.json())
        .then(data => {
            // Seleciona a tabela
            var tabela = document.querySelector('.tbl-area_hospitalar tbody');

            // Limpa o conteúdo existente da tabela
            tabela.innerHTML = '';

            // Para cada área hospitalar recebida
            data.forEach(area => {
                // Corta a descrição em seis palavras e adiciona '...' se houver mais palavras
                var descricaoCurta = area.descricao.split(' ').slice(0, 6).join(' ');
                if (area.descricao.split(' ').length > 6) {
                    descricaoCurta += '...';
                }

                // Cria uma string HTML com os dados da área hospitalar
                var content = `<tr>
                        <td>
                            <div class="checkbox d-inline-block">
                                <input type="checkbox" class="checkbox-input" id="checkbox2">
                                <label for="checkbox2" class="mb-0"></label>
                            </div>
                        </td>
                        <td>${area.nome}</td>
                        <td>${descricaoCurta}</td>
                        <td>
                            <div class="d-flex align-items-center list-action">
                                <a class="badge bg-info mr-2" data-toggle="tooltip" data-placement="top"
                                    title="Editar" href="#" onclick="modalEditarAH('${area.id}')">
                                    <i class="ri-key-2-line mr-0"></i>
                                </a>
                                <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top"
                                    title="Editar" href="#" onclick="modalEditarAH('${area.id}')">
                                    <i class="ri-pencil-line mr-0"></i>
                                </a>
                                <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top"
                                    title="Eliminar" href="#" onclick="modalEliminarAH('${area.id}')">
                                    <i class="ri-delete-bin-line mr-0"></i>
                                </a>
                            </div>
                        </td>
                    </tr>`;

                // Adiciona a string HTML à tabela
                tabela.innerHTML += content;
            });
        })
        .catch(error => console.error('Erro ao buscar dados da API:', error));
}

$(document).ready(function () {
    $('#tipo_produto_estoque').change(function () {
        if ($(this).val() === 'descartável') {
            $('#item_descartavel').fadeIn();
            $('#item_medicamento').fadeOut();
            $('#formProdutoEstoque #dosagem_inp').css('display', 'none');
            $('#formProdutoEstoque #dosagem_inp').fadeOut();
        } else {
            $('#formProdutoEstoque #dosagem_inp').css('display', 'block');
            $('#formProdutoEstoque #dosagem_inp').fadeIn();
            $('#item_descartavel').fadeOut();
            $('#item_medicamento').fadeIn();
        }
    });
});

let counter = 1;
document.getElementById('btn_repetir_lote').addEventListener('click', function () {
    // Get the existing element to clone
    const originalElement = document.getElementById('repetir_');

    // Clone the original element
    const cloneElement = originalElement.cloneNode(true);

    // Numeração automática dos inputs
    cloneElement.querySelectorAll('input').forEach(function (input, index) {
        const elementId = input.getAttribute('id');
        const inputName = input.getAttribute('name');
        input.setAttribute('id', `${elementId}_${counter}`);
        input.setAttribute('name', `${inputName}_${counter}`);
        input.setAttribute('onchange', `addQtdTotal('#${elementId}_${counter}')`);
        input.value = "";
    });
    counter++;

    // Adicionar botão de eliminar
    const btnEliminar = document.createElement('button');
    btnEliminar.classList.add('btn', 'btn-danger', 'ml-2');
    btnEliminar.textContent = 'Eliminar';
    btnEliminar.addEventListener('click', function () {
        this.parentNode.parentNode.removeChild(this.parentNode);
    });
    cloneElement.appendChild(btnEliminar);

    // Append the cloned element to the parent of the original element
    originalElement.parentNode.insertBefore(cloneElement, originalElement.nextSibling);
});


const inputDescritivo = document.getElementById('descritivo');
const inputQuantidadeTotal = document.getElementById('qtd_total_estoque');

function addQtdTotal(input) {
    var valor = $(input).val();

    // Valida o valor usando uma expressão regular
    const regex = /^([0-9]{1,2})x([0-9]{1,3})x([0-9]{1,4})$/;
    if (!regex.test(valor)) {
        // Retorna o último valor válido
        $(this).val(valor.slice(0, -1));
        return;
    }

    // Formata o valor
    $(this).val(valor.replace(/([0-9]{1,2})x([0-9]{1,3})x([0-9]{1,4})/, '$1x$2x$3'));

    // Multiplica os números
    const caixas = parseInt(valor.split('x')[0]);
    const caixinhas = parseInt(valor.split('x')[1]);
    const unidades = parseInt(valor.split('x')[2]);
    const quantidadeTotal = caixas * caixinhas * unidades;

    $('#qtd_total_estoque').val(quantidadeTotal);
}

let intervalId;

function checkSession() {
    fetch('/api/check-session')
        .then(response => response.json())
        .then(data => {
            //console.log(data);
            if (data.status == 0) {
                // Redirecionar ou recarregar a página se não houver sessão ativa
                alert('A tua sessão expirou');
                clearInterval(intervalId); // Limpar o intervalo após a sessão expirar
                window.location.reload();
            }
        })
        .catch(error => console.error('Erro ao verificar sessão:', error));
}

// Verificar a sessão a cada 1 minuto
intervalId = setInterval(checkSession, 60000);

function led() {
    toastr.options.positionClass = 'toast-bottom-left';
    toastr.warning('Obrigado', 'Para teste');
}

//setInterval(led, 3500);
