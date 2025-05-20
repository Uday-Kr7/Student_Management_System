<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Management System</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>

  <div class="container">
    <!-- Sidebar -->
      <div class="sidebar">
        <h2>Menu</h2>
        <a href="home.php">Home</a>
      </div>

    <!-- Main Content -->
      <div class="content">
          <h1>Student Management System</h1>
          <form method="GET" action="" style="margin: 20px 5vw;">
            <input type="text" name="search" placeholder="Search by Name or Course" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit">Search</button>
          </form>
        <div class="table-container">
        <table>
          <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Number</th>
                <th>Course</th>
                <th>Action</th>
              </tr>
          </thead>
          <tbody>

            <?php
              include("config.php");

            // Records per page
              $limit = 7;

            // Current page
              $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
              $offset = ($page - 1) * $limit;

            // Search keyword
              $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

            // WHERE clause for search
              $where = "";
              if (!empty($search)) {
              $where = "WHERE name LIKE '%$search%' OR course LIKE '%$search%'";
            }

            // Fetch filtered records
              $sql = "SELECT * FROM students $where LIMIT $offset, $limit";
              $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['name']}</td>
              <td>{$row['email']}</td>
              <td>{$row['number']}</td>
              <td>{$row['course']}</td>
              <td>
                <a href='update.php?id={$row['id']}'><button class='action'>Update</button></a>
                <a href='delete.php?id={$row['id']}'><button class='action'>Delete</button></a>
              </td>
            </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <?php
      // Count total filtered records
        $count_sql = "SELECT COUNT(*) FROM students $where";
        $count_result = mysqli_query($conn, $count_sql);
        $total_rows = mysqli_fetch_array($count_result)[0];
        $total_pages = ceil($total_rows / $limit);

      // Preserve search query in pagination links
        $searchParam = !empty($search) ? "&search=" . urlencode($search) : "";
        echo "<div class='pagination'>";
  
      // Previous
        if ($page > 1) {
        $prev = $page - 1;
        echo "<a href='?page=$prev$searchParam'>&laquo; Previous</a>";
      }

      // Page numbers
        for ($i = 1; $i <= $total_pages; $i++) {
        $active = ($i == $page) ? "active-page" : "";
        echo "<a class='$active' href='?page=$i$searchParam'>$i</a>";
      }

      // Next
        if ($page < $total_pages) {
        $next = $page + 1;
        echo "<a href='?page=$next$searchParam'>Next &raquo;</a>";
      }

      echo "</div>";
      ?>

    <div>
      <p>
        &copy; <?php echo date("Y"); ?> Student Management System. Developed by Uday Sah. All rights reserved.
      </p>
    </div>
  </div>

</body>
</html>
