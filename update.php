<?
    // 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
    $connect=mysql_connect( "127.0.0.1:3306", "root", "root") or  
        die( "SQL server에 연결할 수 없습니다.");
    
    mysql_query("SET NAMES UTF8");
   // 데이터베이스 선택
   mysql_select_db("respberry",$connect);
 
   // 세션 시작
   session_start();
   $watt=$_GET['watt'];
   $power=$_GET['power'];
   $watt = $watt/12;
   // 쿼리문 생성
   $sql1 = "Insert into machine Values(10001,$watt)";
   $result1 = mysql_query($sql1, $connect);

   $sql2 = "update switch set power = $power where name = 10001";
   $result2 = mysql_query($sql2, $connect);
	
   echo "{\"ok\":1}";

   mysql_close($connect);
?>
