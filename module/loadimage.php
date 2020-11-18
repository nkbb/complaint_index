<?

include "filedn.php";
//$defaultimg = "../img/noimage.gif";
$expnoimg = "../upload/profile/".$pf."_".$m.".jpg";
$defaultimg = "../upload/profile/0_".$m.".jpg";

if(file_exists($expnoimg))$defaultimg = $expnoimg;
file_transact($url, "image/jpeg",$defaultimg);
?>

