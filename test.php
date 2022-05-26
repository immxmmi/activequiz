<?php

require_once("../../config.php");
require_once("classes/activequiz_session.php");
global $DB;

$sesstionID = 31;

$answers = array();
$dbanswers = array();
$course = $DB->get_record('course', array('id'=>1), '*', MUST_EXIST);
//var_dump($session);
//$sql = 'SELECT * FROM "public"."mdl_activequiz_attempts" where id= :id;';
//$params = array('id' => 13);
//$sql = 'SELECT * FROM "public"."mdl_activequiz_questions" WHERE activequizid = :activequizid AND questionid = :questionid;';
//$params = array('activequizid'=> 13,'questionid' => 11);
//$tablename = "mdl_activequiz";


$sql = 'SELECT * FROM "public"."mdl_activequiz_sessions" WHERE id = :sessionid';
$params = array('sessionid' => $sesstionID);
$sessions = $DB->get_records_sql($sql, $params);






//$sql = 'SELECT * FROM "public"."mdl_activequiz_questions" WHERE activequizid = :activequizid';


//var_dump($sessions);



//var_dump($result);




//var_dump($answers);
//var_dump($dbanswers);


$bestanden = 0;
$nichtbestanden = 0;


// TABLE :: mdl_activequiz_sessions
echo "<br />";
echo "TEST DATA TABLE SESSIONS:";
foreach ($sessions as $session)
{

echo "<br />";
echo "ID: ";
echo $session->id;
echo "<br />";
echo "activequizid: ";
echo $session->activequizid;
echo "<br />";
echo "name: ";
echo $session->name;
echo "<br />";
echo "anonymize_responses: ";
echo $session->anonymize_responses;
echo "<br />";
echo "fully_anonymize: ";
echo $session->fully_anonymize;
echo "<br />";
echo "sessionopen: ";
echo $session->sessionopen;
echo "<br />";
echo "status: ";
echo $session->status;
echo "<br />";
echo "currentquestion: ";
echo $session->currentquestion;
echo "<br />";
echo "currentqnum: ";
echo $session->currentqnum;
echo "<br />";
echo "currentquestiontime: ";
echo $session->currentquestiontime;
echo "<br />";
echo "classresult: ";
echo $session->classresult;
echo "<br />";
echo "nextstarttime: ";
echo $session->nextstarttime;
echo "<br />";
echo "created: ";
echo $session->created;
echo "<br />";
echo "<br />";
#######################################################################

// TABLE :: mdl_activequiz_questions
echo "<br />";
echo "TEST DATA TABLE QUESTIONS:";

$sql = 'SELECT * FROM "public"."mdl_activequiz_questions" WHERE activequizid = :activequizid';
$params = array('activequizid' => $session->activequizid);
$result = $DB->get_records_sql($sql, $params);


foreach ($result as $answer)
{
echo "<br />";
echo "ID: ";
echo $answer->id;
echo "<br />";
echo "ActivequizID: ";
echo $answer->activequizid;
echo "<br />";
echo "QuestionID: ";
$questionID = $answer->questionid;
echo $questionID;
echo "<br />";
echo "NoTime: ";
echo $answer->notime;
echo "<br />";
echo "QuestionTime: ";
echo $answer->questiontime;
echo "<br />";
echo "Tries: ";
echo $answer->tries;
echo "<br />";
echo "Points: ";
echo $answer->points;
echo "<br />";
echo "Showhistoryduringquiz: ";
echo $answer->showhistoryduringquiz;
echo "<br />";
echo "<br />";
 ###################################################################

echo "TEST QUIZ QUESTIONS:";
// TABLE :: mdl_question_attempts
$sql = 'SELECT * FROM "public"."mdl_question_attempts" WHERE questionid = :question;';
$params = array('question' => $questionID);
$questions = $DB->get_records_sql($sql, $params);



############### -> LABELS --> ANSWERS
$lab1 = "test";
$lab2 = "test";
$lab3 = "test";
$lab4 = "test";
foreach ($questions as $question)
{
    echo "<br />";
echo "QUESTIONS:";
echo "<br />";
echo "ID: ";
echo $question->id;
echo "<br />";
echo "QuestionID: ";
echo $question->questionid;
echo "<br />";
echo "QuestionusageID: ";
echo $question->questionusageid;
echo "<br />";
echo "Question Summary: ";
$rowallAnswers = $question->questionsummary;
$allAnswers = explode(':', $rowallAnswers);
$answerArray = explode(';', $allAnswers[1]);

foreach($answerArray as $option){
    echo $option;
}

$allAnswers = $question->questionsummary;
$lab1 = $answerArray[0];
$lab2 = $answerArray[1];
$lab3 = $answerArray[2];
$lab4 = $answerArray[2];

//echo $allAnswers;

echo "<br />";
echo "Answer: ";
echo $question->rightanswer;
echo "<br />";
echo "responsesummary: ";
echo $question->responsesummary;
echo "<br />";
echo "<br />";
echo "<br />";



$label1 = "test";
$value1= 2;
$label2 = "ts";
$value2= 3;
$label3 = "tew";
$value3= 1;
$label4 = "test";
$value4= 3;



echo "
<!DOCTYPE html>
<hthml>
    <head>
        <meta charset='utf-9'>
        <title></title>
        <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js'></script>-->
        <script src='js/chartjs/Chart.min.js'></script>
    </head>
    <body>
        <div class='container'>
            <canvas id='barChart'></canvas>
        </div>
        <script>
      const massPopChart = new Chart(barChart, {
                type: 'bar',
                data: {
                    labels: ['$label1', '$label2', '$label3', '$label4'],
                    datasets: [{
                        label: '# of Votes',
                        data: [$value1, $value2, $value3, $value4],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
        });
        </script>
    </body>
</html> ";












}


echo "<br />";
echo "<br />";


###################################################################




// TABLE :: md_question_answers
$sql = 'SELECT * FROM "public"."mdl_question_answers" WHERE question = :question;';
$params = array('question' => $questionID);
$questions = $DB->get_records_sql($sql, $params);

foreach ($questions as $answer)
{
    echo "<br />";
echo "TEST QUIZ ANSWER:";
echo "<br />";
echo "ID: ";
echo $answer->id;

echo "<br />";
echo "Question: ";
echo $answer->question;

echo "<br />";
echo "Answer: ";
$clean_answer = strip_tags($answer->answer);
echo $clean_answer;

echo "<br />";
echo "<br />";
}
}

//#############################################################################

// TABLE :: mdl_activequiz_grades
echo "<br />";
echo "TEST DATA TABLE GRADE:";

$sql = 'SELECT * FROM "public"."mdl_activequiz_grades" WHERE activequizid = :activequizid';
$params = array('activequizid' => $session->activequizid);
$result = $DB->get_records_sql($sql, $params);


foreach ($result as $answer)
{

echo "<br />";
echo "ID: ";
echo $answer->id;
echo "<br />";
echo "ActivequizID: ";
echo $answer->activequizid;
echo "<br />";
echo "UserID: ";
echo $answer->userid;
echo "<br />";
echo "Grade: ";
$grade =  $answer->grade;
echo $grade;
if($grade == "0.00000"){
    $nichtbestanden++;
}else{
    $bestanden++;
}
echo "<br />";
echo "Timemodified: ";
echo $answer->timemodified;
echo "<br />";
echo "<br />";

}



}
















// SELECT * FROM "public"."mdl_activequiz_attempts";
//echo "<script>console.log('test')</script>";



//$label1 = "Red";
//$value1= 2;
//$label2 = "Blue";
//$value2= 2;
//$label3 = "Yellow";
//$value3= 2;
//$label4 = "Green";
//$value4= 2;
//$label5 = "Purple";
//$value5= 2;
//$label6 = "Orange";
//$value6= 2;
/*
echo "
<!DOCTYPE html>
<hthml>
    <head>
        <meta charset='utf-9'>
        <title></title>
        <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js'></script>-->
        <script src='js/chartjs/Chart.min.js'></script>
    </head>
    <body>
        <div class='container'>
            <canvas id='barChart'></canvas>
        </div>
        <script>
      const massPopChart = new Chart(barChart, {
                type: 'bar',
                data: {
                    labels: ['$label1', '$label2', '$label3', '$label4', '$label5', '$label6'],
                    datasets: [{
                        label: '# of Votes',
                        data: [$value1, $value2, $value3, $value4, $value5, $value6],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
        });
        </script>
    </body>
</html> ";
*/
