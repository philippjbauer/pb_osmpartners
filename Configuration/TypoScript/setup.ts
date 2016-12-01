
plugin.tx_pbosmpartners_pi1 {
  view {
    templateRootPaths.0 = EXT:pb_osmpartners/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_pbosmpartners_pi1.view.templateRootPath}
    partialRootPaths.0 = EXT:pb_osmpartners/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_pbosmpartners_pi1.view.partialRootPath}
    layoutRootPaths.0 = EXT:pb_osmpartners/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_pbosmpartners_pi1.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_pbosmpartners_pi1.persistence.storagePid}
    #recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

plugin.tx_vhs.settings.asset {
    /**
     * CSS Assets
     */
    leafletcss {
        path = EXT:pb_osmpartners/Resources/bower_components/leaflet/dist/leaflet.css
        group = leaflet
        standalone = 0
        type = css
    }

    osmpartnerscss {
        path = EXT:pb_osmpartners/Resources/Public/Styles/production.css
        group = general
        standalone = 0
        type = css
    }

    /**
     * Javascript Assets
     */
    leafletjs {
        path = EXT:pb_osmpartners/Resources/bower_components/leaflet/dist/leaflet.js
        group = leaflet
        standalone = 0
        movable = 0
        type = js
    }

    leafletprovidersjs {
        path = EXT:pb_osmpartners/Resources/bower_components/leaflet-providers/leaflet-providers.js
        group = leaflet
        dependencies = leafletjs
        standalone = 0
        movable = 0
        type = js
    }

    osmpartnersjs {
        path = EXT:pb_osmpartners/Resources/Public/Scripts/production.js
        movable = 1
        type = js
    }
}
