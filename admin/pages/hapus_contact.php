<?php
// Include the DbConnector class
require_once '../DbConnector.php';

// Check if the contact ID is provided in the URL
if (isset($_GET['id_contact'])) {
    $id_contact = $_GET['id_contact'];

    // Create an instance of DbConnector
    $dbConnector = new DbConnector();

    // Attempt to delete the contact
    if ($dbConnector->deleteContact($id_contact)) {
        echo "Contact deleted successfully!";
        // Redirect to contact.php or any other page after successful deletion
        header('Location: contact.php');
        exit();
    } else {
        echo "Failed to delete contact.";
    }
} else {
    echo "Contact ID not provided.";
}
?>
