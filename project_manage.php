<?php
if(!isset($_SESSION)){session_start();}   //세션이 있으면 넘어가고 없으면 세션을 시작함
?>
<!DOCTYPE HTML>
<html>
   
   <head>
      <meta charset="UTF-8" \>
      <style>
      @import url(http://fonts.googleapis.com/earlyaccess/jejugothic.css);
      a {
         text-decoration: none;
         color: black;
      }
      /*왼쪽 메뉴 스타일들*/
      #left_menu {
         width: 300px;
         height: 770px;
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
         width: 80px;
         height: 40px;
         float: left;
         border: 3px solid black;
         margin-left: 30px;
         background-size: cover;
         background-image: url('project_back.png')
      }
      #left_project_manage:hover {
         background-image: url('project_back_hover.png')       
      }

      /*오른쪽 메뉴 스타일들*/
      #right_menu {
         width: 1500px;
         height: 755px;
         float: left;
      }
      #right_menu1 {
         margin-top: 40px;
         width: 1500px;
         height: 100px;
      }
      .applicant:hover {
         background-color: black;
         color: white;
      }
      #right_menu2 {
         width: 1500px;
         height: 520px;
         border-radius: 30px 30px 30px 30px;
         background-color: #EAEAEA;         
      }
      /*#board_area {margin:50px; height: 535px;}*/
            .list-table {
                margin-bottom: 20px;
            }
            .list-table thead th{ height:40px; border-top:2px solid #09C; border-bottom:1px solid #CCC; font:bold 17px 'malgun gothic';  }
            .list-table tbody td{ text-align:center; padding:10px 0; border-bottom:1px solid #CCC; height:20px; font: 14px 'malgun gothic';}
            #main_head {
                text-align: center;
            }
            table {
                margin: auto;
            }
            #make_project{
                width: 150px;
                height: 40px;
                border: 3px solid black;
                background-image: url('make_project.png');
                background-size: cover;
                margin-right: 330px;
                float: right;
            }
            #make_project:hover {
                background-image: url('make_project_hover.png');
            }
