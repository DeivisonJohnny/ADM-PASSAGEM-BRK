window.onload = function () {
    const boxDetails = document.querySelectorAll('.details')
    const iconBtnDetails = document.querySelectorAll('.icon-detalis')


    // função de abrir mais detalhes do CDC
    function abrirDetalhe() {

        iconBtnDetails.forEach((btn, ind) => {
            btn.addEventListener('click', clickDetails)

            function clickDetails() {
                if (boxDetails[ind].className == 'details') {
                    boxDetails[ind].classList.add('detailsOpen')
                    boxDetails[ind].classList.remove('details')
                    iconBtnDetails[ind].style.animationName = 'rotateIconInit'

                    setTimeout(() => {
                        iconBtnDetails[ind].style.transform = 'rotate(180deg)'
                    }, 650)

                } else {
                    if (boxDetails[ind].className == 'detailsOpen') {
                        boxDetails[ind].classList.add('detailsExit')
                        boxDetails[ind].classList.remove('detailsOpen')
                        iconBtnDetails[ind].style.animationName = 'rotateIconOver'

                        setTimeout(() => {
                            iconBtnDetails[ind].style.transform = 'rotate(360deg)'
                        }, 650)

                    } else {
                        if (boxDetails[ind].className == 'detailsExit') {
                            boxDetails[ind].classList.add('detailsOpen')
                            boxDetails[ind].classList.remove('detailsExit')
                            iconBtnDetails[ind].style.animationName = 'rotateIconInit'
                            setTimeout(() => {
                                iconBtnDetails[ind].style.transform = 'rotate(180deg)'
                            }, 650)
                        }
                    }
                }
            }
        });
    }
    abrirDetalhe()

    // Função de abrir os dados do campo de Observação dentro dos detalhes
    function abrirObs() {
        const btnOpenObs = document.querySelectorAll('.openObs')
        const boxContent = document.querySelectorAll('.obs-contentExit')

        btnOpenObs.forEach((btn, ind) => {
            btn.addEventListener('click', acaoObs)
            function acaoObs() {
                openObsAnima(ind)
            }
        });

        function openObsAnima(ind) {
            if (boxContent[ind].className == 'obs-contentExit') {
                boxContent[ind].classList.add('obs-contentOpen')
                boxContent[ind].classList.remove('obs-contentExit')
            } else {
                boxContent[ind].classList.remove('obs-contentOpen')
                boxContent[ind].classList.add('obs-contentExit')

            }
        }

    }

    abrirObs()

    // abrir caixas de visualização e de finalização 

    const acaoVisual = document.querySelectorAll('.acao-final')
    const closeVisual = document.querySelectorAll('.icon-close-visual')
    const boxFinal = document.querySelector('.box-acao-final')


    acaoVisual.forEach((btn, ind) => {
        btn.addEventListener('click', () => {
            console.log(ind + '-> indice acao visual')
            if (btn.classList[1] == 'finalizar') {
                openAcao()
            } 
            else {
                if(btn.classList[1] == 'visualizar') {
                    inserirDadosVisualizar(ind)
                    openVisualizar()
                }
            }
        })
    });


    closeVisual.forEach((btn, ind) => {
        btn.addEventListener('click', () => {
            if (btn.classList[1] == 'visualizar') {
            openVisualizar()
        } else {
            openAcao()
        }
        })
        
    });

    function inserirDadosVisualizar(ind) {
        const dadoCdc = document.querySelectorAll('.dado-cdc')
        const dadoName = document.querySelectorAll('.dado-name')
        const dadoCity = document.querySelectorAll('.dado-city')
        const dadoDate = document.querySelectorAll('.dado-date')
        const dadoPrevisto = document.querySelectorAll('.dado-previsto')
        const dadoCoord = document.querySelectorAll('.dado-coord')
        const dadoObs = document.querySelectorAll('.dado-obs')

        document.querySelector('#resposta-name').innerHTML = dadoName[ind].textContent
        document.querySelector('#resposta-city').innerHTML = dadoCity[ind].textContent
        document.querySelector('#resposta-cdc').innerHTML = dadoCdc[ind].textContent
        document.querySelector('#resposta-data').innerHTML = dadoDate[ind].textContent
        document.querySelector('#resposta-previsto').innerHTML = dadoPrevisto[ind].textContent
        document.querySelector('#resposta-coord').innerHTML = dadoCoord[ind].textContent
        document.querySelector('#resposta-obs').innerHTML = dadoObs[ind].textContent
        
    }


    function openVisualizar() {
        const boxVisual = document.querySelector('.box-acao-visualizar')
        console.log('chamando')
        if (boxVisual.classList[1] == 'box-acao-visualizar-exit' || boxVisual.className == 'box-acao-visualizar') {
            boxVisual.classList.add('box-acao-visualizar-open')
            boxVisual.classList.remove('box-acao-visualizar-exit')
        } else {
            boxVisual.classList.remove('box-acao-visualizar-open')
            boxVisual.classList.add('box-acao-visualizar-exit')
            setTimeout(() => {
                boxVisual.classList.remove('box-acao-visualizar-exit')
            }, 450)
        }
    }


    function openAcao() {

        if (boxFinal.classList[1] == 'box-acao-final-exit' || boxFinal.className == 'box-acao-final') {
            boxFinal.classList.add('box-acao-final-open')
            boxFinal.classList.remove('box-acao-final-exit')
        } else {
            boxFinal.classList.remove('box-acao-final-open')
            boxFinal.classList.add('box-acao-final-exit')
            setTimeout(() => {
                boxFinal.classList.remove('box-acao-final-exit')
            }, 450)
        }
    }

    const obterLocal = document.querySelector('#btnObterLocal')

    obterLocal.addEventListener('click', ultiLocal)

    function ultiLocal() {
        if ('geolocation' in navigator) {

            navigator.geolocation.watchPosition(function (pos) {
                let lat = pos.coords.latitude
                let long = pos.coords.longitude
                document.querySelector('#coord').value = lat.toString() + long.toString()
                initMap(lat, long)
            })


        }

        let map;
        let marker;

        async function initMap(lat, long) {
            const position = { lat: lat, lng: long }

            const { Map } = await google.maps.importLibrary("maps")
            const { Marker } = await google.maps.importLibrary("marker")

            map = new Map(document.querySelector('#map'), {
                zoom: 16,
                center: position,
                mapId: "DEMO_MAP_ID"
            })

            marker = new Marker({
                map: map,
                position: position,
                title: 'Test'
            })
        }
    }
}


