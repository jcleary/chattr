<?php

class SurveyManager {

    static public function create($name, $values, $visible = 1, $can_vote = 1) {
        db_exec("insert into surveys (name, visible, can_vote) values ('$name', $visible, $can_vote)");

        global $conn;
        $id = mysqli_insert_id($conn);

        foreach($values as $value) {
            db_exec("insert into survey_options (survey_id, value) values ($id, '$value')");
        }
    }

    static public function find($id) {
        $res = db_exec("SELECT id, name FROM surveys where id = $id");
        return  mysqli_fetch_row($res);
    }


    static public function all($visible = null, $can_vote = null) {
        $where = [];

        if ($visible != null) {
            $where[] = "visible = $visible";
        }

        if ($can_vote != null) {
            $where[] = "can_vote = $can_vote";
        }

        $sql = "SELECT id, name, can_vote, visible FROM surveys";
        if (count($where) > 0) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }

        $res = db_exec($sql);
        return  mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    static public function options($id) {
        $res = db_exec("SELECT id, value FROM survey_options where survey_id = $id");
        $options = mysqli_fetch_all($res, MYSQLI_ASSOC);

        foreach($options as $key => $option) {
            $options[$key]['votes'] = get_votes_for($option['id']);
        }

        return $options;
    }



}
