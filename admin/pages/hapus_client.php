<?php
// Include the DbConnector class
require_once '../DbConnector.php'; // Adjust the filename if needed

// Check if the client ID is provided in the URL
if (isset($_GET['id_client'])) {
    $id_client = $_GET['id_client'];

    // Create an instance of DbConnector
    $dbConnector = new DbConnector();

    // Attempt to delete the client
    if ($dbConnector->deleteClient($id_client)) {
        echo "Client deleted successfully!";
        // Redirect to client.php or any other page after successful deletion
        header('Location: client.php');
        exit();
    } else {
        echo "Failed to delete client.";
    }
} else {
    echo "Client ID not provided.";
}
?>
