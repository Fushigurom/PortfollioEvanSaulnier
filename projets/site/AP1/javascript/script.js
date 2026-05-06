
// Fonction pour récupérer la dernière vidéo YouTube


function initMap() {
    const location = { lat: 48.8566, lng: 2.3522 }; // Paris par défaut, à remplacer par les coordonnées voulues
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: location,
    });
    const marker = new google.maps.Marker({
        position: location,
        map: map,
        title: "Hyrst - Localisation",
    });
}
