<? session_start();

if(!isset($_SESSION["admin"])){
        header("Location: ./adminlogin.php");
exit();
}

include("../connect.php");



function maskid($stdid){
$first = strtoupper(substr($stdid, 0, 1));
$stdid = strrev(substr($stdid, 1));

switch ($first) {
    case 'B':
        $stdid+=date('y')+24;
        break;
    case 'F':
        $stdid+=date('y')+32;
        break;
    case 'M':
        $stdid+=date('y')+13;
        break;
    case 'D':
        $stdid+=date('y')+24;
        break;
    case 'L':
        $stdid+=date('y')+35;
        break;
    case 'J':
        $stdid+=date('y')+36;
        break;
    case 'K':
        $stdid+=date('y')+17;
        break;
    case 'E':
        $stdid+=date('y')+28;
        break;
    case 'W':
        $stdid+=date('y')+19;
        break;
    case 'A':
        $stdid+=date('y')+30;
        break;
    default:
        $stdid+=date('y')+5;
        break;
}




return base_convert(base_convert($stdid, 11, 8)+date('y'), 23, 33);}


 $insertData = $_POST["data"];

    // 將換行統一轉換成 "\n"
    $insertData = str_replace(array("\r\n", "\r"), "\n", $insertData);

    // 拆分資料行
    $lines = explode("\n", $insertData);

  // 插入資料
    foreach ($lines as $line) {
        
          if (trim($line) == '') {
        continue; // 跳過空行
    }
        
        
        
        //get 最大t_id start
        $sql_get_t_id = "SELECT MAX(t_id) FROM student";
$result = $link->query($sql_get_t_id);
$row = $result->fetch_assoc();
$max_d = $row["MAX(t_id)"]+1 ;



        //get 最大t_id end

        $fields = explode(",", $line);
        $mask_id=maskid($fields[0]);

        $sql = "INSERT INTO student (s_id ,masked_id, roomtype,t_id) VALUES ('".strtolower($fields[0])."','".$mask_id."', '".$fields[1]."','".$max_d."')";
       
        if (mysqli_query($link, $sql) === FALSE) {
            echo "<br>Error while adding to student: <span style='color:red;'>" . $sql . "</span><br>" . mysqli_error($link);
          
        }else{echo "<br>-------adding to student ok!"; }
        
        
        
        /////////////////////////////////////////////////////////////////
        $sql_team = "INSERT INTO team (masked_id , r_type ,t_id,t_water_id) VALUES ('".$mask_id."','$fields[1]','".$max_d."','".$max_d."')";
       
        if (mysqli_query($link, $sql_team) === FALSE) {
            echo "<br>Error while adding to team: <span style='color:red;'> " . $sql_team . "</span><br>" . mysqli_error($link);
        
        }else{echo "<br>-------adding to team ok!"; }
        
        
        
        /////////////////////////////////////////////////////
        
        
        
        
        
        $sql2="INSERT INTO user (username  ,password_salted) VALUES ('".strtolower($fields[0])."','".md5(maskid($fields[0]))."')";
        
        if (mysqli_query($link, $sql2) === FALSE) {
            echo "<br>Error while adding to user: <span style='color:red;'> " .$sql2 . "</span>s<br>" . mysqli_error($link);
        }else{echo "<br>-------adding to user ok!"; }
    }
    
    
    
        mysqli_close($link);
