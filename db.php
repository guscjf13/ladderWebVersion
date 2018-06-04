<style>
		#error_card_total {
			width: 1550px;
			height: 300px;
			margin:25px 25px 25px 0;
		}
		#error_detail_total {
			width: 1550px;
			height: 300px;
			margin:25px 25px 25px 0;
		}
		#error_card {
			width: 260px;
			height: 300px;
			background-color: #F15F5F;
			border-style: none;
			border-radius: 50px;
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
	const DEFAULT_URL = 'https://tactical-codex-203912.firebaseio.com';
	const DEFAULT_PATH='/';
	const DEFAULT_TOKEN = 'AIzaSyAvW-VI8ng3W6bHGIhoQYMdbsJIpLCBoNg';
	$firebase = new \Firebase\FirebaseLib(DEFAULT_URL);

		function is_passwd_correct($id, $passwd, &$name)
		{
			global $firebase;
			$id_path="/users/".$id."/id";
			$pw_path="/users/".$id."/password";
			$name_path="/users/".$id."/name";
			$count_path="/users/".$id."/project/count";

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

				<div id=error_card_total> 
            		<label for=error_card_radio> 
						<!-- 여기서 for문으로 오류 개수만큼 만들기-->
						<?php
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

							$iname = explode("\"", $iname);
							$work = explode("\"", $work);
							$beginline = explode("\"", $beginline);
							$deadline = explode("\"", $deadline);
							$info = explode("\"", $info);
							$status = explode("\"", $status);
							?>

						<div id=error_card>
							<table style="border: black; border-collapse: collapse; width:260px;">
								<tr style="height:50px">
									<th>
										<!-- <pre> 컴파일 오류 </pre>  -->
										<?php 
										if($urgency == "true")
											echo "[긴급]&nbsp";
										echo $iname[1];
										?>
										
									<hr>
									</th>
								</tr>

								<tr style="height:50px">
									<th>
										<?php
										echo $beginline[1]."&nbsp~&nbsp".$deadline[1];
										?>
									<hr>
									</th>
									<!-- <th>
										<pre> 2018.06.03 </pre> 
									</th> -->
								</tr>

								<tr style="height:200px">
									<th>
										<!-- <pre> 어렵다... </pre> -->
										<?php
										echo $info[1];
										?>
										
									</th>
								</tr>
							</table>
						</div>

						<?php } ?>
					</label>
				</div>

            	<label for=error_detail_radio>
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
					<div id=error_detail_total>
						<table border="1" style="border: black; border-collapse: collapse; width:260px;">
								<tr style="height:50px">
									<th>
										<!-- <pre> 컴파일 오류 </pre>  -->
										<?php 
										if($urgency == "true")
											echo "[긴급]&nbsp";
										echo $iname[1];
										?>
									</th>
								</tr>

								<tr style="height:50px">
									<th>
										<?php
										echo $beginline[1]."&nbsp~&nbsp".$deadline[1];
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
										echo $info[1];
										?>
									</th>
								</tr>
							</table>
					</div> 
            	</label>

            </section>

			<?php
		}
?>