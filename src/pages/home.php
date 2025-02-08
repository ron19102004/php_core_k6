<?php
require($_SERVER['DOCUMENT_ROOT'] . "/utils.php");
Import::config(["db"]);

$users = [];

$conn = Database::get_instance();
$stmt = $conn->prepare("SELECT * FROM `users`");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
while ($row = $stmt->fetch()) {
    array_push($users, $row);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Email</th>
                <th>Pass</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <?php echo $user["id"] ?>
                    </td>
                    <td><?php echo $user["username"] ?></td>
                    <td><?php echo $user["email"] ?></td>
                    <td><?php echo $user["password"] ?></td>
                    <td><?php echo $user["created_at"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div>
        <?php if (empty($users)): ?>
            <p>
                No data
            </p>
        <?php else: ?>
            <p>
                Have data
            </p>
        <?php endif; ?>
    </div>
</body>

</html>