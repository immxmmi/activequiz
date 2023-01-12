// QUIZ DATA
const {PDFDocument, StandardFonts, rgb} = PDFLib

var e = document.getElementById("chart_typ");
//var value = e.value;
//var text = e.options[e.selectedIndex].text;

class QuizData {
    constructor(sessionName, chartType, label, labels, data, rightAnswer, answers, question) {
        this.sessionName = sessionName;
        this.chartType = chartType;
        this.label = label;
        this.labels = labels;
        this.data = data;
        this.rightAnswer = rightAnswer;
        this.answers = answers;
        this.question = question;
    }
}

const chartWidth = 550;
const chartHeight = 400;

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

async function getChartDataBySessionID(sessionID, slot) {
    return generateChartBySessionAndSlot(sessionID, 'bar', slot);
}

// create image -->
function createChartLink(chartType, title, labels, data, question, xlabel, ylabel) {
    let labelsStr = labels.map(x => "'" + x + "'").toString();
    var url = `./backend/api/chart_img_api.php?type=${chartType}&height=${chartHeight}&width=${chartWidth}&title=${title}&labels=${labelsStr}&data=${data}&xlabel=${xlabel}&ylabel=${ylabel}`;
    console.log(e.value);
    return encodeURI(url);
}


//async function buildPdf(sessionName, chartType, label, labels, data, rightAnswer, question, answers) {
async function buildPdf(currentQuizList) {

    var sessionName = currentQuizList.at(0).sessionName;
    const questionFontSize = 17
    const answerFontSize = 13;
    const logoYShift = 126;
    const answerYShift = 30;
        // Deckblatt
        const reportUrl = '/mod/activequiz/backend/assets/ActiveQuiz_Report_Deckblatt.pdf';
        const existingPdfBytes = await fetch(reportUrl).then(res => res.arrayBuffer());

        // Logo
        const pngUrl = '/mod/activequiz/backend/assets/fh_logo.png';
        const pngImageBytes = await fetch(pngUrl).then((res) => res.arrayBuffer());

        const pdfDoc = await PDFDocument.load(existingPdfBytes);
        const pngImage = await pdfDoc.embedPng(pngImageBytes);

        const pages = pdfDoc.getPages();

        //const pdfDoc = await PDFLib.PDFDocument.create();
        const arialFont = await pdfDoc.embedFont(StandardFonts.Helvetica);

        const firstPage = pages[0];
        const {width, height} = firstPage.getSize();
        firstPage.drawText(sessionName, {
            x: 50,
            y: height / 2,
            size: 34,
            font: arialFont,
            color: rgb(0.0, 0.392, 0.612), //blau
        });
        for (let i = 0; i < currentQuizList.length; i++) {
            let page = pdfDoc.addPage();
            page.drawImage(pngImage, {
                x: 10,
                y: height - logoYShift,
                width: 180,
                height: 113
            });
            page.drawText("Frage:  " + currentQuizList.at(i).question, {
                x: 40,
                y: height - logoYShift - 30,
                size: questionFontSize,
                font: arialFont,
                color: rgb(0, 0.1, 0.156),
                maxWidth: width - 80
            });
            const form = pdfDoc.getForm();
            const radioGroup = form.createRadioGroup(i + "");

            let j;
            let questionLines = (currentQuizList.at(i).question.length / 45) + 1;
            let newQuestionLine = 30;
            let newLine = 22;
            let lines = 0;

            let answerShiftCount = 0;
            for (j = 0; j < currentQuizList.at(i).answers.length; j++) {
                if((logoYShift + (newQuestionLine * questionLines) + 31 + (answerYShift * j) + (lines * newLine)) > height){
                    lines = 0;
                    answerShiftCount = 0;
                    page = pdfDoc.addPage();
                    page.drawImage(pngImage, {
                        x: 10,
                        y: height - logoYShift,
                        width: 180,
                        height: 113
                    });
                    page.drawText("Frage:  " + currentQuizList.at(i).question, {
                        x: 40,
                        y: height - logoYShift - 30,
                        size: questionFontSize,
                        font: arialFont,
                        color: rgb(0, 0.1, 0.156),
                        maxWidth: width - 80
                    });
                }
                if (currentQuizList.at(i).answers[j].replace(/^\s+/g, "") == currentQuizList.at(i).rightAnswer.replace(/\s+/g, "")) {
                    page.drawText(currentQuizList.at(i).answers[j], {
                        x: 70,
                        y: height - logoYShift - (newQuestionLine * questionLines) - answerYShift - (answerYShift * answerShiftCount) - (lines * newLine),
                        size: answerFontSize,
                        font: arialFont,
                        color: rgb(0.537, 0.702, 0.114),
                        maxWidth: width - 80
                    });
                    radioGroup.addOptionToPage(currentQuizList.at(i).answers[j], page, {
                        height: 13,
                        width: 13,
                        x: 43,
                        y: height - logoYShift - (newQuestionLine * questionLines) - 31 - (answerYShift * answerShiftCount) - (lines * newLine)
                    });
                    radioGroup.select(currentQuizList.at(i).answers[j]);
                } else {
                    page.drawText(currentQuizList.at(i).answers[j], {
                        x: 70,
                        y: height - logoYShift - (newQuestionLine * questionLines) - answerYShift - (answerYShift * answerShiftCount) - (lines * newLine),
                        size: answerFontSize,
                        font: arialFont,
                        color: rgb(0, 0.1, 0.156),
                        maxWidth: width - 80
                    });
                    radioGroup.addOptionToPage(currentQuizList.at(i).answers[j], page, {
                        height: 13,
                        width: 13,
                        x: 43,
                        y: height - logoYShift - (newQuestionLine * questionLines) - 31 - (answerYShift * answerShiftCount) - (lines * newLine)
                    });
                }
                lines = lines + (currentQuizList.at(i).answers[j].length / 68);
                answerShiftCount++;
            }
            page = pdfDoc.addPage();
            page.drawImage(pngImage, {
                x: 10,
                y: height - logoYShift,
                width: 180,
                height: 113
            });
            page.drawText("Frage:  " + currentQuizList.at(i).question, {
                x: 40,
                y: height - logoYShift - 30,
                size: questionFontSize,
                font: arialFont,
                color: rgb(0, 0.1, 0.156),
                maxWidth: width - 80
            });
            // Chart
            const chartUrl = createChartLink(currentQuizList.at(i).chartType, currentQuizList.at(i).question, currentQuizList.at(i).labels, currentQuizList.at(i).data, currentQuizList.at(i).question, "Antworten", "Auswertung");

            const chartImageBytes = await fetch(chartUrl).then((res) => res.arrayBuffer());
            const chartImage = await pdfDoc.embedPng(chartImageBytes);
            page.drawImage(chartImage, {
                x: 30,
                y: height - logoYShift - (newQuestionLine * questionLines) - 60 - chartHeight,
                width: chartWidth,
                height: chartHeight,
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


    if (sessionID == null || sessionName == null) {
        return;
    }

    let listOfQuestion = new Array();

    // QUIZ API
    getQuizDataBySession(sessionID, 1).then(async (quizSlots) => {

        const slotMax = quizSlots.data.data.max_slots;
        for (let currentSlot = 1; currentSlot <= slotMax; currentSlot++) {

            getQuizDataBySession(sessionID, currentSlot).then(async (quizData) => {
                let answers;

                // CHART API
                getChartDataBySessionID(sessionID, currentSlot).then((chartData) => {
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

                    let currentQuizData = new QuizData(sessionName, chartType, label, labels, data, rightAnswer, answers, question);
                    listOfQuestion.push(currentQuizData);
                    if(currentSlot == slotMax){
                        buildPdf(listOfQuestion);
                    }
                });
            });
        };
    });

}

