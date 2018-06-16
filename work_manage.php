<?php
if(!isset($_SESSION)){session_start();}	//세션이 있으면 넘어가고 없으면 세션을 시작함
include "db.php";
$index = $_REQUEST['index'];
?>
<!DOCTYPE html>
<html>

<head>
	<style>
	a {
			text-decoration: none;
			color: black;
		}
		#message_logo {
			width: 80px;
			height: 80px;
			background-size: cover;
			margin: 5px auto;
		}
		#backBtn {
			margin: 20px 0 0 210px;
			width: 100px;
			height: 50px;
			border: 0;
			border-style: none;
			background-image: url('back.png');
			background-size: cover;
		}
		#backBtn:hover {
			background-image: url('back_hover.png');
			cursor: pointer;
		}
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
        #doneBtn {
            width: 150px;
            height: 50px;
            margin-top: 20px;
            margin-right: 30px;
            float: right;
            border-style: none;
            border: 0;
            background-size: cover;
            background-image: url('add_work.png');
        }
        #doneBtn:hover {
            background-image: url('add_work_hover.png');
            cursor: pointer;
        }
	</style>
</head>

<body>
	<h1 id=main_head style="margin: 20px 0 40px 0;">일감 관리</h1>
	<div id="board_area"> 
    <table class="list-table">
    	<thead>
        	<tr>
            	<th width="60">번호</th>
                <th width="200">제목</th>
                <th width="100">담당자</th>
                <th width="200">기간</th>
                <th width="80">상태</th>
            </tr>
        </thead>
    
        <?php
			$wincrease_path="/project/".$index."/things/increase";
            $wincrease = $firebase->get($wincrease_path);
            $i = 1;
            while($wincrease >= $i){
                $valid_path="/project/".$index."/things/".$i;
                $valid = $firebase->get($valid_path);
                if($valid == "null"){
                    $i++;
                }else{
                    $wname_path="/project/".$index."/things/".$i."/wname";
                    $content_path="/project/".$index."/things/".$i."/content";
                    $wbegin_path="/project/".$index."/things/".$i."/beginline";
                    $wdead_path="/project/".$index."/things/".$i."/deadline";
                    $state_path="/project/".$index."/things/".$i."/state";
                    $wid_path="/project/".$index."/things/".$i."/id";

                    $wname = $firebase->get($wname_path);
                    $content = $firebase->get($content_path);
                    $wbegin = $firebase->get($wbegin_path);
                    $wdead = $firebase->get($wdead_path);
                    $state = $firebase->get($state_path);
                    $wid = $firebase->get($wid_path);

                    $wname = explode("\"", $wname)[1];
                    $content = explode("\"", $content)[1];
                    $wbegin = explode("\"", $wbegin)[1];
                    $wdead = explode("\"", $wdead)[1];
                    $wid = explode("\"", $wid)[1];
    			?>
	<tbody>
		<tr>
            <td width="60"><?php echo $i; ?></td>
            <td width="200"><a href=# onclick="window.open('work_manage_detail.php?pindex=<?php echo $index;?>&windex=<?php echo $i;?>','window_name','width=550,height=600,location=no,status=no,scrollbars=no')" id="message_img" style=""><?php echo $wname;?></a></td>   <!--REQUEST 로 선택한 글 프로젝트 $index를 넘겨준다.-->
            <?php if($wid == null){?>
            <td width="100">배정안됨</td>
        	<?php }else{?>
            <td width="100"><?php echo $wid;?></td>
        	<?php }?>
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

    

    <a href="work_add.php?pindex=<?php echo $index?>">
        <input id=doneBtn type=button Onclick="location.replace('work_add.php?pindex=<?php echo $index?>');" value="">
    </a>

 </div>

</body>

</html>