/*      #right_menu3 {
         width: 1500px;
         height: 260px;
         border-radius: 0 0 30px 30px;
         background-color: #B7F0B1;         
      }*/

      </style>
   </head>

   <body>
      <?php
         include "db.php";
         include "top_menu.php";
         
      
         $index = $_REQUEST['index'];
         $path = "/check/signup/".$index."/id/";
         $array = $firebase->get($path);
         $array = explode(",", $array);
         $i=0;

         $id = $_SESSION['id'];

            $pname_path="/project/".$index."/pInfo/pname";  //path 설정할때 $index 사용함
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

            $pname = explode("\"", $pname)[1];  //"" 붙는거 없애는작업
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
               <form action=project_property_change.php method=post>
                  <table border=0 style="width: 200px; height: 340px; border-collapse: collapse;">
                     <tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
                        <th style="width: 100px;"><h2 style="line-height: 60px;">팀장</h2></th>
                        <td style="width: 140px;"><h3 style="width: 100px; height: 40px; line-height: 40px; text-align: center; font-size: 18px;"><?php echo $leader?></h3></td>
                     </tr>
                     <tr style="height: 60px; border-bottom: 2px dotted #BDBDBD;">
                        <th><h2>목표</h2></th>
                        <td style="width: 140px;"><input style="width: 100px; height: 40px; text-align: center; font-size: 13px;" type=text name=goal value=<?php echo $goal?>></td>
                     </tr>
                     <tr style="height: 80px; border-bottom: 2px dotted #BDBDBD;">
                        <td colspan=2> 
                           <input type="date" name=beginline value="<?php echo $begin?>">
                           &nbsp~<br>&nbsp
                           <input type="date" name=deadline value="<?php echo $dead?>">
                        </td>
                     </tr>
                     <tr style="height: 100px;">
                        <td colspan=2>
                           <input type=textarea value="<?php echo $info?>" name=info  cols="50" rows="100">
                        </td>
                     </tr>
                  </table>
                      <input type="hidden" name="index" value="<?php echo $index?>">

                  <input style="float: left; width: 80px; height: 40px;" type=submit value="바꾸기">
                  <a style="float: left;" href=main_joined.php?index=<?php echo $index?>> <div id=left_project_manage></div> </a>
               </form>
            </div>
         </div>

      </div>


      <div id=right_menu>
         <h1 style="text-align: center; width: 1500px; margin-top: 40px;">프로젝트 관리</h1>

         <div id=right_menu1>

            <table border=0 style="float: left; height: 50px; border-collapse: collapse; margin: 30px 0 0 150px;">
               <tr>
                  <td style="width: 200px; text-align: center;"><h2 style="margin: 0;">신청한 사람</h2></td>
                  <?php
                     while($array[$i] != null){
                        $sign_id = explode("\"",$array[$i])[1];
                        $i++;
                        $vvv_path = "/check/signup/".$index."/id/".$sign_id;
                        $vvv = $firebase->get($vvv_path);
                        if($vvv == 1){
                        
                  ?>
                  <td class=applicant style = "width: 100px; height: 50px; text-align:center; font-size: 25px; cursor:pointer; border-radius: 20px;" onClick = " location.href='signup_admit.php?index=<?php echo $index;?>&sign_id=<?php echo $sign_id;?>' " onMouseOver = " window.status = 'signup_admit.php?index=<?php echo $index;?>&sign_id=<?php echo $sign_id;?>' " onMouseOut = " window.status = '' ">
                           <?php echo $sign_id;?>
                        </td>
                  <?php
                        }
                     }
                  ?>
               </tr>
            </table>

            <form style="float: right; height: 100px;" action="project_invite.php" method="post">
               <input style="width: 120px; text-align: center; height: 30px; margin: 35px 10px 35px 30px;" type=text name=invite_id>
               <input style="display: none;"id=index name=index value=<?php echo $index;?>>
               <input style="width: 80px; height: 40px; margin: 30px 150px 0 0;"  type=submit value="초대">
            </form>

            <h2 style="float: right; height: 100px; line-height: 100px; margin: 0px;"> 팀원 초대 </h2>

         </div>

         <div id=right_menu2>
            <h3 id=main_head>팀원 관리</h3>

        <div id="board_area"> 

            <table class="list-table">
                <thead>
                    <tr>
                        <th width="60">번호</th>
                        <th width="100">아이디</th>
                        <th width="400">담당 일감</th>
                        <th width="140">진행상황</th>
                        <th width="80">상태</th>
                        <th width="60">방출</th>
                    </tr>
                </thead>
                
                <?php
                    $pmincrease_path="/project/".$index."/member/increase";
                    $pmincrease = $firebase->get($pmincrease_path);
                    $i = 1;
                    while($pmincrease >= $i){
                        $valid_path="/project/".$index."/member/".$i."/isLeader";
                        $valid = $firebase->get($valid_path);
                        if($valid == 'true'){
                            $i++;
                        }elseif($pmincrease == $i && $valid == 'null'){
                           break;
                        }elseif($pmincrease > $i && $valid == 'null'){
                           $i++;
                        }else{
                            $pmindex = $i;
                            $pmid_path="/project/".$index."/member/".$i."/id";
                            $pmwork_path="/project/".$index."/member/".$i."/work";

                            $pmid = $firebase->get($pmid_path);
                            $pmwork = $firebase->get($pmwork_path);
                            $pmwork = explode("},\"", $pmwork);
                            $x = 0;
                            while($pmwork[$x] != 'null'){
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
                              $pmwstate_path="/project/".$index."/member/".$i."/work/".$pmwork[$y]."/state";
                              $pmwstate[$y] = $firebase->get($pmwstate_path);
                              if($pmwstate[$y]==1){$pmwork[$y]="<font color='red'> $pmwork[$y]</font>";}
                              elseif($pmwstate[$y]==2){$pmwork[$y]="<font color='orange'> $pmwork[$y]</font>";}
                              elseif($pmwstate[$y]==3){$pmwork[$y]="<font color='green'> $pmwork[$y]</font>";}
                            }

                            $signup_path = "/check/signup/".$i."/id/".$pmid;
                            $signup = $firebase->get($signup_path);

                        ?>
                <tbody>
                    <tr>
                        <td width="60"><?php echo $pmindex; ?></td>
                        <td width="100"><?php echo $pmid; ?></td>
                        <td width="400">
                           <?php
                           if($x == 0){ echo "담당 하는 일이 없습니다!";}
                           else{
                              for($f=0;$f<$x;$f++){
                                 echo $pmwork[$f]."&nbsp";
                              }
                           }
                           ?>    
                        </td>
                        <td width="140"><?php make_memberbar($index,$pmindex);?></td>
                        <?php if($signup == 1){?>
                        <td width="80">신청중</td>
                        <?php }elseif($signup == 2){?>
                        <td width="80">초대중</td>
                        <?php }else{?>
                        <td width="80">팀원</td>
                        <td width="60"><a href="fire_member.php?pindex=<?php echo $index;?>&pmindex=<?php echo $pmindex;?>&pmid=<?php echo $pmid;?>"><button>방출</button></a></td>
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
            <!-- 여기다가는 팀원들 관리 -->
            
         </div>
<!--          <div id=right_menu3>
            여기다가는 일감 관리
         </div> -->
      </div>


<!-- 
      <div>
         <h4>팀원 초대</h4>
         <form action="project_invite.php" method="post">
            <input id=invite type=text placeholder="초대할 아이디" name=invite_id>
            <input style="display: none;"id=index name=index value=<?php echo $index;?>>
            <input type="submit" name="초대" value="초대">
         </form>
         
      </div>
      
 -->

   </body>

   <?php
      include "footer.php";
   ?>

</html>