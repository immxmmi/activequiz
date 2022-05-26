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
echo $answer->questionid;
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

}


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


$label1 = "Nicht Bestanden";
$value1= $nichtbestanden;
//$label2 = "Blue";
//$value2= 2;
//$label3 = "Yellow";
//$value3= 2;
$label2 = "Bestanden";
$value2= $bestanden;
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
                    labels: ['$label1', '$label2'],
                    datasets: [{
                        label: '# of Votes',
                        data: [$value1, $value2],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
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