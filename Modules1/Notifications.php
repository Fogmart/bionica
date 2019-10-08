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

echo '
      <div id="active_admin_content" class="without_sidebar">
        <div id="main_content_wrapper">
          <div id="main_content">
            <div class="blank_slate_container" id="dashboard_default_message">
              <span class="blank_slate">
			  <table>
';
	
if(isset($_POST['del']))
{
$notifications_sql = 'SELECT * FROM `notifications` WHERE `id`= '.$_POST['del'].';'; 	
$data_n = $mysqli->query($notifications_sql);
if($row_n = $data_n->num_rows)$notifications = $data_n->fetch_assoc();
	
	$block=$notifications['delete']. $_SESSION['email'];
	
$mysqli->query(" UPDATE `notifications` SET `delete` = '".$block."' WHERE `id`=".$_POST['del'].";");

exit;	

}	
	
	
$sqlss="";
if($_SESSION['call']=="1")
	{
		$sqlss.='(`call`="'.$_SESSION['call'].'")';
	}
if($_SESSION['direct']=="1")
	{
		if($sqlss!=""){$sqlss.="OR";}
		$sqlss.='(`direct`="'.$_SESSION['direct'].'")';
	}
if($_SESSION['store']=="1")
	{
		if($sqlss!=""){$sqlss.="OR";}
		$sqlss.='(`store`="'.$_SESSION['store'].'")';
	}
if($_SESSION['admin']=="1")
	{
		if($sqlss!=""){$sqlss.="OR";}
		$sqlss.='(`admin`="'.$_SESSION['admin'].'")';
	}
	
$notifications_sql = '
SELECT * FROM `notifications`
WHERE '.$sqlss.' 
ORDER BY `id` DESC;
';




$data_n = $mysqli->query($notifications_sql);
$row_n = $data_n->num_rows;
$nomer=1;

while($notifications = $data_n->fetch_assoc()){
	if (strpos($notifications['delete'], $_SESSION['email']) !== false) // именно через жесткое сравнение
	{
		continue;
	}
	
	$ddat=new DateTime("now");
	$ddat2=new DateTime($notifications['OrderDate']);
	if($ddat2>$ddat){continue;}
	
	echo "<tr>";
		echo "<td style='width:20px;'>";
			echo ($nomer++);
		echo "</td>";
		
				if (strpos($notifications['OrderDate'], date("Y-m-d")) !== false) // именно через жесткое сравнение
				{
					echo "<td style='width:40px;' title='Новое'>";
					echo '<span class="iconify" data-icon="emojione-v1:blue-circle" data-inline="false"></span>';
				} else {
					$ddaattaa = date_diff(new DateTime(), new DateTime($notifications['OrderDate']))->days;
					echo "<td style='width:40px;' title='Старое ".$ddaattaa." д. назад'>";
					echo $ddaattaa.'д.';
				}
		
			
		echo "</td>";
		echo "<td style='font-size: 17px;'>";
		
			if($notifications['url']!="no")
			{
				$newWin= "newWin = window.open('".$notifications['url']."' ,'', 'width=900,height=550,left=200,top=200,menubar=no,toolbar=no,location=no');";
				echo '<u><a onclick="'.$newWin.'">'.$notifications['title'].'</a></u>';
			}
			else
			{
			echo '<a style="color:#343434;">'.$notifications['title'].'</a>';
			}
		echo "</td>";
		echo "<td>";
			echo $notifications['OrderDate'];
		echo "</td>";
		$gon='
				var del = '.$notifications['id'].';
				var sms={del:del};
				var url="Modules/Notifications.php";
				var metod="POST";
				
					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							location.reload();
							
						});
		';
		echo "<td style='font-size: 20px;width:20px;'title='Удалить' onclick='".$gon."'>";
			echo '<span class="iconify" data-icon="ant-design:close-circle-outline" data-inline="false"></span>';
		echo "</td>";
	echo "</tr>";	
	
}	

echo '
			  </table>
              </span>
            </div>
          </div>
        </div>
      </div>
';



//echo date('d.m.Y H:i:s', strtotime(date('2019-05-02 21:22:03')));



//.date('Y-m-d H:i:s', strtotime(date("Y-m-d  H:i:s").' +60 day')).
?>