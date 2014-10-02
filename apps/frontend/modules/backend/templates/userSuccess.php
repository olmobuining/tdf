<div class="page-left">
	<article class="main">
		<header>
			<h1 class="large">Gegevens van <?php echo $user->username; ?></h1>
		</header>
		<table>
			<tr>
				<td>
					<strong>Gebruikersnaam: </strong>
				</td>
				<td>
					<?php echo $user->username; ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Guild rank:</strong>
				</td>
				<td>
					<?php echo $user->Rank->name; ?>
				</td>
			</tr>
			<?php if($officer = $user->isOfficer()) : ?>
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
		<section class="comments">
			<header>
				<h2 class="ringbearer">Karakters van <?php echo $user->username; ?></h2>
			</header>
			<table cellpadding="0" cellspacing="0" class="character-table">
				<thead class="ringbearer">
					<th>Naam</th>
					<th>Profession</th>
					<th>Ras</th>
					<th>Level</th>
				</thead>
				<tbody>
					<?php if (count($user->myCharacters) == 0) : ?>
						<tr>
							<td colspan="4"><?php echo $user->username; ?> heeft nog geen karakters</td>
						</tr>
					<?php else : ?>
						<?php foreach ($user->myCharacters as $char) :?>
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
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</section>
		<section class="comments">
		<h2 class="ringbearer">reacties van <?php echo $user->username; ?></h2>
		<?php if (count($user->Comments) == 0) : ?>
			<article class="error">
				<p><?php echo $user->username; ?> heeft nog geen reacties geplaatst</p>
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
<aside class="related">
	<header>
		<h2 class="ringbearer">Blogs van <?php echo $user->username; ?></h2>
	</header>
	<?php if (count($user->Posts) == 0) : ?>
		<article class="error">
			<p><?php echo $user->username; ?> heeft nog geen blogs geplaatst</p>
		</article>
	<?php endif; ?>
	<?php $i=0; ?>
	<?php foreach ($user->Posts as $blog): ?>
		<?php include_component('blog', 'relatedBlog', array('blog' => $blog)); ?>
		<?php $i++;?>
		<?php if ($i == 15) : ?>
			<?php break; ?>
		<?php endif; ?>
	<?php endforeach; ?>
</aside>