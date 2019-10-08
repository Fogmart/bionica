<?
require "../../connect.php"; 
if($_SESSION['store']!="1")exit();
//Получаем массив нашего меню из БД в виде массива

//foreach ($_POST as $key => $value) {$add[$key] = $value;  echo "<p>POST ".$key." = ".$value."</p>";} //все POST запросы


// Функция транслитерации
function translit($string) {
	 $string = trim($string); // убираем пробелы в начале и конце строки
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'j',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',  'ц' => 'ts',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '',    'ы' => 'y',   'ъ' => '',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        '’' => '',    '.' => '',    ' ' => '-',
		')' => '',    '(' => '',    '!' => '',
		'+' => '',    '-' => '',    '?' => '',
 
        'А' => 'a',   'Б' => 'b',   'В' => 'v',
        'Г' => 'g',   'Д' => 'd',   'Е' => 'e',
        'Ё' => 'e',   'Ж' => 'zh',  'З' => 'z',
        'И' => 'i',   'Й' => 'j',   'К' => 'k',
        'Л' => 'l',   'М' => 'm',   'Н' => 'n',
        'О' => 'o',   'П' => 'p',   'Р' => 'r',
        'С' => 's',   'Т' => 't',   'У' => 'u',
        'Ф' => 'f',   'Х' => 'h',  'Ц' => 'ts',
        'Ч' => 'ch',  'Ш' => 'sh',  'Щ' => 'sch',
        'Ь' => '',    'Ы' => 'y',   'Ъ' => '',
        'Э' => 'e',   'Ю' => 'yu',  'Я' => 'ya',
    );
    return strtr($string, $converter);
}





	if($_POST['id']=='new'){
	$sql ='INSERT INTO `group` (`title`,`url`, `parent`) VALUES
			("'. $_POST['title'] .'","'. (translit($_POST['title'])) .'", '. $_POST['parent'] .');
		';
	$mysqli->query($sql);
	}
	else{
	$sql ='UPDATE `group`
			SET `title` = "'. $_POST['title'] .'", `url` = "'. (translit($_POST['title'])) .'", `position` = "'. $_POST['position'] .'"
			WHERE `id` ='. $_POST['id'] .';';
	$mysqli->query($sql);		
	}

	if($_POST['del']=='del')
		if($_POST['parent']!=0)
		{
				$sql ='DELETE FROM `group` WHERE `id` ='. $_POST['id'] .';';
				$mysqli->query($sql);
		}
		else
		{
				$sql ='DELETE FROM `group` WHERE `id` ='. $_POST['id'] .' OR `parent` ='. $_POST['id'] .';';
				$mysqli->query($sql);
		}

$menu="";

	$sql = 'SELECT * FROM `group` WHERE `parent`="0" ORDER BY `id`;';
	$data = $mysqli->query($sql);
	$row = $data->num_rows;
	while($res = $data->fetch_assoc())
	{
		$menu=$menu.'<!--Katalog-->';
		$menu=$menu.'	<div class="item '.$res['id'].'">';
		$menu=$menu.'	<span>Главный</span>';
		$menu=$menu.'	<input readonly type="text" id="'.$res['id'].'" data="'.$res['parent'].'" onclick="gored(this);" value="'.$res['title'].'">';
		$menu=$menu.'	<span>Подкаталоги</span>';
		$menu=$menu.'		<div id="items">';
		
			$sql2 = 'SELECT * FROM `group` WHERE `parent`='.$res['id'].' AND `parent`!=0 ORDER BY `id`;';
			$data2 = $mysqli->query($sql2);
			$row2 = $data2->num_rows;
			while($res2 = $data2->fetch_assoc())
			{
				$menu=$menu.'			<input readonly type="text" id="'.$res2['id'].'" data="'.$res2['parent'].'" onclick="gored(this);" value="'.$res2['title'].'">';
			}	
		
		$menu=$menu.'		</div>';
		$menu=$menu.'	<button onclick="gonewkat('.$res['id'].');">Добавить подкаталог</button>';
		$menu=$menu.'	</div>';
		$menu=$menu.'<!--Katalog-->';
	}

	



?>
<style>
*{/*border:1px solid red;*/ margin:0px 0px;}
#settings{
	width:100%;
	background:#343434;
	color:#fff;
	display:table;
	float:left;
}
#addhome{
	width:20%;
	text-align:center;
	float:left;
	border:1px solid black;
	background:#464646;
	cursor:pointer;
}
#addhome2{
	width:75%;
	text-align:center;
	float:right;
}
input{
	width:100%;
		cursor:pointer;
}
input[type="text"]{
	text-align:center;
}
.conteiner{
	width:100%;
	float:left;
	margin:5px;
	text-align:center;
	
}
.item{
	width:150px;
	border:1px solid black;
	padding:2px;
	float:left;
}
.item button{
	width:100%;
}
span{
font-size:14px;
}
</style>

<div id="main">
	<div id="settings">
		<div id="addhome" onclick="gonewhome();">
			<p>Добавить</p>
			<p>главный</p>
			<p>раздел</p>
		</div>
		<div id="addhome2">
			<input type="text" name="title" id="title" placeholder="Выберете каталог">
			<input type="text" name="id" id="id">
			<input type="text" name="place" id="place" value="0">
			<button onclick="assept();">Применить</button>
			<button onclick="del();">Удалить</button>
		</div>
	</div>
	<div class="conteiner">
		<?echo $menu;?>
	</div>
</div>

<script src="/js/vendor/jquery-1.12.0.min.js"></script>
<script>
var redtitle = document.getElementById('title');
var redid = document.getElementById('id');
var redparent = document.getElementById('place');

var con=document.getElementsByClassName('conteiner')[0];

//data это родитель
//id это id в бд

function gored(e)
{
	redtitle.value=e.value;
	redid.value=e.id;
	redparent.value=e.getAttribute('data');
}
function gonewhome()
{
	con.innerHTML+='<div class="item"><span>Главный</span><input readonly type="text" id="new" data="0" onclick="gored(this);" value="home"></div>';

}
function gonewkat(x)
{
item=document.getElementsByClassName('item '+x)[0];	

item.innerHTML+='<input readonly type="text" id="new" data="'+x+'" onclick="gored(this);" value="Page">';

}

function assept()
{
				var id=$('#id').val();
				var title=$('#title').val();
				var parent=$('#place').val();
				
				var sms={id:id,title:title,parent:parent};
				var url="group_red.php";
				var metod="POST";
				
					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							$("html").html( result );
						});	
}
function del()
{
				var id=$('#id').val();
				var del="del";
				
				var sms={id:id,del:del};
				var url="group_red.php";
				var metod="POST";
				
					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							$("html").html( result );
						});		
}
</script>




