// QUIZ DATA
const {PDFDocument, StandardFonts, rgb} = PDFLib

// Generate Chart By Parameter --> Answers
function generateChartBySessionAndSlot(sessionid, type, slot) {
    var url = '/mod/activequiz/backend/api/chart_api.php?sessionid=' + sessionid + '&type=' + type + '&slot=' + slot;
    return fetch(url).then((response) => response.json());
}

// Generate Chart By Parameter -->
async function getQuizDataBySession(sessionid, slot) {
    var url = '/mod/activequiz/backend/api/quiz_api.php?sessionid=' + sessionid + '&slot=' + slot;
    return fetch(url).then((response) => response.json());
}


// TODO - Slots
async function getChartDataBySessionID(sessionID) {

    // for (let slot = 1; slot < slots; slot++) {
    return generateChartBySessionAndSlot(sessionID, 'bar', 1);
    //  generateChartBySessionAndSlot(sessionID, 'pie', slot);
    //   generateChartBySessionAndSlot(sessionID, 'pie3d', slot);
    // }
}

// create image -->
function createChartLink(chartType, title, labels, data, question, xlabel, ylabel) {
    let labelsStr = labels.map(x => "'" + x + "'").toString();
    const height = 250;
    const weight = 350;
    var url = `./backend/api/chart_img_api.php?type=${chartType}&height=${height}&weight=${weight}&title=${title}&labels=${labelsStr}&data=${data}&xlabel=${xlabel}&ylabel=${ylabel}`;
    return encodeURI(url);
}



// TODO
async function buildPdf(sessionName, chartType, label, labels, data, rightAnswer, question, answers) {

    // Deckblatt
    const reportUrl = '/mod/activequiz/backend/assets/ActiveQuiz_Report_Deckblatt.pdf';
    const existingPdfBytes = await fetch(reportUrl).then(res => res.arrayBuffer());

    // Logo
    const pngUrl = '/mod/activequiz/backend/assets/fh_logo.png';
    const pngImageBytes = await fetch(pngUrl).then((res) => res.arrayBuffer());

    // Chart
    const chartUrl = createChartLink(chartType, sessionName, labels, data, question, "Antworten", "Auswertung");
    console.log(chartUrl);
    const chartImageBytes = await fetch(chartUrl).then((res) => res.arrayBuffer());


    const pdfDoc = await PDFDocument.load(existingPdfBytes);
    const pngImage = await pdfDoc.embedPng(pngImageBytes);
    const chartImage = await pdfDoc.embedPng(chartImageBytes);


    const pages = pdfDoc.getPages();
    const questionArray = [];
    questionArray[0] = question;
    const answersArray = [];
    answersArray[0] = answers;
    const rightAnswerArray = [];
    rightAnswerArray[0] = rightAnswer;

    //const pdfDoc = await PDFLib.PDFDocument.create();
    const arialFont = await pdfDoc.embedFont(StandardFonts.Helvetica);
    console.log(data);
    const firstPage = pages[0];
    const {width, height} = firstPage.getSize();
    firstPage.drawText(sessionName, {
        x: 50,
        y: height / 2,
        size: 34,
        font: arialFont,
        color: rgb(0.0, 0.392, 0.612), //blau
    });

    for (let i = 0; i < questionArray.length; i++) {
        let page = pdfDoc.addPage();
        page.drawImage(pngImage, {
            x: 10,
            y: height - 126,
            width: 180,
            height: 113
        });
        page.drawText(questionArray[i], {
            x: 40,
            y: height - 126 - 30,
            size: 28,
            font: arialFont,
            color: rgb(0, 0.1, 0.156),
            maxWidth: width - 80
        });
        const form = pdfDoc.getForm();
        const radioGroup = form.createRadioGroup(questionArray[i]);

        let j;
        let newLine = 15;
        let lines = 0;
        for (j = 0; j < answersArray[i].length; j++) {
            if (answersArray[i][j].replace(/^\s+/g, "") == rightAnswerArray[i].replace(/\s+/g, "")) {
                page.drawText(answersArray[i][j], {
                    x: 70,
                    y: height - 126 - 30 - 40 - (40 * j) - (lines * newLine),
                    size: 18,
                    font: arialFont,
                    color: rgb(0.537, 0.702, 0.114),
                    maxWidth: width - 80
                });
                radioGroup.addOptionToPage(answersArray[i][j], page, {
                    height: 15,
                    width: 15,
                    x: 43,
                    y: height - 126 - 30 - 40 - (40 * j) - (lines * newLine)
                });
                radioGroup.select(answersArray[i][j]);
            } else {
                page.drawText(answersArray[i][j], {
                    x: 70,
                    y: height - 126 - 30 - 40 - (40 * j) - (lines * newLine),
                    size: 18,
                    font: arialFont,
                    color: rgb(0, 0.1, 0.156),
                    maxWidth: width - 80
                });
                radioGroup.addOptionToPage(answersArray[i][j], page, {
                    height: 15,
                    width: 15,
                    x: 43,
                    y: height - 126 - 30 - 40 - (40 * j) - (lines * newLine)
                });
            }
            lines = lines + answersArray[i][j].length / 50;
        }
        /*
        page.drawText(test, {
            x: 40,
            y: height - 126 - 30 - 40 - (40 * j) - (lines * newLine),
            size: 28,
            font: arialFont,
            color: rgb(0, 0.1, 0.156),
            maxWidth: width - 80
        });*/

        page = pdfDoc.addPage();
        page.drawImage(pngImage, {
            x: 10,
            y: height - 126,
            width: 180,
            height: 113
        });
        page.drawText(questionArray[i] + " - Chart", {
            x: 40,
            y: height - 126 - 30,
            size: 28,
            font: arialFont,
            color: rgb(0, 0.1, 0.156),
            maxWidth: width - 80
        });
        page.drawImage(chartImage, {
            x: 30,
            y: height - 126 - 30 - 60 - 300,
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
    download(pdfBytes, sessionName + time.toString(), "application/pdf");
}

async function createPdf(sessionID, sessionName) {


    if (sessionID == null || sessionName == null) {return;}

    // Anfrage an quizapi --> get
    $slotMax = 2;



    // QUIZ API
    getQuizDataBySession(sessionID, 1).then(async (quizSlots) => {

        $slotMax = quizSlots;
        console.log(quizSlots);

    getQuizDataBySession(sessionID, 1).then(async (quizData) => {
        let answers;

        // CHART API
        getChartDataBySessionID(sessionID).then((chartData) => {
            // Chart data
            const chartType = chartData.data.charttype;
            let label = chartData.data.chartdata.datasets.at(0).label;
            label = 'Answers';

            // CHART API
            const labels = chartData.data.chartdata.labels;
            const data = chartData.data.chartdata.datasets.at(0).data;
            // Quiz Data
            const rightAnswer = quizData.data.data.right_answer;
            const question = quizData.data.data.question;
            const answers = labels;




            buildPdf(sessionName, chartType, label, labels, data, rightAnswer, question, answers);

        });

    })

}

