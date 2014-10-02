<div class="page-left">
	<article class="main">
		<header>
			<h1 class="large">Mijn gegevens</h1>
		</header>
		<table>
			<tr>
				<td>
					<strong>Gebruikersnaam: </strong>
				</td>
				<td>
					<?php echo $userLogged->username; ?> &nbsp;&nbsp;&nbsp; <a href="<?php echo url_for('change', array('what' => 'username', 'id' => 1)); ?>">Gebruikersnaam aanpassen.</a>
				</td>
			</tr>
			<?php if (($userLogged->first_name != '') OR ($userLogged->last_name != '')) : ?>
				<tr>
					<td>
						<strong>Naam:</strong>
					</td>
					<td>
						<?php echo $userLogged->first_name . ' ' .$userLogged->last_name; ?>
					</td>
				</tr>
			<?php endif; ?>
			
			<?php if ($userLogged->birthdate != 0) : ?>
				<tr>
					<td>
						<strong>Geboortedatum:</strong>
					</td>
					<td>
						<?php echo date('d-m-Y', $userLogged->birthdate); ?>
					</td>
				</tr>
			<?php endif; ?>
			<tr>
				<td>
					<strong>E-mail:</strong>
				</td>
				<td>
					<?php echo $userLogged->email; ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Guild rank:</strong>
				</td>
				<td>
					<?php echo $userLogged->Rank->name; ?>
				</td>
			</tr>
			<?php if($officer = $userLogged->isOfficer()) : ?>
			<tr>
				<td>
					<strong>Officer:</strong>
				</td>
				<td>
					<?php echo $officer->description; ?>
				</td>
			</tr>
			<?php endif; ?>
			<tr>
				<td>
					<strong>Geregistreerd:</strong>
				</td>
				<td>
					<?php 
					if($registrationDate->created_at == 1):
						echo "Voor 1 Juli 2012";
					elseif(!is_null($registrationDate->created_at)):
						echo strftime("%e %B %G", $registrationDate->created_at);
					endif;
					?>
				</td>
			</tr>
		</table>
		<?php /*
		<section class="comments">
			<header>
				<h2 class="ringbearer">Mijn karakters</h2>
			</header>
			
			<script>
				function hideField(id) {
					$('td.level-up-field'+id).show()
				}
				function doLevel(action, id) {
					$('td.level-up-field'+id).hide();
					if ((action == 'up') || (action == 'down')) {
						$.getJSON('/backend/levelCharacter/id/'+id+'/doWhat/'+action, function(data) {
							if (data.error == false) {
								$('td.level'+id).html(data.newLevel);
								if(parseInt(data.newLevel) == 80) {
									console.log(data.message);
									$('td.level-up-field'+id).hide();	
								} else {
									var t = setTimeout( "hideField("+id+")", 250);
								}
							} else {
								console.log(data.message);
							}
						});
					}else {
					}
				}
			</script>
			<table cellpadding="0" cellspacing="0" class="character-table">
				<thead class="ringbearer">
					<th>Naam</th>
					<th>Profession</th>
					<th>Ras</th>
					<th>Level</th>
					<th>&nbsp;</th>
				</thead>
				<tbody>
					<?php foreach ($userLogged->myCharacters as $char) :?>
						<tr>
							<td>
								<?php echo $char->name; ?>
							</td>
							<td>
								<?php echo $char->Profession->name; ?>
							</td>
							<td>
								<?php echo $char->Race->name; ?>
							</td>
							<td class="level<?php echo $char->id ?>">
								<?php echo $char->level; ?>
							</td>
							<td class="level-up-field<?php echo $char->id ?>">
								<?php if($char->level != 80): ?>
									<a href="javascript:void(0);" onclick="doLevel('up', <?php echo $char->id; ?>)">Level up!</a>
								<?php endif; ?>
							</td>
						</tr>
						<?php 
						// Remove level button
						/*<br> <a href="javascript:void(0);" onclick="doLevel('down', <?php echo $char->id; ?>)">Min</a> */ ?><?php /*
					<?php endforeach; ?>
					<?php if($userLogged->Permission->level > 1 && count($userLogged->myCharacters) < $maxchars):?>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><a href="<?php echo url_for('add-character'); ?>">Karakter toevoegen</a></td>
					<?php endif; ?>
				</tbody>
			</table>
			<br><br><br>
			<p>Wil je een karakter <strong>verwijderen</strong> / <strong>aanpassen</strong>?<br> 
			Mail dan naar info@guild-tdf.nl met wat je wilt aanpassen of verwijderen. Of neem contact op met K!ll0</p>
		</section>
		*/ ?>
		<section class="comments">
		<h2 class="ringbearer">Mijn reacties</h2>
		<?php if (count($userLogged->Comments) == 0) : ?>
			<article class="error">
				<p>U heeft nog geen reacties geplaatst</p>
			</article>
		<?php else: ?>
			<?php $i = 0; ?>
			<?php foreach($comments as $comment): ?>
				<article <?php if($i == 0) { echo 'class="first"'; } ?>>
					<header>
						<h3>Reactie op 
						<?php if ($comment->post_id != null) : ?>
							blog: <a href="<?php echo url_for('blog_item', array('type' => $comment->Post->PostType->slug, 'slug' => $comment->Post->slug)); ?>"><?php echo $comment->Post->title; ?></a>
						<?php elseif($comment->image_id != null): ?>
							<?php 
							foreach ($comment->Image->Albums as $album) {
								break;	
							}
							?>
							plaatje: <a href="<?php echo url_for('image', array('type' => 'album', 'type_slug' => $album->slug, 'image_slug' => $comment->Image->slug)); ?>"><?php echo $comment->Image->title; ?></a>
						<?php endif; ?>
						
						 </h3><time><?php echo date('j-m-Y H:i:s', $comment->created_at); ?></time>
					</header>
					<p><?php echo nl2br($comment->text); ?></p>
				</article>
				<?php $i++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</section>
	</article>
	
