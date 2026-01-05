
			<? include("header.php");?>	

    <main class="container pt-4 pb-4" style="width: 300px;">


<? 

if(isset($_POST['stdid'])&&isset($_POST['pw'])){
    $ac=strtolower($_POST['stdid']);
    $pw=$_POST['pw'];





if(!$sldb){
    echo "can't find database: " . mysqli_error($link);
}else{
    
    
    	$sql_query= "select * from user where username='".$ac."' and password_salted='".$pw."' ";
	$result=mysqli_query($link,$sql_query);
if(mysqli_num_rows($result)== 1 ){
$_SESSION["name"]=$ac;
    
        header("Location: /index.php");
exit();
    
    
    
}else {
	echo ' <div class="alert alert-warning alert-dismissible fade show container " role="alert">
 學號或密碼錯誤
</div> ';}
}

}
    
    
    

?>
		 
	
	<!--test9999999999-->
<div class="card text-center"  >
  <div class="card-header">
    學生登入
  </div>
  <div class="card-body">
  
  
  
  <form action="" method="post">

 
 
 
  <div class="form-floating mb-3">
  <input type="text" class="form-control" id="floatingInput" placeholder=" " name="stdid">
  <label for="floatingInput"> 學號</label>
</div>
<div class="form-floating ">
  <input type="password" class="form-control" id="floatingPassword" placeholder=" " name="pw">
  <label for="floatingPassword">密碼</label>
</div>
 <div class="pt-4">
  </div>
  <button type="submit" class="btn btn-primary ">登入</button>

	
	</form>
	
  </div>


		 
</div>
<br> <div class="alert alert-light alert-dismissible fade show container " role="alert">
 如無法登入，請聯絡圖資館： <br>
 0755-55-5445<br>
 ( 週一~週五 08:30~17:30 )
</div>
</main>	<? include("footer.htm");?>	