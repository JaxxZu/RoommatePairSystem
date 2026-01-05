<?
session_start();
if(!isset($_SESSION["name"])){
    header("Location: /login.php");
exit();
}else {
	  echo "»»»»»»測試環境 登入者:",$_SESSION["name"],"«««««««<br>";
    
}


if(!isset($_GET["tid"])){
 echo "ERROR : aim team no. missing";
 exit();
}



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';
 $std=$_SESSION["name"];
 $aim_team_no=$_GET["tid"];
	include("connect.php");
	echo "<br>";
//判斷自己隊伍+對方隊伍人數是否大於房間大小 start
	
	//處理已登入的帳號
		$get_ac_teamid= "select t_id from student where s_id='".$_SESSION["name"]."'";
	 $row =mysqli_fetch_array(mysqli_query($link,$get_ac_teamid));
//登入的帳號的隊伍編號
$login_ac_teamid =$row['t_id'];	
echo "<br>自己隊伍t_id：",$login_ac_teamid;

			$get_ac_teamid= "select t_id from student where t_id='".$login_ac_teamid."'";

	$login_ac_team_people=mysqli_num_rows(mysqli_query($link,$get_ac_teamid));
//登入的帳號的隊伍的成員人數


		echo "<br>自己隊伍人數：",$login_ac_team_people;

	
	//-------------------------------------------------------------------
	//處理想加入的隊伍
	
				$get_aim_teamid= "select t_id from student where t_id='".$aim_team_no."'";

	
		$aim_team_people=mysqli_num_rows(mysqli_query($link,$get_aim_teamid));
		echo "<br>目標隊伍t_id：",$aim_team_no;

	echo "<br>目標隊伍人數：",$aim_team_people;
	
	if($aim_team_people==0){
	    echo "出錯：目標隊伍人數=0";
	    exit;
	}
	
	
	

	
	if($_GET["tid"]==$login_ac_teamid){
	    echo "<br>出錯：目標隊伍id=自己隊伍id<br>";
	    exit();
	}else{
	    	    echo "<br>  目標tid不等於自己tid<br>";

	}
	
	
	
	
	
	
	
	
	
	//處理房間大小
	
	
	
			$get_ac_room_type= "select roomtype from student where s_id='".$_SESSION["name"]."'";
	 $row =mysqli_fetch_array(mysqli_query($link,$get_ac_room_type));
	$login_ac_room_type =$row['roomtype'];
	//登入帳號的房間類別
	
	echo "<br>自己的房間類型：",$login_ac_room_type;
	
				$get_ac_room_type= "select r_people_num from room  where r_type='".$login_ac_room_type."'";
	 $row =mysqli_fetch_array(mysqli_query($link,$get_ac_room_type));
		$login_ac_room_able_live_people =$row['r_people_num'];
            //登入帳號房間類型容納人數
		echo "<br>自己的房間類型容納人數：",$login_ac_room_able_live_people;



		$get_aim_room_type= "select r_type  from team where t_id='".$aim_team_no."'";
	 $row =mysqli_fetch_array(mysqli_query($link,$get_aim_room_type));
	$aim_room_type =$row['r_type'];
	//登入帳號的房間類別
	echo "<br>目標隊伍的房間類型：",$aim_room_type;
	




	
	if($aim_team_people+$login_ac_team_people>$login_ac_room_able_live_people){
	    echo "<br>出錯： (自己隊伍人數+目標隊伍人數)>房間容量<br>";
	    exit();
	}else{
	    	    echo "<br>  自己隊伍人數+目標隊伍人數<=房間容量<br>";

	}
	
		
	if($login_ac_room_type!=$aim_room_type){
	    echo "<br>出錯: 自己房間類型≠目標隊伍房間類型<br>";
	    exit();
	}else{
	    echo "<br>自己房間類型=目標隊伍房間類型<br>";
	}
	
	
