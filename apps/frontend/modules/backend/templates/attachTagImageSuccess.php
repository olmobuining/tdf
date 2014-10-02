<div class="page-left">
	<article class="form">
		<header>
			<h1 class="large">Tag linken aan plaatjes</h1>
		</header>
		<div class="form">
			<div class="row">
				<div class="label">
					<label for="posts">Plaatje</label> 
				</div>
				<select id="images" name="image">
					<?php foreach($images as $image): ?>
						<option value="<?php echo $image->id; ?>" src="/uploads/images/<?php echo $image->folder; ?>/large/<?php echo $image->src; ?>"><?php echo $image->title; ?></option>
					<?php endforeach; ?>
				
				</select>
			</div>
			<div class="row ltags">
				<div class="label">
					Tags gekoppeld aan dit plaatje
				</div>
				<div id="linkedTags"></div>
			</div>
			<div class="clear"></div>
			<div class="row tags">
				<div class="label">
					Alle tags
				</div>
				<?php 
				foreach($tags as $id => $tag ) :
					echo "<a class=\"tag tag-$id\" id=\"$id\" onclick=\"addTag($id);\"><span>+</span>  $tag</a>";
				endforeach;
				?>
			</div>
			
		</div>
	</article>

</div>
<script>
var imageSelectBox = $('#images');
var imageId = $('#images').val();
var linkedTagsDiv = $('#linkedTags');
var TagsDiv = $('.row.tags');
$(function () {
	var imageId = $('#images').val();
	$('a.tag').each(function () {
		$(this).find('span').html('+');
		TagsDiv.append($(this));
	});
	$.getJSON('/backend/ajaxGetTags', {imageid:imageId, for:'image'},  function (data) {
		$.each(data, function (ind, value) {
			var tagLink = $('a#'+ind);
				tagLink.find('span').html('-');
				linkedTagsDiv.append(tagLink);
		});
	});
	imageSelectBox.change(function () {
		var imageId = $('#images').val();
		$('#previewImg').attr('src', $('#images').find('option:selected').attr('src'));
		$('a.tag').each(function () {
			$(this).find('span').html('+');
			TagsDiv.append($(this));
		});
		$.getJSON('/backend/ajaxGetTags', {imageid:imageId, for:'image'},  function (data) {
			$.each(data, function (ind, value) {
				var tagLink = $('a#'+ind);
				tagLink.find('span').html('-');
				linkedTagsDiv.append(tagLink);
			});
		});
	});
});

	function addTag(id) {
		var imageId = $('#images').val();
		$.getJSON('/backend/ajaxAttachTag', {imageid:imageId, tagid:id, to:'image'},  function (data) {
			var tagLink = $('a#'+id);
			if (data.status == 'new') {
				tagLink.find('span').html('-');
				linkedTagsDiv.append(tagLink);
			} else if (data.status == 'removed') {
				tagLink.find('span').html('+');
				TagsDiv.append(tagLink);
			}
		});
	}

</script>
<aside class="text">
	<header>
		<h2 class="ringbearer">Voorbeeld</h2>
	</header>
	<img src=""  id="previewImg" />
</aside>
