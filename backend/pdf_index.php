<?php
require_once("../../../config.php");

//   Activequiz\classes\output\report_overview_renderer.php  --> Button for download
?>
<html>
<head>
    <meta charset="utf-8"/>
    <script src="<?php echo $CFG->wwwroot; ?>/lib/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://unpkg.com/pdf-lib@1.4.0"></script>
    <script src="https://unpkg.com/downloadjs@1.4.7"></script>
</head>

<body>
<p>QUIZ PDF - CREATE </p>
<button onclick="createPdf(11)">Create PDF</button>
</body>



<script src="<?php echo $CFG->wwwroot; ?>/mod/activequiz/js/pdf_generator.js"></script>
</html>