//判斷自己隊伍+對方隊伍人數是否大於房間大小 end
		
		//寫進msgkaisi
		
		$sql_msg_add = "INSERT INTO msg (msg_type, add_to_t_id, ask_to_t_id) VALUES ('2', '1', '3');";

		//檢測是否已經有邀請過 start
			$get_check_msg= "select w_water_id  from msg where add_to_t_id ='".$login_ac_teamid."'AND ask_to_t_id ='".$aim_team_no."'";

	if(mysqli_num_rows(mysqli_query($link,$get_check_msg))){
	  	    echo "<br>出錯：你的隊伍已邀請過該隊伍<br>";
 exit;
	}
		
			
				//檢測是否已經有邀請過 end
	

		
		
		
		
$sql_msg_add = "INSERT INTO msg (msg_type, add_to_t_id, ask_to_t_id) VALUES ('2', $login_ac_teamid, $aim_team_no);";

$rs = mysqli_query($link, $sql_msg_add);

if (!$rs) {    die("Error:".$sql_msg_add."<br> " . mysqli_error($link));}


		
		
		
		
				//寫進msg end
		
		
		
		//////////////////////
			$get_aim_std_masked_id= "select masked_id from team where t_id='".$aim_team_no."'";
			$rs=mysqli_query($link,$get_aim_std_masked_id);
			
while($row =mysqli_fetch_array($rs)){


echo "<br>目標隊伍成員：",$row['masked_id'];
//從maskedid獲取stdid
			$sql_stdid= "select s_id from student where masked_id='".$row['masked_id']."'";
						$rs_get_stdid=mysqli_query($link,$sql_stdid);
 $row_get_stdid =mysqli_fetch_array($rs_get_stdid);





//add to waiting list start




////add to waiting list end



	
//mail start

echo "<br> start to send mail:<br>";



$mail = new PHPMailer(true);    
// Passing `true` enables exceptions
try {
    
    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    $recive_address=$row_get_stdid['s_id']."@linkedlist.link";
    //服务器配置
    $mail->CharSet ="UTF-8";                     
    $mail->SMTPDebug = 0;                       
    $mail->isSMTP();                           
    $mail->Host = 'smtp-mail.outlook.com';               
    $mail->SMTPAuth = true;                    
    $mail->Username = 'rsp@https.443.gs';                
    $mail->Password = 'Hap67759a';            
    $mail->SMTPSecure = 'STARTTLS';                 
    $mail->Port = 587;                            

    $mail->setFrom('rsp@https.443.gs', 'RSP系統');  
    $mail->addAddress($recive_address, $recive_address);  
    //$mail->addAddress('ellen@example.com');  
   // $mail->addReplyTo('xxxx@yyy.com', 'info'); 
    //$mail->addCC('cc@example.com');                
    //$mail->addBCC('bcc@example.com');               


    // $mail->addAttachment('../xy.zip');      
    // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');   

    //Content
    $mail->isHTML(true);                                
    $mail->Subject = 'RSP系統通知';
    $mail->Body    = '<html lang="zh-tw"><body style="background-color:#f0f0f0;"> <style> .container { background-color: #fff; width: 500px;  padding: 20px;  border-radius: 10px;  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);  }body {font-family: sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }.linkbutton { display: inline-block; padding: 5px 20px;  font-size: 17px; text-align: center; text-decoration: none;  cursor: pointer; border-radius: 10px;  color: #ffffff;  background-color: #3498db;  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }</style><div class="container">  <h1>通知</h1> <p>你收到一則新的組隊請求</p><br>
<a href="https://rsp.443.gs/mynotice.php" class="linkbutton"> 查看詳情</a><br><br><hr><br>本電子信發送自生活輔導組<br>查詢電話： 0755-555-555 （週一至週五 08:30~17:30）<br><br> </div></body></html>


';
    $mail->AltBody = 'RSP:你收到一則新的組隊請求';

    $mail->send();
$mail_sent=1;
} catch (Exception $e) {
    $mail_sent=$mail->ErrorInfo;
}
				echo $mail_sent;
//mail end
    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!







}
		

		
	
		
		
		