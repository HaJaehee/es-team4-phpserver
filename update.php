<?
    // �����ͺ��̽� ���� ���ڿ�. (db��ġ, ���� �̸�, ��й�ȣ)
    $connect=mysql_connect( "127.0.0.1:3306", "root", "root") or  
        die( "SQL server�� ������ �� �����ϴ�.");
    
    mysql_query("SET NAMES UTF8");
   // �����ͺ��̽� ����
   mysql_select_db("respberry",$connect);
 
   // ���� ����
   session_start();
   $watt=$_GET['watt'];
   $power=$_GET['power'];
   $watt = $watt/12;
   // ������ ����
   $sql1 = "Insert into machine Values(10001,$watt)";
   $result1 = mysql_query($sql1, $connect);

   $sql2 = "update switch set power = $power where name = 10001";
   $result2 = mysql_query($sql2, $connect);
	
   echo "{\"ok\":1}";

   mysql_close($connect);
?>
