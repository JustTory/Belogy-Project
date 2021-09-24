<?php
    //$url = parse_url(getenv("mysql://bcc5dcffb5aa63:47f36dfc@us-cdbr-east-04.cleardb.com/heroku_ac967c3a31d7ed8?reconnect=true"));

    $server = "us-cdbr-east-04.cleardb.com";
    $username = "bcc5dcffb5aa63";
    $password = "47f36dfc";
    $db = "heroku_ac967c3a31d7ed8";

    $conn = new mysqli($server, $username, $password, $db);

    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL";
        exit();
    }
    else {
        echo "connect sucess";
        exit();
    }
?>
