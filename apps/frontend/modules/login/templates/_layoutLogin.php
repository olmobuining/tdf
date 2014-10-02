<?php if ($isLoggedIn) : ?>
	<?php if ($userLogged) : ?>
		<?php if ($userLogged->Permission->level > 0) : ?>
			<a href="http://www.facebook.com/groups/thedutchfellowship/" target="_new" id="fb-link"></a>
			<a href="<?php echo url_for('my_account'); ?>" id="my-account-link"></a>
			<a href="<?php echo url_for('calendar'); ?>" id="calendar-link"></a>
		<?php endif; ?>
		<?php if ($userLogged->Permission->level > 99) : ?>
			<ul id="admin-link">
				<ul id="admin-tab">
					<li><a href="<?php echo url_for('activate_user'); ?>">User activeren</a></li>
					<li><a href="<?php echo url_for('userlist'); ?>">User lijst</a></li>
					<li><a href="<?php echo url_for('statistics'); ?>">Statistics</a></li>
					<li><a href="<?php echo url_for('adminlog'); ?>">Adminlog</a></li>
					<li><a href="<?php echo url_for('new-characters'); ?>">Nieuwe karakters</a></li>
					<li><a href="<?php echo url_for('activityCheckpage'); ?>">Activiteits checker leden</a></li>
				</ul>
			</ul>
		<?php endif; ?>
		<?php if ($userLogged->Permission->level > 0) : ?>
			<ul id="mychars-link">
				<ul id="mychars-tab">
					<?php foreach($userLogged->getMyCharacters() as $character) :?>
						<li id="char-<?php echo $character->id; ?>-listitem"><span class="profession-<?php echo $character->Profession->id ?>"></span><?php echo $character->name; ?><a id="char-levelup-<?php echo $character->id; ?>" class="<?php if($character->level == 80): ?>empty-up<?php else: ?>up<?php endif; ?>" onclick="doLevelNew('up', '<?php echo $character->id; ?>')"></a><span class="level">lvl <?php echo $character->level; ?></span></li>
					<?php endforeach; ?>
						<?php if(count($userLogged->myCharacters) < sfConfig::get('app_character_maxcharacters')):?>
							<a href="<?php echo url_for('add-character'); ?>">Karakter toevoegen</a>
						<?php endif; ?>
						<p>Wil je een karakter <strong>verwijderen</strong> / <strong>aanpassen</strong>?<br> 
						Mail dan naar info@guild-tdf.nl met wat je wilt aanpassen of verwijderen. Of neem contact op met Killo(Ingame: Arazu Erebus)</p>
				</ul>
			</ul>
		<?php endif; ?>
		<a href="<?php echo url_for('logout'); ?>" id="logout-link"></a>
		<?php if ($userLogged->Permission->level > 0) : ?>
			<p>Welkom terug, <a href="<?php echo url_for('my_account'); ?>"><?php echo $userLogged->username; ?></a></p>
		<?php else : ?>
			<p>Je account is nog niet geactiveerd</p>
		<?php endif; ?>
	<?php endif; ?>
<?php else: ?>
	<a href="<?php echo url_for('login'); ?>" id="login-link"></a>
<?php endif; ?>
<script>
function hideFieldNew(id) {
	$('a#char-levelup-'+id).show()
}
function doLevelNew(action, id) {
	$('a#char-levelup-'+id).hide();
	if ((action == 'up')) {
		$.getJSON('/backend/levelCharacter/id/'+id+'/doWhat/'+action, function(data) {
			if (data.error == false) {
				$('li#char-'+id+'-listitem > span.level').html("lvl "+data.newLevel);
				if(parseInt(data.newLevel) == 80) {
					console.log(data.message);
					$('a#char-levelup-'+id).hide();	
				} else {
					var t = setTimeout( "hideFieldNew("+id+")", 250);
				}
			} else {
				console.log(data.message);
			}
		});
	}else {
	}
}
</script>