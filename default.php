<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Nick's Pizza</title>
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
  <script>  
    var map;
    function initialize(lat, lng, name) {
      //Define Google Map options
	  var mapOptions = {zoom: 18, center: new google.maps.LatLng(lat, lng),
      mapTypeId: google.maps.MapTypeId.ROADMAP};
      //Create the Google Map object 
      map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
      //place a marker at the address
      var marker = new google.maps.Marker({position: new google.maps.LatLng(lat, lng),map: map,title: name});
    }
  </script>
  </head>

  <body>
  <div id="wrap">
    <div id="header">
      <h2 class="headerText">Nick's Pizza</h2>
    </div>
    <div id="menu">
      <p class="menuText"><a href="http://foodtracker.hostzi.com/">Home </a> | <a href="locations.php">Locations</a> | Services | Contact Us</p>
    </div>
    <br />
    <form action="" method="post">
      Your Address:
      <input type="text" name="myaddress" />
    </form>
    <br />
    <?php
      if(isset($_POST['myaddress'])){
        $myaddress = urlencode($_POST['myaddress']);
        //here is the google api url
        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$myaddress&sensor=false";
        //get the content from the api using file_get_contents
        $getmap = file_get_contents($url);
        //the result is in json format. To decode it use json_decode
        $googlemap = json_decode($getmap);
         //get the latitute, longitude from the json result by doing a for loop
        foreach($googlemap->results as $res){
          $address = $res->geometry;
          $latlng = $address->location;
          $formattedaddress = $res->formatted_address;

          $con=mysqli_connect("mysql11.000webhost.com","a9565384_nick","beeka5789","a9565384_tracker");
          // Check connection
          if (mysqli_connect_errno($con))
          {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }

          $sql="SELECT address, name, lat, lng, ( 3959 * acos( cos( radians(".$latlng->lat.") ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(".$latlng->lng.") ) + sin( radians(".$latlng->lat.") ) * sin( radians( lat ) ) ) ) AS distance FROM locations ORDER BY distance;";
          $result=mysqli_query($con,$sql);

           //Associative array
//          while($row=mysqli_fetch_assoc($result))
//          {
//            echo $row['address'];
//            echo "<br/>";
//            echo $row['distance'];
//            echo "<br/>";
//            echo "<br/>";
//		  }
          $row=mysqli_fetch_assoc($result);
          // Free result set
          mysqli_free_result($result);
          mysqli_close($con);

          echo "<script>google.maps.event.addDomListener(window, 'load', function(){initialize(".$row['lat'].",".$row['lng'].",'".$row['name']."');});</script>";
		  echo "<br />";
		  echo "<h2>Closest Location: ".$row['address']."</h2>";
		  echo "<h2>Map:</h2>";
		  echo '<div id="googleMap" style="width:500px;height:380px;"></div>';
        }
      }
      ?>
  </div>
</body>
</html>
