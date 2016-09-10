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

function get_visible_surveys() {
    $res = db_exec("SELECT id, name, can_vote FROM surveys WHERE visible = 1 order by ID ");
    return  mysqli_fetch_all($res);
}

function get_survey_options($id) {
    $res = db_exec("SELECT id, value FROM survey_options where survey_id = $id");
    $options = [];
    while ($row = mysqli_fetch_row($res)) {
        array_push($options, $row);
    }
    return $options;
}

