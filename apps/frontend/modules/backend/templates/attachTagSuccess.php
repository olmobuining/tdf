<div class="page-left">
	<article class="form">
		<header>
			<h1 class="large">Tag linken aan blogs</h1>
		</header>
		<div class="form">
			<div class="row">
				<div class="label">
					<label for="posts">Blogs</label> 
				</div>
				<select id="blogs" name="blog">
					<?php foreach($blogs as $blog): ?>
						<option value="<?php echo $blog->id; ?>"><?php echo $blog->title; ?></option>
					<?php endforeach; ?>
				
				</select>
			</div>
			<div class="row ltags">
				<div class="label">
					Tags voor deze blog
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
var blogSelectBox = $('#blogs');
var blogId = $('#blogs').val();
var linkedTagsDiv = $('#linkedTags');
var TagsDiv = $('.row.tags');
$(function () {
	var blogId = $('#blogs').val();
	$('a.tag').each(function () {
		$(this).find('span').html('+');
		TagsDiv.append($(this));
	});
	$.getJSON('/backend/ajaxGetTags', {blogid:blogId, for:'blog'},  function (data) {
		$.each(data, function (ind, value) {
			var tagLink = $('a#'+ind);
				tagLink.find('span').html('-');
				linkedTagsDiv.append(tagLink);
		});
	});
	blogSelectBox.change(function () {
		var blogId = $('#blogs').val();
		$('a.tag').each(function () {
			$(this).find('span').html('+');
			TagsDiv.append($(this));
		});
		$.getJSON('/backend/ajaxGetTags', {blogid:blogId, for:'blog'},  function (data) {
			$.each(data, function (ind, value) {
				var tagLink = $('a#'+ind);
				tagLink.find('span').html('-');
				linkedTagsDiv.append(tagLink);
			});
		});
	});
});

	function addTag(id) {
		var blogId = $('#blogs').val();
		$.getJSON('/backend/ajaxAttachTag', {blogid:blogId, tagid:id, to:'blog'},  function (data) {
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
		<h2 class="ringbearer">Foutmeldingen</h2>
	</header>
	<ul>
		
	</ul>
</aside>
