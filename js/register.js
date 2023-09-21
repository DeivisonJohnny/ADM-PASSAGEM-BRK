window.onload = function () {

    const required = document.querySelectorAll('.requiredP')
    const inputs = document.querySelectorAll('.inputs')
    const form = document.querySelector('form')
    console.log(form)

    form.addEventListener('submit', (event) => {
        let isValid = true; // Inicialmente, assumimos que o formulário é válido.

        inputs.forEach(inp => {
            if (inp.value.length < 3) {
                isValid = false; // Se um campo não for válido, definimos isValid como false.
            }
        });

        if (!isValid) {
            event.preventDefault(); // Cancela a submissão apenas se isValid for false.
        }

        // Chame todas as funções de validação, independentemente de isValid, se desejar.
        validNome();
        validUser();
        validCity();
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


    function validNome() {
        if (inputs[0].value.length < 3) {
            setError(0)
        } else {
            removerError(0)
        }
    }
    function validUser() {
        if (inputs[1].value.length < 3) {
            setError(1)
        } else {
            removerError(1)
        }
    }

    function validCity() {
        if (inputs[2].value.length < 5) {
            setError(2)
        } else {
            removerError(2)
        }
    }


    function validPass() {
        if (inputs[3].value.length < 8) {
            setError(3)
        } else {
            removerError(3)
        }
    }

    inputs[0].addEventListener('input', validNome)
    inputs[1].addEventListener('input', validUser)
    inputs[2].addEventListener('input', validCity)
    inputs[3].addEventListener('input', validPass)


}