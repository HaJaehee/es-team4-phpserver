<?
    // �����ͺ��̽� ���� ���ڿ�. (db��ġ, ���� �̸�, ��й�ȣ)
    $connect=mysql_connect( "127.0.0.1:3306", "root", "root") or  
        die( "SQL server�� ������ �� �����ϴ�.");
    
    mysql_query("SET NAMES UTF8");
   // �����ͺ��̽� ����
   mysql_select_db("respberry",$connect);
   date_default_timezone_set('Asia/Seoul');
   // ���� ����
   session_start();
    
   // ������ ����
   $sql = "select * from machine where name = 10001";
 
   // ���� ���� ����� $result�� ����
   $result = mysql_query($sql, $connect);
   // ��ȯ�� ��ü ���ڵ� �� ����.
   $total_record = mysql_num_rows($result);
 
   // ��ȯ�� �� ���ڵ庰�� JSONArray �������� �����.
   $wh = 0;
   for ($i=0; $i < $total_record; $i++)                    
   {
      // ������ ���ڵ�� ��ġ(������) �̵�  
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
