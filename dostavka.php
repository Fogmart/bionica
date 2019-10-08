<?
error_reporting(E_ALL);
ini_set("display_errors", 1);
//подключаем файл с классом CalculatePriceDeliveryCdek
include_once("CalculatePriceDeliveryCdek.php");
try {

////////////////////////////////////////////////////////
//////////           CDEK            ///////////////////
////////////////////////////////////////////////////////

// 136 Посылка склад-склад (только для Интернет-магазинов) До 30 кг. 
// 137 Посылка склад-дверь (только для Интернет-магазинов) До 30 кг. 
// 233 Экономичная посылка склад-дверь (только для Интернет-магазинов) до 50 кг
// 234 Экономичная посылка склад-склад (только для Интернет-магазинов) до 50 кг. 

// 10 склад-склад До 30 кг. 
// 11 склад-дверь До 30 кг.
// 15 склад-склад От 30 кг. 
// 16 склад-дверь От 30 кг. 

// 										 modeId modeId
/*
1. дверь-дверь (Д-Д) — Курьер забирает груз у отправителя и доставляет получателю на указанный адрес.
2. дверь-склад (Д-С) — Курьер забирает груз у отправителя и довозит до склада, получатель забирает груз самостоятельно в ПВЗ (самозабор).
3. склад-дверь (С-Д) — Отправитель доставляет груз самостоятельно до склада, курьер доставляет получателю на указанный адрес.
4. склад-склад (С-С) — Отправитель доставляет груз самостоятельно до склада, получатель забирает груз самостоятельно в ПВЗ (самозабор).

*/

/*	Логин сдек				*/	$authLoginString = "ucuMEqqwacdJkXYAqNdyBQQ1m3dzhGPx";
/*	Пароль сдек				*/	$passwordString = "pyRiAOTUG0GbYr0lDGudg9Wy0uLRBROn";
/*	Индекс отправителя		*/	$senderCityId = $_POST['index1'];
/*	Индекс получателя		*/	$receiverCityId = $_POST['index2'];
/*	~ сроки отправки 4 дня	*/	$dateExecute = Date('y:m:d', strtotime("+4 days"));
/*	Тариф по умолчанию		*/	$setTariffId = "136";
/*	1 Тариф					*/	$tariffList1 = "136";
/*	2 Тариф					*/	$tariffList2 = "137";
/*	режим доставки			*/	$modeId = "4";		//modeId режим доставки, склад-дверь value="3"
/*	ширина					*/	$width = 7; //см
/*	длина					*/	$length = 12; //см
/*	высота					*/	$height = 1; //см
/*	масса					*/	$massa = 300; //грамм

/*	масса					*/	$weight = $massa/1000; //кг
/*	обьем					*/	$volume = ($width/100)*($length/100)*($height/100); //м3

	//создаём экземпляр объекта CalculatePriceDeliveryCdek
	$calc = new CalculatePriceDeliveryCdek();
	
    //Авторизация. Для получения логина/пароля (в т.ч. тестового) обратитесь к разработчикам СДЭК -->
    if(strlen($authLoginString)>0) //если указан логин
    if(strlen($passwordString)>0)  //если указан пароль
		$calc->setAuth($authLoginString, $passwordString); // проводим аутентификацию
	
	//устанавливаем город-отправитель
	$calc->setSenderCityId($senderCityId);
	//устанавливаем город-получатель
	$calc->setReceiverCityId($receiverCityId);
	//устанавливаем дату планируемой отправки
	$calc->setDateExecute($dateExecute);
	
	//задаём список тарифов с приоритетами
    if(strlen($tariffList1)>0)$calc->addTariffPriority($tariffList1);
    if(strlen($tariffList2)>0)$calc->addTariffPriority($tariffList2);
	
	//устанавливаем тариф по-умолчанию
	if(strlen($setTariffId)>0) //если указан Тариф по умолчанию
	$calc->setTariffId($setTariffId);
		
	//устанавливаем режим доставки
	if(strlen($modeId)>0)$calc->setModeDeliveryId($modeId);
	//добавляем места в отправление
	//$calc->addGoodsItemBySize($_REQUEST['weight1'], $_REQUEST['length1'], $_REQUEST['width1'], $_REQUEST['height1']);
	$calc->addGoodsItemByVolume($weight, $volume);
	
	if ($calc->calculate() === true) {
		$CDEKres = $calc->getResult();
		
		//echo 'Цена доставки: ' . $CDEKres['result']['price'] . 'руб.<br />';
		//echo 'Срок доставки: ' . $CDEKres['result']['deliveryPeriodMin'] . '-' . 
								 //$CDEKres['result']['deliveryPeriodMax'] . ' дн.<br />';
		//echo 'Планируемая дата доставки: c ' . $CDEKres['result']['deliveryDateMin'] . ' по ' . $CDEKres['result']['deliveryDateMax'] . '.<br />';
		//echo 'id тарифа, по которому произведён расчёт: ' . $CDEKres['result']['tariffId'] . '.<br />';
        if(array_key_exists('cashOnDelivery', $CDEKres['result'])) {
            //echo 'Ограничение оплаты наличными, от (руб): ' . $CDEKres['result']['cashOnDelivery'] . '.<br />';
        }
	} else {
		$err = $calc->getError();
		if( isset($err['error']) && !empty($err) ) {
			//var_dump($err);
			foreach($err['error'] as $e) {
				echo 'Код ошибки: ' . $e['code'] . '.<br />';
				echo 'Текст ошибки: ' . $e['text'] . '.<br />';
			}
		}
	}
    
    //раскомментируйте, чтобы просмотреть исходный ответ сервера
    // var_dump($calc->getResult());
    // var_dump($calc->getError());

} catch (Exception $e) {
    echo 'Ошибка: ' . $e->getMessage() . "<br />";
}



 $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://postprice.ru/engine/russia/api.php?from=".$_POST['index1']."&to=".$_POST['index2']."&mass=".$_POST['massa']."&valuation=".$_POST['sum_p']."");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);
