<?php

if(!file_exists ("uploads")) {
	mkdir("uploads");
}

if(isset($_POST['subir'])){

	$uploadedfile_size=$_FILES['uploadedfile'][size];
	
	$file_name=$_FILES[uploadedfile][name];
	
	$add="uploads/$file_name";
	
	if(move_uploaded_file ($_FILES[uploadedfile][tmp_name], $add)){
	
		rename($add,'uploads/test.'.substr($file_name,-3));
		
		include('funciones.php');
	
		if(file_exists('test.png')){
			png_a_jpg('test.png');
		}
		
		$url='uploads/test.jpg';
		
		if(file_exists($url)){
			
			if(count(getColorPallet($url))==0){
				deliver_response(200, true);
			}
		
			else{
				deliver_response(200, false);
			}
			
			unlink($url);
		}
		
		else{
			deliver_response(400, false);
		}
	
	}

}

?>

<div style="margin:auto;text-align:center;">

	<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		
		<p>
			<input name="uploadedfile" type="file" />
		</p>
		
		<p>
			<input name="subir" type="submit" value="upload"/>
		</p>
	
	</form>

</div>
