<?php
require_once("../../../config.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Chart</title>
    <style type="text/css">
        .chartwrapper {
            width: 640px;
        }
    </style>
    <script src="<?php echo $CFG->wwwroot; ?>/lib/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://unpkg.com/pdf-lib@1.11.0"></script>
    <script src="https://unpkg.com/downloadjs@1.4.7"></script>
</head>

<body>
<p>Click the button to create a PDF document with form fields using <code>pdf-lib</code></p>
<button onclick="createForm()">Create PDF</button>
<p class="small">(Your browser will download the resulting file)</p>
    <script src="../js/pdf_generator.js"></script>
</body>

</html>
