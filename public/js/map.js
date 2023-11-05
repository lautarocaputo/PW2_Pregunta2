
function loadGoogleMaps() {
    
    var mapElement = document.getElementById("map");
    var id = mapElement.getAttribute('name');
  
    fetch('/profile/getUbicacion?id='+id+'')
      .then(response => response.json())
      .then(data => {
        var map = new google.maps.Map(mapElement, {
          center: {
            lat: parseFloat(data.latitud),
            lng: parseFloat(data.longitud)
          },
          zoom: 15,
        });
  
        var marker = new google.maps.Marker({
          position: {
            lat: parseFloat(data.latitud),
            lng: parseFloat(data.longitud),
          },
          map: map,
        });
      })
      .catch(error => {
        alert("Tenemos un problema para encontrar tu ubicación");
      });
  }
  
  window.onload = loadGoogleMaps;