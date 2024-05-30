<?php
require 'auth.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $file = $_FILES['file'];
    
    $target_dir = "music/";
    $target_file = $target_dir . basename($file["name"]);
    
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        $sql = "INSERT INTO music (user_id, title, file_path) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $_SESSION['user_id'], $title, $target_file);
        $stmt->execute();
        header('Location: index.php');
    } else {
        $error = "File upload failed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Music</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        h2 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            display: flex;
            flex-direction: column;
        }
        input[type="text"],
        input[type="file"] {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Upload Music</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Music Title" required>
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
</body>
</html>
