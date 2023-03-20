<?php
require_once ('../data/dbhelper.php');
$id = '';
if(isset($_GET['id'])) {
    $id       = $_GET['id'];
	$sql      = 'select * from product where id = '.$id;
	$product = executeSingleResult($sql);
	
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Chi Tiết</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center"><?=$product['title']?></h2>
			</div>
			<div class="panel-body">
            <div class="row">
        
            <div class="col-lg-5">
            <img src=" <?=$product['thumbnail']?>" style="width: 100%" id="img_thumbnail">
        
            </div>
         <div class="col-lg-7">
         <?=$product['content']?>
         </div>
          </div>
            
			</div>
		</div>
	</div>
 
</body>
</html>