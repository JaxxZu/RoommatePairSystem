<? include("header.php");	







if(isset($_POST['is_e'])){
    //更新個人資料
    
    //0:不吸 1：傳統 2:電子 3:都吸
    if(isset($_POST['smoke'])){
        
        if($_POST['smoke']==0){$smk=0; }else if (isset($_POST['esmoke'])){$smk=3;}else{$smk=1;}}else{ $smk=2;}

      $sql_qry="UPDATE `student` SET `line_id`='".$_POST['line']."' ,`tg_us`='".$_POST['tg']."',`ig_us`='".$_POST['ig']."',`discord_us`='".$_POST['dc']."',`email`='".$_POST['email']."' ,`is_e`='".$_POST['is_e']."' ,`is_smoke`='".$smk."',`ac_temp_low`='".$_POST['ac_tp_low']."' ,`ac_temp_high`='".$_POST['ac_tp_high']."' ,`is_bring_people`='".$_POST['bring']."' ,`phone_call`='".$_POST['call']."' ,`country`='".$_POST['country']."' ,`self_intro`='".$_POST['comment']."' ,`monday_HH_s`='".$_POST['monday_HH_s']."' ,`monday_MM_s`='".$_POST['monday_MM_s']."' ,`monday_HH_e`='".$_POST['monday_HH_e']."' ,`monday_MM_e`='".$_POST['monday_MM_e']."' ,`sunday_HH_s`='". $_POST['sunday_HH_s']."' ,`sunday_MM_s`='".$_POST['sunday_MM_s']."' ,`sunday_HH_e`='".$_POST['sunday_HH_e']."' ,`sunday_MM_e`='".$_POST['sunday_MM_e']."'  WHERE `student`.`s_id`='".$_SESSION["name"]."'";
      
      
     $result = mysqli_query($link, $sql_qry);

     
      if ($result === false) {
            echo "Error executing query: "
            //. mysqli_error($link)
            ;
                  echo "<br>參數（回報錯誤附帶此內容）：<br>".$sql_qry."<br><br>";
                  exit;

        }else {
            echo "success update";
                   header("Location: /myinfo.php?update=1");

            exit;
        }

        exit();
    
    
    
    
    
   
    
    
    	
}else if(isset($_POST['call'])){
    //更新徵友要求
       if(isset($_POST['smoke-want'])){
        
        if($_POST['smoke-want']==0){ 
            $smkw=0;
            
        }else if (isset($_POST['esmoke-want'])){
            $smkw=3;
        }else{
            $smkw=1;
        }
        
        
    }else{
        $smkw=2;
    }


if(isset($_POST['monday_anytime_want'])){
$md_h=25;
$md_m=61;
}else{
$md_h=$_POST['monday_HH_s_want'];
$md_m=  $_POST['monday_MM_e_want'];
}


if(isset($_POST['sunday_anytime_want'])){
$sd_h=25;
$sd_m=61;
}else{
$sd_h=$_POST['sunday_HH_s_want'];
$sd_m=  $_POST['sunday_MM_e_want'];
}


      $sql_qry="UPDATE `student` SET `want_smoke`='".$smkw."'  
      ,`monday_HH_s_want`='".$md_h."'
      ,`monday_MM_e_want`='".$md_m."'
      ,`sunday_HH_s_want`='".$sd_h."'
      ,`sunday_MM_e_want`='".$sd_m."'
      ,`want_phone_call`='".$_POST['call']."'
      ,`want_country`='".$_POST['country']."'
      ,`turn_on_ac`='".$_POST['ac_pp_num']."'
      
      ,`want_bring_people`='".$_POST['bring']."' WHERE `student`.`s_id`='".$_SESSION["name"]."'";
      
      
     $result = mysqli_query($link, $sql_qry);

    // echo $result;
      if ($result === false) {
            echo "Error executing query: "
            //. mysqli_error($link)
            ;
                  echo "<br>參數（回報錯誤附帶此內容）：<br>".$sql_qry."<br><br>";
                  exit;

        }else {
            echo "success update";
                   header("Location: /myinfo.php?update=2");

            exit;
        }


    
}                       header("Location: /myinfo.php#come-from-update-proson-info-without-參數");exit();

