window.onload = function () {

    // Eventos de fechar/abrir caixa de alterar senha
    document.querySelector('#pencil').addEventListener('click', openAltSenha)

    document.querySelector('#closeAltSenha').addEventListener('click', closeAltSenha)

    // Abre a caixa de alterar senha do usuario
    const boxForm = document.querySelector('.box-mudar-senha')

    function openAltSenha() {
        if (boxForm.classList.length > 1) {
            if (boxForm.classList[1] == 'altSenha') {
                boxForm.classList.remove('altClose')
                boxForm.classList.remove('altSenha')
            }
        } else {
            closeAltSenha()
        }
    }


    // Fechar a caixa de alterar senha do usuario
    function closeAltSenha() {
        if (boxForm.classList.length <= 1) {
            boxForm.classList.add('altSenha')
            setTimeout(() => {
                boxForm.classList.add('altClose')
            }, 570)
        }
    }

    // Salva a senha para desmarcar
    const senhaReal = document.querySelector('#senha').textContent

    // Pegar o tamanho da senha quando carregar
    let tamSenha = document.querySelector('#senha').textContent.length


    
    // cria a string que vai mascarar
    var ocultar = ''
    for (let i = 0; i < tamSenha; i++) {
        ocultar += '*'
    }

    // vai inserir a string que mascara a senha
    document.querySelector('#senha').innerHTML = ocultar

    // Evento de mostrar a senha
    document.querySelector('#eye').addEventListener('click', mostrarSenha)


    function mostrarSenha() {
        if (document.querySelector('#senha').textContent == ocultar) {
            document.querySelector('#senha').innerHTML = senhaReal
        } else {
            document.querySelector('#senha').innerHTML = ocultar
        }
    }

    const anexo = document.querySelector('#anexo')
    anexo.addEventListener('change', mudarNameAnexo)

    console.log(anexo.files)

    function mudarNameAnexo() {
        let testeStr = anexo.files[0].name

        testeStr = testeStr.split('.')

        // Pega a extenxão do arquivo anexado
        testeStr = testeStr[1].toLowerCase()
        

        verificarExtensao(testeStr)

        var fileName = anexo.value.split("\\").pop()
        const label = document.querySelector('#labelAnexo')

        if (fileName != '') {
            
            label.innerHTML = fileName
        } else {
            label.innerHTML = 'Anexar foto'
        }

        if (label.textContent != 'Anexar foto') {
            label.style.backgroundColor = '#3505F9'
        } else {
            label.style.backgroundColor = '#f9054a'
        }

    }

    function verificarExtensao(extensao) {
        console.log(extensao)
        let suportados = document.querySelector('#arquivosSuportados')
        if(extensao != 'jpg' && extensao != 'jpeg' && extensao != 'png') {

            console.log(extensao == 'png')

            suportados.style.color = 'red'
            suportados.style.fontWeight = 'bold'
            
        } else {
            suportados.style.color = 'blue'
            // suportados.style.fontWeight = 'bold'
        }
    }

    // Funcão de abrir box de formulario para o usuario adicionar a foto de perfil 
        
    const boxInserirPerfil = document.querySelector('.box-inserir-perfil')

    document.querySelector('#box-img-perfil').addEventListener('click', openBoxAddPerfil)
    
    function openBoxAddPerfil() {
        if (boxInserirPerfil.classList[2] == 'ocultarAddPerfil') {
            boxInserirPerfil.classList.add('addPerfilOpen')
            boxInserirPerfil.classList.remove('addPerfilClose')
            boxInserirPerfil.classList.remove('ocultarAddPerfil')
        } else {
            closeBoxAddPerfil()
        }
    }
    
    document.querySelector(".btnClosePerfil").addEventListener('click', closeBoxAddPerfil)

    function closeBoxAddPerfil() {
        if (boxInserirPerfil.classList.length <= 2) {
            boxInserirPerfil.classList.add('addPerfilClose')
            boxInserirPerfil.classList.remove('addPerfilOpen')

            setTimeout(() => {
                boxInserirPerfil.classList.add('ocultarAddPerfil')
            },380)
        }
    }

}
