<?php
    if(!isset($_SESSION)){session_start();} //세션이 있으면 넘어가고 없으면 세션을 시작함
	include "db.php";
?>
<!doctype html>
<html lang="ko">
 <head>
  <meta charset="UTF-8">
  <title>프로젝트 목록</title>
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
  #board_area {margin:50px auto; height: 510px;}
  .list-table thead th{ height:40px; border-top:2px solid #09C; border-bottom:1px solid #CCC; font:bold 17px 'malgun gothic';  }
  .list-table tbody td{ text-align:center; padding:10px 0; border-bottom:1px solid #CCC; height:20px; font: 14px 'malgun gothic';}
  #main_head {
    margin: 50px auto 0px auto;
    text-align: center;
  }
  table {
    margin: 0px auto;
  }

</style>

 </head>
 <body>
<?php
include "top_menu.php";
?>


<h1 id=main_head>내가 오르는 사다리</h1>
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
            $count_path="/user/".$_SESSION['id']."/project/count";
            $count = $firebase->get($count_path);
            $i = 1;
            while($count >= $i){
                $valid_path="/user/".$_SESSION['id']."/project/".$i;
                $valid = $firebase->get($valid_path);
                if($valid == 'null'){
                    $i++;
                }
                else{
                    $index_path="/user/".$_SESSION['id']."/project/".$i."/index";
                    $index = $firebase->get($index_path);

                    $pname_path="/project/".$index."/pInfo/pname";
                    $goal_path="/project/".$index."/pInfo/goal";
                    $nump_path="/project/".$index."/pInfo/numpeople";
                    $maxp_path="/project/".$index."/pInfo/maxpeople";
                    $leader_path="/project/".$index."/pInfo/leader";
                    $begin_path="/project/".$index."/pInfo/beginline";
                    $dead_path="/project/".$index."/pInfo/deadline";
                    $status_path="/project/".$index."/pInfo/status";
                    
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
    			?>
	<tbody>
		<tr>
            <td width="60"><?php echo $index; ?></td>
            <td width="400"><a href="main_joined.php?index=<?php echo $index;?>"><?php echo $pname; ?></a></td>   <!--REQUEST 로 선택한 글 프로젝트 $index를 넘겨준다.-->
            <td width="200"><?php echo $goal; ?></td>
            <td width="80"><?php echo $nump; ?>/<?php echo $maxp; ?></td>
            <td width="100"><?php echo $leader; ?></td>
            <td width="200"><?php echo $begin; ?>&nbsp~&nbsp<?php echo $dead; ?></td>
            <td width="100"><?php echo $status; ?></td>
        </tr>
	</tbody>
    <?php
                $i++;
            }
        }
    ?>
    </table>

 </div>
 <?php
        include "footer.php";
    ?>


 </body>
</html>
