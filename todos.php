<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // start session
}

$host = "localhost";                             // or 127.0.0.1
$username = "root";                              // your_database_username
$password = "";                                  // your_database_password
$dbname = "to_do_app";                           // your_database_name

$conn = new mysqli($host, $username, $password, $dbname);
// always have to test if there is an error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// create the table with the three columns
$sql = "CREATE TABLE IF NOT EXISTS todos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            task VARCHAR(255) NOT NULL,
            checked VARCHAR(20)
        )";
if ($conn->query($sql) === false) {
    die("Error creating table: " . $conn->error);
}



// create the table for the bot
$sql = "CREATE TABLE IF NOT EXISTS botData (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId VARCHAR(50) NOT NULL,
    chatId VARCHAR(50) NOT NULL,
    userName VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === false) {
die("Error creating table: " . $conn->error);
}
// Add endpoint to handle POST requests and call storeUserData function
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["userId"]) && isset($_POST["chatId"]) && isset($_POST["userName"])) {
    $userId = $_POST["userId"];
    $chatId = $_POST["chatId"];
    $userName = $_POST["userName"];
    
    $insertSql = "INSERT INTO botData (userId, chatId, userName) VALUES ('$userId', '$chatId', '$userName')";
    if ($conn->query($insertSql) === false) {
        die("Error inserting user data: " . $conn->error);
    }
}
/*



$sql = "SELECT * FROM botData";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        // header('Content-Type: application/json');
        // Output user data as JSON
        echo json_encode($users);
    }
/*
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["sendData"])) {
    // Fetch user data from the database
    $sql = "SELECT * FROM botData";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        header('Content-Type: application/json');
        // Output user data as JSON
        echo json_encode($users);
        // Encode user data as JSON
        //$jsonData = json_encode($users);

        // Set appropriate headers to indicate JSON content
        //header('Content-Type: application/json');

        // Send JSON data in the response body
        // echo $jsonData;
    }
}
*/



// Fetch existing elements from the database and store in session
$_SESSION["existingElements"] = fetchExistingElements($conn);

function fetchExistingElements($connection) {
    // Implement this function to fetch existing elements from the database
    $existingElements = array();
    $result = $connection->query("SELECT * FROM todos");
    while ($row = $result->fetch_assoc()) {
        $existingElements[] = $row;
    }
    // Updating the session with existing items
    $_SESSION["existingElements"] = $existingElements;
    return $existingElements;
}
// insert task
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["newTodo"])) {
    //echo "fuck";
    $task = $_POST["newTodo"]; // the user input
    $insertSql = "INSERT INTO todos (task, checked) VALUES ('$task', '0')"; // insert the task into the todos table
    if ($conn->query($insertSql) === false) {
        die("Error inserting todo: " . $conn->error);
    }
    // Update existing elements in the session after inserting a new one
    $_SESSION["existingElements"] = fetchExistingElements($conn);

    // Retrieve list of user IDs from botData table
    $userIds = array();
    $result = $conn->query("SELECT userId FROM botData");
    while ($row = $result->fetch_assoc()) {
        $userIds[] = $row["userId"];
    }    
    // Send the task to the users using the telegram API and bot Token
    $botToken = '6849664260:AAHAZOLoZpJVAcjPqwH31sXeQVG8k_ZEIGw';
    $telegramApiUrl = "https://api.telegram.org/bot{$botToken}/sendMessage";
    $message = "New task added: {$task}";  

    // Send task to each user via Telegram bot
    foreach ($userIds as $userId) {
        $postData = [
            'chat_id' => $userId,
            'text' => $message,
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $telegramApiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if ($response === false) {
            die("Error sending message: " . curl_error($ch));
        }
        curl_close($ch);
    }

    // Redirect back to index.php
    header("Location: index.php");
    exit();
}
// delete task "remove_one" action
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["taskId"])) {
    $taskId = $_POST["taskId"];
    if ($_GET["action"] === "remove_one") {
        // Remove the task from the database
        $deleteSql = "DELETE FROM todos WHERE id = $taskId";
        if ($conn->query($deleteSql) === false) {
            die("Error deleting task: " . $conn->error);
        }
    }
} else {
    http_response_code(400);
}
// "remove_all" action
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["action"]) && $_GET["action"] === "remove_all") {
    $deleteAllSql = "DELETE FROM todos";
    if ($conn->query($deleteAllSql) === false) {
        die("Error deleting all tasks: " . $conn->error);
    }
    exit(); 
}
// checking the task
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["taskId"]) && isset($_POST["isChecked"])) {
    $taskId = $_POST["taskId"]; // get the id of the task
    $isChecked = $_POST["isChecked"]; // get the value "1"
    $updateSql = "UPDATE todos SET checked = $isChecked WHERE id = $taskId"; // updating the database sql request
    if ($conn->query($updateSql) === false) {
        die("Error updating task status: " . $conn->error);
    }
} else {
    http_response_code(400);
}
?>