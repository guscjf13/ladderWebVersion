<?php
if(!isset($_SESSION)){session_start();}
?>
<style>
@import url(http://fonts.googleapis.com/earlyaccess/jejugothic.css);
a {
	text-decoration: none;
    color: #333;
    }
    body {
    	margin: 0px;
    	padding: 0px;
    }
#top_menu {
	height:80px;
	background: #000000;
	}
.top_sub {
	float:left;
	height:80px;
	line-height:80px;
	text-align: center;
	font-size:20px;
	margin-right: 30px;
	color: white;
	}
#top_space {
	display: inline;
	width: 1235px;
	height: 80px;
	}
</style>
<div id=top_menu>
	<?php if($_SESSION['count']==0){?>
	<a href=main_not_joined.php id="logo_img" class=top_sub style="margin-left: 30px; margin-right: 10px"><img src=logo.png style="width: 80px; height: 80px;"></a>
	<?php }elseif($_SESSION['count']==1){
		$up_path = "/users/".$_SESSION['id']."/project";
		$up = explode("\"", $firebase->get($up_path))[1];
		$upi_path = "/users/".$_SESSION['id']."/project/".$up."/index";
		$upi = $firebase->get($upi_path);
		?>
	<a href="main_joined.php?index=<?php echo $upi;?>" id="logo_img" class=top_sub style="margin-left: 30px; margin-right: 10px"><img src=logo.png style="width: 80px; height: 80px;"></a>
	<?php }else{?>
	<a href=project_list.php id="logo_img" class=top_sub style="margin-left: 30px; margin-right: 10px"><img src=logo.png style="width: 80px; height: 80px;"></a>
	<?php }?>
	<div id=top_space class=top_sub></div>
	<a href=project_list.php id=top_project_list class=top_sub>내 프로젝트</a>
	<a href=project_board.php id=top_project_board class=top_sub>프로젝트 게시판</a>
	<a href=logout.php id=top_logout class=top_sub>로그아웃</a>
	<img src=user.png class=top_sub style="margin-top:10px; width: 60px; height: 60px;">
</div>