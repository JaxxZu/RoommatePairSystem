		<? include("header.php");
		
		
		
		
		//check 隊伍編號 開始
		
		 		
	$sql_query= "select t_id from student where s_id='".$_SESSION["name"]."'";
	$result=mysqli_query($link,$sql_query);

 
	
$row =mysqli_fetch_array($result);		



$teamid=$row[0];
				//check 隊伍編號end
		
		?>    <main class="container pt-4 pb-4">
		    
		    <script>

    
    function insidechange(stdid) {
    var iframe = document.getElementById("insideinfo");

   if(stdid=="xxxxxxxxclose"){
        
 
                iframe.src = "about:blank";

    }    else{    iframe.src = "inside.php?noshowaddbtn=1&tid=" + stdid;
}
}





    function cleanmsg(stdid) {
    var iframe = document.getElementById("cleaninfo");

   if(stdid=="xxxxxxxxclose"){
        
 
                iframe.src = "about:blank";

    }    else{    iframe.src = "team_ans.php?add_tid=" + stdid;
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


<div class="modal fade fade-scale" id="cleaninfoModal" onclick="cleanmsg('xxxxxxxxclose')">
    <div class="modal-dialog modal-xl" style="margin-top: 10px; margin-bottom: 10px;" >
        <div class="modal-content"  onclick="event.stopPropagation()">
       
            <div class="modal-body" >
                <iframe src="about:blank" width="100%" height="444px" id="cleaninfo"></iframe>
            </div>
        </div>     

     <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 5px; right: -70px;">
            <i class="bi bi-x-circle" style="font-size:30px;"></i>
        </button>
    </div>
</div>






<?if($no_notice==1){
    
    echo '<div class="alert alert-secondary d-flex align-items-center" role="alert">
<i class="bi bi-x-circle"  style="font-size: 24px;" ></i>  <div class="flex-grow-1">
    &emsp;目前沒有組隊請求
  </div>
  </div>';
    
}else{
				
	$sql_check_blue= "select * from msg where ask_to_t_id='".$teamid."'";
	$result=mysqli_query($link,$sql_check_blue);
   while($row =mysqli_fetch_array($result)){		





echo '<div class="alert alert-primary d-flex align-items-center " role="alert">
  <i class="bi bi-info-circle"  style="font-size: 24px;" > </i><div class="flex-grow-1">
    &emsp;<a href="#" onclick="insidechange(\''.$row['add_to_t_id'].'\')"  data-bs-toggle="modal" data-bs-target="#myModal" class="alert-link">隊伍 ',$row['add_to_t_id'],'</a>請求合併你的隊伍
  </div>
 
 <a onclick="cleanmsg(\'',$row['add_to_t_id'],'&yes=1\')"  data-bs-toggle="modal" data-bs-target="#cleaninfoModal"> <button type="button" class="btn btn-outline-success" >
同意  </button> </a>&emsp; 



<a onclick="cleanmsg(\'',$row['add_to_t_id'],'&yes=0\')"  data-bs-toggle="modal" data-bs-target="#cleaninfoModal"> <button type="button" class="btn btn-outline-danger" >
拒絕  </button> </a>&emsp; 





</div>
';}}
		?>
					












<!--



<div  > <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    testing<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

<div class="alert alert-primary d-flex align-items-center " role="alert">
  <i class="bi bi-info-circle"  style="font-size: 24px;" > </i><div class="flex-grow-1">
    &emsp;<a href="#" class="alert-link">隊伍 123</a>請求合併你的隊伍
  </div>
  <button type="button" class="btn btn-outline-success" data-bs-dismiss="alert">
同意  </button> &emsp; <button type="button" class="btn btn-outline-danger" data-bs-dismiss="alert">
拒絕  </button></div>

<div class="alert alert-primary d-flex align-items-center" role="alert">
  <i class="bi bi-info-circle"  style="font-size: 24px;" > </i><div class="flex-grow-1">
    &emsp;<a href="#" class="alert-link">A111111</a>邀請你加入他的隊伍
  </div>
  <button type="button" class="btn btn-outline-success" data-bs-dismiss="alert">
同意
  </button>&emsp; <button type="button" class="btn btn-outline-danger" data-bs-dismiss="alert">
拒絕  </button></div>

<div class="alert alert-success d-flex align-items-center" role="alert">
<i class="bi bi-check-circle" style="font-size: 24px;"></i>  <div class="flex-grow-1">
    &emsp;A1115555同意了你的組隊邀請
  </div>
  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="alert">
知道了
  </button></div>

<div class="alert alert-danger d-flex align-items-center" role="alert">
<i class="bi bi-x-circle"  style="font-size: 24px;" ></i>  <div class="flex-grow-1">
    &emsp;A1115555拒絕了你的組隊邀請
  </div>
  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="alert">
知道了
  </button></div>
  
  
  -->
  </main>
  
  
  
  
  
    <iframe src="about:blank" width="5px" height="10px" name="view_frame"></iframe>	<? include("footer.htm");?>	
