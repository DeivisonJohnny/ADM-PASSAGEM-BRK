window.onload = function () {

    const btnDepositar = document.querySelector('#btn-depositar')
    const btnCloseDepositar = document.querySelector('#btn-close-depositar')

    const boxDepositar = document.querySelector('.box-deposito')

    btnDepositar.addEventListener('click', acaoDepositar)
    btnCloseDepositar.addEventListener('click', acaoDepositar)

    function acaoDepositar() {
        console.log('acao ativa')
        console.log(boxDepositar.classList)
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

}