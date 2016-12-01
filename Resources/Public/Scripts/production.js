/***
 *
 * This file is part of the "OpenStreetMap Partners" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2016 Philipp Bauer <hello@philippbauer.org>, Philipp Bauer _ Freelance Webdeveloper
 *
 ***/

/**
 * OpenStreetMap Partners Map Class
 * @param {object} map      Map configuration from Extbase Map Model
 * @param {object} partners Partners saved in Extbase Map Model in JSON
 */
function OsmPartnersMap (map, partners) {
    var scope = this;

    // Put the above given variables into
    // the scope, to make it more clear that
    // they belong to it.
    scope.map = map;
    scope.partners = partners;

    // Leaflet Configuration
    scope.leaflet = {
        // Get the map container by ID that
        // is defined in the map/show.html template
        map: L.map('leafletMap-' + scope.map.uid),
        // See other providers at
        // http://leaflet-extras.github.io/leaflet-providers/preview/index.html
        provider: L.tileLayer.provider('CartoDB.Positron'),
        // We need a seperate markers layer to be able to clear all markers at once
        markers: L.layerGroup(),
        // Set the marker to use absolute URLs
        // for the icon. Otherwise the path doesn't
        // resolve correctly.
        icon: L.icon({
            iconUrl: 'typo3conf/ext/pb_osmpartners/Resources/bower_components/leaflet/dist/images/marker-icon.png',
            iconRetinaUrl: 'typo3conf/ext/pb_osmpartners/Resources/bower_components/leaflet/dist/images/marker-icon-2x.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [0, -46]
        }),
    };
    
    // Scope Methods
    scope.addMarkers = addMarkers;
    scope.watchInput = watchInput;
    scope.filterPartners = filterPartners;

    // Initiate Map Class
    init();

    /**
     * Initiate Map Class
     *
     * Finish setting up the leafletMap and its markers
     * and fire up the watcher for the ZIP-Code search.
     */
    function init () {
        scope.leaflet.map
            .setView([scope.map.latitude, scope.map.longitude], 6)
            .addLayer(scope.leaflet.provider)
            .addLayer(scope.leaflet.markers);
        scope.addMarkers();

        scope.watchInput();
    }

    /**
     * Add Markers
     *
     * Add the markers (potentially filtered by ZIP-Code) to the map
     */
    function addMarkers (zip) {
        var zip = zip === undefined ? null : zip,
            marker = null;

        // Clear the markers layer before adding them
        scope.leaflet.markers.clearLayers();

        // Go through markers
        for (var i = 0; i < scope.partners.length; i++) {
            if (zip === null || scope.partners[i].zip.substr(0, zip.length) === zip) {
                // Create marker for this partner
                marker = L.marker([scope.partners[i].latitude, scope.partners[i].longitude], {icon: this.leaflet.icon})
                    .bindPopup('<p><strong>' + scope.partners[i].name + '</strong><br>' + scope.partners[i].street + ' ' + scope.partners[i].houseno + '<br>' + scope.partners[i].zip + ' ' + scope.partners[i].city + '<p><a href="' + scope.partners[i].url + '" target="_blank">Webseite aufrufen</a>');
                // Add marker to the marker layer
                scope.leaflet.markers.addLayer(marker);
            }
        }
    }

    /**
     * Watch Input
     */
    function watchInput () {
        var $leafletSearch = $('#leafletSearch-' + scope.map.uid + ' input'),
            inputDelay = null;

        // We can disable the search input in the plugin,
        // so we check for the presence of the search input
        // before we continue
        if ($leafletSearch.length > 0) {
            $leafletSearch
                .on('keyup', function() {
                    if (inputDelay !== null) {
                        window.clearTimeout(inputDelay);
                    }
                    
                    inputDelay = window.setTimeout(filterPartners, 500, $(this).val());
                });
        }
    }

    /**
     * Filter Partners List
     */
    function filterPartners (zip) {
        var zip = zip === undefined ? '' : zip;

        if (zip !== '') {
            // Hide all partners
            $('#leafletPartners-' + scope.map.uid + ' .leafletPartner').hide();
            // Show partners that do match the ZIP-Code
            $('#leafletPartners-' + scope.map.uid + ' .leafletPartner[data-zip^="' + zip + '"]').show();
        } else {
            // Show all partners
            $('#leafletPartners-' + scope.map.uid + ' .leafletPartner').show();
        }

        scope.addMarkers(zip === '' ? null : zip);
    }
    
}

// Init each map after jQuery is loaded
$(function() {
    if (leafletMaps !== undefined) {
        for (var i = 0; i < leafletMaps.length; i++) {
            new OsmPartnersMap(leafletMaps[i], leafletPartners[i]);
        }
    }
});