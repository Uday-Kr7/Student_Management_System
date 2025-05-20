<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="container">
        <h1>Student Management System</h1>
        <button id="add"><a href="add.php">Add Student</a></button>
    </div>
    
    <div class="content">
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

              // Set records per page
              $limit = 7;

              // Get current page from URL (default is 1)
              $page = isset($_GET['page']) ? $_GET['page'] : 1;
              $offset = ($page - 1) * $limit;

              // Fetch data with LIMIT
              $sql = "SELECT * FROM students LIMIT $offset, $limit";
              $result = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_assoc($result)) {
              echo 
                "<tr>
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
          // Total records
          $total_sql = "SELECT COUNT(*) FROM students";
          $total_result = mysqli_query($conn, $total_sql);
          $total_rows = mysqli_fetch_array($total_result)[0];

          // Total pages
          $total_pages = ceil($total_rows / $limit);

          echo "<div class='pagination'>";

          // Previous Button
          if ($page > 1) {
              $prev = $page - 1;
              echo "<a href='?page=$prev'>&laquo; Previous</a>";
          }

          // Numbered Page Links
          for ($i = 1; $i <= $total_pages; $i++) {
              $active = ($i == $page) ? "active-page" : "";
              echo "<a class='$active' href='?page=$i'>$i</a>";
          }

          // Next Button
          if ($page < $total_pages) {
              $next = $page + 1;
              echo "<a href='?page=$next'>Next &raquo;</a>";
          }

          echo "</div>";
        ?>
  </div>
    <?php include("footer.php")?>
</body>
</html>