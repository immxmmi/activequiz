// QUIZ DATA
const {PDFDocument, StandardFonts, rgb} = PDFLib

let quizData = [];
let chartData = [];

// Generate Chart By Parameter
function generateChartBySessionAndSlot(sessionid, type, slot) {
    var url = '/mod/activequiz/backend/api/chart_api.php/';
    var params = {sessionid: sessionid, type: type, slot: slot};

    $.getJSON(url, params, function (data) {
        chartData.push(data.data.chartdata.labels);
        chartData.push(data.data.chartdata.datasets.data);
    });
}

// Generate Chart By Parameter
async function getQuizDataBySession(sessionid) {

    var url = '/mod/activequiz/backend/api/quiz_api.php?';
    var params = {sessionid: sessionid};

    $.getJSON(url, params, function (data) {
        quizData.push(data.data.data);
    });
}


function cleanData() {
    chartData = [];
    quizData = [];
}

async function getChartDataBySessionID(sessionID) {
   // for (let slot = 1; slot < slots; slot++) {
     return    generateChartBySessionAndSlot(sessionID, 'bar', 1);
      //  generateChartBySessionAndSlot(sessionID, 'pie', slot);
     //   generateChartBySessionAndSlot(sessionID, 'doughnut', slot);
   // }
}

function downloadChart(title, labels, data, chartType){

    var myChart = new Chart(document.getElementById('chart').getContext('2d'), {
        type: chartType,
        data: {
            labels: labels,
            datasets: [
                {
                    label: title,
                    data: data,
                    backgroundColor: 'rgba(26,56,229,0.2)',
                    borderColor: 'rgb(49,141,53)',
                    borderWidth: 1,
                },
            ],
        },
        options: {
            animation: {
                onComplete: function () {
                    //console.log(myChart.toBase64Image());
                },
            },
        },
    });

   return myChart.toBase64Image();
}



async function createPdf(sessionID) {
    if (sessionID == null) {
        return;
    }


    // QUIZDATA
    // await getChartDataBySessionID(sessionID, 1);
    // console.log('chartData');
    // console.log(chartData);

    await getQuizDataBySession(sessionID);
    await getChartDataBySessionID(sessionID);

    if (quizData.length > 0) {


        const data = quizData.at(0);
        cleanData();

        //console.log('quizData');
        //console.log(data);
        //console.log('data.question');
        //console.log(data.question[0]);
        //console.log('data.answers');
        //console.log(data.answers[0]);
        //console.log('data.right_answer');
        //console.log(data.right_answer[0]);

        const question = data.question[0];
        const answers = data.answers[0];
        const rightAnswer = data.right_answer[0];



        const title = 'Test';
        const lables = ['One', 'Two', 'Three', 'Four', 'Five', 'Six'];
        const dataTest = [12, 19, 3, 5, 2, 3];
        const chartType = 'bar';
        const rowChart = downloadChart(title,lables, dataTest, chartType);
        //window.location.href = 'data:application/octet-stream;base64,' + img;

       // console.log(rowChart);
        console.log(chartData);

        // Test Data
        //const question = ["Question 1", "Question 2"];
        //const answers = [["Answer1", "Answer2", "Answer3", "Answer4"], ["Answer1", "Answer2", "Answer3", "Answer4"]];
        //const rightAnswer = ["Answer1", "Answer2"];

        // Deckblatt
        const reportUrl = '/mod/activequiz/backend/assets/ActiveQuiz_Report_Deckblatt.pdf';
        const existingPdfBytes = await fetch(reportUrl).then(res => res.arrayBuffer());
        // Logo
        const pngUrl = '/mod/activequiz/backend/assets/fh_logo.png';
        const pngImageBytes = await fetch(pngUrl).then((res) => res.arrayBuffer());
        // Chart
        const chartUrl = '/mod/activequiz/backend/assets/Chart.png';
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

        for (let i = 0; i < question.length; i++) {
            let j;
            const page = pdfDoc.addPage();
            page.drawImage(pngImage, {
                x: 10,
                y: height - 126,
                width: 180,
                height: 113
            });
            page.drawText(question[i], {
                x: 40,
                y: height - 126 - 30,
                size: 28,
                font: arialFont,
                color: rgb(0, 0.1, 0.156),
                maxWidth: width - 80
            });
            const form = pdfDoc.getForm();
            const radioGroup = form.createRadioGroup(question[i]);


          //  for (j = 0; j < answers[i].length; j++) {
            for (j = 0; j < 1; j++) {
                if (answers[i][j] == rightAnswer[i]) {
                    page.drawText(answers[i][j], {
                        x: 70,
                        y: height - 126 - 30 - 40 - (40 * j),
                        size: 18,
                        font: arialFont,
                        color: rgb(0.537, 0.702, 0.114),
                    });
                    radioGroup.addOptionToPage(answers[i][j], page, {
                        height: 15,
                        width: 15,
                        x: 43,
                        y: height - 126 - 30 - 40 - (40 * j)
                    });
                    radioGroup.select(answers[i][j]);
                } else {
                    page.drawText(answers[i][j], {
                        x: 70,
                        y: height - 126 - 30 - 40 - (40 * j),
                        size: 18,
                        font: arialFont,
                        color: rgb(0, 0.1, 0.156),
                    });
                    radioGroup.addOptionToPage(answers[i][j], page, {
                        height: 15,
                        width: 15,
                        x: 43,
                        y: height - 126 - 30 - 40 - (40 * j)
                    });
                }
            }
            page.drawImage(chartImage, {
                x: 30,
                y: height - 126 - 30 - 40 - (40 * j) - 300,
                width: 500,
                height: 300,
            });
            form.flatten();
        }
        const pdfBytes = await pdfDoc.save();
        // Time and Date
        const d = new Date();
        const time = d.getTime();
        // Download
        download(pdfBytes, "QUIZ PDF" + time.toString(), "application/pdf");
    }
}

