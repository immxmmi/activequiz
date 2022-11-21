var session = jQuery('#sessionid').val();
/// QUIZ DATA
var quizdata = null;
if (session !== null) {
    var url = './api/quiz_api.php';
    var params = {sessionid: session};


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

var dano = null;
// Generate Chart By Parameter
async function generateChartBySessionAndSlot(sessionid, type, slot) {
    $.getJSON('https://www.moodle.local/mod/activequiz/backend/api/chart_api.php?sessionid=' + sessionid + '&type=' + type + '&slot=' + slot, function (data) {
         dano = data;
    });
   return dano;
}

async function createPdf(session) {


    $data = generateChartBySessionAndSlot(session, 'bar', 3);

    console.log(data);


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
    download(pdfBytes, "QUIZ PDF" + time.toString(), "application/pdf");
}