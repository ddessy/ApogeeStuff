<?php

class QuizUtil {

    public function getInputType($type) {

        if ($type == "RADIO_BUTTON") {
            echo 'radio';
        } else {
            echo 'checkbox';
        }
    }

     public function getInputTextType($type) {

        if ($type == "TEXTAREA") {
            echo 'textarea';
        } else {
            echo 'text';
        }
    }

    public function getInsertQueryForResponses($question, $response, $respondentId) {

        if ($question === "action") {
            return "";
        }

        $qArray = explode('_', $question);

        if (count($qArray) == 1) {
            return "('$respondentId', '$qArray[0]', null, '$response', null), ";
        }

        if (count($qArray) == 2) {
            return "('$respondentId', '$qArray[0]', '$response', null, null), ";
        }

        if (count($qArray) == 3) {
            return "('$respondentId', '$qArray[0]', null, '$response', '$qArray[1]'), ";
        }

        return "";
    }

    public function getAllInsertQueriesForResponses($post, $userId) {

        $sqlQuery = "INSERT INTO quiz_questions_responses(respondent_id, quiz_question_id, response_text, answer_type_id, answer_grid_entry_id) VALUES ";

        foreach ($post as $key => $value) {
            if (is_array($value)) {
                foreach ($_POST[$key] as $selected) {
                    $sqlQuery .= $this::getInsertQueryForResponses($key, $selected, $userId);
                }
            } else {
                $sqlQuery .= $this::getInsertQueryForResponses($key, $value, $userId);
            }
        }

        $sqlQuery .= ";";
        $sqlQuery = str_replace(", ;", ";", $sqlQuery);

        return $sqlQuery;
    }


    public function getAllUpdateQueriesForResponses($post, $userId) {

        $responseText = "";
        $answerTypeId = "";
        $updateQuery = "";
        $insertQuery = "";
        $deleteQuery = "";

        foreach ($post as $key => $value) {

            if (is_array($value)) {
                foreach ($_POST[$key] as $selected) {
                    $insertQuery .= $this::getInsertQueryForResponses($key, $selected, $userId);
                    $deleteQuery .= "$key, ";
                }
            } else if ($key != "action") {

                $qArray = explode('_', $key);

                if (count($qArray) == 1) {
                    $answerTypeId .= "WHEN (respondent_id = '$userId' AND quiz_question_id = $qArray[0] AND answer_grid_entry_id is null) THEN $value ";
                }

                if (count($qArray) == 2) {
                    $responseText .= "WHEN (respondent_id = '$userId' AND quiz_question_id = $qArray[0]) THEN '$value' ";
                }

                if (count($qArray) == 3) {
                    $answerTypeId .= "WHEN (respondent_id = '$userId' AND quiz_question_id = $qArray[0] AND answer_grid_entry_id = '$qArray[1]') THEN $value ";
                }
            }
        }

        if (!empty($responseText)) {
            $responseText = " SET response_text = CASE " . $responseText . " ELSE response_text END ";
        }

        if (!empty($responseText) && !empty($answerTypeId)) {
            $responseText .= " , ";
        }

        if (!empty($answerTypeId)) {
            $setStatement = "";
            if (empty($responseText)) {
                $setStatement = " SET ";
            }

            $answerTypeId = " $setStatement answer_type_id = CASE $answerTypeId ELSE answer_type_id END ";
        }

        if (!empty($insertQuery)) {
            $insertQuery = "INSERT INTO quiz_questions_responses(respondent_id, quiz_question_id, response_text, answer_type_id, answer_grid_entry_id) VALUES " . $insertQuery .";";
            $insertQuery = str_replace(", ;", ";", $insertQuery);
        }

        if (!empty($deleteQuery)) {
            $deleteQuery .= ";";
            $deleteQuery = str_replace(", ;", "", $deleteQuery);
            $deleteQuery = "DELETE FROM quiz_questions_responses WHERE respondent_id = $userId AND quiz_question_id IN ($deleteQuery)";
        }

        if (!empty($responseText) || !empty($answerTypeId)) {
            $updateQuery = "UPDATE quiz_questions_responses   $responseText $answerTypeId ";
        }

        return array('update' => $updateQuery, 'delete' => $deleteQuery, 'insert' => $insertQuery);
    }
}

?>
