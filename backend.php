<?php
// backend.php script to handle the ID received from the frontend
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Your backend logic here, for example, you can process the ID or perform database operations
    // For demonstration, let's just echo the received ID
    echo "Received ID: $id";
} else {
    echo "ID not received.";
}
?>