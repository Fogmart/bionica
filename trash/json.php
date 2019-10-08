<?
require "connect.php";
				
				
if($_GET['re']=="msg")
if($_GET['user']!=NULL) 
{	
				
				$go ="document.getElementById('usr').style.display='block';
						document.getElementById('send').style.display='none';
						document.getElementById('msg').style.display='none';";
				echo '
				
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="10 4.3 500 500" enable-background="new 10 4.3 500 500" xml:space="preserve" width="40" height="40" onclick="'.$go.'">
				<g>
					<polygon fill="#959595" points="240,157.1 138.6,251.4 240,352.9 240,271.4 381.4,271.4 381.4,231.4 240,231.4 	"/>
					<path fill="#959595" d="M260,4.3c-138.6,0-250,112.9-250,250s112.9,250,250,250s250-112.9,250-250S397.1,4.3,260,4.3z M260,461.4
						c-114.3,0-207.1-92.9-207.1-207.1S145.7,47.1,260,47.1S467.1,140,467.1,254.3S374.3,461.4,260,461.4z"/>
				</g>
				</svg>
				';
				
				
				
				$data_sms = $mysqli->query('
				
				SELECT * FROM `chat` 
				WHERE `id1user`="'.$_SESSION['user'].'" and `id2user`="'.$_GET['user'].'" or `id1user`="'.$_GET['user'].'" and `id2user`="'.$_SESSION['user'].'"
				LIMIT 31;
				
				');
				$row_sms = $data_sms->num_rows;
				
				while($res_sms = $data_sms->fetch_assoc())
				{
					if($res_sms['id1user']==$_SESSION['user']){$atr='float:right; text-align:right;';}
					else{$atr='float:left;text-align:left;';}
					
					
					
					if($res_sms['checks']=="0"){$atr=$atr.' background:#99CC99;';}
						else{$atr=$atr.' background:#a7ccf7;';}
					

					
					echo '<div style="">
						<table style=" width:100%; margin-top:-10px;margin-bottom:-10px; height:40px; ">
						<tr>
							<td style="padding-left:10px; padding-right:10px;">
								<p style=" width:auto; padding:4px 15px 4px 15px; border-radius:4px;'.$atr.'">'.$res_sms['text'].'</p>
							</td>
						</tr>
						<table>
						</div>';

				}
				


}






//echo $_GET['user'];
//получение всех писем		
				//$dialog;
				
				$data_sms = $mysqli->query('
				
				SELECT * FROM `chat` 
				WHERE `id1user`="'.$_SESSION['user'].'" or `id2user`="'.$_SESSION['user'].'" ORDER BY id DESC
				;
				
				');
				$row_sms = $data_sms->num_rows;
				while($res_sms = $data_sms->fetch_assoc())
				{
					//по отправленным
					$add=0;
					$res_sms['id2user'];
					
					for($i=0; $i<=count($dialog); $i++)
					{
						if($dialog[$i]==$res_sms['id2user']){$add++;}
						if($res_sms['id2user']==$_SESSION['user']){$add++;}
					}
					
					if($add==0){$dialog[count($dialog)+1]=$res_sms['id2user'];}
					//по принятым
					$add=0;
					$res_sms['id1user'];
					
					for($i=0; $i<=count($dialog); $i++)
					{
						if($dialog[$i]==$res_sms['id1user']){$add++;}
						if($res_sms['id1user']==$_SESSION['user']){$add++;}
					}
					
					if($add==0){$dialog[count($dialog)+1]=$res_sms['id1user'];}
				}
				
				
			
				for($i=1; $i<=count($dialog); $i++)
				{
								$data_sms = $mysqli->query('
				
								SELECT * FROM `chat` 
								WHERE `id2user`="'.$dialog[$i].'" or `id1user`="'.$dialog[$i].'" ORDER BY id DESC 
								;
								');
								if($row_sms = $data_sms->num_rows)
								$res_sms = $data_sms->fetch_assoc();
								$back_sms[$i]=$res_sms['text'];
								
								if($res_sms['id1user']!=$_SESSION['user'])
								if($res_sms['checks']=="0")
								{$new_sms[$i]="background:#99CC99;";}
								else{$new_sms[$i]="";}
								
								
								$data_sms = $mysqli->query('
								
								SELECT * 
								FROM  `users` 
								WHERE  `iduser` =  "'.$dialog[$i].'" ORDER BY id DESC;
								');
								if($row_sms = $data_sms->num_rows)
								$res_sms = $data_sms->fetch_assoc();
								$usr_name[$i] = $res_sms['first_name']." ".$res_sms['last_name']." (".$dialog[$i].")";
								
								
				
				}
				
				
				
				for($i=1; $i<=count($dialog); $i++)
				{
						
				//var_dump($dialog);
				$go="document.getElementById('text').value='".$dialog[$i]."'; chat(); 
					document.getElementById('usr').style.display='none'; 
					document.getElementById('send').style.display='block';
					document.getElementById('msg').style.display='block';
					check();";
					
					
					
				if($_GET['re']=="usr")
				echo '<div style=" padding-top:0px; padding-bottom:0px;">
						
						<table  onclick="'.$go.'" style=" width:99%; margin:0px;">
						<tr>
							<td style="background:#000; width:60px; height:60px;">
								<div>123</div>
							</td>
							<td style="padding-left:5px;">
								<p style="">'.$usr_name[$i].'
								<p style=" '.$new_sms[$i].'  width:auto; margin-top:-10px; padding:0px 15px 0px 15px; border-radius:4px; float:left;text-align:left;">'.$back_sms[$i].'</p>
								</p>
							</td>
						</tr>
						<table>
					</div>';
					
				}









if($_GET['re']=="sms")
if($_GET['user']!=NULL)
if($_GET['sms']!=NULL)
{
			$mysqli->query('
		
		INSERT INTO `chat` 
		(`id1user`,`id2user`,`text`) 
		VALUES
		("'.$_SESSION['user'].'", "'.$_GET['user'].'","'.$_GET['sms'].'");
		
		');
	
	
}	
if($_GET['reed']=="yes")
	if($_GET['user']!=NULL)
{
						$mysqli->query("
						UPDATE `chat`
						SET `checks` = '1'
						WHERE `id2user`='".$_SESSION['user']."' and `id1user`='".$_GET['user']."';
						");
	
	
}


?>