{
  "description": null,
  "parentClass": null,
  "useTraits": null,
  "allowInherit": false,
  "allowVariants": false,
  "showVariants": false,
  "layoutDefinitions": {
    "fieldtype": "panel",
    "labelWidth": 100,
    "layout": null,
    "name": "pimcore_root",
    "type": null,
    "region": null,
    "title": null,
    "width": null,
    "height": null,
    "collapsible": null,
    "collapsed": null,
    "bodyStyle": null,
    "datatype": "layout",
    "permissions": null,
    "childs": [
      {
        "fieldtype": "panel",
        "labelWidth": 100,
        "layout": null,
        "name": "Layout",
        "type": null,
        "region": null,
        "title": null,
        "width": null,
        "height": null,
        "collapsible": null,
        "collapsed": null,
        "bodyStyle": null,
        "datatype": "layout",
        "permissions": null,
        "childs": [
            <?=$fields?>
        ],
        "locked": null
      }
    ],
    "locked": null
  },
  "icon": null,
  "previewUrl": null,
  "propertyVisibility": {
    "grid": {
      "id": true,
      "path": true,
      "published": true,
      "modificationDate": true,
      "creationDate": true
    },
    "search": {
      "id": true,
      "path": true,
      "published": true,
      "modificationDate": true,
      "creationDate": true
    }
  }
}

