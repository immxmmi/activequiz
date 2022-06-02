<?php
require_once("../../../config.php");
require_once("session.php");
require_once("mdl_activequiz_attempts.php");
require_once("mdl_question_attempts.php");
require_once("chart_builder.php");
require_once("single_choice.php");
require_once("trueFalse_choice.php");
global $DB;
global $chart_values;
global $chart_label;

// SESSION ID
$sessionID = 44;
// Activequiz ID
$activequizID = 18;



// CHART BUILDER
$chart = new Chart();
// CHART HEAD
$chart->startTag();


# # # # # # # # -SESSION- # # # # # # # #
echo "SESSION DATA:</br>";
echo "TABLE :: mdl_activequiz_sessions</br>";
$session = new Session();
$sql = 'SELECT * FROM "public"."mdl_activequiz_sessions" WHERE id = :sessionid AND activequizid = :activequizid';
$params = array('sessionid' => $sessionID, 'activequizid' => $activequizID);
$result = $DB->get_records_sql($sql, $params);
$sessions = $session->getSessionByID($result);
//var_dump($sessions);
##########################################


# # # # # # # #  -ACTIVE-QUIZ ATTEMPTS- # # # # # # # #
echo "ACTIVE-QUIZ ATTEMPTS</br>";
echo "TABLE :: mdl_activequiz_attempts</br>";
$active_attemp = new activequiz_attempts();
$sql = 'SELECT * FROM "public"."mdl_activequiz_attempts" WHERE  sessionid = :sessionid;';
$params = array('sessionid' => $sessions[0]->getId());
$result = $DB->get_records_sql($sql, $params);
$active_attemps = $active_attemp->getAttemptsByID($result);
$current_attemp = $active_attemps[0];

echo"</br>";
echo"QUBALAYOUT: ".$current_attemp->getQubalayout();
echo"</br>";
echo"ATTEMPTNUM: ".$current_attemp->getAttemptnum();
echo"</br>";
echo"questionengid: ".$current_attemp->getQuestionengid();
echo"</br>";
echo"PREVIEW: ".$current_attemp->getPreview();
echo"</br>";
echo"</br>";
echo"</br>";
//var_dump($active_attemps);
#######################################################




# # # # # # # #  -QUESTION ATTEMPTS- # # # # # # # #
echo "QUESTION ATTEMPTS</br>";
echo "TABLE :: mdl_question_attempts</br>";
$question_attemp = new question_attempts();
$sql = 'SELECT * FROM "public"."mdl_question_attempts" WHERE  questionusageid = :questionusageid;';
$params = array('questionusageid' => $current_attemp->getQuestionengid());
$result = $DB->get_records_sql($sql, $params);
$question_attemps = $question_attemp->getAttemptsByQuestionengID($result);
//var_dump($question_attemps);
####################################################


$chartType = "";
$questionType = "singel";


$single = new Single_Choice();
$trueFalse = new TrueFalse_Choice();

switch ($questionType) {
    case "singel":
        $single->setData($question_attemps);
        echo "</br> VALUES";
        echo "</br>";
        var_dump($single->getValues());
        echo "</br> LABELS";
        echo "</br>";
        var_dump($single->getLabels());
        break;
    case "true/false":
        $trueFalse->setData($question_attemps);
    default:
        echo "no Type";
}

switch (1) {
    case 0:
        $chartType = "bar";
        break;
    case 1:
        $chartType = "doughnut";
        break;
    case 2:
        $chartType = "pie";
        break;
    default:
        $chartType = "bar";
        break;
}

$data = $chart->buildNewChart($chartType, $single->getLabels(), $single->getValues());


echo "</br>";
echo json_encode($data, JSON_PRETTY_PRINT);


echo "<head><script>
var ourChart = null;
var showChart = null;
var ourData = ".json_encode($data).";
		jQuery(document).ready(function () {
				ourChart = jQuery('#ourChart');
                showChart = new Chart(ourChart,{
                    type: ourData.data.charttype,
					data: ourData.data.chartdata,
					options: ourData.data.chartoptions
                });
			});
</script></head>";

echo '<body><div class="container">
            <canvas id="ourChart"></canvas> 
        </div></body>';



