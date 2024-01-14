<?php
// Include the DbConnector class
require_once '../DbConnector.php';

// Check if the member ID is provided in the URL
if (isset($_GET['id_member'])) {
    $id_member = $_GET['id_member'];

    // Create an instance of DbConnector
    $dbConnector = new DbConnector();

    // Attempt to delete the member
    if ($dbConnector->deleteMember($id_member)) {
        echo "Member deleted successfully!";
        // Redirect to member.php or any other page after successful deletion
        header('Location: member.php');
        exit();
    } else {
        echo "Failed to delete member.";
    }
} else {
    echo "Member ID not provided.";
}
?>
