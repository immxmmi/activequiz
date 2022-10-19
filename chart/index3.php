<?php
require_once("../../../config.php");
?>
<html>
<head>
    <meta charset="utf-8"/>
    <script src="<?php echo $CFG->wwwroot; ?>/lib/jquery/jquery-3.5.1.min.js"></script>
    <script src="https://unpkg.com/pdf-lib@1.4.0"></script>
    <script src="https://unpkg.com/downloadjs@1.4.7"></script>
</head>

<body>
<p>Click the button to create a new PDF document with <code>pdf-lib</code></p>
<button onclick="createPdf()">Create PDF</button>
<p class="small">(Your browser will download the resulting file)</p>

</body>


<script>

    var session = 2;
    /// QUIZ DATA
    var quizdata = null;
    if (session !== null) {
        var url = './quiz_api.php';
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

    async function createPdf() {
            var qu = quizdata.data.data;
      console.log(qu);

        if (quizdata === null) {
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
            page.drawText('Creating PDFs in JavaScript is awesome!', {
                x: 50,
                y: height - 4 * fontSize,
                size: fontSize,
                font: timesRomanFont,
                color: rgb(0, 0.53, 0.71),
            })

            // Serialize the PDFDocument to bytes (a Uint8Array)
            const pdfBytes = await pdfDoc.save()

            // Trigger the browser to download the PDF document
            download(pdfBytes, "pdf-lib_creation_example.pdf", "application/pdf");
        }
    }
</script>
</html>