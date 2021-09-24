<?php
    $url = parse_url(getenv("mysql://bcc5dcffb5aa63:47f36dfc@us-cdbr-east-04.cleardb.com/heroku_ac967c3a31d7ed8?reconnect=true"));

    $server = $url["us-cdbr-east-04.cleardb.com"];
    $username = $url["bcc5dcffb5aa63"];
    $password = $url["47f36dfc"];
    $db = substr($url["heroku_ac967c3a31d7ed8"], 1);

    $conn = new mysqli($server, $username, $password, $db);
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
?>
