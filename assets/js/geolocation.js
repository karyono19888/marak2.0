var x = document.getElementById("location");

function getlocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Sorry! your browser is not supporting");
    }
}

function showPosition(position) {
    document.getElementById("m_visit_koor_long").value =
        position.coords.longitude;
    document.getElementById("m_visit_koor_lat").value = position.coords.latitude;
    document.getElementById("user-location").style.visibility = "visible";
}

function showError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            alert("Mohon aktifkan lokasi anda.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("User location information is unavailable.");
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
    }
}