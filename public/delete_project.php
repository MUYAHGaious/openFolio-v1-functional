<?php
include '../config/config.php'; 
include '../config/header.php'; 


if (isset($_POST['delete_project']) && isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];

        $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->bind_param("i", $project_id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                
                $_SESSION['message'] = "Project deleted successfully.";
            } else {
                
                $_SESSION['error'] = "Project not found.";
            }
        } else {
            $_SESSION['error'] = "Error deleting project: " . $conn->error;
        }

        $stmt->close();
    }
    $conn->close();

// Redirect back to the dashboard
header("Location: dashboard.php");
exit;
?>