</div>
<?php if ($userLogged->Permission->level > 1 && $ts3token !== false) : ?>
<aside class="text">
	<header>
		<h2 class="ringbearer">Teamspeak</h2>
	</header>
	<p><a href="ts3server://ts.gulid-tdf.nl?nickname=<?php echo $userLogged->username; ?>&addbookmark=The%20Dutch%20Fellowship&token=<?php echo $ts3token->description; ?>">Maak een bookmark.</a> <br>
	Na het klikken op "Maak een bookmark" zal Teamspeak openen. Dan vraagt hij voor een aantal opties. <br>
	Daar <strong>kies je "bookmark only"</strong>.<br>
	Zodra je dit gedaan hebt klik je op de onderstaande link(Verbind met de server).<br><br></p>
	<p><a href="ts3server://ts.gulid-tdf.nl?nickname=<?php echo $userLogged->username; ?>&addbookmark=The%20Dutch%20Fellowship">Verbind met de server.</a><br>
	<br>
	Als je eenmaal een bookmark hebt gemaakt en verbonden bent met de teamspeak server kun je voortaan verbinden via de bookmark in Teamspeak. Of met de link "verbind met de server". <strong>Gebruik de link "Maak een bookmark" niet nogmaals!</strong></p>
</aside>
<?php endif; ?>
<?php if ($userLogged->Permission->level > 24) : ?>
<aside class="text">
	<header>
		<h2 class="ringbearer">Links</h2>
	</header>
	<?php if ($userLogged->Permission->level > $blogReq['new']) : ?>
		<p><a href="<?php echo url_for('post-blog', array('type' => 'news')); ?>">Nieuwe nieuws blog.</a></p>
		<p><a href="<?php echo url_for('post-blog', array('type' => 'beginners')); ?>">Nieuwe beginners blog.</a></p>
	<?php endif; ?>
	<?php if ($userLogged->Permission->level > $tagReq['attach']) : ?>
		<p><a href="<?php echo url_for('attach-tag'); ?>">Tags linken aan een blog.</a></p>
	<?php endif; ?>
	<?php if ($userLogged->Permission->level > $tagReq['new']) : ?><br>
		<p><a href="<?php echo url_for('new-tag'); ?>">Nieuwe tag.</a></p>
	<?php endif; ?>
	<?php if ($userLogged->Permission->level > $newEventReq) : ?><br>
		<p><a href="<?php echo url_for('new-event'); ?>">Nieuw Event</a></p>
	<?php endif; ?>
	<?php if ($userLogged->Permission->level > sfConfig::get('app_image_new')) : ?><br>
		<p><a href="<?php echo url_for('new-image'); ?>">Nieuw Plaatje</a></p>
		<p><a href="<?php echo url_for('attach-tag-image'); ?>">Plaatje koppelen met tag</a></p>
		<p><a href="<?php echo url_for('attach-image-type'); ?>">Plaatje type koppelen</a></p>
		<p><a href="<?php echo url_for('attach-image-album'); ?>">Plaatje toevoegen aan album</a></p>
	<?php endif; ?>
</aside>
<?php endif; ?>
<aside class="related">
	<header>
		<h2 class="ringbearer">Mijn blogs</h2>
	</header>
	<?php if (count($userLogged->Posts) == 0) : ?>
		<article class="error">
			<p>U heeft nog geen blogs geplaatst</p>
		</article>
	<?php endif; ?>
	<?php $i=0; ?>
	<?php foreach ($userLogged->Posts as $blog): ?>
		<?php include_component('blog', 'relatedBlog', array('blog' => $blog)); ?>
		<?php $i++;?>
		<?php if ($i == 15) : ?>
			<?php break; ?>
		<?php endif; ?>
	<?php endforeach; ?>
</aside>
