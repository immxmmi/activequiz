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
</head>

<body>
<button onclick="createPdf()">Create PDF</button>

    <script src="../js/pdf_generator.js"></script>




</body>

</html>
