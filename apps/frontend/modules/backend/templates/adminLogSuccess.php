	<table cellpadding="0" cellspacing="0">
		<tr><td>Online users(laatste 5 minuten)</td></tr>
		<?php foreach($extras as $extra) : ?>
			<tr style="border-bottom:1px solid black;">
				<td width="250px"><?php echo strftime('%A %e %B %Y - %H:%M:%S', $extra->updated_at). ' </td> <td style="padding:0 40px;">'.$extra->User->username; ?><td></tr>
		<?php endforeach; ?>
		</table>
		<br><br><br>
		<table cellpadding="0" cellspacing="0">
		<?php foreach($logs as $log) : ?>
			<tr style="border-bottom:1px solid black;">
				<td width="250px"><?php echo strftime('%A %e %B %Y - %H:%M:%S', $log->created_at). ' </td> <td style="padding:0 40px;">'.nl2br($log->description); ?><td></tr>
		<?php endforeach; ?>
		</table>