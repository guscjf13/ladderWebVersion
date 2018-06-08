<?php
if(!isset($_SESSION)) {session_start();}
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="UTF-8" \>
		<style>
		@import url(http://fonts.googleapis.com/earlyaccess/jejugothic.css);
		a {
			text-decoration: none;
			color: black;
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
			width: 1300px;
			height: 80px;
		}
		#logo_center {
		  display: table-cell;
		  vertical-align: middle;
		  text-align: center;
		}
		table {
			margin: 0 auto;
		}
		th {
			width: 500px;
			height: 50px;
		}
		input {
			width: 490px;
			height: 40px;
		}
		#submit {
			display: block;
			margin: 0 auto;
		}
		pre {
			float: left;
		}
		select {
			width: 400px;
			height: 40px;
			float: left;
		}
		.list-table thead th{ height:40px; border-top:2px solid #09C; border-bottom:1px solid #CCC; font:bold 17px 'malgun gothic';  }
  		.list-table tbody td{ text-align:center; padding:10px 0; border-bottom:1px solid #CCC; height:20px; font: 14px 'malgun gothic';}
		</style>
	</head>
		

		</style>
</head>
<body>
		<?php
			include "db.php";
			include "top_menu.php";
			$index=$_REQUEST['index'];
			$id=$_SESSION['id'];
		?>

		</div>
		<img src=logo.png id="logo_center" style="width: 300px; height: auto; margin: 30px auto auto auto; padding: auto">
			<table class="list-table">
				<thead>
					<tr>
						<th width="100">보낸 사람</th>
						<th width="100">제목</th>
						<th width="400">보낸 시각</th>
					</tr>
				</thead>
				<?php
					$i=1;
					do{
						$id_path="/project/".$index."/member/".$i."/id";
						$r_id=$firebase->get($id_path);
						if("\"".$id."\""==$r_id){
							$m_index=$i;
							break;
						}	
						$i++;
						$m_path="/project/".$index."/member/".$i;
						$m=$firebase->get($m_path);
					    }while($m!="null");
					    $m_i=0;
					    do{
					    	$userid_path="/project/".$index."/member/".$m_index."/id/rcvmsg/".$m_i."/userid";
					    	$title_path="/project/".$index."/member/".$m_index."/id/rcvmsg/".$m_i."/path";
					    	// $content_path="/project/".$index."/member/".$m_index."/id/rcvmsg/".$m_i."/content";
					    	$timesend_path="/project/".$index."/member/".$m_index."/id/rcvmsg/".$m_i."/time_send";

					    	$userid=$firebase->get($userid_path);
					    	$title=$firebase->get($title_path);
					    	$time_send=$firebase->get($timesend_path);
					    	?>
					    	<tbody>
               					<tr>
                  					<td width="100"><?php echo $userid?></td>
                  					<td width="100"><a href="message_content.php?index=<?php echo $index;?>&m_index=<?php echo $m_index?>&m_i=<?php echo $m_i?>"><?php echo $title?></a></td>
                  					<td width="400"><?php echo $time_send?></td>
               					</tr>
            				</tbody>
            				<?php
            				$m_i++;
            				$mm_path="/project/".$index."/member/".$m_index."/id/rcvmsg/".$m_i;
            				$mm=$firebase->get($mm_path);
					    }while($mm!="null");
				?>
			
			</table>
			<a href="send_message.php?index=<?php echo $index;?>"><input type="button" name="write_btn" value="쪽지 보내기"/></a>
</body>
</html>