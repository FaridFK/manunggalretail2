<?php
// Include the DbConnector class
require_once '../DbConnector.php'; // Adjust the filename if needed

// Check if the project ID is provided in the URL
if (isset($_GET['id_project'])) {
    $id_project = $_GET['id_project'];

    // Create an instance of DbConnector
    $dbConnector = new DbConnector();

    // Attempt to delete the project
    if ($dbConnector->deleteProject($id_project)) {
        echo "Data berhasil dihapus";
        // Redirect to project.php or any other page after successful deletion
        header('Location: project.php');
        exit();
    } else {
        echo "Data gagal dihapus";
    }
} else {
    echo "Project ID not provided.";
}
?>
