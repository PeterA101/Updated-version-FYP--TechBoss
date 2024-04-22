<?php
session_start();
include('connection.php');

// Add debug logging
error_log("User ID from session: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'none'));
error_log("Followed ID from POST: " . (isset($_POST['followed_id']) ? $_POST['followed_id'] : 'none'));


if (isset($_SESSION['user_id']) && isset($_POST['followed_id'])) {
    $followerId = $_SESSION['user_id'];
    $followedId = $_POST['followed_id'];

    error_log("Attempting to follow user. Follower ID: {$followerId}, Followed ID: {$followedId}");


    // SQL for following user
    $sql = "INSERT INTO follows (follower_id, followed_id) VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $followerId, $followedId);

    if ($stmt->execute()) {
        // Follow successful
        echo "Followed successfully";
    } else {
        // Follow failed
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    
    echo "User ID to follow not provided or user not logged in.";
    error_log("User ID to follow not provided or user not logged in.");
}
?>