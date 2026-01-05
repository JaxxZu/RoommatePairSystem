<? 

session_start();
if(!isset($_SESSION["name"])){
    header("Location: /login.php");
exit();
}
include("connect.php");

		$get_ac_teamid= "select t_id from student where s_id='".$_SESSION["name"]."'";
	 $row =mysqli_fetch_array(mysqli_query($link,$get_ac_teamid));
			$get_ac_teamid= "select t_id from student where t_id='".$row['t_id']."'";

	$login_ac_team_people=mysqli_num_rows(mysqli_query($link,$get_ac_teamid));
//登入的帳號的隊伍的成員人數
//echo $login_ac_team_people;
if($login_ac_team_people==1){
    echo "離開隊伍失敗：你的隊伍只有一個人";
    exit;
}


        //get 最大t_id start
        $sql_get_t_id = "SELECT MAX(t_id) FROM student";
$result = $link->query($sql_get_t_id);
$row = $result->fetch_assoc();
$max_d = $row["MAX(t_id)"]+1 ;
        //get 最大t_id end
        
        //
        
        
        	$sql_query= "select masked_id from student where s_id='".$_SESSION["name"]."'";
	$result=mysqli_query($link,$sql_query);
$row_maskid =mysqli_fetch_array($result);		

        //
        $sql_update_t_id="UPDATE team
SET t_id = '".$max_d."'
WHERE masked_id = '".$row_maskid[0]."';";
        	$result=mysqli_query($link,$sql_update_t_id);

        
           $sql_update_t_id="UPDATE student
SET t_id = '".$max_d."'
WHERE masked_id = '".$row_maskid[0]."';";
                	$result=mysqli_query($link,$sql_update_t_id);

        
        
        
        
        
        
        
        echo "已退出原隊伍";
        
        
        
        
        
        





