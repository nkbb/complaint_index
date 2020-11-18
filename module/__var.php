<?

$pd = $_POST;
$gd = $_GET;
$sd = $_SERVER;
$_IP = $sd[REMOTE_ADDR];
$uind = $gd[uind];
$fuind = $gd[fuind];
$req = new request();

$self = $_SERVER[PHP_SELF];
$db = new dbmysql($dbuser,$dbpassword ,$dbname);
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"'); 
?>