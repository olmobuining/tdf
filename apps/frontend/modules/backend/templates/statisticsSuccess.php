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
	// function deleteChar(id, name) {
		// var answer = confirm ("Weet je zeker dat je "+name+" wilt verwijderen?")
		// if (answer)
		// window.location="/delete-char/"+id
	// }
</script>
<h1 style="font-size:24px;font-weight:bold;">Characters</h1>
<div style="width:200px;float:left;height:190px;">
	<?php foreach($profs as $prof => $value): ?>
		<?php echo $prof.":".$value."<br>"; ?>
	<?php endforeach; ?>
</div>
<div style="width:200px;float:left;height:190px;">
	<?php foreach($races as $race => $value): ?>
		<?php echo $race.":".$value."<br>"; ?>
	<?php endforeach; ?>
</div>

<article class="full-page list">
	<form action="<?php echo url_for('statistics') ?>" method="post" name="searchChars" id="searchChars">
		<?php echo count($characters)." Karakters gevonden"; ?><br>
		<?php echo $form; ?><br>
		<button>zoek</button>
	</form>
	<br><br>
	
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
				<!--<th>
					Delete?
				</th>-->
			</tr>
		</thead>
		<tbody>
			<?php foreach($characters as $char): ?>
				<tr>
					<td>
						<?php echo $char->name; ?>
					</td>
					<td>
						<?php echo $char->level; ?>
					</td>
					<td>
						<a href="<?php echo url_for('user', array('slug' => $char->User->slug)); ?>"><?php echo $char->User->username; ?></a>
					</td>
					<td>
						<?php echo $char->Profession->name; ?>
					</td>
					<td>
						<?php echo $char->Race->name; ?>
					</td>
					<!--<td>
						<a onclick="deleteChar(<?php echo $char->id ?>,'<?php echo $char->name; ?>')">Delete</a>
					</td>-->
				</tr>
			<?php endforeach; ?>
		</tbody> 
	</table>
</article>