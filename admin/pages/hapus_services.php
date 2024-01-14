<?php
// Include the DbConnector class
require_once '../DbConnector.php'; // Adjust the filename if needed

// Check if the service ID is provided in the URL
if (isset($_GET['id_services'])) {
    $id_services = $_GET['id_services'];

    // Create an instance of DbConnector
    $dbConnector = new DbConnector();

    // Attempt to delete the service
    if ($dbConnector->deleteService($id_services)) {
        echo "Data berhasil dihapus";
        // Redirect to services.php or any other page after successful deletion
        header('Location: services.php');
        exit();
    } else {
        echo "Data gagal dihapus";
    }
} else {
    echo "Service ID not provided.";
}
?>
