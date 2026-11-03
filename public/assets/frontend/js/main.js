var coordLat = null;
var coordLng = null;
var markerPath = null;

function initMapCoordinates(latitude, longitude){
    coordLat = latitude;
    coordLng = longitude;
    // console.log(coordLat);
    // console.log(coordLng);
}

function initMarker(path){
    if(path == '')
    {
        markerPath = '';
    }else{
        markerPath = '/storage/' + path;
    }
}
$(function() {
    "use strict";

    $(window).on('load', function() {
        $('#preloader').toggle(500, function () {
            $('#preloader').append('fadeOut completed.')
        });
	});

    var longitude = null;

    

    /* google map */
    /**/
    function initialize() {
        var stylez = [
            {
                "featureType": "landscape"
                , "elementType": "geometry"
                , "stylers": [
                    {
                        "weight": 0.1
                    }
                    , {
                        "saturation": -15
                    }
                    , {
                        "lightness": 38
                    }
                    , {
                        "hue": "#0055ff"
                    }
                    , {
                        "gamma": 1.91
                    }
                    , {
                        "visibility": "on"
                    }
                    , {
                        "color": "#f7f6f7"
                    }
                ]
            }, {
                "featureType": "poi"
                , "elementType": "geometry"
                , "stylers": [
                    {
                        "color": "#c3c3c3"
                    }
                ]
            }, {
                "featureType": "road.highway"
                , "elementType": "geometry"
                , "stylers": [
                    {
                        "color": "#f88f6f"
                    }
                ]
            }, {
                "featureType": "road.highway"
                , "elementType": "labels.text.fill"
                , "stylers": [
                    {
                        "visibility": "on"
                    }
                    , {
                        "color": "#8b3f38"
                    }
                ]
            }, {
                "featureType": "road.highway"
                , "elementType": "labels.text.stroke"
                , "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            }, {
                "featureType": "road.arterial"
                , "elementType": "labels.text.fill"
                , "stylers": [
                    {
                        "color": "#020101"
                    }
                ]
            }, {
                "featureType": "road.arterial"
                , "elementType": "labels.text.stroke"
                , "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            }, {
                "featureType": "road.arterial"
                , "elementType": "geometry.stroke"
                , "stylers": [
                    {
                        "color": "#eee4e0"
                    }
                    , {
                        "lightness": -10
                    }
                ]
            }, {
                "featureType": "landscape"
                , "stylers": [
                    {
                        "color": "#fffdf9"
                    }
                ]
            }, {
                "featureType": "road.local"
                , "elementType": "geometry"
                , "stylers": [
                    {
                        "visibility": "simplified"
                    }
                    , {
                        "color": "#d2d2d2"
                    }
                ]
            }, {}, {
                "featureType": "road.local"
                , "elementType": "labels.text.fill"
                , "stylers": [
                    {
                        "color": "#040c06"
                    }
                ]
            }, {
                "featureType": "transit.station"
                , "elementType": "labels.text.fill"
                , "stylers": [
                    {
                        "visibility": "on"
                    }
                    , {
                        "color": "#1d080f"
                    }
                ]
            }, {
                "featureType": "water"
                , "stylers": [
                    {
                        "color": "#cbdbf0"
                    }
                    , {
                        "hue": "#005eff"
                    }
                    , {
                        "saturation": 41
                    }
                ]
            }, {
                "featureType": "administrative"
                , "elementType": "labels.text.fill"
                , "stylers": [
                    {
                        "color": "#7f5e51"
                    }
                ]
            }, {
                "featureType": "poi"
                , "elementType": "geometry.fill"
                , "stylers": [
                    {
                        "color": "#fdeee0"
                    }
                ]
            }, {
                "featureType": "poi.park"
                , "elementType": "geometry.fill"
                , "stylers": [
                    {
                        "color": "#e6f9c1"
                    }
                ]
            }, {
                "featureType": "road.highway.controlled_access"
                , "elementType": "labels.icon"
                , "stylers": [
                    {
                        "hue": "#627dbc"
                    }
                    , {
                        "saturation": -82
                    }
                    , {
                        "gamma": 0.32
                    }
                ]
            }, {
                "featureType": "transit.station"
                , "elementType": "labels.icon"
                , "stylers": [
                    {
                        "hue": "#2a00ff"
                    }
                    , {
                        "saturation": -44
                    }
                    , {
                        "lightness": 3
                    }
                    , {
                        "gamma": 0.33
                    }
                    , {
                        "weight": 0.1
                    }
                ]
            }, {}
        ]
        //19.1737173,72.9535994
        var marker;
        var delta;
        if (jQuery(window).width() < 756) {
            delta = 0;
        }
        var point = new google.maps.LatLng(coordLat, coordLng);
        var center = new google.maps.LatLng(coordLat, coordLng);
        var mapOptions = {
            zoom: 18
            , center: center
            , scrollwheel: false
            , mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        var image = 'assets/frontend/images/gmap_default.png';
        var styledMapOptions = {
            name: "gray-style"
        }
        var jayzMapType = new google.maps.StyledMapType(stylez, styledMapOptions);
        map.mapTypes.set('graystyle', jayzMapType);
        map.setMapTypeId('graystyle');
        var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';

        var marker = new google.maps.Marker({
            map: map
            , position: point
            , icon: markerPath
            , animation: google.maps.Animation.BOUNCE
            , });
        google.maps.event.addListener(marker, 'click', function () {
            infobox.open(map, this);
            map.panTo(point);
        });

        map.panTo(point);
    }
    if (document.getElementById('map')) {
        google.maps.event.addDomListener(window, 'load', initialize);
    };



});