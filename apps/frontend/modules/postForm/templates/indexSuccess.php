<h1>Posts List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Text</th>
      <th>Post type</th>
      <th>User</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Slug</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($posts as $post): ?>
    <tr>
      <td><a href="<?php echo url_for('postForm/show?id='.$post->getId()) ?>"><?php echo $post->getId() ?></a></td>
      <td><?php echo $post->getTitle() ?></td>
      <td><?php echo $post->getText() ?></td>
      <td><?php echo $post->getPostTypeId() ?></td>
      <td><?php echo $post->getUserId() ?></td>
      <td><?php echo $post->getCreatedAt() ?></td>
      <td><?php echo $post->getUpdatedAt() ?></td>
      <td><?php echo $post->getSlug() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('postForm/new') ?>">New</a>
