<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload-song"])) {
    $targetDirectory = "uploads/"; // Create an "uploads" directory where the songs will be stored
    $targetFile = $targetDirectory . basename($_FILES["song-file"]["name"]);
    
    // Check if the file is an allowed format (e.g., mp3 or wav)
    $allowedExtensions = array("mp3", "wav");
    $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    if (in_array($fileExtension, $allowedExtensions)) {
        // Move the uploaded file to the server
        if (move_uploaded_file($_FILES["song-file"]["tmp_name"], $targetFile)) {
            // Store song information in a database (you need a database connection)
            $songTitle = $_POST["song-title"];
            $songArtist = $_POST["song-artist"];
            $songGenre = $_POST["song-genre"];
            
            // Perform database insertion here (e.g., using PDO or MySQLi)
            
            echo "Song uploaded successfully!";
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "Invalid file format. Please upload an mp3 or wav file.";
    }
}
?>