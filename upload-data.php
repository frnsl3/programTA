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
	if (!empty($_FILES)) {
		session_unset();
		echo "Processing XLS with PHP";

		//Global Variable
		$daerah = array();		$tanam = array();
		$panen = array();		$produksi = array();

		//Set default timezone (will throw a notice otherwise)
		date_default_timezone_set('Asia/Kolkata');

		include 'PHPExcel/IOFactory.php';  	
		
		if(isset($_FILES['file']['name'])){
			$file_name = $_FILES['file']['name'];
			$ext = pathinfo($file_name, PATHINFO_EXTENSION);

			if($ext == 'xlsx' || $ext == 'xls'){
				//Checking the file extension
				$file_name = $_FILES['file']['tmp_name'];
				$inputFileName = $file_name;

				//Read your Excel workbook
				try {
					$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
					$objReader = PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($inputFileName);
				} catch (Exception $e) {
					die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) 
					. '": ' . $e->getMessage());
				}

				//Table used to display the contents of the file
		        echo '<center><table style="width:50%;" border=1>';

		        //  Get worksheet dimensions
		        $sheet = $objPHPExcel->getSheet(0);     //Selecting sheet 0
		        $highestRow = $sheet->getHighestRow();     //Getting number of rows
		        $highestColumn = $sheet->getHighestColumn();     //Getting number of columns

		        //  Loop through each row of the worksheet in turn
		        for ($row = 2; $row <= $highestRow; $row++) {

		            //  Read a row of data into an array

		            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
		            NULL, TRUE, FALSE);
		            // This line works as $sheet->rangeToArray('A1:E1') that is selecting all the cells in that row from cell A to highest column cell
		            //Push data from stock array to variables
		            array_push($daerah, $rowData[0][0]);
		            array_push($tanam, $rowData[0][1]);
		            array_push($panen, $rowData[0][2]);
		            array_push($produksi, $rowData[0][3]);		          

		            echo "<tr>";

		            //echoing every cell in the selected row for simplicity. You can save the data in database too.
		            foreach($rowData[0] as $k=>$v)
		                //echo "<td>".$v."</td>";

		            echo "</tr>";
		        }
		        echo '</table></center>';

		        //Send variables to session
		        $_SESSION["favcolor"] = "green";
		        $_SESSION['daerah'] = $daerah;
		        $_SESSION['tanam'] = $tanam;
		        $_SESSION['panen'] = $panen;
		        $_SESSION['produksi'] = $produksi;

		        //Redirect to next process
		        header('refresh: 5;url=upload-data-2.php');
		        
		        }
			else{
				echo '<p style="color:red;">Please upload file with xlsx extension only</p>'; 
			}
		}
		}
		else{?>
		<h2>Excel File Uploader</h2>
		<form enctype="multipart/form-data" action="" method="post" >
			<label class="form-label span3" for="file">File</label>
			<input type="file" name="file" id="file" required />	
			<br><br>
			<input type="submit" value="Submit" />
		</form>
		<?php
		}  
	?>

</body>
</html>