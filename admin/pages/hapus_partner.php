<?php
// Include the DbConnector class
require_once '../DbConnector.php';

// Check if the partner ID is provided in the URL
if (isset($_GET['id_partner'])) {
    $id_partner = $_GET['id_partner'];

    // Create an instance of DbConnector
    $dbConnector = new DbConnector();

    // Attempt to delete the partner
    if ($dbConnector->deletePartner($id_partner)) {
        echo "Partner deleted successfully!";
        // Redirect to partner.php or any other page after successful deletion
        header('Location: partner.php');
        exit();
    } else {
        echo "Failed to delete partner.";
    }
} else {
    echo "Partner ID not provided.";
}
?>
