
			<? session_start();


if(isset($_SESSION["admin"]) ){
    header("Location: ./admintool.php");
exit();

}
?>
		<? include("./adminheader.htm");?>	

    <main class="container pt-4 pb-4" style="width: 500px;">


<? 

if(isset($_POST['stdid'])&&isset($_POST['pw'])){
   
    $pw=$_POST['pw'];


if($_POST['stdid']!="admin"){

echo '

<div class="alert alert-danger alert-dismissible fade show container " role="alert">
ERROR: 登入賬戶非管理員賬戶<br>學生登入：<a href=\'../login.php\'> ../login.php
</a></div>
';
            exit();

}

    include("../connect.php");



if(!$sldb){
    echo "can't find database: " . mysqli_error($link);
}else{
    
    
    	$sql_query= "select * from user where username='admin' and password_salted='".$pw."' ";
	$result=mysqli_query($link,$sql_query);
if(mysqli_num_rows($result)== 1 ){
$_SESSION["admin"]=1;
    
        header("Location: ./admintool.php");
exit();
    
    
    
}else {
	echo ' <div class="alert alert-warning alert-dismissible fade show container " role="alert">
 密碼錯誤
</div> ';}
}

}
    
    
    

?>
		 
	
<div class="card text-center"  >
  <div class="card-header">
    管理員登入
  </div>
  <div class="card-body">
  
  
  
  <form action="" method="post">

 
 
 
  <div class="form-floating mb-3">
  <input type="text" class="form-control" id="floatingInput" placeholder=" " name="stdid">
  <label for="floatingInput"> 管理員</label>
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
<br> <div class="alert alert-danger alert-dismissible fade show container " role="alert">
學生登入：<a href='../login.php'> ../login.php
</a></div>
</main>	<? include("../footer.htm");?>	