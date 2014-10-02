<table>
  <tbody>
  <?php /*
    <tr>
      <th>Id:</th>
      <td><?php echo $user->getId() ?></td>
    </tr>
	*/ ?>
    <tr>
      <th>Username:</th>
      <td><?php echo $user->getUsername() ?></td>
    </tr>
	<?php /*
    <tr>
      <th>Password:</th>
      <td><?php echo $user->getPassword() ?></td>
    </tr>
	*/ ?>
    <tr>
      <th>Email:</th>
      <td><?php echo $user->getEmail() ?></td>
    </tr>
    <tr>
      <th>Birth date:</th>
      <td><?php echo date('d-m-Y', $user->getBirthDate()); ?></td>
    </tr>
    <tr>
      <th>First name:</th>
      <td><?php echo $user->getFirstName() ?></td>
    </tr>
    <tr>
      <th>Last name:</th>
      <td><?php echo $user->getLastName() ?></td>
    </tr>
	<?php /*
    <tr>
      <th>Permission:</th>
      <td><?php echo $user->getPermissionId() ?></td>
    </tr>
    <tr>
      <th>Rank:</th>
      <td><?php echo $user->getRankId() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $user->getSlug() ?></td>
    </tr>
	*/ ?>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('register/edit?id='.$user->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('register/index') ?>">List</a>
