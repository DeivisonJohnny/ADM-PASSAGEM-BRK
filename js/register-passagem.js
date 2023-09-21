window.onload = function () {

    // Inserindo Data Atual do dia de acesso 

    const dataAtual = new Date()

    let dia = (dataAtual.getDate().toString()).padStart(2, '0')
    let mes = ((dataAtual.getMonth() + 1).toString()).padStart(2, '0')
    let ano = (dataAtual.getFullYear()).toString()

    if(dia != '' && mes != '' && ano != '') {
        document.querySelector('#data').value = `${ano}-${mes}-${dia}`
        
    }

    

    // API GOOGLE MAPS
    document.querySelector("#btnPegarLocal").addEventListener('click', pegarCoord)

    let map;

    async function initMap(Latitude, Longitude) {

        const position = { lat: Latitude, lng: Longitude };

        const { Map } = await google.maps.importLibrary("maps");
        const { Marker } = await google.maps.importLibrary("marker");

        map = new Map(document.getElementById("map"), {
            zoom: 16,
            center: position,
            mapId: "DEMO_MAP_ID",
        });

        const marker = new Marker({
            map: map,
            position: position,
            title: "Uluru",
        });
    }


    function pegarCoord() {
        if ('geolocation' in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var lat = position.coords.latitude
                var long = position.coords.longitude
                document.querySelector('#local').value = `${lat}  ` + `${long}`

                initMap(lat, long)
            }, function (error) {
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        alert('A permissão de localização foi negada pelo usuario, recarregue e click em permitir')
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert('As informações de localização infelizmente não estão disponiveis')
                        break;
                    case error.TIMEOUT: 
                        alert('Tempo limite esgotado ao tentar obter a localização')
                        break;
                    case error.UNKNOWN_ERROR:
                        alert('Ocorreu um erro desconhecido ao tentar obter a localização.')
                        break;
                }
            })
        } else {
            alert('Infelizmente seu navegador não é compativel com o site, use outro navegador')
        }
    }

    pegarCoord()



}

// Validação dos inputs

function inputValid() {
    const inputs = document.querySelectorAll('.input')
    const required = document.querySelectorAll('.required')
    function setError(indice) {
        inputs[indice].style.border = '1px solid red'
        inputs[indice].style.boxShadow = '0px 0px 4px 0px red'
        required[indice].style.display = 'flex'
    }

    function removeError(indice) {
        inputs[indice].style.border = '0.5px solid #3505F9'
        inputs[indice].style.boxShadow = ' 0px 0px 8px 0px #3605f99c'
        required[indice].style.display = 'none'
    }


    inputs.forEach((input, index) => {
        input.addEventListener('input',() => {
            let enviar = true
            if (input.value.length < 3) {
                setError(index)
                enviar = false
            } else {
                removeError(index)
            }
            return enviar
        })
    });

    document.querySelector('form').addEventListener('submit', (event) => {
        inputs.forEach((inp, ind) => {
            if(inp.value.length < 3) {
                event.preventDefault()
                setError(ind)
            }
        });
    })


}

inputValid()

