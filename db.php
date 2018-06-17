<?php if(!isset($_SESSION)){session_start();}?>

<style>
		#right_project_processbar {
			width: 1500px;
			height: 30px;
			border: 3px solid black;
			background-color: #FFFFFF;
			border-radius: 5px;
			margin:25px 25px 25px 0;
			line-height: 30px;
			font-size: 20px;
		}
		.right_project_processbar_1percentage {
			width: 14px;
			height: 30px;
			margin-left: 1px;
			background-color: #00D8FF;
			float: left;
		}
		#small_processbar {
			width: 141px;
			height: 18px;
			border: 2px solid black;
			border-radius: 5px;
			background-color: #FFFFFF;
			line-height: 18px;
			font-size: 15px;
		}
		.small_processbar_1percentage {
			position: relative;
			width: 13px;
			height: 18px;
			margin-left: 1px;
			background-color: #00D8FF;
			float: left;
		}
		#right_make_error {
			margin-right: 80px;
			border: 0;
			border-style: none;
			background-image: url('make_error.png');
			background-size: cover;
			width: 120px;
			height: 40px;
			margin-top:10px;
			float: right;
		}
		#right_make_error:hover {
			background-image: url('make_error_hover.png');
			cursor: pointer;
			float: right;
		}
		#error_card_total {
			width: 600px;
			height: 600px;
			margin:0 0px 25px 50px;
			float: left;
		}
		#error_detail_total {
			width: 600px;
			height: 600px;
			margin:0 0px 25px 50px;
			float: left;
		}
		#error_card {
			width: 249px;
			height: 300px;
			border-style: none;
			background-image: url('error_red.png');
			background-size: cover;
			margin-right: 50px;
			float: left;
			cursor: pointer;
		}
		#error_card_radio {display: none;}
		#error_card_radio ~.tab_error #error_card_total {display: none;}
		#error_card_radio:checked ~.tab_error #error_detail_total {display: block;}
		#error_detail_radio {display: none;}
		#error_detail_radio ~.tab_error #error_detail_total {display: none;}
		#error_detail_radio:checked~.tab_error #error_card_total {display: block;}
		</style>
