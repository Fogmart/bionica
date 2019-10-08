<?
if($_SESSION['admin']!=1)
exit;

if(!( isset($_SESSION['admin']) && isset($_SESSION['store']) && isset($_SESSION['direct']) && isset($_SESSION['call'])))
						{

							$_SESSION['user']="Доступ закрыт";
							unset($_SESSION['pass']);
							unset($_SESSION['id']);
							unset($_SESSION['email']);
									unset($_SESSION['admin']);
									unset($_SESSION['store']);
									unset($_SESSION['direct']);
									unset($_SESSION['call']);
									unset($_SESSION['tel']);
									unset($_SESSION['full_adres']);
									exit;
						}


	
$tovar 		= 'SELECT * FROM `tovar` WHERE id'; 
$data_tovar  	= $mysqli->query($tovar );
$row_tovar  	= $data_tovar ->num_rows;
while($res_tovar  = $data_tovar ->fetch_assoc())
	{
			$fact_all+=((int)$res_tovar['dost']+(int)$res_tovar['bron']);
			$money_p_all+=((int)$res_tovar['dost']+(int)$res_tovar['bron']+(int)$res_tovar['kup'])*$res_tovar['sum_z'];
			//$prosm_all+=$res_tovar['prosmo'];
			//$bron_all+=$res_tovar['bron'];
			$kup_all+=$res_tovar['kup'];
			if($res_tovar['kup']>0)$row_kup++;
			$sum_p_all+=$res_tovar['sum_p']*($res_tovar['dost']+$res_tovar['bron']+$res_tovar['kup']);
			$sum_z_all+=$res_tovar['sum_z']*($res_tovar['dost']+$res_tovar['bron']+$res_tovar['kup']);
	}	

$shopping_sql ='SELECT *  FROM `shopping` GROUP BY `session_id`;';
$shopping_data = $mysqli->query($shopping_sql);
$bron_all = $shopping_data->num_rows;	


$people = 'SELECT * FROM `users` WHERE `admin`="0" AND `store`="0" AND `direct`="0" AND `call`="0"';
				$people_data = $mysqli->query($people);
				$people_row = $people_data->num_rows;

				
$posetitely_sql ='SELECT DISTINCT `session` FROM `visit`;';
				$posetitely_data = $mysqli->query($posetitely_sql);
				$posetitely = $posetitely_data->num_rows;

$posetitely_sql ='SELECT * FROM `visit` WHERE `id`;';
				$posetitely_data = $mysqli->query($posetitely_sql);
				$prosm_all = $posetitely_data->num_rows;


			
$konversi	=	($kup_all / $prosm_all)	*	100;


				
//$posetitely=1000;

$sred_stoim=((int)$sum_p_all/((int)$fact_all+(int)$kup_all));

if ($sum_z_all>0) if ($sum_p_all>0)$sred_nacenka=number_format(((($sum_p_all/$sum_z_all)-1)*100), 0, '.','');//25;//из бд				


$sql = 'SELECT * FROM `kassa` WHERE `id`=1';
$kassa = $mysqli->query($sql);
if($kassa_row = $kassa->num_rows)$kassa_res = $kassa->fetch_assoc();



//$dohod=1500;//из бд
$dohod=$kassa_res['from'];
//$rashod=1209;//из бд
$rashod=$kassa_res['name'];
$other_rashod=((int)$rashod/100*6);
$pribil=$dohod-$rashod-$other_rashod;
				
//////////////////предсказания				


$vprod=number_format($prosm_all/100*$konversi, 0, '.',''); //продаж возможно
if($vprod>((int)$fact_all+(int)$kup_all)){$vprod2=((int)$fact_all+(int)$kup_all); }
else {$vprod2=$vprod; $vprod=((int)$fact_all+(int)$kup_all);}


$vdohod=number_format($vprod2*$sred_stoim+$sred_stoim/100*$sred_nacenka*$vprod2, 0, '.',''); //доход возможный


$vrasho=number_format($vprod2*$sred_stoim, 0, '.',''); // расход возможный


$vrasho_other=number_format(($vdohod/100*6), 0, '.',''); //налог возможный

