<?php if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
if($_SESSION['admin']!=1)
if($_SESSION['store']!=1)	
exit;
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

$sity_sql ='SELECT *  FROM `shopping` GROUP BY `session_id`;';
$sity_data = $mysqli->query($sity_sql);
$sity_row = $sity_data->num_rows;

echo '<link href="http://allfont.ru/allfont.css?fonts=courier-new" rel="stylesheet" type="text/css" />
<div     style="position: relative; width: 100%;">';

while($sity_res  = $sity_data ->fetch_assoc())
	{
$txt= '<div style="max-width: 415px;position: relative;float: left;">
<table style="margin: 20px;box-shadow:7px 11px 21px 0px rgba(0,0,0,0.03);min-width:375px; max-width:376px; border: 0px solid red;font-family: \'Courier New\', arial;font-size: 12px;text-transform: uppercase;vertical-align: top; border-collapse:separate;border-spacing: 0;background:#fff;padding: 10px;">

    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="font-size:18px; text-align:center;">бионика маркет</td>
    </tr>
	    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="font-size:18px; text-align:center;">№ '.$sity_res['id'].'</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">**************************************</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">имя : '.$sity_res['fio'].'</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">тел. : '.$sity_res['tel'].'</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">почта : '.$sity_res['email'].'</td>
    </tr>
	<tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">адрес : '.$sity_res['full_adres'].'</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">**************************************</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td style="width:65px;">АРТИК.|</td>
        <td style="width:41px;">КОЛ |</td>
        <td style="width:120px;">НАИМЕНОВАНИЕ</td>
        <td style="width:52px;">|ЦЕНА</td>
    </tr>
';		
		

		$sum_all=0;

		$user_sql ="SELECT * FROM `shopping` WHERE `session_id`= '".$sity_res['session_id']."';";
		$user_data = $mysqli->query($user_sql);
		$user_row = $user_data->num_rows;
		
		while($user_res  = $user_data ->fetch_assoc())
		{
		if($user_res['check']!="ok"){
			$x="delfull('".$user_res['id']."');";
			
			if($user_res['zakaz']!="no")$user_res['name']="<font style='color:red;'>(Заказ)</font>".$user_res['name'];
			
$txt=$txt. '
    <tr style="word-break: break-all;color:#0f0d72;">
        <td style="width:65px;">'.$user_res['art'].'</td>
        <td style="width:41px;">'.$user_res['kolvo'].'</td>
        <td style="width:120px;">'.$user_res['name'].' 
		'.((($user_res['art']=='0')||($user_res['art']=='1'))?'':'<a target="_blank" href="/'.$user_res['url'].'">Open</a>').'
		<a onclick="'.$x.'">Del</a>
        <td style="width:52px;">|'.$user_res['sum_p']*$user_res['kolvo'].'</td>
    </tr>
';
		$sum_all+=$user_res['sum_p']*$user_res['kolvo'];
		}
		}

$txt=$txt. '
	<tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="text-align:center;">**************************************</td>
    </tr>
    <tr style="word-break: break-all;color:#0f0d72;">
        <td colspan="4" style="font-size:18px;">итог : '.$sum_all.' руб.</td>
    </tr>

</table></div>
';		
echo $txt;
	}
?>
</div>
<script>
	function delfull(id)

		{
				var del = id;
				var sms={del:del};
				var url="shopadd.php";
				var metod="POST";
				
					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							location.reload();
							
						});
	}
</script>