$arr = (array) json_decode($result,true);
foreach ($arr as $k=>$v){
    //echo $k."-".$v."<br>"; // etc.
	$js[$k]=$v;
}
//echo $js['code'];

?>

<p style="border:1px dotted red;">
    <label>
        <input type="radio" name="dostavka" onclick="dostavkaadd('Курьер по г. Ставрополь','<?echo $js['locality_to'];?>','<?echo $_POST['massa'];?>','200');" id="dostavka" value="200">
        <img src="images/icons/kur.png" style="height: 40px;"/>Курьером по г.Ставрополь (200 р.)</br>
    </label>
</p>
</br>

<p style="border:1px dotted red;">
	<label>
		<input type="radio" name="dostavka" onclick="dostavkaadd('<?echo $js['locality_from'];?>','<?echo $js['locality_to'];?>','<?echo $_POST['massa'];?>','<?echo $js['pkg'];?>');" id="dostavka" value="<?echo $js['pkg'];?>">
		<img src="images/icons/ptr.png" style="height: 40px;"/>Почта России (<?echo $js['pkg'];?> р.)</br><i><?echo $js['locality_from'];?>-<?echo $js['locality_to'];?></i>
	</label>
</p>
</br>
<p style="border:1px dotted red;">
	<label>
		<input type="radio" name="dostavka" onclick="dostavkaadd('<?echo $js['locality_from'];?>','<?echo $js['locality_to'];?>','<?echo $_POST['massa'];?>','<?echo ($js['ems']+20);?>');" id="dostavka" value="<?echo ($js['ems']+20);?>">
        <img src="images/icons/ems.png" style="height: 40px;"/>Почта России EMS (<?echo ($js['ems']+20);?> р.)</br><i><?echo $js['locality_from'];?>-<?echo $js['locality_to'];?></i>
	</label>
</p>
</br>
<?if (!($CDEKres['result']))
{
	goto nocdek;
}?>
<p style="border:1px dotted red;">
	<label>
		<input type="radio" name="dostavka" onclick="dostavkaadd('<?echo $js['locality_from'];?>','<?echo $js['locality_to'];?>','<?echo $_POST['massa'];?>','<?echo ($CDEKres['result']['price']);?>');" id="dostavka" value="<?echo ($CDEKres['result']['price']);?>">
        <img src="images/icons/cdek.png" style="height: 40px;"/>CDEK (<?echo ($CDEKres['result']['price']);?> р.)</br><i><?echo $js['locality_from'];?>-<?echo $js['locality_to'];?> ( <?echo $CDEKres['result']['deliveryPeriodMin'] . '-' . $CDEKres['result']['deliveryPeriodMax'] . ' дн.'?> ) </i>
	</label>
</p>
<?
nocdek:
?>
<script>
function dostavkaadd(city1,city2,massa,sum){
	var url="dostavkaadd.php";
	var metod="POST";
	var index1="<? echo $_POST['index1'];?>";

	var post={city1:city1 ,city2:city2 ,massa:massa ,sum:sum};

	$.ajax({
		type: metod,
		url: url,
		data: post
	}).done(function( result )
		{
			//$("#dostavkahtml1").html( result );
		});

}
</script>
