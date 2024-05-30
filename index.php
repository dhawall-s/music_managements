<?php
require 'auth.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Music Manager</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            transition: background-color 0.5s;
        }
        
        /* Navigation Links */
       .nav-links {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        
       .nav-links a {
            text-decoration: none;
            color: #337ab7;
            margin-right: 20px;
            transition: color 0.5s;
        }
        
       .nav-links a:hover {
            color: #23527c;
        }
        
        /* Music Section */
       .music-section {
            margin-top: 40px;
            margin-bottom: 20px;
            text-align: center;
        }
        
       .music-section h3 {
            margin-bottom: 10px;
        }
        
       .music-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
       .music-section li {
            margin-bottom: 10px;
            transition: transform 0.5s;
        }
        
       .music-section li:hover {
            transform: scale(1.1);
        }
        
       .music-section a {
            text-decoration: none;
            color: #337ab7;
            transition: color 0.5s;
        }
        
       .music-section a:hover {
            color: #23527c;
        }
        
        /* Animations */
       .music-section li {
            animation: fadeIn 1s;
        }
        
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <h2>Welcome to Music Manager</h2>
    <div class="nav-links">
        <a href="upload.php">Upload Music</a> 
        <a href="index.php">Your Playlists</a> 
        <a href="logout.php">Logout</a>
        <a href="index.html">home</a>
    </div>
    <div class="music-section">
        <h3>Your Music</h3>
        <ul>
            <?php
            $sql = "SELECT * FROM music WHERE user_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_assoc()) {
                echo "<li><a href='play.php?id=".$row['id']."'>".$row['title']."</a></li>";
            }
           ?>
        </ul>
    </div>
</body>
</html>
