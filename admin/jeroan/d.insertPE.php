<?php
	include '../../database.php';
	
	$newpost = 1;
	
	$sqlx = "SELECT MAX(ID) AS last FROM gambar";
	$resultx = $conn->query($sqlx);
	$rowx = $resultx->fetch_assoc();
	$id = $rowx["last"];
	$id +=1;
	
	$sqlx = "SELECT MAX(ID) AS last FROM posting";
	$resultx = $conn->query($sqlx);
	if($resultx->num_rows > 0){
		$rowx = $resultx->fetch_assoc();
		$newpost = $rowx["last"];
	}
	$newpost +=1;
	$ResTarget = 2000;
	$count = 0;
	if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
		
	$str = $_POST['gambar'];
	foreach( $str as $key) {
				//upload and convert
				$id += $count;
				$actual_image_name = "..\\..\\imgpost\\".$id.".jpg";
				$img = $key;
				$img = substr($img, 1+strrpos($img, ','));
				$data = base64_decode($img);
				$success = file_put_contents($actual_image_name,$data);
					
				$check =  exif_imagetype ( $actual_image_name );
				$tmp = $actual_image_name;
				$exploded = explode('.',$tmp);
				if ($check == 2 )
					$imageTmp=imagecreatefromjpeg($tmp);
				else if ($check == 3 )
					$imageTmp=imagecreatefrompng($tmp);
				else if ($check == 1 )
					$imageTmp=imagecreatefromgif($tmp);
				else if ($check == 6 )
					$imageTmp=imagecreatefrombmp($originalImage);
				imagejpeg($imageTmp, $tmp, 100);	
				$ext = $exploded[count($exploded) - 1]; 
				
				//resize
				
				$filenamex = $tmp;
				list($width, $height) = getimagesize($filenamex);
				if($width>$ResTarget||$height>$ResTarget){
					if($width>$height) $percent = $ResTarget / $width;
					else $percent = $ResTarget / $width;
					
					$new_width = $width * $percent;
					$new_height = $height * $percent;
			
					$image_p = imagecreatetruecolor($new_width, $new_height);
					$image = imagecreatefromjpeg($filenamex);
					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					imagejpeg($image_p, $tmp, 100);	
				}
				
				//actual upload process
				move_uploaded_file($tmp,$actual_image_name);
				$sql = "INSERT INTO `gambar` (`ID`, `TagPost`, `Utama`) VALUES ('".$id."',".$newpost.",0);";
				$conn->query($sql);
				$count+=1;
				
				
				$thumbnail_image_name = "../../imgpost/".$id."-thumbnail.jpg";
				copy($actual_image_name, $thumbnail_image_name);
				
				//thumbnail
				$tmp = $thumbnail_image_name;
				$thumbsize = 200;
				$filename = $thumbnail_image_name;
				$percent = 1;
				list($width, $height) = getimagesize($filename);
				if($width>$thumbsize||$height>$thumbsize){
					$startX = 0;
					$startY = 0;
					$diff = $width - $height;
					if($diff>0) $startX = $diff/2;
					else $startY = ($diff*(-1))/2;
					
					$new_width = $thumbsize;
					$new_height = $thumbsize;
					
					$image_p = imagecreatetruecolor($new_width, $new_height);
					$image = imagecreatefromjpeg($filename);
					imagecopyresampled($image_p, $image, 0, 0, $startX, $startY, $new_width, $new_height, $width-($startX*2), $height-($startY*2));
					imagejpeg($image_p, $tmp, 100);	
				}
				move_uploaded_file($tmp,$thumbnail_image_name);
			}
	//header("Location: index.html"); /* Redirect browser */
	}
	
	else{
		echo"
		<script>
			alert('".$_FILES['gambar']."');
		</script>";
	}
	
	
	$judul =$_POST["judul_artikel"];
	$tanggal =$_POST["tanggal_artikel"];
	$isi =$_POST["isi_artikel"];
	$auth =$_POST["auth"];
	$tag0 =$_POST["tag0"];
	$tag1 =$_POST["tag1"];
	$tag2 =$_POST["tag2"];
	$tag3 =$_POST["tag3"];
	$tag4 =$_POST["tag4"];
	$tag5 =$_POST["tag5"];
	$tag6 =$_POST["tag6"];
	$tag7 =$_POST["tag7"];
	$tag8 =$_POST["tag8"];
	if(!$tanggal){
		$t=getdate();
		$tanggal = $t['year']."-".$t['mon']."-".$t['mday']." ".$t['hours'].":".$t['minutes'].":".$t['seconds'];
	}
	$sql = "INSERT INTO `posting` (`ID`, `Judul`, `Tanggal`, `Isi`, `Author`, `tag0`, `tag1`, `tag2`, `tag3`, `tag4`, `tag5`, `tag6`, `tag7`, `tag8`) VALUES (".$newpost.",'".$judul."','".$tanggal."','".$isi."','".$auth."','".$tag0."','".$tag1."','".$tag2."','".$tag3."','".$tag4."','".$tag5."','".$tag6."','".$tag7."','".$tag8."');";
	if ($conn->query($sql) === False) {
		echo "
		<script>
			alert('Terjadi Kelasahan');
		</script>";
		//echo $sql;
	}
	echo"
		<script>
			window.location.href='../postingan.php';
		</script>";
?>