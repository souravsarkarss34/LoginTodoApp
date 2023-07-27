<?php

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: signin.php");
    exit;
}
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
</head>
<body>
<h2>Welcome, <?php echo $_SESSION["username"]; ?></h2>

<?php
    
    if (isset($_SESSION['deleted_message'])) {
        echo '<p style="color: green;">' . $_SESSION['deleted_message'] . '</p>';
        unset($_SESSION['deleted_message']); 
    }
    ?>

    <div class="container">

        <button> <a href="index.php">Create</a> </button>
        <table class="table ">
            
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">Password</th>
      <th scope="col">Operation</th>

    </tr>
  </thead>
  <tbody>

  <?php
  // $sql = "select * from `test`";
  // $result = mysqli_query($conn,$sql);
 
  $userID = $_SESSION["user_id"];
  $sql = "SELECT id, name, email, mobile, password 
          FROM test
          WHERE user_id = '$userID'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $counter = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $password = $row['password'];
        echo '<tr>
                <th scope="row">' . $counter . '</th>
                <td>' . $name . '</td>
                <td>' . $email . '</td>
                <td>' . $mobile . '</td>
                <td>' . $password . '</td>
                <td>
                    <button><a href="update.php?updateid=' . $id . '">Edit</a></button>
                    <button><a href="delete.php?deleteid=' . $id . '">Delete</a></button>
                </td>
            </tr>';
      $counter++;
      }
      
  }
  else {
    echo "Error: " . mysqli_error($conn);
}
  ?>
   
  </tbody>
</table>
    </div>
    <a href="logout.php">Logout</a>
</body>
</html>