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
         background-image: url('left_project_back.png')
      }
      #left_project_manage:hover {
         background-image: url('left_project_back_hover.png')         
      }

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

            $pname_path="/project/".$index."/pInfo/pname";   //path 설정할때 $index 사용함
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

            $pname = explode("\"", $pname)[1];   //"" 붙는거 없애는작업
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
                     <th><h2 style="line-height: 60px;">팀장</h2></th><td><?php echo $leader?></td>
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
            <a href=main_joined.php?index=<?php echo $index?>> <div id=left_project_manage></div> </a>
            <?php }?>
         </div>

      </div>

      <h2>프로젝트 관리</h2>
      <table border="1">
         <tr>
            <th>신청한 사람</th><td></td>
         </tr>
         <?php
            while($array[$i] != null){
               $sign_id = explode("\"",$array[$i])[1];
               $i++;
         ?>
         <tr>
            <td><?php echo $sign_id;?></td><td><a href="signup_admit.php?index=<?php echo $index;?>&sign_id=<?php echo $sign_id;?>"><input type="button" name="승인" value="승인"></a></td>
         </tr>
         <?php }?>
      </table>
      <div>
         <h4>팀원 초대</h4>
         <form action="project_invite.php" method="post">
            <input id=invite type=text placeholder="초대할 아이디" name=invite_id>
            <input style="display: none;"id=index name=index value=<?php echo $index;?>>
            <input type="submit" name="초대" value="초대">
         </form>
         
      </div>
      


   </body>

   <?php
      include "footer.php";
   ?>

</html>