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
		$daerah	= $_SESSION['daerah'];
		$jarak1 = $_SESSION['jarak1'];
		$jarak2 = $_SESSION['jarak2'];

		$cluster  = array();
		$distance1 = array();
		$distance2 = array();

		for ($i=0; $i < count($daerah) ; $i++) { 
			if ($jarak1[$i] < $jarak2[$i]) {
				$input='1';
				array_push($cluster, $input);
				array_push($distance1, $jarak1[$i]);
			}
			else {
				$input='2';
				array_push($cluster, $input);
				array_push($distance2, $jarak2[$i]);	
			}
		}
		$_SESSION['favcolor'] = "blue";
		$_SESSION['cluster'] = $cluster;
		$_SESSION['cluster1'] = $distance1;
		$_SESSION['cluster2'] = $distance2;

		header('refresh: 5;url=upload-data-5.php');

		
	}
?>
</body>
</html>