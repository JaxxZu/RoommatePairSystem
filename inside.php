<?
session_start();
if(!isset($_SESSION["name"])){
    header("Location: /login.php");
exit();
}
//	  echo "»»»»»»測試環境 登入者:",$_SESSION["name"],"«««««««<br>";
    

//echo 	
include("connect.php");



if(isset($_GET['tid'])){
    $teamid=$_GET['tid'];
}else{

$maskid=$_GET['stdid'];




		
	$sql_query= "select * from student where masked_id='".$maskid."'";
	$result=mysqli_query($link,$sql_query);

 
	
$row =mysqli_fetch_array($result);		


   if(!isset($row)){
       echo "查不到該masked-id:<br>",$maskid;
exit();}


$teamid=$row[9];
//獲取該學生的隊伍id
}
	$sql_tm= "select * from student where t_id='".$teamid."'";
	$result_tm=mysqli_query($link,$sql_tm);
$teammate_num=mysqli_num_rows($result_tm);
$row =mysqli_fetch_array($result_tm);		


//echo $teamid,"xxx",$teammate_num;
    //查詢該學生的隊友數量





echo 
'
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HTML 表格示例</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
      crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
	  
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

	  
</head>
<body>



<ul class="nav nav-tabs" id="myTab" role="tablist">

  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1">隊伍'.$teamid.'成員：</a>
  </li>
';
  
   /* <li class="nav-item" role="presentation">

    <button class="nav-link active" id="std1-tab" data-bs-toggle="tab" data-bs-target="#std1" type="button" role="tab">',$maskid,'</button>
  </li>
  
  */
  for ($i=1;$i<=$teammate_num;$i++){
  echo '<li class="nav-item" role="presentation">
    <button class="nav-link';if($i==1){echo ' active ';} echo ' " id="std',$i,'-tab" data-bs-toggle="tab" data-bs-target="#std',$i,'" type="button" role="tab">STD'.$i.'</button>
  </li>';
      
  }
echo '




  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1">(共',$teammate_num,'人)</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">



<!--tab start-->
  <div class="tab-pane fade show active" id="std1" role="tabpanel" >
      
      
<!--
//表單start
-->
<table class="table table-bordered">
  <thead>
    <tr>
      <th width="30%" scope="col">STD: ',$row[1],'</th>
      <th width="40%" scope="col">個人情況</th>
      <th width="40%" scope="col">接受室友</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">環境</th>
      <td colspan="2">'; if($row[34]===(string)0){ echo " 喜歡安靜 ";}else{ echo " 喜歡熱鬧 ";}
	  echo ' </td>
    </tr>
    
    
    
    
    
     <tr>
      <th scope="row">冷氣溫度</th>
      <td colspan="2">',$row[11],"~",$row[12],'℃</td>
    </tr>
     <tr>
      <th scope="row">開冷氣人數</th>
      <td colspan="2">&gt;', $row[10],'人</td>
    </tr>
    <tr>
      <th scope="row">吸菸</th>
      <td>'; if($row[13]===(string)0){ echo " 不吸菸 ";}
	  if($row[13]==1){ echo "只吸傳統菸 ";}
    if($row[13]==2){ echo "只吸電子菸 ";}
    if($row[13]==3){ echo "吸傳統和電子菸 ";} echo'</td>
      <td>';if($row[14]===(string)0){ echo " 不接受吸菸 ";}
	  if($row[14]==1){ echo "只接受傳統菸 ";}
    if($row[14]==2){ echo "只接受電子菸 ";}
    if($row[14]==3){ echo "接受吸傳統和電子菸 ";} echo '</td>
    </tr>
    <tr>
      <th scope="row">打電話</th>
      <td>' ;switch ($row[19]){
case 0:
    echo " 不打 ";
    break;
case 1:
        echo " 甚少打 ";
break;
case 2:
        echo " 偶爾打 ";
break;
case 3:
       echo " 經常打 ";
 break;}
echo ' </td>
      <td>'; switch ($row[20]){
case 0:
    echo " 不能打 ";
    break;
case 1:
        echo " 可以甚少打 ";
break;
case 2:
        echo " 可以偶爾打 ";
