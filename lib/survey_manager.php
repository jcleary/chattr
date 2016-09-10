<?php

class SurveyManager {

    static function create($name, $values, $visible = 1, $can_vote = 1) {
        db_exec("insert into surveys (name, visible, can_vote) values ('$name', $visible, $can_vote)");

        global $conn;
        $id = mysqli_insert_id($conn);

        foreach($values as $value) {
            db_exec("insert into survey_options (survey_id, value) values ($id, '$value')");
        }
    }


}
