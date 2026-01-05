<? session_start();

if(!isset($_SESSION["admin"])){
        header("Location: ./adminlogin.php");
exit();
}


	 include("./adminheader.htm");echo "»»»»»»測試環境 管理員登入狀態:",$_SESSION["admin"],"«««««««<br>";
?>	

    <main class="container pt-4 pb-4" style="width: 80%;">

<form action="./adminadddata.php" method="post">
<div class="mb-3">
  <label for="ca" class="form-label">插入學生資訊：</label>
  <p>格式： “id,roomtype”</p>
  <textarea class="form-control" name="data" id="ca" rows="10"></textarea>
</div>
<button type="submit" class="btn btn-success">Submit</button>
</form>



<? include("../footer.htm");?>	