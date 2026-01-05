<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';
$mail = new PHPMailer(true);    
// Passing `true` enables exceptions
try {
    
    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    $recive_address="a1115532@mail.nuk.edu.tw";
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
   // $mail->addReplyTo('xxxx@163.com', 'info'); 
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
		
//mail end
    //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

		echo $mail_sent;
		
		