break;
case 3:
       echo " 可以經常打 ";
 break;
}echo '</td>
    </tr>
    <tr>
      <th scope="row">帶人進房</th>
      <td>';
	  switch ($row[15]){
case 0:
    echo " 不帶 ";
    break;
case 1:
        echo " 甚少帶 ";
break;
case 2:
        echo " 偶爾帶 ";
break;
case 3:
       echo " 經常帶 ";
 break;}
echo'</td>
      <td>';
      switch ($row[16]){
case 0:
    echo " 不能帶 ";
    break;
case 1:
        echo " 可以甚少帶 ";
break;
case 2:
        echo " 可以偶爾帶 ";
break;
case 3:
       echo " 可以經常帶 ";
 break;
}echo '</td>
    </tr>
   
    <tr>
      <th scope="row">上課日前一晚睡覺時間</th>
      <td> ',str_pad($row[22],2,"0",STR_PAD_LEFT) ,":"
      ,str_pad($row[23],2,"0",STR_PAD_LEFT) ,"~"
      ,str_pad($row[24],2,"0",STR_PAD_LEFT) ,":"
      ,str_pad($row[25],2,"0",STR_PAD_LEFT) ,'</td>
      <td>';
      if($row[30]==25){
          echo "幾點睡都行";
      }else{
      
      echo  str_pad($row[30],2,"0",STR_PAD_LEFT) ,":"
      ,str_pad($row[31],2,"0",STR_PAD_LEFT) ,"前睡" ;}
     echo '</td>
    </tr>
    <tr>
      <th scope="row">節假日前一晚睡覺時間</th>
      <td>',  str_pad($row[26],2,"0",STR_PAD_LEFT) ,":"
      ,str_pad($row[27],2,"0",STR_PAD_LEFT) ,"~"
      ,str_pad($row[28],2,"0",STR_PAD_LEFT) ,":"
      ,str_pad($row[29],2,"0",STR_PAD_LEFT) ,' </td>
      <td>'; if($row[32]==25){
          echo "幾點睡都行";
      }else{ echo  str_pad($row[32],2,"0",STR_PAD_LEFT) ,":"
      ,str_pad($row[33],2,"0",STR_PAD_LEFT) ,"前睡" ;
     }echo ' </td>
    </tr>

    <tr>
      <th scope="row">國籍</th>
      <td> ', $row[17] ,'</td>
      <td>', $row[18],'</td>
    </tr>
    
    
    <tr>
      <th scope="row">留言</th>
      <td colspan="2"><pre style="max-height:60px;">',$row[8],'</pre></td>
    </tr>
  </tbody>
</table>
<!--

//表單end-->
      
      
  </div>
  
  
  <!--tab end-->
';
  /*
  <div class="tab-pane fade" id="std2" role="tabpanel">
  
  
  <!-- start zenyou--->
  


  
  
  
  
  </div>
  
  */
  
  if($teammate_num>1){
      // 有隊友
for($i=2;$row =mysqli_fetch_array($result_tm);$i++){
    
    echo '  <div class="tab-pane fade" id="std',$i,'" role="tabpanel">';
    echo'
    
    
<!--
//表單start
-->
<table class="table table-bordered">
  <thead>
    <tr>
      <th width="30%"  scope="col"> STD: ',$row[1],'</th>
      <th width="40%" scope="col">個人情況</th>
      <th width="40%" scope="col">接受室友</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">環境</th>
      <td colspan="2">'; if($row[34]===(string)0){ echo " 喜歡安靜 ";}else{ echo " 喜歡熱鬧 ";}
	  echo ' </td>
    </tr>
    
    
    
    
    
     <tr>
      <th scope="row">冷氣溫度</th>
      <td colspan="2">',$row[11],"~",$row[12],'℃</td>
    </tr>
     <tr>
      <th scope="row">開冷氣人數</th>
      <td colspan="2">&gt;', $row[10],'人</td>
    </tr>
    <tr>
      <th scope="row">吸菸</th>
      <td>'; if($row[13]===(string)0){ echo " 不吸菸 ";}
	  if($row[13]==1){ echo "只吸傳統菸 ";}
    if($row[13]==2){ echo "只吸電子菸 ";}
    if($row[13]==3){ echo "吸傳統和電子菸 ";} echo'</td>
      <td>';if($row[14]===(string)0){ echo " 不接受吸菸 ";}
	  if($row[14]==1){ echo "只接受傳統菸 ";}
    if($row[14]==2){ echo "只接受電子菸 ";}
    if($row[14]==3){ echo "吸傳統和電子菸 ";} echo '</td>
    </tr>
    <tr>
      <th scope="row">打電話</th>
      <td>' ;switch ($row[19]){
case 0:
    echo " 不打 ";
    break;
case 1:
        echo " 甚少打 ";
break;
case 2:
        echo " 偶爾打 ";
break;
case 3:
       echo " 經常打 ";
 break;}
echo ' </td>
      <td>'; switch ($row[20]){
case 0:
    echo " 不能打 ";
    break;
case 1:
        echo " 可以甚少打 ";
break;
case 2:
        echo " 可以偶爾打 ";
break;
case 3:
       echo " 可以經常打 ";
 break;
}echo '</td>
    </tr>
    <tr>
      <th scope="row">帶人進房</th>
      <td>';
	  switch ($row[15]){
case 0:
    echo " 不帶 ";
    break;
case 1:
        echo " 甚少帶 ";
break;
case 2:
        echo " 偶爾帶 ";
break;
case 3:
       echo " 經常帶 ";
 break;}
