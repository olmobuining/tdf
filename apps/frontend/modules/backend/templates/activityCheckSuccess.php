<script>/*
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
 }); */
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
	<header>
		<h1 class="ringbearer">Alle leden - Online/activiteits check</h1>
	</header>
	<table id="userlist">
	<thead>
		<tr>
			<th>
				username
			</th>
			<th>
				last login
			</th>
			<th>
				last checkin
			</th>
			<th>
				Edit
			</th>
		</tr>
	</thead>
	<tbody> 
	<?php foreach($users as $user): if($user->rank_id == 1){ continue; }?>
		<tr>
			<td>
				<a href="<?php echo url_for('user', array('slug' => $user->slug)); ?>"><?php echo $user->username ?></a>
			</td>
			<td>
				<?php $lastLogin = $user->getLastLogin(); 
				if($lastLogin) {
					$lastLogin = $lastLogin->value;
					if($lastLogin != null) {
						echo date('Y-m-d H:i:s', $lastLogin); 
					} else {
						echo "------Nooit online geweest-----";
					}
				}else {
					echo "------Nooit online geweest-----";
				}
					?>
			</td>
			<td>
				<?php 
				$lastActivation = $user->getActivation(); 
				if($lastActivation) {
					$lastActivation = $lastActivation->value;
					if($lastActivation != null && ($lastActivation != "1")) {
						// var_dump($lastActivation);
						echo date('Y-m-d H:i:s', $lastActivation); 
					} else {
						echo "------Nooit activiteits check gedaan-----";
					}
				} else {
					echo "------Nooit activiteits check gedaan-----";
				}
					?>
			</td>
			</td>
			<td>
				<a href="<?php echo url_for('edit-user', array('userId' => $user->id)); ?>">Edit</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody> 
	</table>
</article>
