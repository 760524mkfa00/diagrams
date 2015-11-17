<script src="//maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>

<script>
    var placeSearch, autocomplete;
    //
    function initialize() {

        autocomplete = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
                {  });
        autocomplete1 = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */(document.getElementById('autocomplete1')),
                {  });
        autocomplete2 = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */(document.getElementById('autocomplete2')),
                {  });
    }


    // [START region_geolocation]
    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = new google.maps.LatLng(
                        position.coords.latitude, position.coords.longitude);
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
                autocomplete1.setBounds(circle.getBounds());
                autocomplete2.setBounds(circle.getBounds());
            });
        }
    }
    // [END region_geolocation]

</script>