<?php

// START OCCAM'S ANTIBOT
include("occams-antibot/library.php");
// END OCCAM'S ANTIBOT

/**
* OCCAM'S ANTIBOT API START
*/ 
$occamPassed = false;

$occam_question_id = $_POST['occam-sec-question-id'];
$occam_data_index = $occam_question_id - 1;
$occam_answer = $occam_data['answers'][$occam_data_index];
$occam_client_answer = strtolower($_POST['occam-sec-answer']);

if ($occam_client_answer == $occam_answer) {
    $occamPassed = true;
}
/**
* OCCAM'S ANTIBOT API END
*/ 

echo '
<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="main.css" />
        <title>Occam\'s Antibot - Example</title>
    </head>
    <body>';

// Author's note: Here's a sample evaluation and output
if ( !$occamPassed ) {
    echo '
    <h1>Error - Human Security Challenge</h1>
    <p>Your answer to the Human Security Challenge question was not correct. Please use the back button to go back and try again.</p>
    ';
} else {
    echo '
    <h1>Success</h1>
    <p>Hello, ' . $_POST['first_name'] . '!</p>';
}

echo '
<br/>
<br/>
    <p>
        <a href="#" onclick="history.back()">Back</a>
    </p>
</body>
</html>';