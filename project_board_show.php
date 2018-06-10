<?php
	if(!isset($_SESSION)){session_start();}
	include("db.php");
?>

<!DOCTYPE html>

<html>
	<head>
		<style>
			#processbar_title {
				margin-left: 200px;
			}
			#right_project_processbar {
				margin-left: 200px;
			}

			#content_left {
				width:1200px;
				height: 500px;
				float: left;
			}
			th {
				width: 250px;
			}
			td {
				width: 250px;
				text-align: center;
			}
			h2 {
				margin: 0;
			}

			#content_right {
				width: 500px;
				height: 470px;
				float:left;
				background-color: green;
			}
		</style>
	</head>

<body>
	<?php include("top_menu.php");?>

	<h1 style="text-align: center;">프로젝트 게시판 세부내용</h1>

	<?php
	make_processbar(72);
	?>

	<div id=content_left>
		<?php 
			//show_content($_REQUEST['num']);
			$index = $_REQUEST['index'];	//REQUEST로 $index 받아서 넣어주고
            $pname_path="/project/".$index."/pInfo/pname";	//path 설정할때 $index 사용함
            $goal_path="/project/".$index."/pInfo/goal";
            $nump_path="/project/".$index."/pInfo/numpeople";
            $maxp_path="/project/".$index."/pInfo/maxpeople";
            $leader_path="/project/".$index."/pInfo/leader";
            $begin_path="/project/".$index."/pInfo/beginline";
            $dead_path="/project/".$index."/pInfo/deadline";
            $status_path="/project/".$index."/pInfo/status";
            $info_path="/project/".$index."/pInfo/info";

            $pname = $firebase->get($pname_path);
            $goal = $firebase->get($goal_path);
            $nump = $firebase->get($nump_path);
            $maxp = $firebase->get($maxp_path);
            $leader = $firebase->get($leader_path);
            $begin = $firebase->get($begin_path);
            $dead = $firebase->get($dead_path);
            $status = $firebase->get($status_path);
            $info = $firebase->get($info_path);

            $pname = explode("\"", $pname)[1];	//"" 붙는거 없애는작업
            $goal = explode("\"", $goal)[1];
            $leader = explode("\"", $leader)[1];
            $begin = explode("\"", $begin)[1];
            $dead = explode("\"", $dead)[1];
            $status = explode("\"", $status)[1];
            $info = explode("\"", $info)[1];

            $id = $_SESSION['id'];
            $signup_path = "/check/signup/".$index."/id/".$id;
            $signup = $firebase->get($signup_path);

            $ucount_path = "/user/".$id."/project/increase";
            $ucount = $firebase->get($ucount_path);
            $flag = 0;
            for($m=1;$m<=$ucount;$m++){
                $joined_path = "/user/".$id."/project/".$m."/index";
                $joined = $firebase->get($joined_path);
                if($joined == $index){
                    $flag = 1;
                    break;
                }
            }
		?>

		<table border=0 style="width: 1000px; height: 340px; margin: 0 auto; border-collapse: collapse;">

			<tr style="height: 70px; border-bottom: 2px dotted #BDBDBD;">
				<th><h2>번호</h2></th><td><?php echo $index?></td>
				<th><h2>프로젝트 이름</h2></th><td><?php echo $pname?></td>
			</tr>

			<tr style="height: 70px; border-bottom: 2px dotted #BDBDBD;">
				<th><h2>목표</h2></th><td><?php echo $goal?></td>
				<th><h2>인원</h2></th><td><?php echo $nump?>&nbsp/&nbsp<?php echo $maxp?></td>
			</tr>

			<tr style="height: 70px; border-bottom: 2px dotted #BDBDBD;">
				<th><h2>팀장</h2></th><td><?php echo $leader?></td>
				<th><h2>팀원</h2></th><td>여기에 팀원을 넣어주세용</td>
			</tr>

			<tr style="height: 70px; border-bottom: 2px dotted #BDBDBD;">
				<th><h2>프로젝트 기간</h2></th><td><?php echo $begin?>&nbsp~&nbsp<?php echo $dead?></td>

				<?php if($signup==1){?>
					<th><h2>상태</h2></th><td style="text-decoration-color: green;">신청중</td>
				<?php }elseif($id == $leader){?>
					<th><h2>상태</h2></th><td style="text-decoration-color: green;">내가 팀장</td>
				<?php }elseif($flag==1){?>
					<th><h2>상태</h2></th><td style="text-decoration-color: green;">참가중</td>
				<?php }else{?>
					<th><h2>상태</h2></th><td><?php echo $status?></td>
				<?php }?>
			</tr>

			<tr style="height: 150px; border-bottom: 2px dotted #BDBDBD;">
				<th><h2>내용</h2></th><td colspan="3"><?php echo $info?></td>
			</tr>

			<tr style="height: 70px;">
				<th colspan=4>

				<?php if($leader==$_SESSION['id']){?>
				<a href=""><input type="button" value="삭제"></a>	<!--우선 틀만 만들어놨음-->
				<a href=""><input type="button" value="수정"></a>
				<?php }if($signup==1){?>
				<a href="exit_project.php?index=<?php echo $index;?>"><input type="button" value="신청취소"></a>
				<?php }elseif($leader!=$_SESSION['id']){?>
				<a href="signupto_project.php?index=<?php echo $index;?>"><input type="button" value="참가신청"></a>
				<?php }?>
				<a href="project_board.php"><input type="button" value="글목록"></a>			

				</th>
			</tr>
		</table>
			
	</div>

	<div id=content_right>
	</div>

	<?php include("footer.php");?>
	
	</body>

</html>