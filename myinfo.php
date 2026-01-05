		<? include("header.php");

		

	$sql_query= "select * from student where s_id='".$_SESSION["name"]."'";
	$result=mysqli_query($link,$sql_query);

    
		
$row =mysqli_fetch_array($result);		
		?>	
<!--hide number箭頭-->
					<style>
					        input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
      -webkit-appearance: none;
      margin: 0; 
    }
    input[type=number] {
        -moz-appearance:textfield;
    }	
    </style>
    
    <main class="container pt-4 pb-4">

<? if(isset($_GET['update'])){
    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
  <strong>';
  switch ($_GET['update']) {
        case '1':
          echo "個人資料";
          break;
            case '2':
          echo "徵友要求";
          break;
            case '3':
         // won't =3
          break;
            case '4':
          echo "密碼";
          break;
      
  }
  
  echo'</strong>更新成功
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>



<?
if(isset($_GET['tmpage'])){
   $homeav=0;
    $tmpage=1;
}else{
      $homeav=1;
    $tmpage=0;
}
?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link <?  if($homeav==1){echo " active ";}?>" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab">個人檔案</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link " id="requiretm-tab" data-bs-toggle="tab" data-bs-target="#requiretm" type="button" role="tab">徵友要求</button>
  </li>
    <li class="nav-item" role="presentation">
    <button class="nav-link<?  if($tmpage==1){echo "  active  ";}?>" id="team-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">隊伍管理</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pw-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" >賬戶安全</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade<?  if($homeav==1){echo "  show active  ";}?>" id="home" role="tabpanel" aria-labelledby="home-tab">
  
  <!-- start person info-->
  <form action="update-person-info.php" method="post" id="form-myself">
  <div class="mb-3"><label  class="form-label" >Line ID</label>
<div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">@</span>	  
  <input type="text" class="form-control" maxlength="50" name="line" placeholder="ID" value="<? echo $row[2];?>" ></div></div>
  
    <div class="mb-3"><label  class="form-label">Instagram Username</label>
  <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">@</span>
  <input type="text" value="<? echo $row[4];?>"  class="form-control" maxlength="50"  name="ig" placeholder="Username" >
</div></div>
  
    <div class="mb-3"><label  class="form-label">Telegram Username</label>
  <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">@</span>
  <input type="text" value="<? echo $row[3];?>"  class="form-control" maxlength="50"  name="dc" placeholder="Username" >
</div></div>
  
    <div class="mb-3"><label  class="form-label">Discord Username</label>
  <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">@</span>
  <input type="text"  value="<? echo $row[5];?>" class="form-control" maxlength="50"  name="tg" placeholder="Username" >
</div></div>
  
  
   
    <div class="mb-3"><label for="exampleInputEmail1" class="form-label"><font color="red">*</font>Email地址</label>
  <input type="email" class="form-control"  value="<? echo $row[6];?>"   maxlength="255" name="email" placeholder="Email Address" >
</div>
  
  
   <style>
        .comment-tooltip {
		text-decoration: underline dotted;
            position: relative;
            display: inline-block;
            cursor: help;
        }

        .comment-tooltip:hover::before {
		
            content: attr(data-tooltip);
            position: absolute;
            background: #333;
            color: #fff;
            padding: 5px;
            border-radius: 3px;
            bottom: 150%;
            left: 50%;
            transform: translateX(-0%);
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .comment-tooltip:hover::before {
            opacity: 1;
        }
    </style>
    <div class="mb-3"><label  class="form-label"><font color="red">*</font>你是喜歡安靜呢還是熱鬧呢？<span class="comment-tooltip" data-tooltip="Respect to 嘴替张牧之">(*)</span ></label>
<br>

<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="is_e" id="i_p" value="0" required="required"  <? if($row[34]===(string)0){ echo " checked ";}?> >
  <label class="form-check-label" for="i_p">安靜</label>
</div>
<div class="form-check form-check-inline" >
  <input class="form-check-input" type="radio"  <? if($row[34]==1){ echo " checked ";}?>name="is_e" id="e_p" value="1">
  <label class="form-check-label" for="e_p">熱鬧</label>
</div>
</div>
  

    <div class="mb-3"><label class="form-label"><font color="red">*</font>是否吸菸？</label>
<br>
<div class="form-check form-check-inline" onclick="clean_smoke()">
  <input<? if($row[13]===(string)0){ echo " checked ";}?>  class="form-check-input" type="radio" name="smoke" id="nosmoke" value="0">
  <label class="form-check-label" for="nosmoke">不吸</label>
</div>

<div class="form-check form-check-inline" onclick="clean_nosmoke()">
  <input<? if($row[13]==1 ||$row[13]==3){ echo " checked ";}?>  class="form-check-input" type="checkbox" name="smoke"  id="esmoke" value="1">
  <label class="form-check-label" for="esmoke">吸傳統菸</label>
</div>

<div class="form-check form-check-inline" onclick="clean_nosmoke()">
  <input<?if($row[13]==2 ||$row[13]==3){ echo " checked ";}?>  class="form-check-input" type="checkbox" name="esmoke"  id="smoke" value="2">
  <label class="form-check-label" for="smoke">吸電子菸</label>
</div>
</div>

  
  <script>
  function clean_smoke(){

 document.getElementById("smoke").checked = false;
 document.getElementById("esmoke").checked = false;
}
function clean_nosmoke(){
document.getElementById("nosmoke").checked = false;
}
  </script>
  
<!--number 不滾動-->
  
      <div class="mb-3"><label  class="form-label"><font color="red">*</font>冷氣設置溫度範圍</label>

  
  <div class="input-group mb-3">
  <input value='<? echo $row[11];?>'  type="number"  onmousewheel="return false;" oninput="if(value.length>2)value=value.slice(0,2)"  onwheel="return false;" class="form-control" placeholder="°C" name="ac_tp_low" required="required"  >
  <span class="input-group-text">～</span>
  <input value='<? echo $row[12];?>'  type="number"  onmousewheel="return false;"  oninput="if(value.length>2)value=value.slice(0,2)" onwheel="return false;" class="form-control" placeholder="°C" name="ac_tp_high"  required="required" >
</div>
  
  
  </div>
  
  
  
  
  
    
    <div class="mb-3"><label  class="form-label"><font color="red">*</font>是否帶人進宿舍？</label>
<br>
<div class="form-check form-check-inline" >
  <input<? if($row[15]===(string)0){ echo " checked ";}?> class="form-check-input" type="radio" name="bring" id="bring0" value="0" required="required" >
  <label class="form-check-label" for="bring0">不帶</label>
</div>


<div class="form-check form-check-inline" >
  <input <? if($row[15]==1){ echo " checked ";}?>class="form-check-input" type="radio" name="bring"  id="bring1" value="1">
  <label class="form-check-label" for="bring1">甚少帶</label>
</div>


<div class="form-check form-check-inline" >
  <input <? if($row[15]==2){ echo " checked ";}?>class="form-check-input" type="radio" name="bring"   id="bring2" value="2">
  <label class="form-check-label" for="bring2">偶爾帶</label>
</div>


<div class="form-check form-check-inline" >
  <input <? if($row[15]==3){ echo " checked ";}?>class="form-check-input" type="radio" name="bring"  id="bring3"  value="3">
  <label class="form-check-label" for="bring3">經常帶</label>
</div>
</div>
  
  
  
  
    
    <div class="mb-3"><label class="form-label"><font color="red">*</font>是否在宿舍打電話？</label>
<br>
<div class="form-check form-check-inline" >
  <input <? if($row[19]===(string)0){ echo " checked ";}?>class="form-check-input" type="radio" name="call" id="call0" value="0" required="required" >
  <label class="form-check-label" for="call0">不打</label>
</div>


<div class="form-check form-check-inline" >
  <input<? if($row[19]==1){ echo " checked ";}?> class="form-check-input" type="radio" name="call"  id="call1" value="1">
  <label class="form-check-label" for="call1">甚少打</label>
</div>


<div class="form-check form-check-inline" >
  <input <? if($row[19]==2){ echo " checked ";}?>class="form-check-input" type="radio" name="call"   id="call2" value="2">
  <label class="form-check-label" for="call2">偶爾打</label>
</div>


<div class="form-check form-check-inline" >
  <input<? if($row[19]==3){ echo " checked ";}?> class="form-check-input" type="radio" name="call"  id="call3"  value="3">
  <label class="form-check-label" for="call3">經常打</label>
</div>
</div>
  
  
  
      <div class="mb-3"><label  class="form-label"><font color="red">*</font>上課日前一晚睡覺時間範圍 (24小時制)</label>

  
  <div class="input-group mb-3">
 <!--xxx--> <input  value='<?  if(isset($row[22])){ echo str_pad($row[22],2,"0",STR_PAD_LEFT) ;}?>'  oninput="if(value.length>2)value=value.slice(0,2)" min="0" max="24" pattern="\d*"    type="number"  onmousewheel="return false;" onwheel="return false;" class="form-control" placeholder="HH" name="monday_HH_s" required="required" >
  <span class="input-group-text">：</span>
  <input  value='<?  if(isset($row[23])){ echo str_pad($row[23],2,"0",STR_PAD_LEFT) ;}?>'  oninput="if(value.length>2)value=value.slice(0,2)"  type="number"  min="0" max="60" pattern="\d*"  onmousewheel="return false;" onwheel="return false;" class="form-control" placeholder="MM" name="monday_MM_s"  required="required" >
  <span class="input-group-text">～</span>
  <input  value='<?  if(isset($row[24])){ echo str_pad($row[24],2,"0",STR_PAD_LEFT) ;}?>' oninput="if(value.length>2)value=value.slice(0,2)"  min="0" max="24" pattern="\d*"   type="number"  onmousewheel="return false;" onwheel="return false;" class="form-control" placeholder="HH" name="monday_HH_e"  required="required" >
  <span class="input-group-text">：</span>
  <input  value='<?  if(isset($row[25])){ echo str_pad($row[25],2,"0",STR_PAD_LEFT) ;}?>'  oninput="if(value.length>2)value=value.slice(0,2)"   type="number"  min="0" max="60" pattern="\d*"  onmousewheel="return false;" onwheel="return false;" class="form-control" placeholder="MM" name="monday_MM_e"  required="required" >
</div>
  
  
  </div>
  
  
  

  
  
      <div class="mb-3"><label  class="form-label"><font color="red">*</font>節假日前一晚睡覺時間範圍 (24小時制)</label>  
  <div class="input-group mb-3 ">
  <input  value='<? if(isset($row[26])){ echo str_pad($row[26],2,"0",STR_PAD_LEFT) ;}?>' type="number" oninput="if(value.length>2)value=value.slice(0,2)"  min="0" max="24" pattern="\d*"   onmousewheel="return false;" onwheel="return false;" class="form-control  " placeholder="HH" name="sunday_HH_s" required="required" >
  
  <span class="input-group-text">：</span>
  <input  value='<?  if(isset($row[27])){ echo str_pad($row[27],2,"0",STR_PAD_LEFT) ;}?>' type="number"  oninput="if(value.length>2)value=value.slice(0,2)"   min="0" max="60" pattern="\d*" onmousewheel="return false;" onwheel="return false;" class="form-control" placeholder="MM" name="sunday_MM_s"  required="required" >
  <span class="input-group-text">～</span>
  <input  value='<?  if(isset($row[28])){ echo str_pad($row[28],2,"0",STR_PAD_LEFT) ;}?>' type="number"  oninput="if(value.length>2)value=value.slice(0,2)" min="0" max="24" pattern="\d*"   onmousewheel="return false;" onwheel="return false;" class="form-control" placeholder="HH" name="sunday_HH_e"  required="required" >
  <span class="input-group-text">：</span>
  <input value='<?  if(isset($row[29])){ echo str_pad($row[29],2,"0",STR_PAD_LEFT) ;}?>'  type="number"  oninput="if(value.length>2)value=value.slice(0,2)"  min="0" max="60" pattern="\d*"  onmousewheel="return false;" onwheel="return false;" class="form-control" placeholder="MM" name="sunday_MM_e"  required="required" >
</div>
  </div>
  
  <div class="mb-3">
 <label  class="form-label"><font color="red">*</font>國籍</label>  
  <input value="<? echo $row[17];?>" type="text"  oninput="if(value.length>87)value=value.slice(0,87)"  class="form-control" placeholder="Country"name="country" required="required" >
</div>
    
   <div class="mb-3">
 <label  class="form-label">留言</label>  
  <textarea type="text" class="form-control" placeholder="Write down more information about you......"  rows="4"  name="comment"><? echo $row[8];?></textarea>
</div>
  
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required="required">
    <label class="form-check-label" for="exampleCheck1"><font color="red">*</font>我確認我輸入的內容不違反善良風俗</label>
  </div>
  <input type="button" onclick="checksmoke()" class="btn btn-primary" value="Submit"/>
  
    <input type="Submit" id="submit-myinfo" style="display:none;" />

  <script>
  function checksmoke(){
  var checkboxes = document.querySelectorAll('input[name="smoke"], input[name="esmoke"]');
  var checked = false;

  checkboxes.forEach(function(checkbox) {
    if (checkbox.checked) {
      checked = true;
    }
  });

  if (checked) {

	document.getElementById("submit-myinfo").click();
  } else {
    alert("未填寫吸菸情況");
  }
}
  </script>
  
</form>


<!--end person-->


</div>
  <div class="tab-pane fade" id="requiretm" role="tabpanel" aria-labelledby="require-tab">
  
  
  <!-- start zenyou--->
  <form action="update-person-info.php" method="post" id="f-requiretm">
  
  
  
  
   
    <div class="mb-3"><label  class="form-label"><font color="red">*</font>是否接受室友吸菸？</label>
<br>
<div class="form-check form-check-inline" onclick="clean_smoke_want()">
  <input<? if($row[14]===(string)0){ echo " checked ";}?>  class="form-check-input" type="radio" name="smoke-want" id="nosmoke-want" value="0">
  <label class="form-check-label" for="nosmoke-want">不接受</label>
</div>

<div class="form-check form-check-inline" onclick="clean_nosmoke_want()">
  <input <? if($row[14]==1||$row[14]==3){ echo " checked ";}?> class="form-check-input" type="checkbox" name="smoke-want"  id="esmoke-want" value="1">
  <label class="form-check-label" for="esmoke-want">吸傳統菸可</label>
</div>

<div class="form-check form-check-inline" onclick="clean_nosmoke_want()">
  <input<? if($row[14]==3||$row[14]==2){ echo " checked ";}?> class="form-check-input" type="checkbox" name="esmoke-want"  id="smoke-want" value="2">
  <label class="form-check-label" for="smoke-want">吸電子菸可</label>
</div>
</div>
  
  
  
  <script>
  function clean_smoke_want(){
 document.getElementById("smoke-want").checked = false;
 document.getElementById("esmoke-want").checked = false;
}
function clean_nosmoke_want(){
document.getElementById("nosmoke-want").checked = false;
}
  </script>
  
  
  
  
    
    <div class="mb-3"><label  class="form-label"><font color="red">*</font>是否接受室友帶人進宿舍？</label>
<br>
<div class="form-check form-check-inline" >
  <input <? if($row[16]===(string)0){ echo " checked ";}?>class="form-check-input" type="radio" name="bring" id="bring0w" value="0" required="required">
  <label class="form-check-label" for="bring0w">不接受</label>
</div>


<div class="form-check form-check-inline" >
  <input <? if($row[16]===(string)1){ echo " checked ";}?> class="form-check-input" type="radio" name="bring"  id="bring1w" value="1">
  <label class="form-check-label" for="bring1w">甚少帶可</label>
</div>


<div class="form-check form-check-inline" >
  <input  <? if($row[16]===(string)2){ echo " checked ";}?>class="form-check-input" type="radio" name="bring"   id="bring2w" value="2">
  <label class="form-check-label" for="bring2w">偶爾帶可</label>
</div>


<div class="form-check form-check-inline" >
  <input <? if($row[16]===(string)3){ echo " checked ";}?> class="form-check-input" type="radio" name="bring"  id="bring3w"  value="3">
  <label class="form-check-label" for="bring3w">經常帶可</label>
</div>
</div>
  
  
  
  
    
    <div class="mb-3"><label  class="form-label"><font color="red">*</font>是否接受在宿舍打電話？</label>
<br>
<div class="form-check form-check-inline" >
  <input  <? if($row[20]===(string)0){ echo " checked ";}?>class="form-check-input" type="radio" name="call" id="call0w" value="0" required="required">
  <label class="form-check-label" for="call0w">不接受</label>
</div>


<div class="form-check form-check-inline" >
  <input <? if($row[20]===(string)1){ echo " checked ";}?>class="form-check-input" type="radio" name="call"  id="call1w" value="1">
  <label class="form-check-label" for="call1w">甚少打可</label>
</div>


<div class="form-check form-check-inline" >
  <input<? if($row[20]===(string)2){ echo " checked ";}?> class="form-check-input" type="radio" name="call"   id="call2w" value="2">
  <label class="form-check-label" for="call2w">偶爾打可</label>
</div>


<div class="form-check form-check-inline" >
  <input<? if($row[20]===(string)3){ echo " checked ";}?> class="form-check-input" type="radio" name="call"  id="call3w"  value="3">
  <label class="form-check-label" for="call3w">經常打可</label>
</div>
</div>
  
    
  <div class="mb-3">
 <label  class="form-label"><font color="red">*</font>希望宿舍內至少有多少人才能開冷氣？</label>  
  <input type="number" value="<? echo $row[10] ?>"  onmousewheel="return false;" oninput="if(value.length>1)value=value.slice(0,1)"  onwheel="return false;" class="form-control" placeholder="Number"name="ac_pp_num" required="required" >
</div>
  
  
      <div class="mb-3"><label  class="form-label"><font color="red">*</font>希望室友在上課日前一晚睡覺時間不超過 (24小時制):</label>
   <div class="col-auto">
    <div class="form-check"  onclick="monday_want_disable()">
      <input class="form-check-input" <? if($row[30]==25){echo " checked ";} ?> type="checkbox" id="monday_anytime_want" name="monday_anytime_want">
      <label class="form-check-label" for="monday_anytime_want" >
任何時候      </label>
    </div>
  </div> 
  
  <div class="input-group mb-3">

      
      
  <input type="number"   <?if($row[30]==25){echo " readOnly ";}else{echo "value='"; if(isset($row[30])){ echo str_pad($row[30],2,"0",STR_PAD_LEFT) ;};echo "'";}?>  min="0" max="24" pattern="\d*" onmousewheel="return false;"  oninput="if(value.length>2)value=value.slice(0,2)" onwheel="return false;" class="form-control" placeholder="HH" id="monday_HH_s_want" name="monday_HH_s_want" required="required">
  <span class="input-group-text">：</span>
  <input type="number" <?if($row[31]==61){echo " readOnly ";}else{echo "value='"; if(isset($row[31])){ echo str_pad($row[31],2,"0",STR_PAD_LEFT) ;};echo "'";}?>   min="0" max="60" pattern="\d*" onmousewheel="return false;" oninput="if(value.length>2)value=value.slice(0,2)"  onwheel="return false;" class="form-control" placeholder="MM" id="monday_MM_e_want" name="monday_MM_e_want"  required="required">
   <span class="col-sm" style="visibility:hidden;"></span>
  <span class="col-sm" style="visibility:hidden;"></span>
</div>
  
  
  </div>

<script>
function monday_want_disable(){


if(document.getElementById("monday_anytime_want").checked===false){

 document.getElementById("monday_HH_s_want").value = "";
 document.getElementById("monday_MM_e_want").value = "";
document.getElementById("monday_HH_s_want").readOnly = false;
 document.getElementById("monday_MM_e_want").readOnly = false;
}else{ 

 document.getElementById("monday_HH_s_want").value = "HH";
 document.getElementById("monday_MM_e_want").value = "MM";

 document.getElementById("monday_HH_s_want").readOnly = true;
 document.getElementById("monday_MM_e_want").readOnly = true;
 }}
</script>
  
  
  
  
  
      <div class="mb-3"><label  class="form-label"><font color="red">*</font>希望室友在節假日前一晚睡覺時間不超過 (24小時制):</label>  
   <div class="col-auto">
    <div class="form-check" onclick="sunday_want_disable()">
      <input <? if($row[32]==25){echo " checked ";} ?> class="form-check-input" type="checkbox" id="sunday_anytime_want" name="sunday_anytime_want" >
      <label class="form-check-label" for="sunday_anytime_want">
任何時候      </label>
    </div>
  </div> 
  <div class="input-group mb-3">

  <input <?if($row[32]==25){echo " readOnly ";}else{echo "value='"; if(isset($row[32])){ echo str_pad($row[32],2,"0",STR_PAD_LEFT) ;};echo "'";}?>  type="number"  min="0" max="24" pattern="\d*"  oninput="if(value.length>2)value=value.slice(0,2)"  onmousewheel="return false;" onwheel="return false;" class="form-control" placeholder="HH" name="sunday_HH_s_want" id="sunday_HH_s_want" required="required">
  <span class="input-group-text">：</span>
  <input <?if($row[33]==61){echo " readOnly ";}else{echo "value='"; if(isset($row[33])){ echo str_pad($row[33],2,"0",STR_PAD_LEFT) ;};echo "'";}?>  type="number"  min="0" max="60" pattern="\d*"  oninput="if(value.length>2)value=value.slice(0,2)" onmousewheel="return false;" onwheel="return false;" class="form-control" placeholder="MM" name="sunday_MM_e_want"  id="sunday_MM_e_want"  required="required">
  <span class="col-sm" style="visibility:hidden;"></span>
  <span class="col-sm" style="visibility:hidden;"></span>

</div>
  </div>
  
<script>
function sunday_want_disable(){


if(document.getElementById("sunday_anytime_want").checked===false){
document.getElementById("sunday_HH_s_want").readOnly = false;
 document.getElementById("sunday_MM_e_want").readOnly = false;
 document.getElementById("sunday_HH_s_want").value = "";
 document.getElementById("sunday_MM_e_want").value = "";
}else{ 

 document.getElementById("sunday_HH_s_want").value = "HH";
 document.getElementById("sunday_MM_e_want").value = "MM";
 document.getElementById("sunday_HH_s_want").readOnly = true;
 document.getElementById("sunday_MM_e_want").readOnly = true;
 }}
</script>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <div class="mb-3">
 <label  class="form-label"><font color="red">*</font>接受室友國籍</label>  
  <input value="<? echo $row[18] ?>" type="text" oninput="if(value.length>87)value=value.slice(0,87)" class="form-control" placeholder="Country"name="country" required="required">
</div>

  
  <div class="mb-3 form-check">
    <input type="checkbox"  class="form-check-input" id="exampleCheck12"  required="required">
    <label class="form-check-label" for="exampleCheck12"><font color="red">*</font>我確認我輸入的內容不違反善良風俗</label>
  </div>
  <input type="button" onclick="checksmoke_want()" class="btn btn-primary" value="Submit"/>
  	    <input type="Submit" id="submit-wanttm" style="display:none;" />

</form>


  <script>
  function checksmoke_want(){
  var checkboxes = document.querySelectorAll('input[name="smoke-want"], input[name="esmoke-want"]');
  var checked = false;

  checkboxes.forEach(function(checkbox) {
    if (checkbox.checked) {
      checked = true;
    }
  });

  if (checked) {

	document.getElementById("submit-wanttm").click(); 
	} else {
    alert("未填寫希望室友吸菸情況");
  }
}
  </script>
  
<!--end zenyou-->


  
  
  
  
  </div>
  <div class="tab-pane fade<?  if($tmpage==1){echo "  show active  ";}?>" id="profile" role="tabpanel" aria-labelledby="team-tab">
      <!-- 隊友 start -->
      
      <br>
      
      <?
      
      		
	$sql_query= "select t_id from student where s_id='".$_SESSION["name"]."'";
	$result=mysqli_query($link,$sql_query);

 
	
$row =mysqli_fetch_array($result);		



$teamid=$row[0];
echo"<p>隊伍編號：",$teamid,"</p>";

//獲取該學生的隊伍id

	$sql_tm= "select ig_us,discord_us,tg_us,line_id,masked_id from student where t_id='".$teamid."'";
	$result_tm=mysqli_query($link,$sql_tm);
$teammate_num=mysqli_num_rows($result_tm);
$i=1;
while($row =mysqli_fetch_array($result_tm)){
   
      
      
      
      
      
      
      echo '
<table class="table table-bordered  table-sm" style="text-align:center;">
<tr >
<th width="22%" rowspan=4>隊友'.$i.'：<br>'.$row['masked_id'].' </th>



<td width="33%">Line</td>
<td width="33%">'.$row[3].'</td>

</tr>
<tr>
<td >Discord</td>
<td >'.$row[1].'</td>
</tr>

<tr>
<td >Telegram</td>
<td >'.$row[2].'</td>
</tr>
<tr>
<td >Instagram</td>
<td >'.$row[0].'</td>
</tr>




</table>';
    $i++;
}





if( $i>2){
    echo '<a href="leave_team_do.php"><button type="button" class="btn btn-danger">離開隊伍</button></a>';
};
?>
<!-----隊友end--->
      
      
      
      
      
      
      
      
      
  </div>
  <div class="tab-pane fade " id="contact" role="tabpanel" aria-labelledby="pw-tab">
  <form id="changepwform" action="update-person-pw.php" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">原密碼</label>
    <input type="password" class="form-control" id="oldpw" >
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">新密碼（大於5位）</label>
    <input type="password" class="form-control" id="newpw">
  </div>
   <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">重複輸入新密碼</label>
    <input type="password" class="form-control" id="newpw2">
  </div>
  
  
    <button type="button" onclick="changepw(event)" class="btn btn-primary">Check Equality</button>
</form>
  </div>
</div>






  <script>
    function changepw(event) {  event.preventDefault();

      var input1Value = document.getElementById('newpw').value;
      var input2Value = document.getElementById('newpw2').value;

      if (input1Value != input2Value) {        
        alert('兩次密碼輸入不相符！');

      } else {
	   if (input1Value.length >= 6) {
		        document.getElementById('changepwform').submit();
      } else {
        alert('密碼長度需要大於5！');
      }

      }
    }
  </script>







   </main>	<? include("footer.htm");?>	