// QUIZ DATA
const {PDFDocument, StandardFonts, rgb} = PDFLib

// Generate Chart By Parameter
function generateChartBySessionAndSlot(sessionid, type, slot) {
    var url = '/mod/activequiz/backend/api/chart_api.php?sessionid=' + sessionid + '&type=' + type + '&slot=' + slot;
    return fetch(url).then((response) => response.json());
}

// Generate Chart By Parameter
async function getQuizDataBySession(sessionid) {

    var url = '/mod/activequiz/backend/api/quiz_api.php?sessionid=' + sessionid;
    return fetch(url).then((response) => response.json());
}

async function getChartDataBySessionID(sessionID) {
    // for (let slot = 1; slot < slots; slot++) {
    return generateChartBySessionAndSlot(sessionID, 'bar', 1);
    //  generateChartBySessionAndSlot(sessionID, 'pie', slot);
    //   generateChartBySessionAndSlot(sessionID, 'doughnut', slot);
    // }
}

function createChartLink(chartType, label, labels, data, question) {
    let labelsStr = labels.map(x => "'" + x + "'").toString();
   // const url = `https://quickchart.io/chart?width=500&height=300&c={type:'${chartType}',data:{labels:[${labelsStr}], datasets:[{label:'${label}',data:[${data}]}]}}`;
    var url = https://www.moodle.local/mod/activequiz/backend/api/chart_img_api.php?type=bar&height=250&weight=350&label=Users&labels=['Q1','Q2','Q3','Q4']&data=data:[50,60,70,180]
    return encodeURI(url);
}

async function buildPdf(chartType, label, labels, data, rightAnswer, question, answers) {

    // Deckblatt
    const reportUrl = '/mod/activequiz/backend/assets/ActiveQuiz_Report_Deckblatt.pdf';
    const existingPdfBytes = await fetch(reportUrl).then(res => res.arrayBuffer());

    // Logo
    const pngUrl = '/mod/activequiz/backend/assets/fh_logo.png';
    const pngImageBytes = await fetch(pngUrl).then((res) => res.arrayBuffer());

    // Chart
    const chartUrl = createChartLink(chartType, label, labels, data, question);
    console.log(chartUrl);
    const chartImageBytes = await fetch(chartUrl).then((res) => res.arrayBuffer());


    const pdfDoc = await PDFDocument.load(existingPdfBytes);
    const pngImage = await pdfDoc.embedPng(pngImageBytes);
    const chartImage = await pdfDoc.embedPng(chartImageBytes);


    const pages = pdfDoc.getPages();

    //const pdfDoc = await PDFLib.PDFDocument.create();
    const arialFont = await pdfDoc.embedFont(StandardFonts.Helvetica);

    const firstPage = pages[0];
    const {width, height} = firstPage.getSize();
    firstPage.drawText('Lektor: Testikus Testor', {
        x: 50,
        y: height / 2,
        size: 34,
        font: arialFont,
        color: rgb(0.0, 0.392, 0.612), //blau
    });

    //for (let i = 0; i < question.length; i++) {
    //    let j;
    const page = pdfDoc.addPage();
    //    page.drawImage(pngImage, {
    //        x: 10,
    //        y: height - 126,
    //        width: 180,
    //        height: 113
    //    });
    //    page.drawText(question[i], {
    //        x: 40,
    //        y: height - 126 - 30,
    //        size: 28,
    //        font: arialFont,
    //        color: rgb(0, 0.1, 0.156),
    //        maxWidth: width - 80
    //    });
    //    const form = pdfDoc.getForm();
    //    const radioGroup = form.createRadioGroup(question[i]);


    // //  //  for (j = 0; j < answers[i].length; j++) {
    // //  for (j = 0; j < 1; j++) {
    //      if (answers[i][j] == rightAnswer[i]) {
    //          page.drawText(answers[i][j], {
    //              x: 70,
    //              y: height - 126 - 30 - 40 - (40 * j),
    //              size: 18,
    //              font: arialFont,
    //              color: rgb(0.537, 0.702, 0.114),
    //          });
    //          radioGroup.addOptionToPage(answers[i][j], page, {
    //              height: 15,
    //              width: 15,
    //              x: 43,
    //              y: height - 126 - 30 - 40 - (40 * j)
    //          });
    //          radioGroup.select(answers[i][j]);
    //      } else {
    //          page.drawText(answers[i][j], {
    //              x: 70,
    //              y: height - 126 - 30 - 40 - (40 * j),
    //              size: 18,
    //              font: arialFont,
    //              color: rgb(0, 0.1, 0.156),
    //          });
    //          radioGroup.addOptionToPage(answers[i][j], page, {
    //              height: 15,
    //              width: 15,
    //              x: 43,
    //              y: height - 126 - 30 - 40 - (40 * j)
    //          });
    //      }
    //  }
    //    page.drawImage(chartImage, {
    //        x: 30,
    //        y: height - 126 - 30 - 40 - (40 * j) - 300,
    //        width: 500,
    //        height: 300,
    //    });
    //    form.flatten();
    //}


    page.drawImage(chartImage, {
        x: 30,
        y: 30,
        width: 500,
        height: 300,
    });

    const pdfBytes = await pdfDoc.save();
    // Time and Date
    const d = new Date();
    const time = d.getTime();
    // Download
    download(pdfBytes, "QUIZ PDF" + time.toString(), "application/pdf");
}

async function createPdf(sessionID) {
    if (sessionID == null) {
        return;
    }

    getQuizDataBySession(sessionID).then(async (quizData) => {
        let answers;
        getChartDataBySessionID(sessionID).then((chartData) => {
            // Chart data
            const chartType = chartData.data.charttype;
            let label = chartData.data.chartdata.datasets.at(0).label;
            label = 'Answers';
            const labels = chartData.data.chartdata.labels;
            const data = chartData.data.chartdata.datasets.at(0).data;
            // Quiz Data
            const rightAnswer = quizData.data.data.right_answer;
            const question = quizData.data.data.question;
            const answers = labels;

            buildPdf(chartType, label, labels, data, rightAnswer, question, answers);

        });

    })

}

