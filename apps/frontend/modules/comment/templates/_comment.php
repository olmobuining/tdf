<script type="text/javascript">

function submitComment() {
	var errorText = document.getElementById("errorText");
	var sendtext = document.getElementById("texty").value;
	$.ajax({
		url: "/comment/postComment",
		dataType: 'html',
		data: "submit="+encodeURI(sendtext)+"&<?php echo $type ?>id=<?php echo $blog->id; ?>",
		complete: function(data){
			errorText.innerHTML=data['responseText'];
			$("#texty").hide(1000);
			$("a#button").hide(1000);
		}
	});
}
</script>
<section class="addComment">
	<h4 class="ringbearer">Plaats een reactie</h4>
	<div id="errorText" class="addComment"></div>
	<textarea type="text" id="texty" > </textarea>
	<a onclick="submitComment()" id="button">Stuur</a>
</section>