<h1>Users List</h1>

<table cellpadding="5">
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
	  <?php /*
      <th>Password</th>
	  */ ?>
      <th>Email</th>
      <th>Birth date</th>
      <th>First name</th>
      <th>Last name</th>
	  <?php /*
      <th>Permission</th>
      <th>Rank</th>
      <th>Slug</th>
	  */ ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
      <td><a href="<?php echo url_for('register/show?id='.$user->getId()) ?>"><?php echo $user->getId() ?></a></td>
      <td><?php echo $user->getUsername() ?></td>
	  <?php /*
      <td><?php echo $user->getPassword() ?></td>
	  */ ?>
      <td><?php echo $user->getEmail() ?></td>
      <td><?php echo $user->getBirthDate() ?></td>
      <td><?php echo $user->getFirstName() ?></td>
      <td><?php echo $user->getLastName() ?></td>
	  <?php /*
      <td><?php echo $user->getPermissionId() ?></td>
      <td><?php echo $user->getRankId() ?></td>
      <td><?php echo $user->getSlug() ?></td>
	  */ ?>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('register/new') ?>">New</a>
