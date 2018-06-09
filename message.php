<?php
if(!isset($_SESSION)) {session_start();}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.css"/>
	<meta charset="UTF-8" \>
	<style>
	#message input:nth-of-type(1), #message input:nth-of-type(1) ~ div:nth-of-type(1), #message input:nth-of-type(2), #message input:nth-of-type(2) ~ div:nth-of-type(2){display:none;}
	#message input:nth-of-type(1):checked ~ div:nth-of-type(1), #message input:nth-of-type(2):checked ~ div:nth-of-type(2){display: block;}
		@import url(http://fonts.googleapis.com/earlyaccess/jejugothic.css);
		#message > label {
    		display:inline-block;
    		font-variant:small-caps;
    		font-size:.9em;
    		padding:5px;
    		text-align:center;
    		width:20%;
    		line-height:1.8em;
    		font-weight:700;
    		border-radius:3px 3px 0 0;
    		background:#eee;
    		color:#777;
    		border:1px solid #ccc;
    		border-width:1px 1px 0
		}
		#message > label:hover {
    		cursor:pointer
		}
		#message input:nth-of-type(1):checked ~ label:nth-of-type(1), #message > label[for=tab1]:hover {
    		background:skyblue;
    		color:#fff
			}
		#message input:nth-of-type(2):checked ~ label:nth-of-type(2), #message > label[for=tab2]:hover {
    		background:skyblue;
    		color:#fff
		}
		a {
			text-decoration: none;
			color: black;
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
</head>
<body>
		<?php
			include "db.php";
			$index=$_REQUEST['index'];
			$id=$_SESSION['id'];
		?>
		<div id="message">
		<input id="tab1" type=radio name=tab checked=checked>
		<input id="tab2" type=radio name=tab>
		<label for="tab1">받은 쪽지</label>
		<label for="tab2">보낸 쪽지</label>
		<div class=tab-item1>
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

					    $m_i=1;

					    do{
					    	$userid_path="/project/".$index."/member/".$m_index."/rcvmsg/".$m_i."/userid";
					    	$title_path="/project/".$index."/member/".$m_index."/rcvmsg/".$m_i."/title";
					    	// $content_path="/project/".$index."/member/".$m_index."/id/rcvmsg/".$m_i."/content";
					    	$timesend_path="/project/".$index."/member/".$m_index."/rcvmsg/".$m_i."/time_send";

					    	$userid=$firebase->get($userid_path);
					    	$title=$firebase->get($title_path);
					    	$time_send=$firebase->get($timesend_path);
					    	$u=explode("\"",$userid)[1];
					    	$t=explode("\"",$title)[1];
					    	$ts=explode("\"",$time_send)[1];
					    	?>
					    	<tbody>
               					<tr>
                  					<td width="100"><?php echo $u?></td>
                  					<td width="100"><a href="message_content.php?index=<?php echo $index;?>&m_index=<?php echo $m_index?>&m_i=<?php echo $m_i?>"><?php echo $t?></a></td>
                  					<td width="400"><?php echo $ts?></td>
               					</tr>
            				</tbody>
            				<?php
            				$m_i++;
            				$mm_path="/project/".$index."/member/".$m_index."/rcvmsg/".$m_i;
            				$mm=$firebase->get($mm_path);
					    }while($mm!="null");
				?>
			
			</table>
			</div>
			<div class=tab-item2>
				<table class="list-table">
				<thead>
					<tr>
						<th width="100">받는 사람</th>
						<th width="100">제목</th>
						<th width="400">보낸 시각</th>
					</tr>
				</thead>
				<?php
					$s_i=1;
					do{
						$sid_path="/project/".$index."/member/".$s_i."/id";
						$rr_id=$firebase->get($sid_path);
						if("\"".$id."\""==$rr_id){
							$mm_index=$s_i;
							break;
						}	
						$s_i++;
						$mm_path="/project/".$index."/member/".$s_i;
						$mm=$firebase->get($mm_path);
					    }while($mm!="null");

					    $mm_i=1;

					    do{
					    	$suserid_path="/project/".$index."/member/".$mm_index."/sendmsg/".$mm_i."/userid";
					    	$stitle_path="/project/".$index."/member/".$mm_index."/sendmsg/".$mm_i."/title";
					    	// $content_path="/project/".$index."/member/".$m_index."/id/rcvmsg/".$m_i."/content";
					    	$stimesend_path="/project/".$index."/member/".$mm_index."/sendmsg/".$mm_i."/time_send";

					    	$suserid=$firebase->get($suserid_path);
					    	$stitle=$firebase->get($stitle_path);
					    	$stime_send=$firebase->get($stimesend_path);
					    	$su=explode("\"",$suserid)[1];
					    	$st=explode("\"",$stitle)[1];
					    	$sts=explode("\"",$stime_send)[1];
					    	?>
					    	<tbody>
               					<tr>
                  					<td width="100"><?php echo $su?></td>
                  					<td width="100"><a href="message_content2.php?index=<?php echo $index;?>&mm_index=<?php echo $mm_index?>&mm_i=<?php echo $mm_i?>"><?php echo $st?></a></td>
                  					<td width="400"><?php echo $sts?></td>
               					</tr>
            				</tbody>
            				<?php
            				$mm_i++;
            				$mmm_path="/project/".$index."/member/".$mm_index."/sendmsg/".$mm_i;
            				$mmm=$firebase->get($mmm_path);
					    }while($mmm!="null");
				?>
			
			</table>
			</div>
			</div>
			<a href="send_message.php?index=<?php echo $index;?>&m_index=<?php echo $m_index;?>"><input type="button" class="button is-rounded" name="write_btn" value="쪽지 보내기"/></a>
</body>
</html>