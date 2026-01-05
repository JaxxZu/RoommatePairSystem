<? 

function maskid($stdid){
$first = strtoupper(substr($stdid, 0, 1));
$stdid = strrev(substr($stdid, 1));

switch ($first) {
    case 'B':
        $stdid+=date('y')+24;
        break;
    case 'F':
        $stdid+=date('y')+32;
        break;
    case 'M':
        $stdid+=date('y')+13;
        break;
    case 'D':
        $stdid+=date('y')+24;
        break;
    case 'L':
        $stdid+=date('y')+35;
        break;
    case 'J':
        $stdid+=date('y')+36;
        break;
    case 'K':
        $stdid+=date('y')+17;
        break;
    case 'E':
        $stdid+=date('y')+28;
        break;
    case 'W':
        $stdid+=date('y')+19;
        break;
    case 'A':
        $stdid+=date('y')+30;
        break;
    default:
        $stdid+=date('y')+55;
        break;
}




$tran= base_convert(base_convert($stdid, 11, 8)+date('y'), 23, 33);


echo $tran,"<br>";}



maskid("B1115531");
maskid("B1115532");
maskid("B1115533");
maskid("B1115534");







