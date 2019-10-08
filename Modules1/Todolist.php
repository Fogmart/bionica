<?php if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php"; 
if($_SESSION['admin']!=1)
if($_SESSION['store']!=1)
if($_SESSION['direct']!=1)	
exit;

if(isset($_POST['todolist']))
{
$mysqli->query("INSERT INTO `todolist`(`title`, `name`) VALUES ('".$_POST['todolist']."','".$_POST['name']."');");	
}

if(isset($_POST['delnote']))
{
$mysqli->query("DELETE FROM `todolist` WHERE `id`= ".$_POST['delnote'].";");	
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  min-width: 250px;
}

/* Include the padding and border in an element's total width and height */
* {
  box-sizing: border-box;
}

/* Remove margins and padding from the list */
ul#myUL {
  margin: 0;
  padding: 0;
}

/* Style the list items */
ul#myUL li {
  cursor: pointer;
  position: relative;
  padding: 12px 8px 12px 40px;
  list-style-type: none;
  background: #eee;
  font-size: 18px;
  transition: 0.2s;
  
  /* make the list items unselectable */
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Set all odd list items to a different color (zebra-stripes) */
ul#myUL li:nth-child(odd) {
  background: #f9f9f9;
}

/* Darker background-color on hover */
ul#myUL li:hover {
  background: #ddd;
}

/* When clicked on, add a background color and strike out text */
ul#myUL li.checked {
  background: #888;
  color: #fff;
  text-decoration: line-through;
}

/* Add a "checked" mark when clicked on */
ul#myUL li.checked::before {
  content: '';
  position: absolute;
  border-color: #fff;
  border-style: solid;
  border-width: 0 2px 2px 0;
  top: 10px;
  left: 16px;
  transform: rotate(45deg);
  height: 15px;
  width: 7px;
}

/* Style the close button */
.close {
  position: absolute;
  right: 0;
  top: 0;
  padding: 12px 16px 12px 16px;
}

.close:hover {
  background-color: #f44336;
  color: white;
}

/* Style the header */


/* Clear floats after the header */


/* Style the input */
#myInput {
  margin: 0;
  border: none;
  border-radius: 0;
  width: 75%;
  padding: 10px;
  float: left;
  font-size: 16px;
}

/* Style the "Add" button */
.addBtn {
  padding: 9px;
  width: 25%;
  background: #d9d9d9;
  color: #555;
  float: left;
  text-align: center;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
  border-radius: 0;
}

.addBtn:hover {
  background-color: #bbb;
}
</style>
</head>


<div id="myDIV" style="  background-color: #4bacfe;  padding: 10px 40px;  color: white;  text-align: center;">
  <h2 style="margin:5px">Общий список задач</h2>
  <input onkeypress="enters();" type="text" id="myInput" placeholder="Что записать?">
  <span id="myInputEnter" onclick="newElement()" class="addBtn">Записать</span>
</div>

<ul id="myUL">
<!-- это в бд-->
<?
$sqlnote = 'SELECT * FROM `todolist` ORDER BY `id` DESC;'; 	
$data_note = $mysqli->query($sqlnote);
if($row_note = $data_note->num_rows){
while($res_note = $data_note->fetch_assoc())
{
	echo '<li>'.$res_note['title'].' <font style="font-size:10px;">('.$res_note['name'].')</font><span onclick="delnote('.$res_note['id'].');" class="close">×</span></li>';
}
}
?>

</ul>
</br></br>

<script>
function enters(){

    if (event.key === "Enter") {
	newElement();
        // Do something better
    }

}

function newElement() {

  
  	var node = $('#myInput').val();
	var user = '<?echo $_SESSION['user'];?>';
	var sms={todolist:node,name:user};
	var url="Modules/Todolist.php";
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
function delnote(x) {

	var sms={delnote:x};
	var url="Modules/Todolist.php";
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

</html>
