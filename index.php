		<? include("header.php");
						?>	

  
    <main class="container pt-4 pb-4">
<div class="card text-white bg-info  mb-3">
  <div class="card-header">
    公告
    <button type="button" class="btn-close text-white float-end btn-close-white" aria-label="Close" onclick="closepost(this)"></button>
  </div>
  <div class="card-body">
    <pre class="card-text"><?
    	$sql_query="SELECT self_intro FROM student WHERE s_id = 'admin' ";
    		$result=mysqli_query($link,$sql_query);
$row =mysqli_fetch_array($result);		

    echo $row[0];
    //公告
    ?></pre>
  </div>
</div>

<script>
  function closepost(button) {
    var card = button.closest('.card');
    if (card) {
      card.remove();
    }
  }
</script>









<div class="modal fade fade-scale" id="myModal" onclick="insidechange('xxxxxxxxclose')">
    <div class="modal-dialog modal-xl" style="margin-top: 10px; margin-bottom: 10px;" >
        <div class="modal-content"  onclick="event.stopPropagation()">
       
            <div class="modal-body" >
                <iframe src="about:blank" width="100%" height="600px" id="insideinfo"></iframe>
            </div>
        </div>     

     <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 5px; right: -70px;">
            <i class="bi bi-x-circle" style="font-size:30px;"></i>
        </button>
    </div>
</div>







<script>

    
    function insidechange(stdid) {
    var iframe = document.getElementById("insideinfo");

   if(stdid=="xxxxxxxxclose"){
        
 
                iframe.src = "about:blank";

    }    else{    iframe.src = "inside.php?stdid=" + stdid;
}
}

</script>

<div class="row row-cols-1 row-cols-md-3 g-4">


<?


	
			$get_ac_room_type= "select roomtype from student where s_id='".$_SESSION["name"]."'";
	 $row_rt =mysqli_fetch_array(mysqli_query($link,$get_ac_room_type));

	//登入帳號的房間類別
	

    	$sql_query="SELECT * FROM student WHERE roomtype = '".$row_rt['roomtype']."' ";
    		$result=mysqli_query($link,$sql_query);
while($row =mysqli_fetch_array($result)){		//<!-- 簡單介紹start-->


if(!isset($row[14])||!isset($row[13])){break;}



	$sql_tm= "select t_id from student where t_id='".$row["t_id"]."'";




echo '
  <div class="col" data-bs-toggle="modal" onclick="insidechange(\''.$row[1].'\')" data-bs-target="#myModal">
    <div class="card h-100">
	<div class="card-header">
        <small class="text-muted">'.$row[1].'</small> <span class="badge bg-'; if($row[34]===(string)0){ echo "info";}else{ echo "warning";}echo' text-dark">#喜歡'; if($row[34]===(string)0){ echo "安靜";}else{ echo "熱鬧";}echo'</span> <span class="badge bg-primary">隊伍:'.mysqli_num_rows(mysqli_query($link,$sql_tm)).'人</span>
      </div>
      <div class="card-body">

<table class="table table-bordered  table-sm" style="text-align:center;">
<tr >
<th width="50%">個人情況 </th>
<th width="50%">徵友條件</th>

</tr>

<tr>
<td >'; if($row[13]===(string)0){ echo " 不吸菸 ";}
	  if($row[13]==1){ echo "只吸傳統菸 ";}
    if($row[13]==2){ echo "只吸電子菸 ";}
    if($row[13]==3){ echo "吸傳統和電子菸 ";} echo'</td>
<td >';if($row[14]===(string)0){ echo " 不接受吸菸 ";}
	  if($row[14]==1){ echo "只接受傳統菸 ";}
    if($row[14]==2){ echo "只接受電子菸 ";}
    if($row[14]==3){ echo "接受吸傳統和電子菸 ";} echo '</td>
</tr>




<tr>
<td >' ;switch ($row[19]){
case 0:
    echo "不";
    break;
case 1:
        echo "甚少";
break;
case 2:
        echo "偶爾";
break;
case 3:
       echo "經常";
 break;}
echo '打電話</td>
<td >' ;switch ($row[20]){
case 0:
    echo "不接受";
    break;
case 1:
        echo "接受甚少";
break;
case 2:
        echo "接受偶爾";
break;
case 3:
       echo "接受經常";
 break;}
echo '打電話</td>
</tr>


<tr>
<td >';
	  switch ($row[15]){
case 0:
    echo "不";
    break;
case 1:
        echo "甚少";
break;
case 2:
        echo "偶爾";
break;
case 3:
       echo "經常";
 break;}
echo'帶人進房</td>
<td >';
      switch ($row[16]){
case 0:
    echo " 不接受";
    break;
case 1:
        echo " 接受甚少";
break;
case 2:
        echo " 接受偶爾";
break;
case 3:
       echo " 接受經常";
 break;
}echo '帶人進房</td>
</tr>





<tr>
<td >', $row[17] ,'人</td>
<td >接受', $row[18] ,'人</td>
</tr>


<tr>
<td colspan="2">',$row[8],'</td>
</tr>



</table>

      </div>
    </div>
  </div>

';}
  
  //  <!-- 簡單介紹end-->
  
  ?>
  
 
 
 
</div>
</div>

		<? include("footer.htm");?>	