echo'</td>
      <td>';
      switch ($row[16]){
case 0:
    echo " 不能帶 ";
    break;
case 1:
        echo " 可以甚少帶 ";
break;
case 2:
        echo " 可以偶爾帶 ";
break;
case 3:
       echo " 可以經常帶 ";
 break;
}echo '</td>
    </tr>
   
    <tr>
      <th scope="row">上課日前一晚睡覺時間</th>
      <td> ',str_pad($row[22],2,"0",STR_PAD_LEFT) ,":"
      ,str_pad($row[23],2,"0",STR_PAD_LEFT) ,"~"
      ,str_pad($row[24],2,"0",STR_PAD_LEFT) ,":"
      ,str_pad($row[25],2,"0",STR_PAD_LEFT) ,'</td>
      <td>';
      if($row[30]==25){
          echo "幾點睡都行";
      }else{
      
      echo  str_pad($row[30],2,"0",STR_PAD_LEFT) ,":"
      ,str_pad($row[31],2,"0",STR_PAD_LEFT) ,"前睡" ;}
     echo '</td>
    </tr>
    <tr>
      <th scope="row">節假日前一晚睡覺時間</th>
      <td>',  str_pad($row[26],2,"0",STR_PAD_LEFT) ,":"
      ,str_pad($row[27],2,"0",STR_PAD_LEFT) ,"~"
      ,str_pad($row[28],2,"0",STR_PAD_LEFT) ,":"
      ,str_pad($row[29],2,"0",STR_PAD_LEFT) ,' </td>
      <td>'; if($row[32]==25){
          echo "幾點睡都行";
      }else{ echo  str_pad($row[32],2,"0",STR_PAD_LEFT) ,":"
      ,str_pad($row[33],2,"0",STR_PAD_LEFT) ,"前睡" ;
     }echo ' </td>
    </tr>

    <tr>
      <th scope="row">國籍</th>
      <td> ', $row[17] ,'</td>
      <td>', $row[18],'</td>
    </tr>
    
    
    <tr>
      <th scope="row">留言</th>
      <td colspan="2" ><pre >',$row[8],'</pre></td>
    </tr>
  </tbody>
</table>
<!--

//表單end-->
      
      
    
    
    
    ';
    
    echo '    
  </div>
  
  
  <!--tab end-->';
}  }
  
  
  
  echo '
  
  
  
</div>';

$get_ac_teamid= "select t_id from student where s_id='".$_SESSION["name"]."'";
	 $row_ac =mysqli_fetch_array(mysqli_query($link,$get_ac_teamid));
	 
	 
	 if(isset($_GET['noshowaddbtn'])){
$noshowaddbtn=$_GET['noshowaddbtn'];

}else{
    $noshowaddbtn=0;
}
	 
	 
	 
if($row_ac['t_id']!=$teamid &&$noshowaddbtn!=1){

echo '
<a href="team_add.php?tid='.$teamid.'">
<div class="d-grid ">
  <button class="btn btn-primary" type="button">送出組隊請求</button>
</div>
</a>';
}

echo '</body>
</html>
';