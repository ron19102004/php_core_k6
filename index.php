<?php
require($_SERVER['DOCUMENT_ROOT'] . "/utils.php");
Import::config([
    "db"
]);
// URLHelper::redirect("/src/pages/login.php");

$conn = Database::get_instance();
// $sql = file_get_contents("./create_table.sql");
// $conn->exec($sql);

// $stmt = $conn->prepare("INSERT INTO `users` (`username`, `password`, `email`, `created_at`) VALUES (?, ?, ?, current_timestamp())");

// $username = "ABCEFFD";
// $password = "ABDS";
// $email = "DHFF";

// $stmt->bindParam(1, $username);
// $stmt->bindParam(2, $password);
// $stmt->bindParam(3, $email);
// $stmt->execute();

// $stmt = $conn->prepare("SELECT * FROM `users`");
// $stmt->setFetchMode(PDO::FETCH_ASSOC);
// $stmt->execute();
// while($row = $stmt->fetch()){
//   echo $row["id"]."<br>";
// }