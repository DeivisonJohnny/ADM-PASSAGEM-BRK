// Declare variáveis globais para armazenar o mapa, marcadores e serviço de direções
let map;
let directionsService;
let directionsRenderer;

// Função de inicialização do mapa
function initMap() {
    const initialLocation = { lat: -34.397, lng: 150.644 }; // Coordenadas iniciais do mapa
    map = new google.maps.Map(document.getElementById("map"), {
        center: initialLocation,
        zoom: 14
    });

    // Inicialize o serviço de direções e o renderizador
    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(map);
}

initMap()

// Função para pegar a localização atual do usuário
function pegarLocalizacao() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            const userLocation = {lat: lat, lng: lng}

         

            // Centralize o mapa na localização do usuário
            map.setCenter(userLocation);

            // Crie um marcador na localização do usuário
            const marker = new google.maps.Marker({
                position: userLocation,
                map: map,
                title: "Sua Localização"
            });
        });
    } else {
        alert("Geolocalização não suportada no seu navegador.");
    }
}

// Função para traçar uma rota
function tracarRota() {
    // Defina a origem e o destino (substitua com as coordenadas ou endereços desejados)
    const origin = "Toronto, Canada";
    const destination = "Montreal, Canada";

    // Crie a solicitação de rota
    const request = {
        origin: origin,
        destination: destination,
        travelMode: google.maps.TravelMode.DRIVING
    };

    // Calcule a rota usando o serviço de direções
    directionsService.route(request, function (result, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            // Exiba a rota no mapa
            directionsRenderer.setDirections(result);
        } else {
            alert("Não foi possível traçar a rota: " + status);
            alert("Mensagem de error " + error_message);
        }
    });
}

// Associe funções aos botões
document.getElementById("btnPegarLocal").addEventListener("click", pegarLocalizacao);
document.getElementById("btnTraçarRota").addEventListener("click", tracarRota);
