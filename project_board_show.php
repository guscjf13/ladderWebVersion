<?php
	if(!isset($_SESSION)){session_start();}
	include("db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>뿌ㅃ빠뿌빠뿌</title>
</head>
<body>
<?php include("top_menu.php");?>
<div class="content">
	<h2>프로젝트 게시판 세부내용</h2>
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
	<table border=1 cellsapcing=0>
		<tr>
			<td>번호</td><td><?php echo $index?></td>
		</tr>
		<tr>
			<td>프로젝트 이름</td><td><?php echo $pname?></td>
		</tr>
		<tr>
			<td>목표</td><td><?php echo $goal?></td>
		</tr>
		<tr>
			<td>인원</td><td><?php echo $nump?>&nbsp/&nbsp<?php echo $maxp?></td>
		</tr>
		<tr>	
			<td>팀장</td><td><?php echo $leader?></td>
		</tr>
		<tr>
			<td>프로젝트 기간</td><td><?php echo $begin?>&nbsp~&nbsp<?php echo $dead?></td>
		</tr>
		<?php if($signup==1){?>
		<tr>	
			<td>상태</td><td style="text-decoration-color: green;">신청중</td>
		</tr>
		<?php }elseif($id == $leader){?>
		<tr>	
			<td>상태</td><td style="text-decoration-color: green;">내가 팀장</td>
		</tr>
		<?php }elseif($flag==1){?>
		<tr>	
			<td>상태</td><td style="text-decoration-color: green;">참가중</td>
		</tr>
		<?php }else{?>
		<tr>	
			<td>상태</td><td><?php echo $status?></td>
		</tr>
		<?php }?>
		<tr>	
			<td>내용</td><td><?php echo $info?></td>
		</tr>
		<tr>	
			<td colspan=2>

			<?php if($leader==$_SESSION['id']){?>
			<a href=""><input type="button" value="삭제"></a>	<!--우선 틀만 만들어놨음-->
			<a href=""><input type="button" value="수정"></a>
			<?php }if($signup==1){?>
			<a href="exit_project.php?index=<?php echo $index;?>"><input type="button" value="신청취소"></a>
			<?php }elseif($leader!=$_SESSION['id']){?>
			<a href="signupto_project.php?index=<?php echo $index;?>"><input type="button" value="참가신청"></a>
			<?php }?>
			<a href="project_board.php"><input type="button" value="글목록"></a>			

			</td>
		</tr>
		</table>
		
</div>
<?php include("footer.php");?>
</body>
</html>