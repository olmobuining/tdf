<script>
$.tablesorter.addParser({ 
        // set a unique id 
        id: 'rank', 
        is: function(s) { 
            // return false so this parser is not auto detected 
            return false; 
        }, 
        format: function(s) { 
            // format your data for normalization 
            return s.toLowerCase().replace(/inactief/,10).replace(/new user/,9).replace(/stagair/,8).replace(/member/,7).replace(/wvw/,5).replace(/pvx/,4).replace(/pve/,3).replace(/pvp/,2).replace(/co-leider/,1).replace(/guild leider/,0); 
        }, 
        // set type, either numeric or text 
        type: 'numeric' 
 }); 
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
<article class="full-page list">
	<table id="userlist">
	<thead>
		<tr>
			<th>
				username
			</th>
			<th>
				email
			</th>
			<th>
				rank
			</th>
			<th>
				permission
			</th>
			<th>
				first name
			</th>
			<th>
				last name
			</th>
			<th>
				date of birth
			</th>
			<th>
				points
			</th>
			<th>
				edit
			</th>
		</tr>
	</thead>
	<tbody> 
	<?php foreach($users as $user): ?>
		<tr>
			<td>
				<a href="<?php echo url_for('user', array('slug' => $user->slug)); ?>"><?php echo $user->username ?></a>
			</td>
			<td>
				<?php echo $user->email ?>
			</td>
			<td>
				<?php echo $user->Rank->name ?>
			</td>
			<td>
				<?php echo $user->Permission->name ?>
			</td>
			<td>
				<?php echo $user->first_name ?>
			</td>
			<td>
				<?php echo $user->last_name ?>
			</td>
			<td>
				<?php echo date('d-m-Y', $user->birthdate); ?>
			</td>
			<td>
				<?php echo $user->points; ?>
			</td>
			<td>
				<a href="<?php echo url_for('edit-user', array('userId' => $user->id)); ?>">Edit</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody> 
	</table>
</article>
