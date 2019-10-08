<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
/*
code-100
locality_from-МОСКВА
locality_to-САНКТ-ПЕТЕРБУРГ
city_from-
city_to-
region_from-МОСКВА
region_to-САНКТ-ПЕТЕРБУРГ
simple_letter-0
reg_letter-0
val_letter-0
simple_parcel-85
reg_parcel-111
val_parcel-171.67
pkg-319 // обычный
ems-470.08 //курьерский
letter_reg_1class-155
letter_val_1class-250
reg_parcel1class-180
val_parcel1class-250
pkg_1class-252
pkg_val_1class-342
cod-2170

//https://postprice.ru/user/integration/
oswindows@bk.ru
1 token: 1011481c535583e32926c5b3b573116a412c7c98

*/

$_POST['index1'];
$_POST['index2'];
$_POST['massa'];
$_POST['sum_p'];




$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://postprice.ru/engine/russia/api.php?from=101000&to=355000&mass=250&valuation=750");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch); 
curl_close($ch); 
$arr = (array) json_decode($result,true);
foreach ($arr as $k=>$v){
    echo $k."-".$v."<br>"; // etc.
	$js[$k]=$v;
}
echo $js['code'];


?>