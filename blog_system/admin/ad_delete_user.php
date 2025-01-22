<?php
    session_start();
    include '../includes/db.php';

    if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        echo "<p class='text-danger'>Access Denied!</p>";
        exit;
    }

    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $user_id = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        if($stmt->execute()) {
            echo "<p class='text-success'>User deleted successfully!</p>";
        } else {
            echo "<p class='text-danger'>Failed to delete the user!</p>";
        }
        $stmt->close();
    } else {
        echo "<p class='text-danger'>Invalid User ID!</p>";
    }

    header("Location: ../admin/admin.php?action=manage_users");
?>