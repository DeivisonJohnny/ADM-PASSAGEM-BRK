window.onload = function () {

    var required = document.querySelectorAll('.requiredP')
    var inputs = document.querySelectorAll('.inputs')
    const form = document.querySelector('form')

    form.addEventListener('submit', (event) => {
        let isValid = true; // Inicialmente, assumimos que o formulário é válido.

            if (inputs[0].value.length < 3 || inputs[1].value.length < 8) {
                isValid = false; // Se um campo não for válido, definimos isValid como false.
            }


        if (!isValid) {
            event.preventDefault(); 
        }

    
        validUser();
        validPass();
    })


    function setError(ind) {
        required[ind].style.display = 'flex'
        inputs[ind].classList.add('inputError')
    }

    function removerError(ind) {
        required[ind].style.display = 'none'
        inputs[ind].classList.remove('inputError')
    }
    

    function validUser() {
        if (inputs[0].value.length < 3) {
            setError(0)
        } else {
            removerError(0)
        }
    }


    function validPass() {
        if (inputs[1].value.length < 8) {
            setError(1)
        } else {
            removerError(1)
        }
    }

    inputs[0].addEventListener('input', validUser)
    inputs[1].addEventListener('input', validPass)
}