<div class="breadcrums">
	<a href="<?php echo url_for('homepage'); ?>">Home</a> &raquo;
	<a href="<?php echo url_for('calendar', array('month' => date('n', $event->start), 'year' =>  date('Y', $event->start) ) ); ?>">Kalender</a> &raquo;
	<a href="<?php echo url_for('event', array('slug' => $event->slug)); ?>"><?php echo $event->name; ?></a> 
</div>
<article class="event">
	<header>
		<h1 class="ringbearer"><?php echo $event->name; ?></h1>
	</header>
	<?php if (($userLogged->Permission->level > sfConfig::get('app_event_edit_all'))) : ?>
		<p><a href="<?php echo url_for('edit-public-event', array('id' => $event->id)); ?>">Bewerk Event</a></p>
		<?php if(!is_null($event->points)): ?>
			<?php if (time() > $event->start): ?>
				<p><a href="<?php echo url_for('give-points', array('eventId' => $event->id)); ?>">Geef punten</a></p>
			<?php endif; ?>
		<?php endif; ?>
	<?php elseif(($userLogged->Permission->level > sfConfig::get('app_event_public_edit') && $userLogged->id == $event->User->id)): ?>
		<p><a href="<?php echo url_for('edit-public-event', array('id' => $event->id)); ?>">Bewerk Event</a></p>
	<?php endif; ?>
	<p><?php echo strftime('%A',$event->start).' '.strftime('%d', $event->start).' '.strftime('%B', $event->start).' '.date('H:i', $event->start) ?></p>
	<?php echo html_entity_decode(nl2br($event->description)); ?>
	<?php if ( count($approvedCharacters) > 0 ) : ?>
		<section class="comments">
			<header>
				<h2 class="ringbearer">Toegelaten Deelnemers</h2>
			</header>
			<table cellpadding="0" cellspacing="0" class="character-table">
				<thead class="ringbearer">
					<tr>
						<th>
							Naam
						</th>
						<th>
							Profession
						</th>
						<th>
							Level
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($approvedCharacters as $char): ?>
						<tr>
							<td>
								<a href="<?php echo url_for('user', array('slug' => $char->myCharacter->User->slug)); ?>" title="Karakter van <?php echo $char->myCharacter->User->username ?>"><?php echo $char->myCharacter->name; ?></a>
							</td>
							<td>
								<?php echo $char->myCharacter->Profession->name; ?>
							</td>
							<td>
								<?php echo $char->myCharacter->level; ?>
							</td>
							<?php if($userLogged->id == $event->user_id || $userLogged->Permission->level > sfConfig::get('app_event_accept_all')): ?>
								<td>
									<a href="<?php echo url_for('changeStatus', array('eventId' => $event->id, 'charId' => $char->myCharacter->id, 'changeTo' => 'backup')); ?>">Backup</a>
								</td>
								<td>
									<a href="<?php echo url_for('changeStatus', array('eventId' => $event->id, 'charId' => $char->myCharacter->id, 'changeTo' => 'maybe')); ?>">Misschien</a>
								</td>
								<td>
									<a href="<?php echo url_for('changeStatus', array('eventId' => $event->id, 'charId' => $char->myCharacter->id, 'changeTo' => 'remove')); ?>">Verwijder</a>
								</td>
							<?php endif; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</section>
	<?php endif; ?>
	<?php if ( count($backupCharacters) > 0 ) : ?>
		<section class="comments">
			<header>
				<h2 class="ringbearer">Backup Deelnemers</h2>
			</header>
			<table cellpadding="0" cellspacing="0" class="character-table">
				<thead class="ringbearer">
					<tr>
						<th>
							Naam
						</th>
						<th>
							Profession
						</th>
						<th>
							Level
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($backupCharacters as $char): ?>
						<tr>
							<td>
								<?php echo $char->myCharacter->name; ?>
							</td>
							<td>
								<?php echo $char->myCharacter->Profession->name; ?>
							</td>
							<td>
								<?php echo $char->myCharacter->level; ?>
							</td>
							<?php if($userLogged->id == $event->user_id || $userLogged->Permission->level > sfConfig::get('app_event_accept_all')): ?>
								<td>
									<a href="<?php echo url_for('changeStatus', array('eventId' => $event->id, 'charId' => $char->myCharacter->id, 'changeTo' => 'accept')); ?>">Accepteer</a>
								</td>
								<td>
									<a href="<?php echo url_for('changeStatus', array('eventId' => $event->id, 'charId' => $char->myCharacter->id, 'changeTo' => 'maybe')); ?>">Misschien</a>
								</td>
								<td>
									<a href="<?php echo url_for('changeStatus', array('eventId' => $event->id, 'charId' => $char->myCharacter->id, 'changeTo' => 'remove')); ?>">Verwijder</a>
								</td>
							<?php endif; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</section>
	<?php endif; ?>
	<?php if ( count($maybeCharacters) > 0 ) : ?>
		<section class="comments">
			<header>
				<h2 class="ringbearer">Misschien</h2>
			</header>
			<table cellpadding="0" cellspacing="0" class="character-table">
				<thead class="ringbearer">
					<tr>
						<th>
							Naam
						</th>
						<th>
							Profession
						</th>
						<th>
							Level
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($maybeCharacters as $char): ?>
						<tr>
							<td>
								<?php echo $char->myCharacter->name; ?>
							</td>
							<td>
								<?php echo $char->myCharacter->Profession->name; ?>
							</td>
							<td>
								<?php echo $char->myCharacter->level; ?>
							</td>
							<?php if($userLogged->id == $event->user_id || $userLogged->Permission->level > sfConfig::get('app_event_accept_all')): ?>
								<td>
									<a href="<?php echo url_for('changeStatus', array('eventId' => $event->id, 'charId' => $char->myCharacter->id, 'changeTo' => 'accept')); ?>">Accepteer</a>
								</td>
								<td>
									<a href="<?php echo url_for('changeStatus', array('eventId' => $event->id, 'charId' => $char->myCharacter->id, 'changeTo' => 'backup')); ?>">Backup</a>
								</td>
								<td>
									<a href="<?php echo url_for('changeStatus', array('eventId' => $event->id, 'charId' => $char->myCharacter->id, 'changeTo' => 'remove')); ?>">Verwijder</a>
								</td>
							<?php endif; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</section>
	<?php endif; ?>
	<?php if ( count($pendingCharacters) > 0 ) : ?>
		<section class="comments">
			<header>
				<h2 class="ringbearer">Nog niet geaccepteerd</h2>
			</header>
			<table cellpadding="0" cellspacing="0" class="character-table">
				<thead class="ringbearer">
					<tr>
						<th>
							Naam
						</th>
						<th>
							Profession
						</th>
						<th>
							Level
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($pendingCharacters as $char): ?>
						<tr>
							<td>
								<?php echo $char->myCharacter->name; ?>
							</td>
							<td>
								<?php echo $char->myCharacter->Profession->name; ?>
							</td>
							<td>
								<?php echo $char->myCharacter->level; ?>
							</td>
							<?php if($userLogged->id == $event->user_id || $userLogged->Permission->level > sfConfig::get('app_event_accept_all')): ?>
								<td>
									<a href="<?php echo url_for('changeStatus', array('eventId' => $event->id, 'charId' => $char->myCharacter->id, 'changeTo' => 'accept')); ?>">Accepteer</a>
								</td>
								<td>
									<a href="<?php echo url_for('changeStatus', array('eventId' => $event->id, 'charId' => $char->myCharacter->id, 'changeTo' => 'backup')); ?>">Backup</a>
								</td>
								<td>
									<a href="<?php echo url_for('changeStatus', array('eventId' => $event->id, 'charId' => $char->myCharacter->id, 'changeTo' => 'maybe')); ?>">Misschien</a>
								</td>
							<?php endif; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</section>
	<?php endif; ?>

