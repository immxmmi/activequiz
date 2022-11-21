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
<button onclick="createPdf()">Create PDF</button>
</body>

<div>
    <form action="javascript:void(0);">
        <label for="session">Session ID:</label>
        <input type="number" id="sessionid" name="session" value="2">
    </form>
</div>


<script>
    var session =  jQuery('#sessionid').val();
    /// QUIZ DATA
    var quizdata = null;
    if (session !== null) {
        var url = './api/quiz_api.php';
        var params = {
            sessionid: session
        };
        var addquizdata = function (data) {
            quizdata = data;
            return;
        }

        jQuery.get(url, params, addquizdata).fail(function (data) {
            alert(data.responseJSON.meta.data);
        });
    }
    // QUIZ DATA

    const {PDFDocument, StandardFonts, rgb} = PDFLib
    async function generateChartBySlot(slot){
        return    $.getJSON('https://www.moodle.local/mod/activequiz/backend/api/chart_api.php?sessionid=11&type=bar&slot=3');
    }

    async function createPdf() {

        $data = generateChartBySlot(3).Object;
        console.log($data);



        // TIME
        const d = new Date();
        let time = d.getTime();
            //var right_answer = quizdata.data;
            var qu = quizdata.data.data.question;
            var aw = quizdata.data.data.answers;


        //if (quizdata === null) {
            // Create a new PDFDocument
            const pdfDoc = await PDFDocument.create()

            // Embed the Times Roman font
            const timesRomanFont = await pdfDoc.embedFont(StandardFonts.TimesRoman)

            // Add a blank page to the document
            const page = pdfDoc.addPage()

            // Get the width and height of the page
            const {width, height} = page.getSize()

            // Draw a string of text toward the top of the page
            const fontSize = 30
            page.drawText(qu[0], {
                x: 50,
                y: height - 4 * fontSize,
                size: fontSize,
                font: timesRomanFont,
                color: rgb(0, 0.53, 0.71),
            })

            page.drawText(aw[0], {
                x: 80,
                y: height - 6 * fontSize,
                size: fontSize,
                font: timesRomanFont,
                color: rgb(0, 0.53, 0.71),
            })

            // Serialize the PDFDocument to bytes (a Uint8Array)
            const pdfBytes = await pdfDoc.save()

            // Trigger the browser to download the PDF document
            download(pdfBytes, "QUIZ PDF" + time.toString() , "application/pdf");
        }
</script>
</html>