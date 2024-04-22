<?php
session_start(); 
include('connection.php');


$searchQuery = $_POST['query'] ?? '';

$searchQuery = mysqli_real_escape_string($con, $searchQuery);


$query = "SELECT user_id, firstname, lastname FROM signup WHERE firstname LIKE '%$searchQuery%' OR lastname LIKE '%$searchQuery%'";
$result = mysqli_query($con, $query);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        
        echo "<div class='search-result'>";
        echo "<p>" . htmlspecialchars($row['firstname']) . " " . htmlspecialchars($row['lastname']) . "</p>";

        
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $row['user_id']) {
            
            echo "<button class='follow-button' data-userid='" . htmlspecialchars($row['user_id']) . "'>Follow</button>";
        }
        echo "</div>";
    }
} else {
    echo "No users found";
}
?>
