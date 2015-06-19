<?
    // 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
    $connect=mysql_connect( "127.0.0.1:3306", "root", "root") or  
        die( "SQL server에 연결할 수 없습니다.");
    
    mysql_query("SET NAMES UTF8");
   // 데이터베이스 선택
   mysql_select_db("respberry",$connect);
 
   // 세션 시작
   session_start();
 
   
   $sql1 = "select watt from machine where name = 10001";
   $result1 = mysql_query($sql1, $connect);
   $total_record = mysql_num_rows($result1);
 $watt = 0;
 $wh = 0;
   for ($i=0; $i < $total_record; $i++)                    
   {
      // 가져올 레코드로 위치(포인터) 이동  
      mysql_data_seek($result1, $i);              
      $row1 = mysql_fetch_array($result1);
      $watt = $watt + $row1[watt];
   }
  $sql2 = "select wh from hour where name = 10001";
  $result2 = mysql_query($sql2, $connect);
  $total_record = mysql_num_rows($result2);
for ($i=0; $i < $total_record; $i++)
 {
      // 가져올 레코드로 위치(포인터) 이동
      mysql_data_seek($result2, $i);
      $row2 = mysql_fetch_array($result2);
      $wh = $wh + $row2[wh];
 }
    $sql3 = "select power from switch where name = 10001";
    $result3 = mysql_query($sql3, $connect);
    mysql_data_seek($result3, 0);
    $row3 = mysql_fetch_array($result3);
    $power = $row3[power];

 echo "{\"watt\":$watt,\"watthour\":$wh,\"power\":$power}";

   mysql_close($connect);
?>
