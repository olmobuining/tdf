<script>
	$(document).ready(function() { 
		$("#userlist").tablesorter({ 
			headers: { 
				2: { 
					sorter:'rank' 
				} 
			} 
		}); 
	}); 
</script>
<h1 style="font-size:24px;font-weight:bold;">Nieuwe Karakters ( max 40 )</h1>
<br>
<article class="full-page list">
	<table id="userlist">
		<thead>
			<tr>
				<th>
					Name
				</th>
				<th>
					Level
				</th>
				<th>
					Gebruiker
				</th>
				<th>
					Profession
				</th>
				<th>
					Ras
				</th>
				<th>
					Made on
				</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($newChars as $char): ?>
				<tr>
					<td>
						<?php echo $char->myCharacter->name; ?>
					</td>
					<td>
						<?php echo $char->myCharacter->level; ?>
					</td>
					<td>
						<a href="<?php echo url_for('user', array('slug' => $char->myCharacter->User->slug)); ?>"><?php echo $char->myCharacter->User->username; ?></a>
					</td>
					<td>
						<?php echo $char->myCharacter->Profession->name; ?>
					</td>
					<td>
						<?php echo $char->myCharacter->Race->name; ?>
					</td>
					<td>
						<?php echo strftime('%c', $char->created_at); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody> 
	</table>
</article>