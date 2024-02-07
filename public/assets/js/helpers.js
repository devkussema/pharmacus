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
