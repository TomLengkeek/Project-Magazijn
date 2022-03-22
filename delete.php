<?php
// Maak contact met de database
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "magazijn";

// include("./connect_db.php");
include("./Database.php");

$db = new Database();

try {
    $conn = $db->conn;

    // sql delete a record
    $sql = "DELETE FROM category WHERE category=:category";


    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':category', $category);

    if (!isset($_GET['category'])) {
        header("Location: ./read.php");
        exit();
    }

    $category = $_GET['category'];

    $stmt->execute();
    echo "record met category={$category} is verwijderd";
    header("Refresh:2; ./read.php");
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