$v2vpibl=number_format(( ( $vprod2 * ( $sred_nacenka * ( $sred_stoim / 100 ) ) )-$vrasho_other), 0, '.',''); //; //месячная прибыль возможно
if($v2vpibl>0)$v2okup= number_format($vrasho/$v2vpibl, 0, '.',''); //; окупаемость возможная
if($v2vpibl>0)$v2rentab=	number_format((( $v2vpibl / ( $vprod2 * ( $sred_stoim + ( $sred_nacenka *  $sred_stoim / 100  ) ) ) ) * 100), 2, '.',''); // рентабельность возможная


//реальные
$PRIBL=	number_format(((int)$dohod-(int)$rashod-(int)$other_rashod), 0, '.',''); //месячная прибыль
$OKUP=	number_format($rashod/$PRIBL, 0, '.',''); //окупаемость
$RENT=	number_format(( $PRIBL/((int)$dohod/100) ), 2, '.',''); //рентабельность

?>
<script src="jsg/core.js"></script>
<script src="jsg/charts.js"></script>
<script src="jsg/animated.js"></script>
<style>
#chartdivcont {
  width: 20%;
  min-width:200px;	
  border: 0px solid black;
 
  float:left;
  height:260px;
  margin-left:1px;
  margin-right:1px;
}
#chartdivcont2 {
  width: 58%;
  min-width:400px;
	height:260px;
  border: 0px solid black;
  
  float:left;
   margin-left:1px;
  margin-right:1px;
}
#chartdivtitle {
	padding-top:5px;
	width:100%
	height: 20px;
	text-align:center;
}
#chartdiv {
  width: 100%;
  min-width:200px;
  height: 200px;
  margin:2px;
}
#chartdiv1 {
  width: 100%;
  min-width:200px;
  height: 200px;
  margin:2px;
}
#chartdiv2 {
  width: 100%;
  min-width:200px;
  height: 100%;
  margin:2px;
}
#chartdiv5 {
  width: 100%;
  min-width:200px;
  height: 100%;
  margin:2px;
}
#chartdiv3 {
  width: 100%;
  min-width:200px;
  height: 200px;
  margin:2px;
}
#chartdiv4 {
  width: 100%;
  min-width:200px;
  height: 200px;
  margin:2px;
}
#kl{
 height:18px;
 width:25%;
 padding: 2px;
}
</style>
<div style="border:1px solid black;">
<div style="height:40px; width:50%; float:left;">
 <a target="_blank" href="/Modules/Mapuser.php">
	<input type="submit" value="Карта посещения" style="height:40px; float:left;"/></a>
</div>
<div style="height:40px; width:50%; float:right;">
<a target="_blank" href="/Modules/Mapbot.php">
	<input type="submit" value="Поисковые боты" style="height:40px; float:right;"/></a>
</div>
</div>
<div style="border:1px solid black;">
<div id="chartdivtitle"><font style="font-size:18px;">Реальные показатели</font></div>
<div id="chartdivcont">
	<div id="chartdivtitle">Конверсия :<?echo number_format($konversi, 2, '.','')."%";?></div>
	<div id="chartdiv"></div>	
	<div id="chartdivtitle">
		<font id="kl" style="background:#67b7dc;color:#fff;"> плохо </font>
		<font id="kl" style="background:#6771dc;color:#fff;"> хорошо </font>
		<font id="kl" style="background:#a367dc;color:#fff;"> отлично </font>
		<p></p>
	</div>
	<div id="chartdivtitle"></div>
</div>
<div id="chartdivcont">
	<div id="chartdivtitle">Рентабельность: <?echo number_format($RENT, 2, '.','')."%";?></div>
	<div id="chartdiv1"></div>	
	<div id="chartdivtitle">
		<font id="kl" style="background:#dc6967;color:#fff;"> дешево </font>
		<font id="kl" style="background:#67dc75;color:#fff;"> норма </font>
		<font id="kl" style="background:#dc6967;color:#fff;"> дорого </font>
		<p></p>
	</div>
	<div id="chartdivtitle"></div>
</div>
<div id="chartdivcont2">
	<div id="chartdivtitle">Реальные показатели (продаж: <?echo $kup_all;?>)</div>
	<div id="chartdiv2"></div>	
</div>
</div>

<!--------------------------------------------------------------------------------------------------->


