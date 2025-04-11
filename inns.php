<?php

$pagetitle = 'Inn Database';

$NEEDPUB = true;
require 'common.php';

$inns = array();

foreach ($eoserv_inns->Data() as $inn) {
    if ($inn->id == 0) {
        continue;
    }

    $quizzes = array();

    // Get quiz data for the inn
    foreach ($inn->quizzes as $quiz) {
        $quizzes[] = array(
            'question' => $quiz->question,
            'answer' => $quiz->answer,
        );
    }

    // Add inn data with quizzes
    $inns[] = array(
        'id' => $inn->id,
        'name' => $inn->name,
        'quizzes' => (count($quizzes) == 0) ? null : $quizzes, // Include quizzes if available
    );
}

$tpl->inns = $inns;
$tpl->Execute('inns');