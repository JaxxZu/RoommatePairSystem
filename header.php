<? 

session_start();


$currentFile = $_SERVER['SCRIPT_FILENAME'];
$fileName = basename($currentFile);



if(!isset($_SESSION["name"]) && $fileName!="login.php"){
    header("Location: /login.php");
exit();
}else if(isset($_SESSION["name"])&& $fileName=="login.php"){
       header("Location: /index.php");
exit();
    
}

	        		include("connect.php");



echo '<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>K大室友互選系統RSP</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
      crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
	  
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
</head>
<body>
<div id="root" >
    <header style="background-color:#dfdfdf;">
     
        <div class="py-3 mb-4 border-bottom">
            <div class="container d-flex flex-wrap">
                <a href="/" class="d-flex align-items-center mb-lg-0 me-lg-auto text-dark text-decoration-none">
                       <img width="auto" height="40px" src="../logo" referrerpolicy="no-referrer">
                    
                </a>    
                
                
                
               <ul >
                </ul>
                
                
                
                
                
                
                ';
			if(isset($_SESSION["name"])){echo	 ' <ul class="nav nav-pills nav-fill">
  <li class="nav-item">
    <a class="nav-link ';if($fileName=="index.php"){ echo "active";}
 echo '" href="/">棟友清單</a>
  </li>
  
  <!--
  <li class="nav-item">
    <a class="nav-link ';   if($fileName=="room.php"){ echo "active";}       echo '" href="/room.php">房間分配</a>
  </li>
  
  -->
  
  
  <li class="nav-item">
    <a class="nav-link ';if($fileName=="myinfo.php"||$fileName=="login.php"){ echo "active";} echo'" href="/myinfo.php">個人資料</a>
  </li>
    <li class="nav-item position-relative">
    <a class="nav-link ';if($fileName=="mynotice.php"){ echo "active";} echo '" href="/mynotice.php">
      <i class="bi bi-bell"></i>
     ';
     
     
     
     
     	        		
	        		
	$sql_query= "select masked_id,t_id from student where s_id='".$_SESSION["name"]."'";
	$result=mysqli_query($link,$sql_query);

 
	
$row =mysqli_fetch_array($result);		
     
     
     
	$sql_red= "select ask_to_t_id from msg where ask_to_t_id='".$row[1]."'";
	$result_red=mysqli_query($link,$sql_red);

     if(mysqli_fetch_array($result_red)){
         echo ' <span class="notification-badge">
        <span class="badge bg-danger rounded-circle position-absolute top-0" style="width: 1rem; height: 1rem;">
          <span style="font-size: 0.5rem; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">!</span>
        </span>
      </span>';         $no_notice=0;

     }else{
         $no_notice=1;
     }
     
    echo '</a>
  </li>
   <li class="nav-item position-relative">
    <a class="nav-link "  data-bs-toggle="modal" data-bs-target="#logoutComfirm"  href="#">
      <i class="bi bi-box-arrow-in-right"></i>
      
    </a>
  </li>
</ul>   
   
        
      </div></div>  
        
        
    </header>
<div class="modal fade fade-scale" id="logoutComfirm" tabindex="-1" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >警告</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" ></button>
      </div>
      <div class="modal-body">
        <p>確認登出嗎？</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">否</button>
<a href="logout.php" >      
	  <button type="button" class="btn btn-primary">確認</button></a>
      </div>
    </div>
  </div>
</div>

	 ';}else{
	     echo '</div></div>    </header>';
	 }
	 
	  if($fileName!="login.php"){ echo "»»»»»»測試環境 登入者:",$_SESSION["name"],"«««««««<br>";
	      
	        		



echo "»»»»»»測試環境 masked id:", $row[0],"«««««««<br>";
echo "»»»»»»測試環境 隊伍 id:",$row[1],"«««««««<br>";



	      
	      
	      
	      
	  }
