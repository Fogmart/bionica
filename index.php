<? if(!$require['connect.php'])require $_SERVER['DOCUMENT_ROOT']."/connect.php";

///echo "<br><br><br></br>";
/*foreach ($_SERVER as $key => $value) {echo "<p>SERVER ".$key." = ".$value."</p>";}*/ //все POST запросы
//foreach ($_POST as $key => $value) {echo "<p>POST ".$key." = ".$value."</p>";} //все POST запросы
//foreach ($_GET as $key => $value) {echo "<p>GET ".$key." = ".$value."</p>";} //все GET запросы

$tree = false;
if($tree)echo 1;


	if( isset($_GET['route']) || isset($_GET['seach']) )
	{
if($tree)echo 2;

		if(isset($_GET['route']))
		{

if($tree)echo 3;

			$sql = 'SELECT * FROM `tovar` 
			WHERE 
				`url` = "'. $_GET['route'] .'" or
				`id` = "'. $_GET['route'] .'"
			;';
			$data = $mysqli->query($sql);
			if($row = $data->num_rows)
			{
if($tree)echo 4;

				require "route.php";
				echo '<script>var rangemin=0;	var rangemax=1;	var basikrangemin =0;  var basikrangemax =0; </script>';
				require "footer.php";
                die;
			}
			else
			{
if($tree)echo 5;
				$sql = 'SELECT * FROM `group` 
				WHERE 
					`url` LIKE "%'. $_GET['route'] .'%"
				;';
				$data = $mysqli->query($sql);
				if($row = $data->num_rows)
				{
if($tree)echo 6;
					$res2 = $data->fetch_assoc();


					//require "header.php";
					$_POST['group_id']=$res2['id'];
					require "seach.php";
					require "footer.php";
                    die;
				}
				else
				{
if($tree)echo 7;
					if($_GET['route']=="index.html" || $_GET['seach']=="index.html")
					{
if($tree)echo 8;
					echo "<script>location.href=location.origin;</script>";
					}

                    if($_GET['seach']!="" && $_GET['seach']!=" ")
                    {
if($tree)echo 9;
                        require "404.php";
                        die;
                    }


                    exit(file_get_contents('404.php'));
                require "404.php";
                die;
				//header('HTTP/1.0 404 Not Found');
				//header('Status: 404 Not Found');
				}
			}

		}
		if(isset($_GET['seach']))
		{
if($tree)echo 10;
				if($_GET['seach']!="" && $_GET['seach']!=" "){
if($tree)echo 11;
				$sql = 'SELECT * FROM `group` 
				WHERE 
					`title` LIKE "%'. $_GET['seach'] .'%"
				;';
				$data = $mysqli->query($sql);
				if($row = $data->num_rows)
				{
if($tree)echo 12;
					$res2 = $data->fetch_assoc();

					$_POST['group_id']=$res2['id'];
					$_GET['seach']=NULL;
				}}
if($tree)echo 13;
			require "seach.php";
			require "footer.php";
            die;
		}
	}
	else
	{
if($tree)echo 14;
			require "header.php";
			echo '<script>var rangemin=0;	var rangemax=1;	var basikrangemin =0;  var basikrangemax =0; </script>';
			require "main.php";
			require "footer.php";
            die;
	}
if($tree)echo 15;
?>







<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<script>
var tabIsPressed = false;

$(window).keydown(function(event){
    if(event.keyCode == 17) {
        tabIsPressed = true; event.preventDefault();
    }
});

$(window).keyup(function(event){
    if(event.keyCode == 17) {
    tabIsPressed = false; event.preventDefault();
    }
});

$(window).on('keydown', function(e) {
  if (tabIsPressed && event.keyCode === 112) {
                      event.preventDefault();

					  window.location.href = window.location.origin+"/login.php";
                      return;
    }
});
</script>
