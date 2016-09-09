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

function create_survey($name, $values) {
    db_exec("insert into surveys (name) values ('$name')");

    global $conn;
    $id = mysqli_insert_id($conn);

    foreach($values as $value) {
        db_exec("insert into survey_options (survey_id, value) values ($id, '$value')");
    }
}

function get_current_survey() {
    $res = db_exec("SELECT id, name FROM surveys order by ID desc LIMIT 1");
    return  mysqli_fetch_row($res);
}

function get_live_surveys() {
    $res = db_exec("SELECT id, name FROM surveys WHERE live = 1 order by ID ");
    return  mysqli_fetch_all($res);
}


function get_survey($id) {
    $res = db_exec("SELECT id, name FROM surveys where id = $id");
    return  mysqli_fetch_row($res);
}


function get_survey_options($id) {
    $res = db_exec("SELECT id, value FROM survey_options where survey_id = $id");
    $options = [];
    while ($row = mysqli_fetch_row($res)) {
        array_push($options, $row);
    }
    return $options;
}



