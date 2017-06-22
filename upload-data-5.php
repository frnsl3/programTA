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
		$daerah = $_SESSION['daerah'];
		$normtanam = $_SESSION['normtanam'];
		$normpanen = $_SESSION['normpanen'];
		$normprodu = $_SESSION['normprodu'];
		$jarak1 = $_SESSION['jarak1'];
		$jarak2 = $_SESSION['jarak2'];
		$cluster = $_SESSION['cluster'];
		$cluster1 = $_SESSION['cluster1'];
		$cluster2 = $_SESSION['cluster2'];

		$c1a = 0; $c2a = 0;
		$c1b = 0; $c2b = 0;
		$c1c = 0; $c2c = 0;

		$pc1a = 0; $pc2a = 0;
		$pc1b = 0; $pc2b = 0;
		$pc1c = 0; $pc2c = 0;

		for ($i=0; $i < count($daerah); $i++) { 
			if ($cluster[$i] =='1') {
				$c1a = $c1a + $normtanam[$i];
				$c1b = $c1b + $normpanen[$i];
				$c1c = $c1c + $normprodu[$i];
			}
			else {
				$c2a = $c2a + $normtanam[$i];
				$c2b = $c2b + $normpanen[$i];
				$c2c = $c2c + $normprodu[$i];
			}
		}

		$pc1a = $c1a / count($cluster1); $pc2a = $c2a / count($cluster2);
		$pc1b = $c1b / count($cluster1); $pc2b = $c2b / count($cluster2);
		$pc1c = $c1c / count($cluster1); $pc2c = $c2c / count($cluster2);

		echo $pc1a."<br>";
		echo $pc1b."<br>";
		echo $pc1c."<br>";
		echo $pc2a."<br>";
		echo $pc2b."<br>";
		echo $pc2c."<br>";

	}
?>
</body>
</html>