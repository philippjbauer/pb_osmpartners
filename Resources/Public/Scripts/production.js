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
 * @param {object} map      Map Configuration from Extbase Map Model
 * @param {object} partners Partners saved from Extbase Map Model in JSON
 * @param {object} settings Optional settings
 */
function OsmPartnersMap (map, partners, settings) {
    var scope = this;

    // Put the above given variables into
    // the scope, to make it more clear that
    // they belong to it.
    scope.map = map;
    scope.partners = partners;
    scope.options = {
        trackingUrl: undefined,
        provider: 'CartoDB.Positron',
        icon: {
            iconUrl: 'typo3conf/ext/pb_osmpartners/Resources/bower_components/leaflet/dist/images/marker-icon.png',
            iconRetinaUrl: 'typo3conf/ext/pb_osmpartners/Resources/bower_components/leaflet/dist/images/marker-icon-2x.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [0, -46],
        },
        labels: {
            linktext: 'Webseite aufrufen',
        },
        filterDelay: 500,
    };

    // Merge Defaults and Settings
    Object.assign(scope.options, settings);

    // Leaflet Configuration
    scope.leaflet = {
        // Get the map container by ID that
        // is defined in the map/show.html template
        map: L.map('leaflet-map-' + scope.map.uid),
        // See other providers at
        // http://leaflet-extras.github.io/leaflet-providers/preview/index.html
        provider: L.tileLayer.provider(scope.options.provider),
        // We need a seperate markers layer to be able to clear all markers at once
        markers: L.layerGroup(),
        // Set the marker to use absolute URLs
        // for the icon. Otherwise the path doesn't
        // resolve correctly.
        icon: L.icon(scope.options.icon),
    };

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
            .setView([scope.map.latitude, scope.map.longitude], scope.map.initZoomLevel)
            .addLayer(scope.leaflet.provider)
            .addLayer(scope.leaflet.markers);

        // Add the partners to the markerLayer
        addMarkers();
        // Watch ZIP input
        watchInput();
        // Watch links
        watchPartnerLinks();
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
                marker = L.marker(
                    [
                        scope.partners[i].latitude,
                        scope.partners[i].longitude
                    ],
                    {
                        icon: scope.leaflet.icon
                    }
                );

                // Create Tooltip
                var tooltipHtml = createTooltipMarkup(scope.partners[i]);
                marker.bindTooltip(tooltipHtml);

                // Create Popup
                var popupHtml = createPopupMarkup(scope.partners[i], scope.options.labels.linktext);
                marker.bindPopup(popupHtml);

                // Add marker to the marker layer
                scope.leaflet.markers.addLayer(marker);
            }
        }
    }

    /**
     * Create the HTML markup for the marker tooltip
     * @param  {object} partner
     * @return {string}
     */
    function createTooltipMarkup (partner) {
        return '\
            <strong>' + partner.name + '</strong>\
            <br>' +  partner.city + '\
        ';
    }


    /**
     * Create the HTML markup for the marker popup
     * @param  {object} partner
     * @param  {string} linktext
     * @return {string}
     */
    function createPopupMarkup (partner, linktext) {
        return '\
            <strong>' + partner.name + '</strong>\
            <br>' + partner.street + ' ' + partner.houseno + '\
            <br>' + partner.zip + ' ' + partner.city + '\
            <br><a href="' + partner.url + '" class="js-partner-tracking" data-partner="' + partner.uid + '" target="_blank">' + linktext + '</a>\
        ';
    }

    /**
     * Filter Partners List
     */
    function filterPartners (zip) {
        var zip = zip === undefined ? '' : zip;

        if (zip !== '') {
            // Hide all partners
            $('#leaflet-partners-' + scope.map.uid + ' .leaflet-partner').hide();
            // Show partners that do match the ZIP-Code
            $('#leaflet-partners-' + scope.map.uid + ' .leaflet-partner[data-zip^="' + zip + '"]').show();
        } else {
            // Show all partners
            $('#leaflet-partners-' + scope.map.uid + ' .leaflet-partner').show();
        }

        // Add filtered markers to the map
        addMarkers(zip === '' ? null : zip);
    }

    /**
     * Watch Input
     */
    function watchInput () {
        var $leafletSearch = $('#leaflet-search-' + scope.map.uid + ' input'),
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
                    
                    inputDelay = window.setTimeout(filterPartners, scope.options.filterDelay, $(this).val());
                });
        }
    }

    /**
     * Watch clicks on partner links
     */
    function watchPartnerLinks () {
        if (typeof scope.options.trackingUrl != 'undefined') {
            $('body').on('click', '.js-partner-tracking', function () {
                trackPartnerLinkClick($(this).data('partner'));
            });
        } else {
            console.error('Can\'t track clicks. No tracking URL defined.');
        }
    }

    /**
     * Track partner link click
     * @param  {integer} partner
     * @return {void}
     */
    function trackPartnerLinkClick (partner) {
        $.post(
            scope.options.trackingUrl,
            'tx_pbosmpartners_pi1[partner]=' + partner
        )
        .done(function (data) {
            if (data.success == 'false') {
                console.log(data.message);
            }
        })
        .fail(function () {
            console.error('XHR call not successful. Nothing will be tracked.');
        });
    }
    
}

// Init each map after jQuery is loaded
$(function() {
    if (typeof leafletMaps != 'undefined') {
        for (var i = 0; i < leafletMaps.length; i++) {
            new OsmPartnersMap(
                leafletMaps[i], 
                leafletPartners[i], 
                {
                    trackingUrl: leafletTrackingUrl,
                    labels: leafletLabels,
                }
            );
        }
    }
});