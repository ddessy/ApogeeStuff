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
}

?>
