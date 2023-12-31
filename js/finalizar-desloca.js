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

        function inserirCoordMaps() {

            const divMap = document.querySelectorAll('.div-map')
            let latDado = document.querySelectorAll('.lat')
            let longDado = document.querySelectorAll('.long')

            divMap.forEach((div, ind) => {

                let lat = parseFloat(latDado[ind].textContent)
                let long = parseFloat(longDado[ind].textContent)

                inserirCoordDiv(ind, lat, long)
                
            })
            

            let map;
            let marker;

            async function inserirCoordDiv(ind, lat, long) {
                const position = {lat: lat, lng: long}

                const { Map } = await google.maps.importLibrary("maps")
                const { Marker } = await google.maps.importLibrary("marker")

                map = new Map(document.querySelectorAll('.div-map')[ind], {
                    zoom: 14,
                    center: position,
                    mapId: "DEMO_MAP_ID",
                    mapTypeId: 'satellite',
                    
                })

                marker = new Marker( {
                    map: map,
                    position: position,
                    title: 'Localização inicial'
                })

            }

        }
        inserirCoordMaps()

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
            if (btn.classList[1] == 'finalizar') {
                openAcao(ind)
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
            openAcao(ind)
        }
        })
        
    });

    function inserirDadosVisualizar(ind) {
        const dadoCdc = document.querySelectorAll('.dado-cdc')
        const dadoName = document.querySelectorAll('.dado-name')
        const dadoCity = document.querySelectorAll('.dado-city')
        const dadoDate = document.querySelectorAll('.dado-date')
        const dadoPrevisto = document.querySelectorAll('.dado-previsto')
        const dadoLat = document.querySelectorAll('.lat')
        const dadoLong = document.querySelectorAll('.long')
        const dadoMaps = document.querySelectorAll('.dado-map')
        const dadoObs = document.querySelectorAll('.dado-obs')

        document.querySelector('#resposta-name').innerHTML = dadoName[ind].textContent
        document.querySelector('#resposta-city').innerHTML = dadoCity[ind].textContent
        document.querySelector('#resposta-cdc').innerHTML = dadoCdc[ind].textContent
        document.querySelector('#resposta-data').innerHTML = dadoDate[ind].textContent
        document.querySelector('#resposta-previsto').innerHTML = dadoPrevisto[ind].textContent

        let lat = parseFloat(dadoLat[ind].textContent)
        let long = parseFloat(dadoLong[ind].textContent)

        document.querySelector('#resposta-coord').innerHTML = lat + ',' + long

        mapVisual(lat, long)

        async function mapVisual(lat, long) {
            const position = {lat: lat, lng: long}

            const { Map } = await google.maps.importLibrary("maps")
            const { Marker } = await google.maps.importLibrary("marker")

            map = new Map(document.querySelector('#resposta-map'), {
                zoom: 16,
                center: position,
                mapId: "DEMO_MAP_ID",
                mapTypeId: 'satellite',
            })

            marker = new Marker({
                map: map,
                position: position,
                title: 'Marcador'
            })

        }
        document.querySelector('#resposta-obs').innerHTML = dadoObs[ind].textContent
        
    }


    function openVisualizar() {
        const boxVisual = document.querySelector('.box-acao-visualizar')
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


    function openAcao(ind) {

        if (boxFinal.classList[1] == 'box-acao-final-exit' || boxFinal.className == 'box-acao-final') {
            // Adicionar o cdc no valor para encaminha para o banco
            const cdcF = document.querySelector('#cdcFinal')
            const dadoCdcFinal = document.querySelectorAll('.dado-cdc')
            cdcF.value = dadoCdcFinal[ind].textContent

            boxFinal.classList.add('box-acao-final-open')
            boxFinal.classList.remove('box-acao-final-exit')

            ultiLocal()
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

            navigator.geolocation.getCurrentPosition(function (pos) {
                let lat = pos.coords.latitude
                let long = pos.coords.longitude
                document.querySelector('#coord').value = lat.toString() + long.toString()
                initMap(lat, long)

                console.log(lat, long)
                console.log(document.querySelector('#latFinal'))
                console.log(document.querySelector('#longFinal'))

                document.querySelector('#latFinal').value = lat.toString()
                document.querySelector('#longFinal').value = long.toString()
                
            })


        }
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
            mapId: "DEMO_MAP_ID",
            mapTypeId: 'satellite'
        })

        marker = new Marker({
            map: map,
            position: position,
            title: 'Test'
        })
    }
}


