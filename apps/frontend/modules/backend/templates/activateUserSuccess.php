<div class="page-left">
	<article class="form">
		<header>
			<h1 class="large">Activeer gebruiker</h1>
		</header>
		<form action="<?php echo url_for('activate_user'); ?>" method="post" id="activate">
		<div class="form">
			<div class="row">
				<div class="label">
					<label for="posts">Gebruiker</label> 
				</div>
				<select id="user" name="user">
					<?php foreach($users as $user): ?>
						<option value="<?php echo $user->id; ?>"><?php echo $user->username.' &nbsp;&nbsp;'. $user->email; ?></option>
					<?php endforeach; ?>
				
				</select>
			</div>
			<div class="row">
				<?php echo $message; ?>
			</div>
			<div class="row">
				<button type="submit">Activeer</button>
			</div>
		</div>
		</form>
	</article>

</div>
