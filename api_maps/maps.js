let map;

function local() {
    if('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition(function(pos) {
            var latitude = pos.coords.latitude
            var longitude = pos.coords.longitude

            initMap(latitude, longitude)
        })
    }
}

async function initMap(lati, long) {
  const { Map } = await google.maps.importLibrary("maps");

  map = new Map(document.getElementById("map"), {
    center: { lat: lati, lng: long},
    zoom: 14,
  });
}

local()




// ______________________________________________________


window.onload = function () {
  // API GOOGLE MAPS
  document.querySelector("#btnPegarLocal").addEventListener('click', pegarCoord);

  async function initMap(Latitude, Longitude) {
      const position = { lat: Latitude, lng: Longitude };
      
      // Carregar a API do Google Maps
      await loadScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyCd5XbOjyBOfY73XFQZs9qOLWdg7lgX8kA&callback=initMap");

      // The map, centered at a given position
      const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 16,
          center: position,
          mapId: "DEMO_MAP_ID",
      });

      // The marker, positioned at the given position
      const marker = new google.maps.Marker({
          map: map,
          position: position,
          title: "Uluru",
      });
  }

  function pegarCoord() {
      if ('geolocation' in navigator) {
          navigator.geolocation.getCurrentPosition(function (position) {
              var lat = position.coords.latitude;
              var long = position.coords.longitude;
              document.querySelector('#local').value = `${lat}  ` + `${long}`;
              
              initMap(lat, long);
          });
      }
  }
}
