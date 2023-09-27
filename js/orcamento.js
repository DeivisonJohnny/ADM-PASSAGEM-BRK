window.onload = function () {

    const btnDepositar = document.querySelector('#btn-depositar')
    const btnCloseDepositar = document.querySelector('#btn-close-depositar')

    const boxDepositar = document.querySelector('.box-deposito')

    btnDepositar.addEventListener('click', acaoDepositar)
    btnCloseDepositar.addEventListener('click', acaoDepositar)

    const data = new Date()

    const dia = (data.getDate().toString().padStart(2, '0'))
    const mes = ((data.getMonth() + 1).toString().padStart(2, '0'))
    const ano = (data.getFullYear().toString())


    document.querySelector('#data').innerHTML = dia + '/' + mes + '/' + ano



    function acaoDepositar() {
        if (boxDepositar.classList[1] == "exitDepositar") {
            boxDepositar.classList.add('openDepositar')
            boxDepositar.style.display = 'flex'
            boxDepositar.classList.remove('exitDepositar')
        } else {
            boxDepositar.classList.remove('openDepositar')
            boxDepositar.style.display = 'flex'
            boxDepositar.classList.add('exitDepositar')
            setTimeout(() => {
                boxDepositar.style.display = 'none'

            }, 550)

        }
    }

    const inputDeposito = document.querySelector('#input-deposito');

    inputDeposito.addEventListener('input', () => {
        let valor = inputDeposito.value;

        // Remova todos os caracteres não numéricos
        valor = valor.replace(/\D/g, '');

        // Formate o valor como moeda BRT
        const valorFormatado = formatarMoeda(valor);
        let valorN = valorFormatado.replace(/[^0-9,.]/g, '');

        valorN = valorN.replace(',', '.');

        if (inputDeposito.value.length <= 11) {
            if (valorFormatado == 'R$ NaN') {
                inputDeposito.value = ''
            } else {
                inputDeposito.value = valorFormatado;
            }
        }




    });

    // Função para formatar o valor como moeda BRT
    function formatarMoeda(valor) {
        const numero = parseFloat(valor) / 100; // Divida por 100 para lidar com centavos
        return numero.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }
    // Informações do valor por cada deslocamento

    let deposito = document.querySelector('#deposito').textContent.replace(/[^0-9,.]/g, '').replace(',', '.');
    let deslocamentoM = document.querySelector('#deslocamentoM').textContent

    var saldoAtual = parseFloat(deposito) - (parseFloat(deslocamentoM) * 7)

    saldoAtual = saldoAtual.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'})

    document.querySelector('#valor-gasto').textContent = (deslocamentoM * 7).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'})

    let valorTarifa = document.querySelector('#valor-tarifa').textContent.replace(/\D/g, '');

    let valorT = parseFloat(valorTarifa)
    let saldoT = parseFloat(saldoAtual.replace(/\D/g, ''))

    document.querySelector('#saldoAtual').innerHTML = saldoAtual
    document.querySelector('#deslocamento_possiveis').innerHTML = saldoT / valorT

    let finalizados = document.querySelector('#finalizados').textContent

    finalizados = parseInt(finalizados)

    document.querySelector('#incompletos').innerHTML = parseInt(deslocamentoM) - finalizados


}
