<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}
include 'db_connect.php';

$result = $conn->query("SELECT * FROM feedback ORDER BY created_at DESC");
?>

<h2>Feedback Dashboard</h2>
<a href="logout.php">Logout</a>
<table border="1">
  <tr>
    <th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Status</th><th>Date</th><th>Action</th>
  </tr>
  <?php while ($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['email']) ?></td>
    <td><?= htmlspecialchars($row['message']) ?></td>
    <td><?= $row['status'] ?></td>
    <td><?= $row['created_at'] ?></td>
    <td>
      <form method="POST" action="update_status.php">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <select name="status">
          <option <?= $row['status'] == 'new' ? 'selected' : '' ?>>new</option>
          <option <?= $row['status'] == 'read' ? 'selected' : '' ?>>read</option>
          <option <?= $row['status'] == 'responded' ? 'selected' : '' ?>>responded</option>
        </select>
        <button type="submit">Update</button>
      </form>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
