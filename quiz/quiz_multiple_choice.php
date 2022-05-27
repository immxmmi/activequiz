<?php
require_once("../../../config.php");
require_once ("session.php");
require_once ("mdl_activequiz_attempts.php");
require_once ("mdl_question_attempts.php");
require_once ("build_chart.php");
global $DB;


// SESSION
$sessionID = 33;

// TABLE :: mdl_activequiz_sessions
echo "</br>";
echo "</br>";
echo "TABLE :: mdl_activequiz_sessions";
echo "</br>";
$session = new Session();
$sql = 'SELECT * FROM "public"."mdl_activequiz_sessions" WHERE id = :sessionid';
$params = array('sessionid' => $sessionID);
$result = $DB->get_records_sql($sql, $params);
$sessions = $session->getSessionByID($result);
var_dump($sessions);

// ACTIVE-QUIZ ATTEMPTS
// TABLE :: mdl_activequiz_attempts
echo "</br>";
echo "</br>";
echo "TABLE :: mdl_activequiz_attempts";
echo "</br>";
$active_attemp = new activequiz_attempts();
$sql = 'SELECT * FROM "public"."mdl_activequiz_attempts" WHERE  sessionid = :sessionid;';
$params = array('sessionid' => $sessions[0]->getId());
$result = $DB->get_records_sql($sql, $params);
$active_attemps = $active_attemp->getAttemptsByID($result);
var_dump($active_attemps[0]);


// TABLE :: mdl_question_attempts
echo "</br>";
echo "</br>";
echo "TABLE :: mdl_question_attempts";
echo "</br>";
$question_attemp = new question_attempts();
$sql = 'SELECT * FROM "public"."mdl_question_attempts" WHERE  questionusageid = :questionusageid;';
$params = array('questionusageid' => $active_attemps[0]->getQuestionengid());
$result = $DB->get_records_sql($sql, $params);
//var_dump($result);
$question_attemps = $question_attemp->getAttemptsByQuestionengID($result);
var_dump($question_attemps);

$chart = new Chart();
$chart->output("aa","vv","cc","dd",2,3,4,5);


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
                        labels: ['aa', 'aa', 'aa', 'cc'],
                        datasets: [{
                            label: '# of Votes',
                            data: [2, 3, 4, 2],
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



