<?
    // 데이터베이스 접속 문자열. (db위치, 유저 이름, 비밀번호)
    $connect=mysql_connect( "127.0.0.1:3306", "root", "root") or  
        die( "SQL server에 연결할 수 없습니다.");
    
    mysql_query("SET NAMES UTF8");
   // 데이터베이스 선택
   mysql_select_db("respberry",$connect);
   date_default_timezone_set('Asia/Seoul');
   // 세션 시작
   session_start();
    
   // 쿼리문 생성
   $sql = "select * from machine where name = 10001";
 
   // 쿼리 실행 결과를 $result에 저장
   $result = mysql_query($sql, $connect);
   // 반환된 전체 레코드 수 저장.
   $total_record = mysql_num_rows($result);
 
   // 반환된 각 레코드별로 JSONArray 형식으로 만들기.
   $wh = 0;
   for ($i=0; $i < $total_record; $i++)                    
   {
      // 가져올 레코드로 위치(포인터) 이동  
      mysql_data_seek($result, $i);       
        
      $row = mysql_fetch_array($result);
	$wh = $wh + $row[watt];
   }
   
    if($wh != 0){
    $stamp = mktime();
	$now = date("Y-m-d H:i:s",$stamp);
	$sql2 = "Insert into hour values(10001,\"$now\",$wh)";
	$result2 = mysql_query($sql2, $connect) or die (mysql_error());
	$sql3 = "delete from machine where name = 10001";
	$result3 = mysql_query($sql3, $connect);
	echo "{\"ok\":1}";
    }else{
    echo "{\"ok\":0}";
    }

   mysql_close($connect);
?>