<?php		
	require 'vendor/autoload.php';
	const DEFAULT_URL = 'https://ladder-4774f.firebaseio.com';
	const DEFAULT_PATH='/';
	const DEFAULT_TOKEN = 'AIzaSyCQdUGhgXCmsj6_LY84J91tAeuzL4cYLd0';
	$firebase = new \Firebase\FirebaseLib(DEFAULT_URL);

		function is_passwd_correct($id, $passwd, &$name)
		{
			global $firebase;
			$id_path="/user/".$id."/id";
			$pw_path="/user/".$id."/password";
			$name_path="/user/".$id."/name";
			$count_path="/user/".$id."/project/count";

            $get_id = $firebase->get($id_path);

            if($get_id == "null"){
            	?><script >alert("아이디를 확인하세요.")</script><?php
            	return false;
            }

            $get_passwd = $firebase->get($pw_path);

            if("\"".$passwd."\"" != $get_passwd){
            	?><script >alert("비밀번호를 확인하세요.")</script><?php
            	return false;
            }
            $name = $firebase->get($name_path);
            $name = explode("\"",$name)[1];
            $_SESSION['count'] = $firebase->get($count_path);
            ?><script >alert("환영합니다!")</script><?php
			return true;
			//id, password 파이어베이스랑 검사해서 일치하면 name에 사용자의 이름 넣어주면서 true 반환, id, password 틀리면 false 반환
		}

		function make_processbar($index)
		{
				global $firebase;
			    $wincrease_path="/project/".$index."/things/increase";
            	$wincrease = $firebase->get($wincrease_path);
                $z = 1;
                $percentage = 0;
            	$done = 0;
            	$issue = 0;

            	while($wincrease >= $z){
                	$cal_path="/project/".$index."/things/".$z."/state";
                	$cal = $firebase->get($cal_path);
                	if($cal == null){
                	}elseif($cal == 3){
                		$done++;
                	}elseif($cal == 2){
                		$issue++;
                	}
                	$z++;
            	}
            	$percentage = ($done*100/$wincrease) - ($issue*5);
            	$percentage %= 100;
            	if($percentage<=0){$percentage=0;}
			?>
			
			<h1 id=processbar_title> 사다리를 얼마나 올랐을까... </h1>
			<div id=right_project_processbar>
				<?php
					for($i=0;$i<$percentage;$i++) {
						?> <div class=right_project_processbar_1percentage> </div> <?php
					}
					if($percentage<= 96){
						echo "　$percentage%";
					}else{
						?><div style="position: absolute; right: 6%;left: 94%;"><?php echo "$percentage%";?></div><?php
					}
					
				?>
			</div>

			<?php
		}
		function make_smallbar($index)
		{
				global $firebase;
			    $wincrease_path="/project/".$index."/things/increase";
            	$wincrease = $firebase->get($wincrease_path);
                $z = 1;
                $percentage = 0;
            	$done = 0;
            	$issue = 0;

            	while($wincrease >= $z){
                	$cal_path="/project/".$index."/things/".$z."/state";
                	$cal = $firebase->get($cal_path);
                	if($cal == null){
                	}elseif($cal == 3){
                		$done++;
                	}elseif($cal == 2){
                		$issue++;
                	}
                	$z++;
            	}
            	$percentage = ($done*100/$wincrease) - ($issue*5);
            	$percentage %= 100;
            	if($percentage<=0){$percentage=0;}
            	$per = $percentage;
            	$percentage /= 10;
            	$percentage %= 10;

			?>
			
			<div id=small_processbar>
				<?php
					for($i=0;$i<$percentage;$i++) {
						?> <div class=small_processbar_1percentage> </div> <?php
					}
					if($per==0){
						echo "0%";
					}elseif($percentage< 8){
						echo $per."%";
					}else{
						echo $per."%";
					}
					
				?>
			</div>

			<?php
		}
		function make_memberbar($pindex,$pmindex)
		{
				global $firebase;
                $pmwork_path="/project/".$pindex."/member/".$pmindex."/work";

                $pmwork = $firebase->get($pmwork_path);
                $pmwork = explode("},\"", $pmwork);
                $x = 0;
                $percentage = 0;
            	$done = 0;
            	$issue = 0;
                while($pmwork[$x] != null){
                	if($x == 0){
                		$pmwork[$x] = explode("\"", $pmwork[$x])[1];
                		$x++;
                	}else{
                		$pmwork[$x] = explode("\"", $pmwork[$x])[0];
                		$x++;
                	}
                }

                $pmid = explode("\"", $pmid)[1];

                for($y=0;$y<$x;$y++){
                	$pmwstate_path="/project/".$pindex."/member/".$pmindex."/work/".$pmwork[$y]."/state";
                	$pmwstate[$y] = $firebase->get($pmwstate_path);
                	if($pmwstate[$y]==3){$done++;}
                	elseif($pmwstate[$y]==2){$issue++;}
                }
                if($x != 0){
            		$percentage = ($done*100/$x) - ($issue*5);
            		$percentage %= 100;
            		if($percentage<=0){$percentage=0;}
            		$per = $percentage;
            		$percentage /= 10;
            		$percentage %= 10;
                }


			?>
			
			<div id=small_processbar>
				<?php
					for($i=0;$i<$percentage;$i++) {
						?> <div class=small_processbar_1percentage> </div> <?php
					}
					if($per==0){
						echo "0%";
					}elseif($percentage< 8){
						echo $per."%";
					}else{
						echo $per."%";
					}
					
				?>
			</div>

			<?php
		}

		function make_error_card($project_index)
		{
			global $firebase;
			$index = $project_index;
			$count_path = "/project/".$index."/issue/count";
			$count = $firebase->get($count_path);
			?>

            <input id=error_card_radio type=radio name=error>
            <input id=error_detail_radio type=radio name=error checked="checked">

            <section class=tab_error>

				<div id=error_card_total style="float: left;"> 
            		<label for=error_card_radio style="float: left; margin-top:0"> 

		            	<div>
		            		<h1 style="width: 130px; float: left; margin: 10px 0 0 215px; font-size:30px;"> 오류카드 </h1>
							<a href=make_error.php id=right_make_error class=top_sub></a> 
		            	</div>
						<!-- 여기서 for문으로 오류 개수만큼 만들기-->
						<?php
						// 이거 만들 때 radio 하나씩 만들어주고 value로 issue index 넘겨주면 그에 해당하는 세부사항 볼 수 있을거같은데?!
						for($i=1;$i<=$count;$i++){
							$iname_path = "/project/".$index."/issue/".$i."/iname";
							$urgency_path = "/project/".$index."/issue/".$i."/urgency";
							$work_path = "/project/".$index."/issue/".$i."/work";
							$beginline_path = "/project/".$index."/issue/".$i."/beginline";
							$deadline_path = "/project/".$index."/issue/".$i."/deadline";
							$info_path = "/project/".$index."/issue/".$i."/info";
							$status_path = "/project/".$index."/issue/".$i."/status";

							$iname = $firebase->get($iname_path);
							$urgency = $firebase->get($urgency_path);
							$work = $firebase->get($work_path);
							$beginline = $firebase->get($beginline_path);
							$deadline = $firebase->get($deadline_path);
							$info = $firebase->get($info_path);
							$status = $firebase->get($status_path);

							$iname = explode("\"", $iname)[1];
							$work = explode("\"", $work)[1];
							$beginline = explode("\"", $beginline)[1];
							$deadline = explode("\"", $deadline)[1];
							$info = explode("\"", $info)[1];
							$status = explode("\"", $status)[1];
							?>

						<div id=error_card style="margin-top:15px;">
							<table style="border-style: none; width:249px;">
								<tr style="height:100px;">
									<th>
										<!-- <pre> 컴파일 오류 </pre>  -->
										<?php 
										if($urgency == "true")
											echo "[긴급]&nbsp";
										echo $iname;
										?>
										
									<hr>
									</th>
								</tr>

								<tr style="height:30px">
									<th>
										<?php
										echo $beginline."&nbsp~&nbsp".$deadline;
										?>
									<hr>
									</th>
									<!-- <th>
										<pre> 2018.06.03 </pre> 
									</th> -->
								</tr>

								<tr style="height:170px">
									<th>
										<!-- <pre> 어렵다... </pre> -->
										<?php
										echo $info;
										?>
										
									</th>
								</tr>
							</table>
						</div>

						<?php } ?>
					</label>
				</div>

            		<?php
            		$iname_path = "/project/".$index."/issue/".$i."/iname";
            		$urgency_path = "/project/".$index."/issue/".$i."/urgency";
            		$work_path = "/project/".$index."/issue/".$i."/work";
            		$beginline_path = "/project/".$index."/issue/".$i."/beginline";
            		$deadline_path = "/project/".$index."/issue/".$i."/deadline";
            		$info_path = "/project/".$index."/issue/".$i."/info";
            		$status_path = "/project/".$index."/issue/".$i."/status";

            		$iname = $firebase->get($iname_path);
            		$urgency = $firebase->get($urgency_path);
            		$work = $firebase->get($work_path);
            		$beginline = $firebase->get($beginline_path);
            		$deadline = $firebase->get($deadline_path);
            		$info = $firebase->get($info_path);
            		$status = $firebase->get($status_path);

            		$iname = explode("\"", $iname);
            		$work = explode("\"", $work);
            		$beginline = explode("\"", $beginline);
            		$deadline = explode("\"", $deadline);
            		$info = explode("\"", $info);
            		$status = explode("\"", $status);
            		?>
					<div id=error_detail_total style="float: left;">
            			<label for=error_detail_radio style="float: left;">

		            	<div>
		            		<h1 style="width: 130px; float: left; margin: 10px 0 0 215px; font-size:30px;"> 오류카드 </h1>
							<a href=make_error.php id=right_make_error class=top_sub></a> 
		            	</div>

							<table border="1" style="border: black; border-collapse: collapse; width:260px; margin-top:5px;">
								<tr style="height:50px">
									<th>
										<!-- <pre> 컴파일 오류 </pre>  -->
										<?php 
										if($urgency == "true")
											echo "[긴급]&nbsp";
										echo $iname;
										?>
									</th>
								</tr>

								<tr style="height:50px">
									<th>
										<?php
										echo $beginline."&nbsp~&nbsp".$deadline;
										?>
									</th>
									<!-- <th>
										<pre> 2018.06.03 </pre> 
									</th> -->
								</tr>

								<tr style="height:200px">
									<th>
										<!-- <pre> 어렵다... </pre> -->
										<?php
										echo $info;
										?>
									</th>
								</tr>
							</table>
            			</label>
					</div> 

            </section>

			<?php
		}
?>