<?php

require_once "connection.php";

if(isset($_REQUEST['btn_insert']))
{
	try
	{
		$name	= $_REQUEST['txt_name'];	
        $description	= $_REQUEST['txt_description'];
        $more	= $_REQUEST['txt_more'];
        $status	= $_REQUEST['txt_status'];
        
		$image_file	= $_FILES["txt_file"]["name"];
		$type		= $_FILES["txt_file"]["type"];		
		$size		= $_FILES["txt_file"]["size"];
		$temp		= $_FILES["txt_file"]["tmp_name"];
		
		$path="upload/".$image_file; 
		
		if(empty($name)){
			$errorMsg="Please Enter Name";
		}
        if(empty($description)){
			$errorMsg="Please Enter description";
		}
        if(empty($more)){
			$errorMsg="Please Enter description";
		}
        if(empty($status)){
			$errorMsg="Please Enter description";
		}
		else if(empty($image_file)){
			$errorMsg="Please Select Image";
		}
		else if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif') 
		{	
			if(!file_exists($path))
			{
				if($size < 5000000) 
				{
					move_uploaded_file($temp, "upload/" .$image_file); 
				}
				else
				{
					$errorMsg="Your File To large Please Upload 5MB Size"; 
				}
			}
			else
			{	
				$errorMsg="File Already Exists...Check Upload Folder"; 
			}
		}
		else
		{
			$errorMsg="Upload JPG , JPEG , PNG & GIF File Formate.....CHECK FILE EXTENSION"; 
		}
		
		if(!isset($errorMsg))
		{
			$insert_stmt=$db->prepare('INSERT INTO add_advert(name,description,more,status,image) VALUES(:fname,:fdescription,:fmore,:fstatus,:fimage)'); 					
			$insert_stmt->bindParam(':fname',$name);
            $insert_stmt->bindParam(':fdescription',$description);
            $insert_stmt->bindParam(':fmore',$more);
            $insert_stmt->bindParam(':fstatus',$status);
			$insert_stmt->bindParam(':fimage',$image_file);	  
		
			if($insert_stmt->execute())
			{
				$insertMsg="File Upload Successfully........"; 
				header("refresh:3;index.php");
			}
		}
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>Add advertisement</title>
		
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
		
</head>

	<body>
	
	
	<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
        
          
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div class="wrapper">
	
	<div class="container">
			
		<div class="col-lg-12">
		
		<?php
		if(isset($errorMsg))
		{
			?>
            <div class="alert alert-danger">
            	<strong>WRONG ! <?php echo $errorMsg; ?></strong>
            </div>
            <?php
		}
		if(isset($insertMsg)){
		?>
			<div class="alert alert-success">
				<strong>SUCCESS ! <?php echo $insertMsg; ?></strong>
			</div>
        <?php
		}
		?>   
		
			<form method="post" class="form-horizontal" enctype="multipart/form-data" >
					
				<div class="form-group">
				<label class="col-sm-3 control-label">Name</label>
				<div class="col-sm-6">
				<input type="text" name="txt_name" class="form-control" placeholder="enter name" />
				</div>
				</div>
                <div class="form-group">
				<label class="col-sm-3 control-label">Description</label>
				<div class="col-sm-6">
				<input type="text" name="txt_description" class="form-control" placeholder="enter description" />
				</div>
				</div>
                
                <div class="form-group">
				<label class="col-sm-3 control-label">More</label>
				<div class="col-sm-6">
				<input type="text" name="txt_more" class="form-control" placeholder="enter ..." />
				</div>
				</div>
                
                <div class="form-group">
				<label class="col-sm-3 control-label">status</label>
				<div class="col-sm-6">
				<input type="text" name="txt_status" class="form-control" placeholder="enter status when to show" />
				</div>
				</div>
                
             
					
				<div class="form-group">
				<label class="col-sm-3 control-label">File</label>
				<div class="col-sm-6">
				<input type="file" name="txt_file" class="form-control" />
				</div>
				</div>
					
					
				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9 m-t-15">
				<input type="submit"  name="btn_insert" class="btn btn-success " value="Insert">
				<a href="adds/index.php" class="btn btn-danger">Cancel</a>
                         
				</div>
				</div>
					
			</form>
            <br><br>
			 <button onclick="history.go(-1);">Back to previous page</button>
		</div>
		
	</div>
			
	</div>
										
	</body>
</html>