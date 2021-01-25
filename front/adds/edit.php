<?php

require_once "connection.php";

if(isset($_REQUEST['update_id']))
{
	try
	{
		$id = $_REQUEST['update_id']; 
		$select_stmt = $db->prepare('SELECT * FROM add_advert WHERE id =:id'); 
		$select_stmt->bindParam(':id',$id);
		$select_stmt->execute(); 
		$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
	}
	catch(PDOException $e)
	{
		$e->getMessage();
	}
	
}

if(isset($_REQUEST['btn_update']))
{
	try
	{
		$name	=$_REQUEST['txt_name'];	
		$description	= $_REQUEST['txt_name'];
        $more	= $_REQUEST['txt_name'];
        $status	= $_REQUEST['txt_name'];
		$image_file	= $_FILES["txt_file"]["name"];
		$type		= $_FILES["txt_file"]["type"];	
		$size		= $_FILES["txt_file"]["size"];
		$temp		= $_FILES["txt_file"]["tmp_name"];
			
		$path="upload/".$image_file; 
		
		$directory="upload/"; 
		
		if($image_file)
		{
			if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif') 
			{	
				if(!file_exists($path))
				{
					if($size < 5000000)
					{
						unlink($directory.$row['image']);
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
				$errorMsg="Upload JPG, JPEG, PNG & GIF File Formate.....CHECK FILE EXTENSION";
			}
		}
		else
		{
			$image_file=$row['image']; 
		}
	
		if(!isset($errorMsg))
		{
			$update_stmt=$db->prepare('UPDATE add_advert SET name=:name_up,description =: description_up ,more =: more_up,status=:status_up,image=:file_up WHERE id=:id');
			$update_stmt->bindParam(':name_up',$name);
            $update_stmt->bindParam(':description_up',$description);
            $update_stmt->bindParam(': more_up',$more);
            $update_stmt->bindParam(':status_up',$status);
			$update_stmt->bindParam(':file_up',$image_file);	
			$update_stmt->bindParam(':id',$id);
			 
			if($update_stmt->execute())
			{
				$updateMsg="File Update Successfully.......";	
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
<title>eddit advertisements</title>
		
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
		
</head>

	<body>
	
	
	<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         
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
		if(isset($updateMsg)){
		?>
			<div class="alert alert-success">
				<strong>UPDATE ! <?php echo $updateMsg; ?></strong>
			</div>
        <?php
		}
		?>   
		
			<form method="post" class="form-horizontal" enctype="multipart/form-data">
					
				<div class="form-group">
				<label class="col-sm-3 control-label">Name</label>
				<div class="col-sm-6">
				<input type="text" name="txt_name" class="form-control" value="<?php echo $name; ?>" required/>
				</div>
				</div>
				<div class="form-group">
				<label class="col-sm-3 control-label">Description</label>
				<div class="col-sm-6">
				<input type="text" name="txt_name" class="form-control" value="<?php echo $description; ?>" required/>
				</div>
				</div>
                
                <div class="form-group">
				<label class="col-sm-3 control-label">More</label>
				<div class="col-sm-6">
				<input type="text" name="txt_name" class="form-control" value="<?php echo $more; ?>" required/>
				</div>
				</div>
                
                <div class="form-group">
				<label class="col-sm-3 control-label">status</label>
				<div class="col-sm-6">
				<input type="text" name="txt_name" class="form-control" value="<?php echo $status; ?>" required/>
				</div>
				</div>	
					
				<div class="form-group">
				<label class="col-sm-3 control-label">File</label>
				<div class="col-sm-6">
				<input type="file" name="txt_file" class="form-control" value="<?php echo $image; ?>"/>
				<p><img src="adds/upload/<?php echo $image; ?>" height="100" width="100" /></p>
				</div>
				</div>
					
					
				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9 m-t-15">
				<input type="submit"  name="btn_update" class="btn btn-primary" value="Update">
				<a href="index.php" class="btn btn-danger">Cancel</a>
				</div>
				</div>
					
			</form>
			
		</div>
		
	</div>
			
	</div>
										
	</body>
</html>