<div style="border:1px solid black; margin-top:10px;">
<div id="chartdivtitle"><font style="font-size:18px;">Возможные показатели</font></div>
<div id="chartdivcont">
	<div id="chartdivtitle">Конверсия :<?echo number_format($konversi, 2, '.','')."%";?></div>
	<div id="chartdiv3"></div>	
	<div id="chartdivtitle">
		<font id="kl" style="background:#67b7dc;color:#fff;"> плохо </font>
		<font id="kl" style="background:#6771dc;color:#fff;"> хорошо </font>
		<font id="kl" style="background:#a367dc;color:#fff;"> отлично </font>
		<p></p>
	</div>
	<div id="chartdivtitle"></div>
</div>
<div id="chartdivcont">
	<div id="chartdivtitle">Рентабельность :<?echo number_format($v2rentab, 2, '.','')."%";?></div>
	<div id="chartdiv4"></div>	
	<div id="chartdivtitle">
		<font id="kl" style="background:#dc6967;color:#fff;"> дешево </font>
		<font id="kl" style="background:#67dc75;color:#fff;"> норма </font>
		<font id="kl" style="background:#dc6967;color:#fff;"> дорого </font>
		<p></p>
	</div>
	<div id="chartdivtitle"></div>
</div>

<div id="chartdivcont2">
	<div id="chartdivtitle">Возможные цифры (продаж: ~(<?echo $vprod;?>-<?echo $vprod2;?>)) наценка(<?echo $sred_nacenka;?>%)</div>
	<div id="chartdiv5"></div>	
</div>
</div>
<div style="border:1px solid black; margin-top:10px;">
	<div id="chartdivtitle"><font style="font-size:18px;">***</font></div>
	<div id="chartdivcont" style="width: 24.5%; min-width:150px; height:100px;">
		<div id="chartdivtitle">Окупаемость</div>
		<div style="text-align: center;height: 80%;">
		<?echo $v2okup." мес. - ".$OKUP;?> мес.
		</div>
		<div id="chartdivtitle"></div>
	</div>
	<div id="chartdivcont" style="width: 24.5%; min-width:150px; height:100px;">
		<div id="chartdivtitle">Продажи</div>
		<div style="text-align: center;height: 80%;">
		<?echo $kup_all." шт. из ".((int)$fact_all+(int)$kup_all);?> шт.	
		</div>
		<div id="chartdivtitle"></div>
	</div>
	<div id="chartdivcont" style="width: 24.5%; min-width:150px; height:100px;">
		<div id="chartdivtitle">В ожидании</div>
		<div style="text-align: center;height: 80%;">
		<?echo $bron_all;?> заказ <br> В наличии: <?echo $fact_all;?> наим.
		</div>
		<div id="chartdivtitle"></div>
	</div>
	<div id="chartdivcont" style="width: 24.5%; min-width:150px; height:100px;">
		<div id="chartdivtitle">Люди</div>
		<div style="text-align: center;height: 80%;">
		<?echo "посетителей: ".$posetitely." <br>пользователей: ".$people_row." <br>просмотров: ".$prosm_all;?> 
		</div>
		<div id="chartdivtitle"></div>
	</div>
</div>




<script>
/**
 * ---------------------------------------
 * This demo was created using amCharts 4.
 * 
 * For more information visit:
 * https://www.amcharts.com/
 * 
 * Documentation is available at:
 * https://www.amcharts.com/docs/v4/
 * ---------------------------------------
 */
graph1(<?echo number_format($konversi, 2, '.','');?>,"chartdiv",0.5,15,30,0,2,4);
graph1(<?echo number_format($konversi, 2, '.','');?>,"chartdiv3",0.5,15,30,0,2,4);
graph1(<?echo $RENT;?>,"chartdiv1",4,15,100,9,16,9);
graph1(<?echo $v2rentab;?>,"chartdiv4",4,15,100,9,16,9);

