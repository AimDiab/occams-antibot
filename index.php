<?php

// START OCCAM'S ANTIBOT
include("occams-antibot/library.php");
// END OCCAM'S ANTIBOT

?>

<!doctype html>
<html lang="en">
    <head>

        <link rel="stylesheet" type="text/css" href="main.css" />
        
        <!-- START OCCAM'S ANTIBOT -->
        <link rel="stylesheet" type="text/css" href="occams-antibot/occams-antibot.css" />
        <!-- END OCCAM'S ANTIBOT -->

        <title>Occam's Antibot - Example</title>
    </head>
    <body>

<!-- Author's note: The following is an example form with the implementation code that you would add to your form. Copy and paste from the START comment to the END comment. No need to modify anything inside the block. -->

<form method="POST" action="example-api.php">

    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" required />
    <br />
    <br />

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

    <br />
    <input type="submit" value="Submit" />

</form>

<!-- Author's note: The following code goes at the bottom of any page that has Occam's Antibot. It can be put in your footer template or component. It requires JQuery and drives the skip function using Javascript and JQuery. -->

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


</body>
</html>