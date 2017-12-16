﻿<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Publikasi</title>    
    <?php 
        include 'header.html';
        include 'database.php';
    ?>
</head>
<body>
    <?php include 'Navbar.html';?>
    <div class="grid-container">
        
        <!-- navigasi kiri -->
			<?php include 'left_nav.html';?>
		<!--Recent-->
        <!-- konten -->
		<div class="grid-headline-header">
            <h1 class="headline-header"><span class="header-revcolor">PUBLIKASI</span></h1>
        </div>
        <div class="grid-headline-para">
            <p class="headline-para">
            <?php
                    
                    $sql = "SELECT * FROM `datahalaman`";
                    $result = $conn->query($sql);
                    $id=13;
                    while($row = $result->fetch_assoc()) 
                    {
                        if($id==$row["Katagori"]&& 1==$row["Header"]) echo nl2br($row["Isi"]);
                    }
                    mysqli_data_seek($result,0);
                 ?></p>
        </div>
        <div class="grid-headline-thumbnail">
            <img style="thumbnail" src="f_img/16.jpg" height="auto" width="100%"/>
			<div class="headline-thumbnail-det">
				<div style="padding:10px;font-style:italic;color:white">
					<p>If you do not write for publication, there is little point in writing at all.
						<br> <div style="text-align:right"> - George Bernard Shaw</div>
					</p>
				</div>
			</div>
		</div>
        <div class="grid-content">
            <div class="contentstyle" style="margin:40px;text-align:justify">
                <!-- content start -->
                <?php
                
                $sql = "SELECT * FROM `datahalaman`";
                $result = $conn->query($sql);
                $id=13;
                while($row = $result->fetch_assoc()) 
                {
                    if($id==$row["Katagori"]&& 0==$row["Header"]) {
            ?>
                    <h1><?php echo nl2br($row["Judul"]);?> </h1>
            <p>
                    <?php echo ($row["Isi"]);?>
            </p>
            <?php
                    }
                }
             ?>
                <!-- content end -->
            </div>
        </div>
    </div>
</body>
</html>