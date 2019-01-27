<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Locations</title>
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
    <?php
          $con=mysqli_connect("mysql11.000webhost.com","a9565384_nick","beeka5789","a9565384_tracker");
          // Check connection
          if (mysqli_connect_errno($con))
          {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }

      
		  
		    if(isset($_POST['save']))
			{
			   $sql = "UPDATE locations SET name='".$_POST['name']."', address='".$_POST['address']."', lat='".$_POST['lat']."', lng='".$_POST['lng']."' WHERE id='".$_POST['id']."';"; 
				
			    mysqli_query($con,$sql); 
		    }
	
			 if(isset($_POST['delete']))
			{
              $sql = "DELETE FROM locations WHERE id ='".$_POST['id']."';";
		      mysqli_query($con,$sql); 
			}
			
			if(isset($_POST['create']))
			{
			  $sql = "INSERT INTO locations (name, address, lat, lng) VALUES ('".$_POST['name']."','".$_POST['address']."','".$_POST['lat']."','".$_POST['lng']."');";
			  mysqli_query($con,$sql); 
			}
		     
		  
		  $sql="SELECT * FROM locations;";
          $result=mysqli_query($con,$sql);

           //Associative array
          while($row=mysqli_fetch_assoc($result))
          {
			echo '<form action="" method="post">';
			echo 'ID: '.$row['id'];
			echo '<input type="hidden" name="id" value="'.$row['id'].' ">';
			echo ' Name: <input type="text" name="name" value="'.$row['name'].'" />';
			echo ' Address: <input type="text" name="address" value="'.$row['address'].'" />';
			echo ' Lat: <input type="text" name="lat" value="'.$row['lat'].'" />';
			echo ' Lng: <input type="text" name="lng" value="'.$row['lng'].'" />';	
			echo ' <input type="submit" name="save" value="Save">';	
			echo ' <input type="submit" name="delete" value="Delete">';	
			echo '</form>';
		  }
		  
			echo '<form action="" method="post">';
			echo 'New Location: ';
			echo ' Name: <input type="text" name="name" />';
			echo ' Address: <input type="text" name="address" />';
			echo ' Lat: <input type="text" name="lat" />';
			echo ' Lng: <input type="text" name="lng" />';	
			echo ' <input type="submit" name="create" value="Create">';	
			echo '</form>';
						
      ?>
  </div>
</body>
</html>