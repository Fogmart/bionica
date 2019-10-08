<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
if($_SESSION['admin']!=1)
exit;

///получаем протокол
if (isset($_SERVER['HTTPS']))	$scheme = $_SERVER['HTTPS'];
else	$scheme = '';
if (($scheme) && ($scheme != 'off')) $scheme = 'https';
else $scheme = 'http';

$homeurl=$scheme.'://'.$_SERVER['HTTP_HOST']."/";

$date = date(DateTime::W3C); // получаем текующую дату

$sitesql = 'SELECT * FROM `tovar` ORDER BY `id` DESC;';
$data_map = $mysqli->query($sitesql);
$row_map = $data_map->num_rows;

$size_map=$row_map;
$i=0;
$map="";

while($res_map = $data_map->fetch_assoc()){
$i++;
$url[$i]=$homeurl.$res_map['url']; //юрл сайта
$prioritet[$i]="1.0"; //приоритет
$reload[$i]="weekly"; //раз в неделю
}

$sitesql = 'SELECT * FROM `group` ORDER BY `id` DESC;';
$data_map = $mysqli->query($sitesql);
$row_map = $data_map->num_rows;

$size_map=$size_map+$row_map;

while($res_map = $data_map->fetch_assoc()){
$i++;
$url[$i]=$homeurl.$res_map['url']; //юрл сайта
$prioritet[$i]="0.9"; //приоритет
$reload[$i]="weekly"; //частота раз в неделю
}

echo "</br>ВСЕГО (".$size_map.") страниц i=".$i;

    // создаем новый xml документ
    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->formatOutput = true;

	$SITEMAP_NS = 'http://www.sitemaps.org/schemas/sitemap/0.9';
	$SITEMAP_NS_XSD = 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd';
	$urlSet = $dom->createElementNS($SITEMAP_NS, 'urlset');
	$dom->appendChild($urlSet);
	$urlSet->setAttributeNS('http://www.w3.org/2000/xmlns/' , 'xmlns:xsi',  'http://www.w3.org/2001/XMLSchema-instance');
	$urlSet->setAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'schemaLocation', $SITEMAP_NS . ' ' . $SITEMAP_NS_XSD);



// вывод сайт мапа
for($i=1; $i<=$size_map; $i++)
{

    // create url node for this page
    $urlNode = $dom->createElementNS($SITEMAP_NS, 'url');
    $urlSet->appendChild($urlNode);
    // put url in 'loc' element
    $urlNode->appendChild($dom->createElementNS($SITEMAP_NS,'loc',$url[$i]));
	$urlNode->appendChild($dom->createElementNS($SITEMAP_NS,'lastmod',$date));
	$urlNode->appendChild($dom->createElementNS($SITEMAP_NS,'changefreq',$reload[$i]));
    $urlNode->appendChild($dom->createElementNS($SITEMAP_NS,'priority',$prioritet[$i]));
}


//запись файла
///
$filename=$_SERVER['DOCUMENT_ROOT'].'/sitemap.xml'; 
$xml = $dom->saveXML();
//сохраняем файл sitemap.xml на диск
file_put_contents($filename , $xml);
$fd = fopen($filename, 'r') or die("нет файла");
fclose($fd);
echo '<script>location.href="/sitemap.xml";</script>';