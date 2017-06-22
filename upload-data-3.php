<?php  
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php  
	if (!isset($_SESSION['favcolor'])) {
		echo "Data Not Found";
	  	header('refresh: 5;url=upload-data.php');
	} else {
		echo "Data Found <br>";
		$daerah	   = $_SESSION['daerah'];
		$normtanam = $_SESSION['normtanam'];
		$normpanen = $_SESSION['normpanen'];
		$normprodu = $_SESSION['normprodu'];
		
		//CLuster Point
		$c1point1 = 0.415425165;	$c2point1 = 0.01056506;
		$c1point2 = 0.411739676;	$c2point2 = 0.008279364;
		$c1point3 = 0.397576004;	$c2point3 = 0.008629143;

		$distance1 = array();
		$distance2 = array();

		for ($i=0; $i < count($daerah) ; $i++) { 
			$jarak = sqrt((($c1point1 - $normtanam[$i]) ** 2 ) + (($c1point2 - $normpanen[$i]) ** 2) + (($c1point3 - $normprodu[$i]) ** 2));
			array_push($distance1, $jarak);
		}

		for ($i=0; $i < count($daerah) ; $i++) { 
			$jarak = sqrt((($c2point1 - $normtanam[$i]) ** 2 ) + (($c2point2 - $normpanen[$i]) ** 2) + (($c2point3 - $normprodu[$i]) ** 2));
			array_push($distance2, $jarak);
		}
		
		
		$_SESSION['favcolor'] = "blue";
		$_SESSION['jarak1'] = $distance1;
		$_SESSION['jarak2'] = $distance2;

		header('refresh: 5;url=upload-data-4.php');
	}
?>



</body>
</html>