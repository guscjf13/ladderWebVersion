<?php
if(!isset($_SESSION)){session_start();}	//세션이 있으면 넘어가고 없으면 세션을 시작함
?>
<!DOCTYPE HTML>
<html>
	
	<head>
		<meta charset="UTF-8" \>
		<style>
			#picture {
				text-align: center;
			}
			#logo {
				width: 800px; 
				height: 300px;
				display: block;
				margin: 0 auto;
				padding-top: 50px;
				padding-bottom: 20px;
				text-align: center;
			}
		</style>
	</head>

	<body>

	<div id=logo>
		<a href=login.html><img src=logo.png style="width: 30%; height: auto;" id="logo_img"></a>
	</div>

	<?php
		include "db.php";

		$id=$_POST["ID"];
		$password=$_POST["password"];
		$password2=$_POST["password2"];
		$name=$_POST["name"];
		$question=$_POST["question"];
		$answer=$_POST["answer"];
		if($password!=$password2)
		{
			?>

			<div id=picture> <a href=log_in_make.php><img src=fail_idpw.png style="width: 25%; height: auto;"></a> </div>

			<?php
		}
		else if(empty($id))
		{
			?>

			<div id=picture> <a href=log_in_make.php><img src=fail_idpw.png style="width: 25%; height: auto;"></a> </div>

			<?php
		}
		else if(empty($password))
		{
			?>

			<div id=picture> <a href=log_in_make.php><img src=fail_idpw.png style="width: 25%; height: auto;"></a> </div>

			<?php
		}
		else if(!preg_match("/[0-9]+/", $password) || !preg_match("/[a-zA-Z]+/", $password) || strlen($password)<8)
		{
			?>

			<div id=picture> <a href=log_in_make.php><img src=fail_idpw.png style="width: 25%; height: auto;"></a> </div>

			<?php
		}
		else if(empty($name))
		{
			?>

			<div id=picture> <a href=log_in_make.php><img src=fail_name.png style="width: 25%; height: auto;"></a> </div>

			<?php
		}
		else
		{
			$id_path="/user/".$id."/id";
			$pw_path="/user/".$id."/password";
			$name_path="/user/".$id."/name";
			$count_path="/user/".$id."/project/count";
			$increase_path="/user/".$id."/project/increase";
			
			$firebase->set($id_path, $id);
			$firebase->set($pw_path, $password);
			$firebase->set($name_path, $name);
			$firebase->set($count_path, 0);
			$firebase->set($increase_path, 0);
			
			?>

				<div id=picture> <a href=login.html><img src=make.png style="width: 25%; height: auto;"></a> </div>

			<?php
		}

	?>


	</body>

</html>