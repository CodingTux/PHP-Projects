<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>

    <?php 

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip"));
        $country = $geo["geoplugin_countryName"];
        $city = $geo["geoplugin_city"];
        $test = "Bhilai";
        
    ?>

  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="get">

      <label> Enter address here </label>
        <br>
        <br>
      <input type="text" name="inpAdd" />
      <br>
      <br>

      <label> Country </label>
        <br>
        <br>
        <!-- <label><?php echo $country ?></label> -->
      <input type="text" name="countryLoc" value="<?php echo $country ?>" disabled/>
      <br>
      <br>

      <label> City </label>
        <br>
        <br>
      <input type="text" name="cityLoc" value="<?php echo $city ?>" disabled/>
      <br>
      <br>

      <button type="submit">Submit address </button>

  </form>

  <?php
    // Get lat and long by address
    $address = $_GET['inpAdd']; // Google HQ
    $prepAddr = str_replace(' ','+',$address);
    $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
    $output= json_decode($geocode);
    $latitude = $output->results[0]->geometry->location->lat;
    $longitude = $output->results[0]->geometry->location->lng;
  ?>

      <style>
         /* Set the size of the div element that contains the map */
        #map {
          height: 400px;  /* The height is 400 pixels */
          width: 100%;  /* The width is the width of the web page */
         }
      </style>
    </head>
    <body>
      <div id="map"></div>
      <script>
  // Initialize and add the map
  function initMap() {
    // The location of Uluru
    var uluru = {lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?>};

        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 15, center: uluru});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: uluru, map: map});


  }



      </script>
      <!--Load the API from the specified URL
      * The async attribute allows the browser to render the page while the API loads
      * The key parameter will contain your own API key (which is not needed for this tutorial)
      * The callback parameter executes the initMap() function
      -->
      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcYsxb8ekGy1Q4PqRrYjT3Z-YotAwQoSs&callback=initMap">
      </script>

</body>

</html>