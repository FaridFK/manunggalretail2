<?php
// Include the DbConnector class
require_once '../DbConnector.php';

// Check if the news ID is provided in the URL
if (isset($_GET['id_news'])) {
    $id_news = $_GET['id_news'];

    // Create an instance of DbConnector
    $dbConnector = new DbConnector();

    // Attempt to delete the news
    if ($dbConnector->deleteNews($id_news)) {
        echo "News deleted successfully!";
        // Redirect to news.php or any other page after successful deletion
        header('Location: news.php');
        exit();
    } else {
        echo "Failed to delete news.";
    }
} else {
    echo "News ID not provided.";
}
?>
