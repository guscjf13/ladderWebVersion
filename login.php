<?php
if(!isset($_SESSION)){session_start();}	//세션이 있으면 넘어가고 없으면 세션을 시작함
?>
<!DOCTYPE HTML>
<html>
	
	<head>
		<meta charset="UTF-8" \>
	</head>

	<body>

	<?php		
		include "db.php";

		$id=$_POST['id'];
		$passwd=$_POST['passwd'];
		$name=NULL;

		if(is_passwd_correct($id, $passwd, $name))
		{
			$_SESSION['id'] = $id;
			$_SESSION['name'] = $name;
			if($_SESSION['count'] == 0){
				?>
				<script> location.replace("main_not_joined.php") </script>
				<?php
			}else{
				?>
				<script> location.replace("project_list.php") </script>
				<?php
			}
			//elseif($_SESSION['count'] == 1){
			//	$path = "/users/".$_SESSION['id']."/project";
			//	$index = explode("\"", $firebase->get($path))[1];
			//	$path = "users/".$_SESSION['id']."/project/".$index."/index";
			//	$index = $firebase->get($path);
			//}

		}
		else
		{
			//로그인 실패 메세지 띄워주기
			?>
			<script> location.replace("login.html") </script>
			<?php
		}
	?>

	</body>

</html>