<?php

/**mysql params - enter your username & pass for MYSQL server**/

$username = '';
$password = '';
$host = 'localhost';
$dbname = 'comments';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    if ($_POST['name'] & $_POST['message']) {
        $name = htmlspecialchars(stripslashes($_POST['name']));
        $message = htmlspecialchars(stripslashes($_POST['message']));
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO comments (date_time, name, message) VALUES (NOW(), :name, :message)";

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);

        if ($stmt->execute()) {
            fill_comments();
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

if ($_POST['refresh']) {
    fill_comments();
}

function fill_comments()
{
    global $dbh;
    $sql = "select * from comments order by date_time DESC limit 12";
    echo '<ul>';
    foreach ($dbh->query($sql) as $row) {
        echo '<li>';
        echo '<span class="date">' . date("d.m.Y H:i") . '</span>';
        echo '<span class="name">' . $row['name'] . '</span>';
        echo '<span class="message">' . $row['message'] . '</span>';
        echo '</li>';
    }
    echo '</ul>';
}
?>