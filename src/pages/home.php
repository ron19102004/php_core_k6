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
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = FormHelper::get_input("username");
    $email = FormHelper::get_input("email");
    $password = FormHelper::get_input("password");
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO `users` (`username`, `password`, `email`, `created_at`) VALUES (?, ?, ?, current_timestamp())");

    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $password_hash);
    $stmt->bindParam(3, $email);
    $stmt->execute();
    URLHelper::redirect(URLHelper::my_url());
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

<body class="p-5">
    <div class="flex justify-center items-center">
        <table class="border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr class="">
                    <th scope="col" class="px-6 py-3">Id</th>
                    <th scope="col" class="px-6 py-3">Username</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Pass</th>
                    <th scope="col" class="px-6 py-3">Created At</th>
                </tr>
            </thead>
            <tbody class="">
                <?php foreach ($users as $user): ?>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            <?php echo $user["id"] ?>
                        </td>
                        <td class="px-6 py-4"><?php echo $user["username"] ?></td>
                        <td class="px-6 py-4"><?php echo $user["email"] ?></td>
                        <td class="px-6 py-4"><?php echo $user["password"] ?></td>
                        <td class="px-6 py-4"><?php echo $user["created_at"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="flex flex-col justify-center items-center mt-10">
        <div class="w-96 p-5 rounded-lg shadow-lg hover:shadow-xl bg-gray-50">
            <h1>Add User</h1>
            <form action="<?php echo URLHelper::my_url() ?>" method="post" class="space-y-3 ">
                <div>
                    <input type="text" name="username" id="username" placeholder="Username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>
                <div>
                    <input type="text" name="email" id="email" placeholder="Email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>
                <div>
                    <input type="password" name="password" id="password" placeholder="Password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>
                <div>
                    <button type="submit" class="px-2 py-1 bg-blue-500 hover:bg-blue-600 rounded-lg w-full text-white transition-all">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>