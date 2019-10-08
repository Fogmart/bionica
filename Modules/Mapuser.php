<?php if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
//SELECT * FROM `shopping` GROUP BY `email`;
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
$sity_sql ='SELECT DISTINCT `sity` FROM `visit`;';
$sity_data = $mysqli->query($sity_sql);
$sity_row = $sity_data->num_rows;

$param1;
$param2;


while($sity_res  = $sity_data ->fetch_assoc())
	{


	$i++;
		$user_sql ="SELECT * FROM `visit` WHERE `sity`= '".$sity_res['sity']."';";
		$user_data = $mysqli->query($user_sql);
		$user_row = $user_data->num_rows;
		$user_res  = $user_data ->fetch_assoc();
			//echo $sity_res['sity']."-".$user_row."<br>";
		$eee=0;
		
			if($user_res['sity']==""){$user_res['sity']="Stavropol"; $eee=1;}
	if($user_res['sity']==" "){$user_res['sity']="Stavropol"; $eee=1;}
	
	if($user_res['latitude']==""){$user_res['latitude']="45.0428";}
	if($user_res['latitude']==" "){$user_res['latitude']="45.0428";}
	
	if($user_res['longitude']==""){$user_res['longitude']="41.9734";}
	if($user_res['longitude']==" "){$user_res['longitude']="41.9734";}
		
		$param1 = $param1.'"'.$user_res['sity'].'": {"latitude":'.$user_res['latitude'].', "longitude":'.$user_res['longitude'].'}';
		
		if($sity_row>$i)$param1 = $param1.",";	
		
		if($eee==0)
		{
			$dede=$user_row;
			if($ttt>1)
			{
				$dede = $dede + $ttt;
				$ttt=0;
			}
		$param2 = $param2.'{ "id":"'.$user_res['sity'].'", "name":"'.$user_res['sity'].'", "value":'.$dede.', "color": chart.colors.getIndex(0) }';
		if($sity_row>$i)$param2 = $param2.",";	
		}
		else
		{
		$ttt=$user_row;	
		}
	}
	
	
	//echo $param1 ;
	//echo "<br>" ;
	//echo $param2 ;
if($_GET['o']=="1")	$user_sql ='SELECT * FROM `visit` WHERE `id` ORDER BY `session` DESC;';
	
else $user_sql ='SELECT * FROM `visit` WHERE `id` GROUP BY `ip` ORDER BY `session` DESC;';
$user_data = $mysqli->query($user_sql);
$user_row = $user_data->num_rows;	
$table="<tr>
<td>имя</td>
<td>Введеное имя</td>
<td>Почта</td>
<td>Бот</td>
<td>Устройство</td>
<td>ip</td>
<td>откуда</td>
<td>куда</td>
<td>страна</td>
<td>город</td>
<td>дата</td>
<td>время</td>
</tr>";
while($user_res  = $user_data ->fetch_assoc())
	{
	//$table=$table."<tr>";
	if($user_res['bot']!="1") $table=$table."<tr style='background:#d6ebf5;'>";
	else $table=$table."<tr style='background:#9e9e9e;'>";	
	
		$table=$table."<td>".$user_res['session']."</td>";
		$table=$table."<td>".$user_res['name']."</td>";
		$table=$table."<td>".$user_res['email']."</td>";
		if($user_res['bot']!="1")$table=$table."<td>Нет</td>";
		else $table=$table."<td>Да</td>";
		$table=$table."<td>".$user_res['device']."</td>";
		$table=$table."<td>".$user_res['ip']."</td>";
		$table=$table."<td><a target='_blank' href='".$user_res['refer']."'>".$user_res['refer']."</a></td>";
		$table=$table."<td><a target='_blank' href='".$user_res['url']."'>".$user_res['url']."</a></td>";
		$table=$table."<td>".$user_res['contry']."</td>";
		$table=$table."<td>".$user_res['sity']."</td>";
		$table=$table."<td>".$user_res['date']."</td>";
		$table=$table."<td>".$user_res['time']."</td>";
		
	$table=$table."</tr>";
	}
	
	
?>
<script src="jsd/core.js"></script>
<script src="jsd/maps.js"></script>
<script src="jsd/worldLow.js"></script>
<script src="jsd/animated.js"></script>
<div id="chartdiv" style="height: 50%;"></div>
<style>
td{border:1px solid black;}
</style>
<table style="width:100%;">
    <tr>
        <td colspan="12"><a href="?o=1">Показать всю статистику</a></td>
    </tr>
    <tr>
        <td colspan="12"><a href="?o=">Показать мин. статистику</a></td>
    </tr>
<?echo $table;?>
</table>

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

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create map instance
var chart = am4core.create("chartdiv", am4maps.MapChart);

var title = chart.titles.create();
title.text = "[bold font-size: 20]Пользователи[/]\nпо городам";
title.textAlign = "middle";

var latlong = {
<?echo $param1;?>
};

var mapData = [
  <?echo $param2;?>
];

// Add lat/long information to data
for(var i = 0; i < mapData.length; i++) {
  mapData[i].latitude = latlong[mapData[i].id].latitude;
  mapData[i].longitude = latlong[mapData[i].id].longitude;
}

// Set map definition
chart.geodata = am4geodata_worldLow;

// Set projection
chart.projection = new am4maps.projections.Miller();

// Create map polygon series
var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
polygonSeries.exclude = ["AQ"];
polygonSeries.useGeodata = true;
polygonSeries.nonScalingStroke = true;
polygonSeries.strokeWidth = 0.5;

var imageSeries = chart.series.push(new am4maps.MapImageSeries());
imageSeries.data = mapData;
imageSeries.dataFields.value = "value";

var imageTemplate = imageSeries.mapImages.template;
imageTemplate.propertyFields.latitude = "latitude";
imageTemplate.propertyFields.longitude = "longitude";
imageTemplate.nonScaling = true

var circle = imageTemplate.createChild(am4core.Circle);
circle.fillOpacity = 0.7;
circle.propertyFields.fill = "color";
circle.tooltipText = "{name}: [bold]{value}[/]";

imageSeries.heatRules.push({
  "target": circle,
  "property": "radius",
  "min": 4,
  "max": 30,
  "dataField": "value"
})
</script>