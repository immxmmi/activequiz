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

function downloadChart2(title, labels, data, chartType) {
    var myChart = new Chart(document.getElementById('chart').getContext('2d'), {
        type: 'horizontalBar',
        data: {
            labels: ['One', 'Two', 'Three', 'Four', 'Five', 'Six'],
            datasets: [
                {
                    label: 'My data',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1,
                },
            ],
        },
        options: {
            animation: {
                onComplete: function () {
                    console.log(myChart.toBase64Image());
                },
            },
        },
    });


    var a = document.createElement('a');
    a.href = myChart.toBase64Image();
    a.download = 'my_file_name.png';

// Trigger the download
    a.click();

    return myChart.toBase64Image();
}


function downloadChart() {
    var myChart = new Chart(document.getElementById('chart').getContext('2d'), {
        type: 'horizontalBar',
        data: {
            labels: ['One', 'Two', 'Three', 'Four', 'Five', 'Six'],
            datasets: [
                {
                    label: 'My data',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1,
                },
            ],
        },
        options: {
            animation: {
                onComplete: function () {
                    console.log(myChart.toBase64Image());
                },
            },
        },
    });

    var a = document.createElement('a');
    a.href = myChart.toBase64Image();
    a.download = 'my_file_name.png';

// Trigger the download
    a.click();
}



function startChart() {
    const months = ['January', 'February', 'March', 'April', 'May'];
    const cats = [100, 200, 300, 400, 500];
    const dogs = [50, 60, 70, 180, 190];

    // great tip for quoted array, https://stackoverflow.com/a/43651811/52160
    let monthStr = months.map(x => "'" + x + "'").toString();
    return `https://quickchart.io/chart?width=500&height=300&c={type:'bar',data:{labels:[${monthStr}], datasets:[{label:'Dogs',data:[${dogs}]},{label:'Cats',data:[${cats}]}]}}`

};


async function buildPdf(label,question, answers, rightAnswer, labels2, chartType) {

    // QUICKCHART

    console.log(startChart());

    // Deckblatt
    const reportUrl = '/mod/activequiz/backend/assets/ActiveQuiz_Report_Deckblatt.pdf';
    const existingPdfBytes = await fetch(reportUrl).then(res => res.arrayBuffer());
    // Logo
    const pngUrl = '/mod/activequiz/backend/assets/fh_logo.png';
    const pngImageBytes = await fetch(pngUrl).then((res) => res.arrayBuffer());

    // Chart
    const url = ("https://quickchart.io/chart?c={type:'"+chartType+"',data:{labels:"+labels+",datasets:[{label:'"+label+"',data:["+data+"]}]}}");
    encodeURI(url.toString().replace(" ",""));
    console.log(url);

    const chartImageBytes = await fetch(url).then((res) => res.arrayBuffer());


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
        getChartDataBySessionID(sessionID).then((data) => {


            const labels = data.data.chartdata.labels;
            const datasets = data.data.chartdata.datasets.at(0).data;
            const title = data.data.chartdata.datasets.at(0).label;
            const chartType = data.data.charttype;

            console.log(labels);


            // DATA
            //const chartImgDataBase64 =

            //  downloadChart('title', 'labels', 'datasets', 'chartType');


            // const rightAnswer = quizData.data.data.right_answer;
            // const question = quizData.data.data.question;
            // answers = labels;

            buildPdf('title','question', 'answers', 'rightAnswer', labels, 'pie');

        });

    })

}

