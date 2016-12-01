function initLeaflet(map, partners) {
    var leafletMap = L.map('leafletMap-' + map.uid),
        leafletProvider = L.tileLayer.provider('CartoDB.Positron'),
        leafletMarkers = L.layerGroup(),
        leafletIcon = L.icon({
            iconUrl: 'typo3conf/ext/pb_osmpartners/Resources/bower_components/leaflet/dist/images/marker-icon.png',
            iconRetinaUrl: 'typo3conf/ext/pb_osmpartners/Resources/bower_components/leaflet/dist/images/marker-icon-2x.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [0, -46]
        });

    // Setup map
    leafletMap
        .setView([map.latitude, map.longitude], 6)
        .addLayer(leafletProvider)
        .addLayer(leafletMarkers);

    // Add markers for partners
    addMarkers(leafletMap, leafletMarkers, leafletIcon, partners, '');

    // Watch ZIP Input
    watchZipInput($('#leafletSearch-' + map.uid + ' input[name="zip"]'), 250);
}

function watchZipInput($input, delay) {
    var inputDelay = null;

    $input.on('keyup', function() {
        if (inputDelay !== null) {
            window.clearTimeout(inputDelay);
            // inputDelay = window.setTimeout(filterPartnersByZip, delay, this.value, 125);
        } 
        // else {
            inputDelay = window.setTimeout(filterPartnersByZip, delay, this.value, 125);
        // }
        
    });
}

function filterPartnersByZip(zip, delay) {
    if (zip !== '') {
        $('.leafletPartner:not([data-zip^="' + zip + '"])').fadeOut(delay);
        $('.leafletPartner[data-zip^="' + zip + '"]').fadeIn(delay);
    } else {
        $('.leafletPartner').fadeIn(delay);
    }
}

function addMarkers(leafletMap, leafletMarkers, leafletIcon, partners, zip) {
    leafletMarkers.clearLayers();

    var marker = null;
    for (var i = 0; i < partners.length; i++) {
        if (zip === '' || partners[i].zip.substr(0, zip.length) === zip) {
            // Create marker for this partner
            marker = L.marker([partners[i].latitude, partners[i].longitude], {icon: leafletIcon})
                .bindPopup('<p><strong>' + partners[i].name + '</strong><br>' + partners[i].street + ' ' + partners[i].houseno + '<br>' + partners[i].zip + ' ' + partners[i].city + '<p><a href="' + partners[i].url + '" target="_blank">Webseite aufrufen</a>');
            // Add marker to the marker layer
            leafletMarkers.addLayer(marker);
        }
    }
}

// Init each map
$(function() {
    if (leafletMaps !== undefined) {
        for (var i = 0; i < leafletMaps.length; i++) {
            initLeaflet(leafletMaps[i], leafletPartners[i]);
        }
    }
});