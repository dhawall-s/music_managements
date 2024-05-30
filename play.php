<?php
require 'auth.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM music WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$music = $result->fetch_assoc();

if (!$music) {
    die("Music not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Play Music</title>
</head>
<body>
    <h2>Playing: <?php echo $music['title']; ?></h2>
    <audio controls>
        <source src="<?php echo $music['file_path']; ?>" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <a href="index.php">Back to Home</a>
</body>
</html>
