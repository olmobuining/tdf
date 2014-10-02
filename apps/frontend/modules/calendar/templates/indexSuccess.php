<article class="calendar">

	<section class="months">
		<section class="monthsContainer">
			<section class="month">
				<?php if ($month-1 < 1) { $yearMinus = $year-1; $monthMinus = 12; } else { $yearMinus = $year; $monthMinus = $month-1; } ?>
				<?php if ($month+1 > 12) { $yearPlus = $year+1; $monthPlus = 1;} else { $yearPlus = $year; $monthPlus = $month+1;} ?>
				<a href="<?php echo url_for('calendar', array('month' => $monthMinus, 'year' => $yearMinus)); ?>"><h2 class="ringbearer"><?php echo strftime('%B',mktime(0,0,0,$monthMinus, 1, $yearMinus)); ?></h2></a>
				<h1 class="ringbearer"><?php echo strftime('%B',mktime(0,0,0,$month, 1, $year)); ?></h1>
				<a href="<?php echo url_for('calendar', array('month' => $monthPlus, 'year' => $yearPlus)); ?>"><h2 class="ringbearer"><?php echo strftime('%B',mktime(0,0,0,$monthPlus, 1, $yearPlus)); ?></h2></a>
			</section>
		</section>
	</section>
	<section class="daysHeader">
		<div class="day">
			<h3 class="ringbearer"><?php echo $daysShort[1]; ?></h3>
		</div>
		<div class="day">
			<h3 class="ringbearer"><?php echo $daysShort[2]; ?></h3>
		</div>
		<div class="day">
			<h3 class="ringbearer"><?php echo $daysShort[3]; ?></h3>
		</div>
		<div class="day">
			<h3 class="ringbearer"><?php echo $daysShort[4]; ?></h3>
		</div>
		<div class="day">
			<h3 class="ringbearer"><?php echo $daysShort[5]; ?></h3>
		</div>
		<div class="day">
			<h3 class="ringbearer"><?php echo $daysShort[6]; ?></h3>
		</div>
		<div class="day">
			<h3 class="ringbearer"><?php echo $daysShort[7]; ?></h3>
		</div>
	</section>
	<br style="clear:both;">
	<br>
	<?php //echo  mktime(22,0,0,5, 19,date('y', $today)); ?>
	<section class="days">
		<?php while($blank > 0): ?>
			<div class="day">
				<div class="date">
					&nbsp;
				</div>
			</div>
			<?php $blank = $blank-1; ?>
			<?php $countDays++; ?>
		<?php endwhile; ?>
		<?php $dayNumber = 1; ?>
		<?php while($dayNumber <= $daysInMonth): ?>
			<?php 
			if ($dayNumber == date('j', $today) && $month == date('n', $today) && $year == date('Y', $today)) {
				$classToday = 'today';
			} else {
				$classToday = '';
			}
			?>
			<?php if($countDays == 7): ?>
				<div class="day last <?php echo $classToday; ?>">
			<?php else: ?>
				<div class="day <?php echo $classToday; ?>">
			<?php endif; ?>
				<div class="date">
					<?php echo $dayNumber ?>
					<?php if ($userLogged->Permission->level > sfConfig::get('app_event_public_new')): ?>
						<a  href="<?php echo url_for('new-public-event'); ?>/date/<?php echo date('d-n-Y', mktime(0,0,0,$month,$dayNumber,$year)); ?>" class="add-event"></a>
					<?php endif; ?>
				</div>
				<div class="data">
					<?php 
					$startDay = mktime(0,0,0,$month,$dayNumber,$year);
					$endDay = mktime(24,0,0,$month,$dayNumber,$year);
					
					$eventsForToday = Doctrine::getTable('Event')->getAllInRange($startDay, $endDay);
					
					
					foreach($eventsForToday as $event) {
						
						echo '<strong>'.date('H:i', $event->start). '</strong> - <a href="'.url_for('event', array('slug' => $event->slug)). "\"";
						if ($event->guild_event) {
							echo "class=\"guild-event\"";
						}
						echo '>'.$event->name.'</a><br>';	
						
					}
					?>
					
				</div>
			</div>
			<?php $dayNumber++; ?>
			<?php $countDays++; ?>
			<?php if($countDays > 7): ?>
				</section>
				<section class="days">
				<?php $countDays = 1; ?>
			<?php endif; ?>
		<?php endwhile; ?>
		<?php while($countDays >1 && $countDays <= 7): ?>
			<?php if($countDays == 7): ?>
				<div class="day last">
			<?php else: ?>
				<div class="day">
			<?php endif; ?>
				<div class="date">
					&nbsp;
				</div>
			</div>
			<?php $countDays++; ?>
		<?php endwhile; ?>
	</section>
	<section class="events-list">
		<header>
			<h3 class="ringbearer">Evenementen in <?php echo strftime('%B',mktime(0,0,0,$month, 1, $year)); ?></h3>
		</header>
		<section class="color-info">
			<div class="guild-event"><a href="javascript:void(0);">Guild evenement</a></div>
			<div class="player-event"><a href="javascript:void(0);">Speler evenement</a></div>
		</section>
		<p>
		<?php 
		$startDay = mktime(0,0,0,$month,1,$year);
		$endDay = mktime(24,0,0,$month,$daysInMonth,$year);
		
		$eventsForToday = Doctrine::getTable('Event')->getAllInRange($startDay, $endDay);
		
		?>
		<table cellpadding="0" cellspacing="0">
			<tbody>
				<?php
				foreach($eventsForToday as $event) {
					echo '<tr>';
					echo '<td><strong>'.strftime('%A',$event->start).' '.strftime('%d', $event->start).' '.strftime('%B', $event->start).' '.date('H:i', $event->start). '</strong> </td><td><a href="'.url_for('event', array('slug' => $event->slug)).'"';
					if ($event->guild_event) {
							echo "class=\"guild-event\"";
					}
					echo '>'.$event->name.' </a>('.count($event->getApprovedCharacters()).')<br>';	
					echo '</td></tr>';
				}
				?>
			</tbody>
		</table>
		</p>
	</section>
</article>