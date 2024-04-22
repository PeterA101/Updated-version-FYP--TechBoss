<?php
session_start();
include('connection.php');

if (isset($_SESSION['user_id']) && isset($_POST['unfollowed_id'])) {
    $followerId = $_SESSION['user_id'];
    $unfollowedId = $_POST['unfollowed_id'];

    // SQL for unfollowing user
    $sql = "DELETE FROM follows WHERE follower_id = ? AND followed_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $followerId, $unfollowedId);

    if ($stmt->execute()) {
        echo "Unfollowed successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "User ID to unfollow not provided or user not logged in.";
}
?>