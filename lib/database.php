<?php
$servername = "db";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

function db_exec($commands) {
    if (is_string($commands)) { $commands = [ $commands ]; }
    assert(is_array($commands));

    global $conn;
    mysqli_select_db($conn, 'chattr');

    foreach($commands as $cmd) {
        $res = $conn->query($cmd);
        if (!$res) {
            var_dump(mysqli_error($conn));
        }
    }
    return $res;
}
