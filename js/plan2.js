var watchId;

var infowindowStatique = new google.maps.InfoWindow({
                                            content: "<b>Le lieu du mariage</b>"
                                            });

var infowindowMobile = new google.maps.InfoWindow({
                                            content: "<b>Votre position</b>"
                                            });

function afficheCarte() {
    var map;
    var lat = 48.858565;
    var lng = 2.347198;
    
    //Google Maps
    var myLatlng = new google.maps.LatLng(lat,lng);
    var mapOptions = {zoom: 16, center: myLatlng};
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    var marker = new google.maps.Marker({
                                        position: myLatlng,
                                        map: map,
                                        title : "Centre"
                                        });
    marker.addListener('click', function() {
                       infowindowStatique.open(map, marker);
                       });
}

jQuery("#mesboutons .btn").click(function(){
        jQuery("#mesboutons .btn").removeClass('active');
        jQuery(this).toggleClass('active'); 
});

