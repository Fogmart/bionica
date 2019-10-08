<?php require "../connect.php"; 

	
$user_sql ="SELECT * FROM `visit` WHERE `bot`='1' ORDER BY `id` DESC;";
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
	
    if($user_res['device']=="Google_bot")	$Google_bot++;
	if($user_res['device']=="Yahooo_Bot")	$Yahooo_Bot++;
	if($user_res['device']=="Ask Jeeves/Teoma Bot")$Ask_Bot++;
	if($user_res['device']=="Aport_Bot")		$Aport_Bot++;
	if($user_res['device']=="Yandex_Bot")	$Yandex_Bot++;
	if($user_res['device']=="Microsoft_bot")	$Microsoft_bot++;
	if($user_res['device']=="AltaVista_Bot")	$AltaVista_Bot++;
	if($user_res['device']=="Вебальта_bot")	$web_bot++;
	if($user_res['device']=="Mail.RU_Bot")	$MailRU_Bot++;
	if($user_res['device']=="Bing")			$Bing++;
	if($user_res['device']=="Alexa_Bot")		$Alexa_Bot++;
	if($user_res['device']=="Yammybot")		$Yammybot++;
	if($user_res['device']=="Rambler_Bot")	$Rambler_Bot++;
	if($user_res['device']=="AOL_Bot")		$AOL_Bot++;
	if($user_res['device']=="Lycos_Bot")		$Lycos_Bot++;
	if($user_res['device']=="Openbot")		$Openbot++;

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
<style>
td{border:1px solid black;}
</style>
<table>
    <tr>
        <td>Google_bot</td>
        <td><?echo $Google_bot;?></td>
        <td>Yahooo_Bot</td>
        <td><?echo $Yahooo_Bot;?></td>
        <td>Ask Jeeves/Teoma Bot</td>
        <td><?echo $Ask_Bot;?></td>
        <td>Aport_Bot</td>
        <td><?echo $Aport_Bot;?></td>
    </tr>
    <tr>
        <td>Yandex_Bot</td>
        <td><?echo $Yandex_Bot;?></td>
        <td>Microsoft_bot</td>
        <td><?echo $Microsoft_bot;?></td>
        <td>AltaVista_Bot</td>
        <td><?echo $AltaVista_Bot;?></td>
        <td>Вебальта_bot</td>
        <td><?echo $web_bot;?></td>
    </tr>
    <tr>
        <td>Mail.RU_Bot</td>
        <td><?echo $MailRU_Bot;?></td>
        <td>Bing</td>
        <td><?echo $Bing;?></td>
        <td>Alexa_Bot</td>
        <td><?echo $Alexa_Bot;?></td>
        <td>Yammybot</td>
        <td><?echo $Yammybot;?></td>
    </tr>
    <tr>
        <td>Rambler_Bot</td>
        <td><?echo $Rambler_Bot;?></td>
        <td>AOL_Bot</td>
        <td><?echo $AOL_Bot;?></td>
        <td>Lycos_Bot</td>
        <td><?echo $Lycos_Bot;?></td>
        <td>Openbot</td>
        <td><?echo $Openbot;?></td>
    </tr>
</table>
<br></br>
<table style="width:100%;">
<?echo $table;?>
</table>