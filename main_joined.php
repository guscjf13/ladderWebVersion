<?php
if(!isset($_SESSION)){session_start();}	//세션이 있으면 넘어가고 없으면 세션을 시작함
?>
<!DOCTYPE HTML>
<html>
	
	<head>
		<meta charset="UTF-8" \>
		<style>
		@import url(http://fonts.googleapis.com/earlyaccess/jejugothic.css);
        body {
            margin: 0px;
        }
        #logo_center {
          display: table-cell;
          vertical-align: middle;
          text-align: center;
        }
        pre {
            margin: 0;
            font-size: 50px;
            text-align: center;
        }
  #board_area {margin:5px auto; background-color: white; border-radius: 50px;}
  #invite_area {margin:50px auto; height: 50px;}
  .list-table thead th{ height:40px; border-top:2px solid #09C; border-bottom:1px solid #CCC; font:bold 17px 'malgun gothic';  }
  .list-table tbody td{ text-align:center; padding:10px 0; border-bottom:1px solid #CCC; height:20px; font: 14px 'malgun gothic';}
  #main_head {
    margin: 0px auto 0px auto;
    text-align: center;
  }
  table {
    margin: 0px auto;
  }
		a {
			text-decoration: none;
			color: black;
		}
		/*왼쪽 메뉴 스타일들*/
		#left_menu {
			width: 300px;
			height: 790px;
			float:left;
			overflow: hidden;
		}
		#left_project_logo {
			width: 200px;
			height: 200px;
			margin: 30px 50px 30px 50px;
			background-color: red;
			border-radius: 100px;
			text-align: center;
		}
		#left_project_info {
			border-radius: 50px;
			width: 240px;
			height: 540px;
			margin: 30px;
			padding-top: 30px;
		}
		#left-project-detail {
			width: 200px;
			height: 360px;
			margin-top: 50px;
			margin-left: 20px;
			background-color: white;
			text-align: center;
		}
		#left_project_manage {
			width: 180px;
			height: 50px;
			border: 3px solid black;
			margin-left: 30px;
			background-size: cover;
			background-image: url('left_project_manage.png')
		}
		#left_project_manage:hover {
			background-image: url('left_project_manage_hover.png')			
		}
		
		/*오른쪽 메뉴 스타일들*/
		#right_menu {
			height: 790px;
			float:right;
		}
		#right_make_error {
			border-radius: 100px;
			display: inline-block;
			width: 700px;
			height: 50px;
			background-color: #686868;
			line-height: 50px;
			text-align: center;
			margin-left: 440px;
		}
		#right_project_board {
			border-radius: 50px;
			height: 200px;
			background-color: #CEF279;
			margin:100px 25px 25px 0;
			padding: 10px 10px 10px 10px
		}
		</style>
	</head>

	<body>

		<?php
			include "db.php";
			include "top_menu.php";
			$index = $_REQUEST['index'];	//REQUEST로 $index 받아서 넣어주고
			$id = $_SESSION['id'];

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
		?>

		<div id=left_menu>

			<div id=left_project_logo>
				<img src=left_project_logo.png style="width: 200px; height:200px; border-radius: 100px;">
				<h1 style="margin-top: 20px"><?php echo $pname;?></h1>
			</div>

			<div id=left_project_info>

				<div id=left-project-detail>
					<table border=0 style="width: 200px; height: 340px; border-collapse: collapse;">
						<tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
							<th><h2>팀장</h2></th><td><?php echo $leader?></td>
						</tr>
						<tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
							<th><h2>목표</h2></th><td><?php echo $goal?></td>
						</tr>
						<tr style="height: 80px; border-bottom: 2px dotted #BDBDBD;">
							<th colspan=2><?php echo $begin?>&nbsp~<br>&nbsp<?php echo $dead?></th>
						</tr>
						<tr style="height: 100px;">
							<th colspan=2><?php echo $info?></td>
						</tr>
					</table>
				</div>
				<?php if($id == $leader){?>
				<a href=project_manage.php?index=<?php echo $index?>> <div id=left_project_manage></div> </a>
				<?php }?>
			</div>

		</div>

		<div id=right_menu>
		 <a href=# onClick="window.open('message.php?index=<?php echo $index?>','window_name','width=550,height=600,location=no,status=no,scrollbars=no')" id="message_img" 
		 	style="float: right; margin-right: 100px; margin-top: 30px;"><img src=message.png style="width: 50px; height: 50px;"></a>
			<?php
				make_processbar($index);
				make_error_card($index);	//파라미터로 현재 프로젝트 번호 넘겨줘야함
			?>

			<a href=make_error.php id=right_make_error class=top_sub>	오류 등록 </a> 

			<div id=right_project_board>
				<h3 id=main_head>TO DO LIST</h3>
				 <div id="board_area"> 
    <table class="list-table">
    	<thead>
        	<tr>
            	<th width="60">번호</th>
                <th width="200">제목</th>
                <th width="200">기간</th>
                <th width="80">상태</th>
            </tr>
        </thead>
    
        <?php
			$wincrease_path="/project/".$index."/things/increase";
            $wincrease = $firebase->get($wincrease_path);
            $i = 1;
            while($wincrease >= $i){
                $valid_path="/project/".$index."/things/".$i."/id";
                $valid = $firebase->get($valid_path);
                $valid = explode("\"", $valid)[1];
                if($valid == null){
                    $i++;
                }elseif($valid != $id){
                	$i++;
                }else{
                    $wname_path="/project/".$index."/things/".$i."/wname";
                    $content_path="/project/".$index."/things/".$i."/content";
                    $wbegin_path="/project/".$index."/things/".$i."/beginline";
                    $wdead_path="/project/".$index."/things/".$i."/deadline";
                    $state_path="/project/".$index."/things/".$i."/state";

                    $wname = $firebase->get($wname_path);
                    $content = $firebase->get($content_path);
                    $wbegin = $firebase->get($wbegin_path);
                    $wdead = $firebase->get($wdead_path);
                    $state = $firebase->get($state_path);

                    $wname = explode("\"", $wname)[1];
                    $content = explode("\"", $content)[1];
                    $wbegin = explode("\"", $wbegin)[1];
                    $wdead = explode("\"", $wdead)[1];
    			?>
	<tbody>
		<tr>
            <td width="60"><?php echo $i; ?></td>
            <td width="200"><a href=# onclick="window.open('work_detail.php?pindex=<?php echo $index;?>&windex=<?php echo $i;?>','window_name','width=550,height=600,location=no,status=no,scrollbars=no')" id="message_img" style=""><?php echo $wname;?></a></td>   <!--REQUEST 로 선택한 글 프로젝트 $index를 넘겨준다.-->
            <td width="200"><?php echo $wbegin; ?>&nbsp~&nbsp<?php echo $wdead; ?></td>
            <?php if($state == 3){?>
            <td width="80"><img border="0" src="done2.png" alt="done" width="20" height="20"></td>
        	<?php }elseif($state == 2){?>
        	<td width="80"><img border="0" src="issue2.png" alt="done" width="20" height="20"></td>
        	<?php }elseif($state == 1){?>
        	<td width="80"><img border="0" src="working3.png" alt="done" width="20" height="20"></td>
        	<?php }else{?>
        	<td width="80"><img border="0" src="finding2.png" alt="done" width="20" height="20"></td>
        	<?php }?>
        </tr>
	</tbody>
    <?php
                $i++;
            }
        }
    ?>
    </table>

 </div>
			</div>

		</div>

		<?php
			include "footer.php";
		?>

	</body>

</html>