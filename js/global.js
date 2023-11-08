document.addEventListener("DOMContentLoaded", function () {
    
    // get url params
    var paramString = window.location.href.split('/#')[0];
    paramString = paramString.split('?')[1];
    let urlParams = new URLSearchParams(paramString);

    // set fastbooking previously selected values
    var fb_movieId = urlParams.get('fb_movie');
    var fb_locationId = urlParams.get('fb_location');
    if(fb_movieId != null && fb_locationId != null){
      openFastBooking();
      document.getElementById("FB_movie").value = fb_movieId;
      document.getElementById("FB_location").value = fb_locationId;
    }

  });

function openFastBooking(){
    document.getElementById("fastBookingPopup").style.display = "block";
  }
  function closeFastBooking(){
    document.getElementById("fastBookingPopup").style.display = "none";
  }

  function selectFastBooking(){
    var fb_movieId = document.getElementById("FB_movie").value;
    var fb_locationId = document.getElementById("FB_location").value;
    location.href = '?fb_movie='+fb_movieId+'&fb_location='+fb_locationId;
  }
  function validateFastBooking(){
    var fb_screeningId = document.getElementById("FB_time").value;
    if(fb_screeningId==0){
      alert('Please select a TIME');
    }
  }
  function toggleDropdown() {
    var dropdownContent = document.getElementById("myDropdown");
    dropdownContent.style.display = (dropdownContent.style.display === "block") ? "none" : "block";
  }

  /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }
  // Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }