<?php  
// PHP Session Start
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
		//Convert Session to Array
		$daerah   = $_SESSION['daerah'];			
		$tanam 	  = $_SESSION['tanam'];		$min1 = min($tanam); 	$max1 = max($tanam);
		$panen    = $_SESSION['panen'];		$min2 = min($panen); 	$max2 = max($panen);
		$produksi = $_SESSION['produksi'];	$min3 = min($produksi); $max3 = max($produksi);
		
		//Variables for normalization
		$normtanam = array();
		$normpanen = array();
		$normprodu = array();

		echo "Normalize Data";
		//Normalization Process
		for ($i=0; $i < count($daerah) ; $i++) { 
			$nilai = ($tanam[$i] - $min1) / ($max1 - $min1);
			array_push($normtanam, $nilai);

			$nilai = ($panen[$i] - $min2) / ($max2 - $min2);
			array_push($normpanen, $nilai);

			$nilai = ($produksi[$i] - $min3) / ($max3 - $min3);
			array_push($normprodu, $nilai);
		}
		
		//Send variables to session
		$_SESSION["favcolor"] = "orange";
		$_SESSION['normtanam'] = $normtanam;
		$_SESSION['normpanen'] = $normpanen;
		$_SESSION['normprodu'] = $normprodu;

		//Redirect to next process
		header('refresh: 5;url=upload-data-3.php');
	}

	?>

</body>
</html>