<? include_once "../../app/core/common.php";

//echo '??';
// echo $_SERVER['HTTP_HOST']."vision/include/app/core/common.php";
// echo "https://sugarfish.co.kr/vision/church/";

$WHERE = "AND category='$_POST[category]'";
if($_POST['category'] == 'C'){
    $WHERE = '';
}
if($_POST['way'] === 'S'){
    $WHERE .= "AND (name LIKE '%$_POST[search]%' OR  tmp1 LIKE '%$_POST[search]%')";
}else if($_POST['way'] === 'L'){
    $a = explode(' ', $_POST['search']);
    $WHERE .= "AND tmp1 LIKE '%$a[0]%'";
    $WHERE .= "AND tmp1 LIKE '%$a[1]%'";
    $WHERE .= $a[2]? "AND tmp1 LIKE '%$a[2]%'" : '';
}

$rs = Queryi("SELECT * FROM vision_board_church WHERE is_delete='N' $WHERE ORDER BY name ");
//print_r($rs);
$resultJson = json_encode($rs);
echo urldecode($resultJson);
//echo urldecode("SELECT * FROM vision_board_church WHERE is_delete='N' $WHERE");
?>