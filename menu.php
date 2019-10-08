<?
require "connect2.php";


	$sql22 = 'SELECT * FROM `group` ORDER BY `position`, `id`';
	$data22 = $mysqli->query($sql22);
	$row22 = $data22->num_rows;
	
	
	while($res22 = $data22->fetch_assoc()){
		if($res22['parent']==0){
			
			echo '	<li>
					<a class="mega__title" href="'.$res22['url'].'">'.$res22['title'].'</a>
					<ul class="mega__item">';
					
			$doublemenu.='
			<li><a href="'.$res22['url'].'" style="text-transform: uppercase;"><img alt="" src="images/icons/next.png">'.$res22['title'].'<i class="zmdi zmdi-chevron-right"></i></a>
                                        <div class="category-menu-dropdown" style="width: inherit; padding-bottom:0px;">
                                            <div class="category-menu-dropdown-top" style="text-align:center; padding-left:30px;">
												<div class="category-part-1 category-common2 mb--30" style="width:100%; ">
                                                    <h4 class="categories-subtitle" href="'.$res22['url'].'"><nobr><u>'.$res22['title'].'</u></nobr></h4>
                                                    <ul>
			';

						$sql1 = 'SELECT * FROM `group` WHERE `parent`='.$res22['id'].';';
						$data1 = $mysqli->query($sql1);
						$row1 = $data1->num_rows;
						while($res1 = $data1->fetch_assoc()){
							
							echo '<li><a href="'.$res1['url'].'" style="text-transform: uppercase;">'.$res1['title'].'</a></li>';
							
							$doublemenu.='
                                                        <li><a href="'.$res1['url'].'" style="text-transform: uppercase;"><nobr>'.$res1['title'].'</nobr></a></li>						
							';
						
						}
						
			echo '	</ul>
					</li>';
					
			$doublemenu.='
                                                    </ul>
                                                </div>
			                                 </div>
                                        </div>
                                    </li>
			';
		}
		
	}




///////////////////////////////////////////////////////////////////////////////////////////////////
?>
<!-- Start Single Mega MEnu -->
<li>
	<ul class="mega__item">
		<li>
			<div class="mega-item-img">
				<a onclick="alert('Мяу♥');">
					<img src="images/feature-img/orig2.gif" alt="">
				</a>
			</div>
		</li>
	</ul>
</li>
<!-- End Single Mega MEnu -->
