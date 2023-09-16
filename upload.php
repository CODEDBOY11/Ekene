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
            // Redirect to the index.html page with the uploaded_file parameter
            header("Location: index.html?uploaded_file=" . $targetFile);
            exit(); // Terminate script execution after the redirect
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "Invalid file format. Please upload an mp3 or wav file.";
    }
}