function graph1(znach,name,min,norm,hard,c1,c2,c3){ 
// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// create chart
var chart = am4core.create(name, am4charts.GaugeChart);
chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

chart.innerRadius = -25;

var axis = chart.xAxes.push(new am4charts.ValueAxis());
axis.min = 0;
axis.max=znach+5;

axis.strictMinMax = true;
axis.renderer.grid.template.stroke = new am4core.InterfaceColorSet().getFor("background");
axis.renderer.grid.template.strokeOpacity = 0.3;

var colorSet = new am4core.ColorSet();

var range0 = axis.axisRanges.create();
range0.value = 0;
range0.endValue = min;
range0.axisFill.fillOpacity = 1;
range0.axisFill.fill = colorSet.getIndex(c1);
range0.axisFill.zIndex = - 1;

var range1 = axis.axisRanges.create();
range1.value = min;
range1.endValue = norm;
range1.axisFill.fillOpacity = 1;
range1.axisFill.fill = colorSet.getIndex(c2);
range1.axisFill.zIndex = -1;

var range2 = axis.axisRanges.create();
range2.value = norm;
range2.endValue = hard;
range2.axisFill.fillOpacity = 1;
range2.axisFill.fill = colorSet.getIndex(c3);
range2.axisFill.zIndex = -1;

var range3 = axis.axisRanges.create();
range3.value = hard;
range3.endValue = 100;
range3.axisFill.fillOpacity = 1;
range3.axisFill.fill = colorSet.getIndex(c1);
range3.axisFill.zIndex = -1;

var hand = chart.hands.push(new am4charts.ClockHand());

// using chart.setTimeout method as the timeout will be disposed together with a chart
chart.setTimeout(randomValue, 2000);

function randomValue() {
    hand.showValue(znach, 1000, am4core.ease.cubicOut);
    chart.setTimeout(randomValue, 2000);
}
}
</script>
<script>
status("chartdiv2",<?echo $dohod;?>,<?echo $rashod;?>,<?echo $other_rashod;?>);
status("chartdiv5",<?echo $vdohod;?>,<?echo $vrasho;?>,<?echo $vrasho_other;?>);
function status(name,dohod,rash,other){
/**
 * ---------------------------------------
 * This demo was created using amCharts 4.
 * 
 * For more information visit:
 * https://www.amcharts.com/
 * 
 * Documentation is available at:
 * https://www.amcharts.com/docs/v4/
 * ---------------------------------------
 */

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create(name, am4charts.XYChart);
chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

// using math in the data instead of final values just to illustrate the idea of Waterfall chart
// a separate data field for step series is added because we don't need last step (notice, the last data item doesn't have stepValue)
chart.data = [ {
  category: "Доход\n"+dohod,
  value: dohod,
  open: 0,
  stepValue: dohod,
  color: chart.colors.getIndex( 1 ),
  displayValue: dohod
}, {
  category: "Расходы\n(товар)\n-"+rash,
  value: dohod - rash,
  open: dohod,
  stepValue: dohod - rash,
  color: chart.colors.getIndex( 3 ),
  displayValue: rash*(-1)
}, {
  category: "Расходы\n(другие)\n-"+other,
  value: dohod - rash - other,
  open: dohod - rash,
  stepValue: dohod - rash - other,
  color: chart.colors.getIndex( 4 ),
  displayValue: other*(-1)
}, {
  category: "Прибыль\n"+Math.round(dohod - rash - other),
  value: dohod - rash - other,
  open: 0,
  stepValue: dohod - rash - other,
  color: chart.colors.getIndex( 6 ),
  displayValue: Math.round(dohod - rash - other)
} ];

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
categoryAxis.renderer.minGridDistance = 40;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

var columnSeries = chart.series.push(new am4charts.ColumnSeries());
columnSeries.dataFields.categoryX = "category";
columnSeries.dataFields.valueY = "value";
columnSeries.dataFields.openValueY = "open";
columnSeries.fillOpacity = 0.8;
columnSeries.sequencedInterpolation = true;
columnSeries.interpolationDuration = 1500;

var columnTemplate = columnSeries.columns.template;
columnTemplate.strokeOpacity = 0;
columnTemplate.propertyFields.fill = "color";

var label = columnTemplate.createChild(am4core.Label);
label.text = "{displayValue.formatNumber('# р')}";
label.align = "center";
label.valign = "middle";


var stepSeries = chart.series.push(new am4charts.StepLineSeries());
stepSeries.dataFields.categoryX = "category";
stepSeries.dataFields.valueY = "stepValue";
stepSeries.noRisers = true;
stepSeries.stroke = new am4core.InterfaceColorSet().getFor("alternativeBackground");
stepSeries.strokeDasharray = "3,3";
stepSeries.interpolationDuration = 2000;
stepSeries.sequencedInterpolation = true;

// because column width is 80%, we modify start/end locations so that step would start with column and end with next column
stepSeries.startLocation = 0.1;
stepSeries.endLocation = 1.1;

chart.cursor = new am4charts.XYCursor();
chart.cursor.behavior = "none";
}
</script>

