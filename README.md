# Occam's Antibot
## The simplest anti spam bot solution

Occam's Antibot is a free, open-source widget that you can easily add to any form on any website with minimal integration work, no external server dependencies and no premium or fremium nonsense. Captcha and Recaptcha are very popular solutions to safeguard forms against spam and bots, but due to their popularity, they are quite commonly bypassed. For that reason, I created Occam's Antibot, a simple solution that I hope will prove to be a bit more versatile and difficult for bad actors to engineer a one-size-fits-all solution to cracking.

![A screenshot image of an Occams Antibot security box](http://aimdiab.com/web-design-portfolio/occams-antibot/images/occams-antibot-screenshot-1.png)

## Live Demo

You can view an interactive live demo by following the link below:

[Occam's Antibot Live Demo](http://aimdiab.com/web-design-portfolio/demos/occams-antibot-example-project/)

## Overview

Occam's Antibot consists of 4 simple modules of code.

- The PHP/HTML form widget which displays Occam's Antibot.
- The JS script handles client-side formatting and clicks.
- The PHP configuration file where you define your question/picture/answer pairs.
- The PHP back-end code that evaluates the question/answer pair.

# Setup

## Step 1: Place the `occams-antibot` folder in your project source directory or equivalent.

![A screenshot of the occams antibot folder inside a project source folder.](http://www.aimdiab.com/web-design-portfolio/occams-antibot/images/project-filesystem-example.png)

## Step 2: Include the library file at the top of the page(s) with the form.

```include("occams-antibot/library.php");```

## Step 3: Add the CSS stylesheet to your website or application.

```<link rel="stylesheet" type="text/css" href="occams-antibot/occams-antibot.css" />```

## Step 4: Add HTML and PHP widget to your form.

```
<!-- START OCCAM'S ANTIBOT -->
<div class="occam-container">

    <span class="occam-picture">
        <?php foreach ($occam_data['pictures'] as $id=>$picture): ?>
            <span id="occam-picture-<?=$id+1?>">
                <img src="<?=$picture?>" width="90px" height="90px" />
            </span>
        <?php endforeach; ?>
    </span>

    <div class="occam-title">
        Human Security Challenge:
    </div>

    <div class="occam-question">
        <?php foreach ($occam_data['questions'] as $id=>$question): ?>
            <span id="occam-question-<?=$id+1?>">
                <?=$question?>
            </span>
        <?php endforeach; ?>
        <span class="occam-skip">
            <a href="#" onclick="return false;" id="occam-skip-button">
                Skip
            </a>
        </span>
    </div>

    <span class="occam-input">
        <input name="occam-sec-answer" type="text" size ="3" class="occam-input-box" />
    </span>
    <br />

    <input name="occam-sec-question-id" type="hidden" id="occam-question-id" value="1" />

</div>
<!-- END OCCAM'S ANTIBOT -->
```

## Step 5: Add the Javascript to bottom of the page(s) with the form.


```
<!--  BEGIN OCCAM'S ANTIBOT -->
<!-- JQuery 3.3.1 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

    // sets to hide on init
    // IMPORTANT: update the number of questions
    let numberOfQuestions = <?=$occam_numberOfQuestions?>;
    let sets = [2,3];
    let currentQuestion = 1;

    // hider function
    $.each(sets, function( index, value ) {
        $( "#occam-question-" + value).hide();
        $( "#occam-picture-" + value).hide();
    });

    // skipper function
    $(document).on("click", "#occam-skip-button", function(){
        // hide current
        $( "#occam-question-" + currentQuestion).hide();
        $( "#occam-picture-" + currentQuestion ).hide();
        
        // advance the current question
        if(currentQuestion < numberOfQuestions) {
            currentQuestion++;
        } else {
            // reset to first question
            currentQuestion = 1;
        }
        // show next
        $( "#occam-question-" + currentQuestion).show();
        $( "#occam-picture-" + currentQuestion).show();

        // update form
        $( "#occam-question-id" ).val(currentQuestion);
    });

</script>
<!-- END OCCAM'S ANTIBOT -->
```

## Step 6: Configure your question and picture pairs in `/occams-antibot/library.php`

```
<?php

/**
 * This file holds your questions, answers and hint images.
 * 
 * Make sure you have the same number of entries across the 3
 * sets below and that they are in the same order.
 */

 $occam_numberOfQuestions = 2;

/**
 * Define your hint images below:
 */

$occam_data['pictures'] = [
    'occams-antibot/images/image-1.png',
    'occams-antibot/images/image-2.png',
];

/**
 * Define your questions below:
 */

$occam_data['questions'] = [
    'What is the animal depicted?',
    'What is the animal depicted?'
];

/**
 * Define your answers below:
 */

$occam_data['answers'] = [
    'cat',
    'dog'
];
```

## Step 7: Add the server-side implementation to your API/back-end.

```
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
```

## You're done! 
Now you can evaluate the true/false value of `$occamPassed` and prevent spam from being sent or submitted.

You can [read more about Occam's Antibot here](http://aimdiab.com/web-design-portfolio/occams-antibot/).