</article>

<aside class="text">
	<header>
		<h2 class="ringbearer">Informatie</h2>
	</header>
	<table cellspacing="0" cellpadding="0">
		<tr>
			<td>
				Door:
			</td>
			<td>
				<?php echo $event->User->username; ?>
			</td>
		</tr>
		<tr>
			<td>
				Datum:
			</td>
			<td>
				<?php echo strftime('%A',$event->start).'<br>'.strftime('%d', $event->start).' '.strftime('%B', $event->start); ?>
			</td>
		</tr>
		<tr>
			<td>
				Verzameltijd:
			</td>
			<td>
				 <?php echo date('H:i', $event->start-($event->pre*60)); ?>
			</td>
		</tr>
		<tr>
			<td>
				Start tijd:
			</td>
			<td>
				<?php echo date('H:i', $event->start); ?>
			</td>
		</tr>
		<?php if (date('j', $event->start) != date('j', $event->start+($event->end*60))): ?>
		<tr>
			<td>
				Eind datum:
			</td>
			<td>
				<?php echo strftime('%A',$event->start+($event->end*60)).'<br>'.strftime('%d', $event->start+($event->end*60)).' '.strftime('%B', $event->start+($event->end*60)); ?>
			</td>
		</tr>
		<?php endif; ?>
		<tr>
			<td>
				Verwachte eind tijd:
			</td>
			<td>
				<?php echo date('H:i', $event->start+($event->end*60)); ?>
			</td>
		</tr>
		<tr>
			<td>
				Guild Evenement
			</td>
			<td class="<?php if (($event->guild_event)): echo "yes"; else: echo "no"; endif; ?>">
			</td>
		</tr>
		<?php if (!is_null($event->points)): ?>
		<tr>
			<td>
				Deelname punten:
			</td>
			<td>
				<?php echo $event->points; ?>
			</td>
		</tr>
		<?php endif; ?>
		<tr>
			<td>
				Maximaal aantal deelnemers:
			</td>
			<td>
				<?php echo $event->max_myCharacters; ?>
			</td>
		</tr>
		<tr>
			<td>
				Minimaal level:
			</td>
			<td>
				<?php echo $event->min_level_requirement; ?>
			</td>
		</tr>
		<tr>
			<td>
				Evenement type:
			</td>
			<td>
			<?php if ($event->approval_needed === false): ?>
				Open*
			<?php else: ?>
				Gesloten*
			<?php endif; ?>
			</td>
		</tr>
	</table>
	<p>
			<?php if ($event->approval_needed === false): ?>
				* Iedereen word gelijk aangenomen als deelnemer na het aanmelden.
			<?php else: ?>
				* Er is eerst toestemming nodig om mee te kunnen doen aan dit evenement.
			<?php endif; ?></p>
	<!--
		<p>
			<strong></strong> <br><br>
			<?php if (($event->guild_event)): ?>
				<strong>Guild Evenement!</strong><br><br>
			<?php endif; ?>
			<?php if (!is_null($event->points)): ?>
				<strong>Deelname punten:</strong> <?php echo $event->points; ?><br>
			<?php endif; ?>
			<strong>Maximaal aantal deelnemers:</strong> <?php echo $event->max_myCharacters; ?><br>
			<strong>Minimaal level:</strong> <?php echo $event->min_level_requirement; ?><br>
			<?php if ($event->approval_needed === false): ?>
				Open Evenement.
			<?php else: ?>
				Goed keuring nodig om in dit evenement deel te nemen.
			<?php endif; ?>
		</p><br><br>-->
