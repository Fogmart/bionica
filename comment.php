
<? require $_SERVER['DOCUMENT_ROOT']."/connect2.php"; 

//parent:parent,name:name,email:email
if(isset($_POST['mode']))
{
    if ($_POST['mode'] == 'add'){
        $mysqli->query('
        INSERT INTO `comment`(`idtov`, `title`, `name`, `email`, `parent`) 
                    VALUES ("'.$_POST['idtov'].'","'.$_POST['title'].'","'.$_POST['name'].'","'.$_POST['email'].'","'.$_POST['parent'].'")
        ');
    }
    if ($_POST['mode'] == 'del'){
        $mysqli->query('delete from  `comment` where `id` = "'.$_POST['id'].'"');
    }


}
//foreach ($_POST as $key => $value) {$add[$key] = $value;  echo "<p>POST ".$key." = ".$value."</p>";} //все POST запросы

if(!(isset($res['id'])))$res['id']=$_POST['idtov'];

$sql_comm = 'SELECT * FROM `comment` WHERE `idtov`='.$res['id'].';';
	$data_comm = $mysqli->query($sql_comm);
	$row_comm  = $data_comm->num_rows;
if ($row_comm) {
    echo '<div class="review__address__inner">';
    while ($comment = $data_comm->fetch_assoc()) {


        echo '<!-- Start Single Review -->';
        if ($comment['parent'] < 1)
            echo '<div class="pro__review" style="margin-top:15px;">';
        else
            echo '<div class="pro__review ans" style="margin-top:15px;">';
        //	echo '	<div class="review__thumb">';
        //	echo '		<img src="images/logo/logo.png" alt="review images">';
        //	echo '	</div>';
        echo '	<div class="review__details" style="width: 100%;">';
        echo '		<div class="review__info">';
        echo '			<h4 style="font-size: 16px;">';
        echo '			<a>';
        echo $comment['name'];
        echo '			</a>';
        echo '			</h4>';

        echo '			<div class="rating__send">';
        $parent = "document.getElementById('parent').value=" . $comment['id'] . ";document.getElementById('nameparent').innerHTML='Ответить " . $comment['name'] . "';";
        echo '				<a style="background:#fff;" onclick="' . $parent . '"><i style="color: #999;" class="zmdi zmdi-mail-reply"></i></a>';
        if ($_SESSION['admin']) {
            echo '				<a style="background:#fff;" onclick="delcomment(' . $comment['id'] . ')"><i style="color: #999;" class="zmdi zmdi-delete"></i></a>';
        }

        echo '			</div>';
        echo '		</div>';
        echo '		<div class="review__date">';
        echo '			<span>';
        echo $comment['OrderDate'];
        echo '			</span>';
        echo '		</div>';
        echo '		<p>';
        echo $comment['title'];
        echo '		</p>';
        echo '	</div>';
        echo '</div>';
        echo '<!-- End Single Review -->';


    }
    echo '</div>';
}
?>


<!-- Start RAting Area -->
<div class="rating__wrap">
<h4 class="rating-title-2" style="text-transform: initial;">Ждем ваших отзывов)
</h4> 

<h4 id="nameparent"></h4>

</div>
<!-- End RAting Area -->
<div class="review__box">
<div id="review-form">
<div class="single-review-form">
<div class="review-box name">
<input type="text" id="parent" style="display:none;">
<input type="text" id="name" placeholder="Как вас величать">
<input type="email" id="email" placeholder="Почта">
</div>
</div>
<div class="single-review-form">
<div class="review-box message">
<textarea placeholder="Отзыв" id="title">
</textarea>
</div>
</div>
<div class="review-btn">
<a class="fv-btn" onclick="comment();">Отправить
</a>
</div>
</div>
</div>

		<script>
		
		function comment(){
				var parent=$('#parent').val();
				var name=$('#name').val();
				var email=$('#email').val();
				var title=$('#title').val();
			
				var sms={parent:parent,name:name,email:email,
                        title:title,idtov:idtov,
                        mode:'add'
				        };
				var url="comment.php";
				var metod="POST";
				
					$.ajax({
					type: metod,
					url: url,
					data: sms
					}).done(function( result )
						{
							$("#reviews").html( result );
						});
			}
            <?php if ($_SESSION['admin']) {?>
                function delcomment( id ) {
                    if (confirm('Удалить этот отзыв?')){
                        $.ajax({
                            type: "POST",
                            url: "comment.php",
                            data: {id:id, mode:'del' }
                        }).done(function( result )
                        {
                            $("#reviews").html( result );
                        });
                    }
                }
            <?php  } ?>
		</script>