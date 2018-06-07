<?php
    if(!isset($_SESSION)){session_start();} //세션이 있으면 넘어가고 없으면 세션을 시작함
	include "db.php";
?>
<!doctype html>
<html lang="ko">
 <head>
  <meta charset="UTF-8">
  <title>프로젝트 게시판</title>
  <style>
  @import url(http://fonts.googleapis.com/earlyaccess/jejugothic.css);
        a {
            text-decoration: none;
            color: #333;
        }
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
  #board_area {margin:50px; height: 535px;}
  .list-table thead th{ height:40px; border-top:2px solid #09C; border-bottom:1px solid #CCC; font:bold 17px 'malgun gothic';  }
  .list-table tbody td{ text-align:center; padding:10px 0; border-bottom:1px solid #CCC; height:20px; font: 14px 'malgun gothic';}
#main_head {
    text-align: center;
}
table {
    margin: 50px auto;
}
#make_project{
    position: relative;
}
#make_project a{
    position: absolute;
    right: 50%;
}
</style>

 </head>
 <body>
<?php
include "top_menu.php";
?>


    <h1 id=main_head>프로젝트 게시판</h1>
 <div id="board_area"> 
<table class="list-table">
	<thead>
    	<tr>
        	<th width="60">번호</th>
            <th width="400">프로젝트 이름</th>
            <th width="200">목표</th>
            <th width="80">인원</th>
            <th width="100">팀장</th>
            <th width="200">기간</th>
            <th width="80">상태</th>
        </tr>
    </thead>
    
    <?php
        $count_path="/project/increase";
        $count = $firebase->get($count_path);
        $i = 1;
        while($count >= $i){
            $valid_path="/project/".$i;
            $valid = $firebase->get($valid_path);
            if($valid == 'null'){
                $i++;
            }
            else{
                $index_path="/project/".$i."/pInfo/index";
                $pname_path="/project/".$i."/pInfo/pname";
                $goal_path="/project/".$i."/pInfo/goal";
                $nump_path="/project/".$i."/pInfo/numpeople";
                $maxp_path="/project/".$i."/pInfo/maxpeople";
                $leader_path="/project/".$i."/pInfo/leader";
                $begin_path="/project/".$i."/pInfo/beginline";
                $dead_path="/project/".$i."/pInfo/deadline";
                $status_path="/project/".$i."/pInfo/status";

                $index = $firebase->get($index_path);
                $pname = $firebase->get($pname_path);
                $goal = $firebase->get($goal_path);
                $nump = $firebase->get($nump_path);
                $maxp = $firebase->get($maxp_path);
                $leader = $firebase->get($leader_path);
                $begin = $firebase->get($begin_path);
                $dead = $firebase->get($dead_path);
                $status = $firebase->get($status_path);

                $pname = explode("\"", $pname)[1];
                $goal = explode("\"", $goal)[1];
                $leader = explode("\"", $leader)[1];
                $begin = explode("\"", $begin)[1];
                $dead = explode("\"", $dead)[1];
                $status = explode("\"", $status)[1];

                $id = $_SESSION['id'];
                $signup_path = "/check/signup/".$i."/id/".$id;
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
	<tbody>
		<tr>
            <td width="60"><?php echo $index; ?></td>
            <td width="400"><a href="project_board_show.php?index=<?php echo $index?>"><?php echo $pname; ?></a></td> <!-- 여기서 <a>태그로 request 방식으로 project_board_show.php 로 $index 넘겨줌-->
            <td width="200"><?php echo $goal; ?></td>
            <td width="80"><?php echo $nump; ?>/<?php echo $maxp; ?></td>
            <td width="100"><?php echo $leader; ?></td>
            <td width="200"><?php echo $begin; ?>&nbsp~&nbsp<?php echo $dead; ?></td>
            <?php if($signup == 1){?>
            <td width="100" style="text-decoration-color: green;">신청중</td>
            <?php }elseif($id == $leader){?>
            <td width="100" style="text-decoration-color: green;">내가 팀장</td>
            <?php }elseif($flag == 1){?>
            <td width="100" style="text-decoration-color: green;">참가중</td>
            <?php }else{?>
            <td width="100"><?php echo $status; ?></td>
            <?php }?>
        </tr>
	</tbody>
<?php
            $i++;
        }
    }
?>
</table>
<div id="make_project">
    <a href=make_project.php><input type="button" name="write_btn" value="프로젝트 생성"/></a>
</div>


 </body>
 </div>
 <?php
        include "footer.php";
    ?>
</html>
