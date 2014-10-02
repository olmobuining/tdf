<div class="page-left">
	<article class="form">
		<header>
			<h1 class="large">Plaatje in album toevoegen</h1>
		</header>
		<form action="<?php echo url_for('attach-image-album'); ?>" method="post" id="attach">
		<div class="form">
			<div class="row">
				<div class="label">
					<label for="posts">Plaatje</label> 
				</div>
				<select id="images" name="image">
					<?php foreach($images as $image): ?>
						<option value="<?php echo $image->id; ?>"><?php echo $image->title; ?></option>
					<?php endforeach; ?>
				
				</select>
			</div>
			<div class="row">
				<div class="label">
					<label for="tags">Album</label> 
				</div>
				<select id="tags" name="album">
					<?php foreach($albums as $album): ?>
						<option value="<?php echo $album->id; ?>"><?php echo $album->name; ?></option>
					<?php endforeach; ?>
				
				</select>
			</div>
			<div class="row">
				<?php echo $message; ?>
			</div>
			<div class="row">
				<button type="submit">Opslaan</button>
			</div>
		</div>
		</form>
	</article>

</div>
<aside class="text">
	<header>
		<h2 class="ringbearer">Foutmeldingen</h2>
	</header>
	<ul>
		
	</ul>
</aside>
