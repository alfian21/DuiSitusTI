<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Admin - Data Lulusan</title>
    <?php include 'admin-header.html';?>
</head>
<body>
    <?php include 'admin-navbar.php';?>
    <div class="admin-content-pos">
        
        <div class="admin-main-content">
            <table  class="table-post">
                <col><col><col>
                <tr>
                    <td>Nama</td>
                    <td>Judul</td>
                    <td>Pengaturan</td>
                </tr>
				<?php
					include '../database.php';
					$sql = "SELECT * FROM lulusan";
					$result = $conn->query($sql);
					$i=1;
					while($row = $result->fetch_assoc()) 
					{
				?>
						<tr>
						<td> <?php echo	$row["Nama"] ?></td>
						<td> <?php echo	$row["Judul"] ?></td>
						<td>
							<button id="update-button" type="button" onclick="showUpdateDiv(<?php echo	$row["ID"] ?>)">edit</button>
							<button id="delete-button" type="button" onclick="showDeleteDiv(<?php echo	$row["ID"] ?>)">hapus</button></td>
						</tr>
						
				<?php
					}
					
					$sql = "SELECT MAX(ID) as LAST FROM `lulusan`";
					$result = $conn->query($sql);
					$row = $result->fetch_assoc();
					$id = 1 + $row["LAST"];
					
				?>
            </table>
            <button id="insert-button" style="left:0;" type="button" onclick="showInsertDiv(<?php echo $id ?>)">tambahkan</button>
        </div>

        <!-- insert -->
        <div id="divInsert" class="background-content">
            <div class="background" onclick="hideInsertDiv()"></div>
            <div class="admin-content" id="insert"> 
                A
            </div>
        </div>

        <!-- update -->
        <div id="divUpdate" class="background-content">
            <div class="background" onclick="hideUpdateDiv()"></div>
            <div class="admin-content" id="update"> 
                
            </div>
        </div>

        <!-- delete -->
        <div id="divDelete" class="background-content">
            <div class="background" onclick="hideDeleteDiv()"></div>
            <div id="delete" class="admin-content"> 
                
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/show-div-lulusan.js"></script>
    <script type="text/javascript" src="js/textarea.js"></script>
</body>
</html>