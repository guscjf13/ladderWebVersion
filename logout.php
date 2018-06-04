<?php
if(!isset($_SESSION)){session_start();}	//세션이 있으면 넘어가고 없으면 세션을 시작함
session_destroy();
session_regenerate_id(true);
session_start();
?>
<!DOCTYPE HTML>
<meta charset="UTF-8" \>
<script> alert("성공적으로 로그아웃을 완료하였습니다.") </script>
<script> location.replace("login.html") </script>
