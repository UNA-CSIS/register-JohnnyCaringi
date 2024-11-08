<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "softball";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM games order by id";
            $result = $conn->query($sql);
    
            echo "<table border='1'><tr>";
            echo "<th>ID</th>";
            echo "<th>Opponent</th>";
            echo "<th>Site</th>";
            echo "<th>Result</th>";
            echo "</tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['id'] . "</td>";
                echo "<td>" . $row['opponent'] . "</td>";
                echo "<td>" . $row['site'] . "</td>";
                echo "<td>" . $row['result'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        ?>
    </body>
</html>
