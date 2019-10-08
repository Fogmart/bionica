<?php

?>
<div id="usr"></div>
<div id="msg"></div>


<input style="display:none;" type="text" id="text" name="text" value="" />
	<table id="send" style="display:none;">
	<tr>
	<td style="width:100%;">
	<input type="sms" id="sms" name="sms" value="" style="width:100%; height:40px;" placeholder="Ваше сообщение..."/> 
	</td>
	<td>
	
	</td>
	<td>
	<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="10 4.3 500 500" enable-background="new 10 4.3 500 500" xml:space="preserve" width="40" height="40" onclick="send(); document.getElementById('sms').value=''; chat();">
				<g>
					<path fill="#454545" d="M388.6,247.1V350c0,17.1-12.9,30-30,30h-250c-17.1,0-30-12.9-30-30V161.4c0-17.1,12.9-30,30-30h164.3V88.6
						H108.6c-40,0-72.9,32.9-72.9,72.9V350c0,40,32.9,72.9,72.9,72.9h250c40,0,72.9-32.9,72.9-72.9V247.1H388.6z"/>
					<polygon fill="#454545" points="227.1,265.7 251.4,290 380,161.4 431.4,212.9 430,88.6 305.7,88.6 355.7,137.1 	"/>
				</g>
	</svg>
	</td>
	</tr>
	</table>

	
	
	
<script src="js/jquery.js"></script>
<script>

function send(){
	var text = $('#text').val();
	var text1 = $('#sms').val();
	var sms={user:text, re:"sms", sms:text1};
	var url="json.php";
	var metod="GET";
	
	    $.ajax({
        type: metod,
        url: url,
        data: sms
    }).done();
}
function check(){
	var text = $('#text').val();
	var sms={reed:"yes", user:text};
	var url="json.php";
	var metod="GET";
	
	    $.ajax({
        type: metod,
        url: url,
        data: sms
    }).done();
}

function chat(){
	var text = $('#text').val();
	var post1={user:text, re:"usr"};
	var post2={user:text, re:"msg"};
	var url="json.php";
	var metod="GET";
	
    $.ajax({
        type: metod,
        url: url,
        data: post1
    }).done(function( result )
        {
            $("#usr").html( result );
        });
		
	$.ajax({
        type: metod,
        url: url,
        data: post2
    }).done(function( result )
        {
            $("#msg").html( result );
        });
		
}
 $(document).ready(function(){
        chat();
		setInterval('chat()', 3000); // Интервал обновления в миллисекундах
    });
</script>