</aside>
<?php if (time() < $event->start): ?>
<aside class="text">
	<header>
		<h2 class="ringbearer">Aanmelden
		<?php if ( count($approvedCharacters) > $event->max_myCharacters) : ?> als backup<?php endif; ?></h2>
	</header>
	<?php if(!$event->checkForUser($userLogged->id)) : ?>
		<?php if(count($userLogged->myCharacters) > 0):?>
			<p>
				<form action="<?php echo url_for('event', array('slug' => $event->slug)); ?>" method="post" name="joinEvent">
					<select id="char" name="char">
						<?php foreach ($userLogged->myCharacters as $char) :?>
							<?php if($char->level >= $event->min_level_requirement): ?>
								<option value="<?php echo $char->id; ?>"><?php echo $char->name; ?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
					<button>Aanmelden!</button>
				</form><br>
				<?php echo $formMessage; ?>
			</p><br><br>
		<?php endif; ?>
	<?php else: ?>
		<p>Je bent aangemeld met Karakter: 
		<?php 
		$signedChar = $event->getSignedCharacter($userLogged->id);
		if ($signedChar !== false): ?>
			<?php echo $signedChar->name.', '.$signedChar->Profession->name; ?>
		<?php endif; ?></p>
		<p><a href="<?php echo url_for('remove-char', array('eventId' => $event->id) );?>">Klik hier om je af te melden</a></p>
	<?php endif; ?><br><br>

</aside>
<?php endif; ?>