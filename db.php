<?php if(!isset($_SESSION)){session_start();}?>

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

						<div id=error_card>
							<table style="border: black; border-collapse: collapse; width:260px;">
								<tr style="height:50px">
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

								<tr style="height:50px">
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

								<tr style="height:200px">
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
					</div> 
            	</label>

            </section>

			<?php
		}
?>