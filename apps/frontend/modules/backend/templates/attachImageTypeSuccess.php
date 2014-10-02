<div class="page-left">
	<article class="form">
		<header>
			<h1 class="large">Type koppelen</h1>
		</header>
		<form action="<?php echo url_for('attach-image-type'); ?>" method="post" id="attach">
		<div class="form">
			<div class="row">
				<div class="label">
					<label for="images">Plaatje</label> 
				</div>
				<select id="images" name="image">
					<?php foreach($images as $image): ?>
						<option value="<?php echo $image->id; ?>"><?php echo $image->title; ?></option>
					<?php endforeach; ?>
				
				</select>
			</div>
			<div class="row">
				<div class="label">
					<label for="type">Type</label> 
				</div>
				<select id="type" name="type">
						<option value="1">Main Image</option>
						<option value="2">Sub Image</option>
						<option value="5">Random Image</option>
				
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
