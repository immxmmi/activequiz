// Muss ins php file
//import {download} from "https://unpkg.com/downloadjs@1.4.7";


// QUIZ DATA
const {PDFDocument, StandardFonts, rgb} = PDFLib

//------------------ Inhaltsverzeichnis --------------------
/*
const getPageRefs = (pdfDoc) => {
    const refs = [];
    pdfDoc.catalog.Pages.traverse((kid, ref) => {
      if (kid instanceof PDFPage) refs.push(ref);
    });
    return refs;
  };

const createOutlineItem = (pdfDoc, title, parent, nextOrPrev, page, isLast = false) =>
  PDFDictionary.from(
    {
      Title: PDFString.fromString(title),
      Parent: parent,
      [isLast ? 'Prev' : 'Next']: nextOrPrev,
      Dest: PDFArray.fromArray(
        [
          page,
          PDFName.from('XYZ'),
          PDFNull.instance,
          PDFNull.instance,
          PDFNull.instance,
        ],
        pdfDoc.index,
      ),
    },
    pdfDoc.index,
  );
*/

function showMessage(){
    alert("click here");
}
// Generate Chart By Parameter
async function generateChartBySessionAndSlot(sessionid, type, slot) {

    var quizdata;
    var url = '/mod/activequiz/backend/api/quiz_api.php';
    var param = {session: sessionid, type: type, slot: slot};
    $.getJSON(url, param, function (data) {
        quizdata = data.data.data;
        console.log(quizdata);
    });


    //----------------------- Inhaltverzeichnis -------------------
    /*
    const page1 = pdfDoc.addPage();
    page1.drawImage(pngImage, {
        x: 30,
        y: height-126-30,
        width: 200,
        height: 126,
    });
    page1.drawText('Question 1', {
        x: 40,
        y: height-126-30-40,
        size: 28,
        font: arialFont,
        color: rgb(0, 0.1, 0.156),
    });
    page1.drawText('Answer 1', {
        x: 40,
        y: height-126-30-40-40,
        size: 18,
        font: arialFont,
        color: rgb(0, 0.1, 0.156),
    });
    page1.drawText('Answer 2', {
        x: 40,
        y: height-126-30-40-40-40,
        size: 18,
        font: arialFont,
        color: rgb(0, 0.1, 0.156),
    });
    page1.drawText('Answer 3', {
        x: 40,
        y: height-126-30-40-40-40-40,
        size: 18,
        font: arialFont,
        color: rgb(0.537, 0.702, 0.114), //green
    });
    page1.drawImage(chartImage, {
        x: 30,
        y: height-126-30-40-40-40-40-300,
        width: 500,
        height: 300,
    });


    pdfDoc.addPage(page1);
    const pageRefs = getPageRefs(pdfDoc);
    const outlinesDictRef = pdfDoc.index.nextObjectNumber();
    const outlineItem1Ref = pdfDoc.index.nextObjectNumber();
    const outlineItem1 = createOutlineItem(
        pdfDoc,
        'Question 1',
        outlinesDictRef,
        outlineItem1Ref,
        pageRefs[0],
        true,
    );

    const outlinesDict = PDFDictionary.from(
        {
          Type: PDFName.from('Outlines'),
          First: outlineItem1Ref,
          Last: outlineItem1Ref,
          Count: PDFNumber.fromNumber(1),
        },
        pdfDoc.index,
      );

    pdfDoc.index.assign(outlinesDictRef, outlinesDict);
    pdfDoc.index.assign(outlineItem1Ref, outlineItem1);

    pdfDoc.catalog.set('Outlines', outlinesDictRef);

    //const pdfBytes = PDFDocumentWriter.saveToBytes(pdfDoc);

    const pdfBytes = await pdfDoc.save();
    const d = new Date();
    const time = d.getTime();
    download(pdfBytes, "QUIZ PDF" + time.toString() , "application/pdf");
    */
    //---------------- Old -------------------------
    /*
    const page = pdfDoc.addPage();
    page.drawImage(pngImage, {
        x: 30,
        y: height-126-30,
        width: 200,
        height: 126,
    });
    page.drawText('Question 1', {
        x: 40,
        y: height-126-30-40,
        size: 28,
        font: arialFont,
        color: rgb(0, 0.1, 0.156),
    });
    page.drawText('Answer 1', {
        x: 40,
        y: height-126-30-40-40,
        size: 18,
        font: arialFont,
        color: rgb(0, 0.1, 0.156),
    });
    page.drawText('Answer 2', {
        x: 40,
        y: height-126-30-40-40-40,
        size: 18,
        font: arialFont,
        color: rgb(0, 0.1, 0.156),
    });
    page.drawText('Answer 3', {
        x: 40,
        y: height-126-30-40-40-40-40,
        size: 18,
        font: arialFont,
        color: rgb(0.537, 0.702, 0.114), //green
    });
    page.drawImage(chartImage, {
        x: 30,
        y: height-126-30-40-40-40-40-300,
        width: 500,
        height: 300,
    });

    const pdfBytes = await pdfDoc.save();
    const d = new Date();
    const time = d.getTime();
    download(pdfBytes, "QUIZ PDF" + time.toString() , "application/pdf");*/
}



async function createPdf(sessionID) {
    //showMessage();
    generateChartBySessionAndSlot(sessionID, 'bar', 3);


    const reportUrl = '/mod/activequiz/backend/assets/ActiveQuiz_Report_Deckblatt.pdf';
    const existingPdfBytes = await fetch(reportUrl).then(res => res.arrayBuffer());

    const pngUrl = '/mod/activequiz/backend/assets/fh_logo.png';
    const pngImageBytes = await fetch(pngUrl).then((res) => res.arrayBuffer());

    const chartUrl = '/mod/activequiz/backend/assets/Chart.png';
    const chartImageBytes = await fetch(chartUrl).then((res) => res.arrayBuffer());

    const pdfDoc = await PDFDocument.load(existingPdfBytes);
    const pngImage = await pdfDoc.embedPng(pngImageBytes);
    const chartImage = await pdfDoc.embedPng(chartImageBytes);

    const question = ["Question 1", "Question 2"];
    const answers = [["Answer1", "Answer2", "Answer3", "Answer4"],["Answer1", "Answer2", "Answer3", "Answer4"]];
    const rightAnswer = ["Answer1", "Answer2"];

    const pages = pdfDoc.getPages();

    //const pdfDoc = await PDFLib.PDFDocument.create();
    const arialFont = await pdfDoc.embedFont(StandardFonts.Helvetica);


    const firstPage = pages[0];
    const { width, height } = firstPage.getSize();
    firstPage.drawText('Lektor: Testikus Testor', {
        x: 50,
        y: height/2,
        size: 34,
        font: arialFont,
        color: rgb(0.0, 0.392, 0.612), //blau
    });

    for(var i = 0; i < question.length; i++){
        const page = pdfDoc.addPage();
        page.drawImage(pngImage, {
            x: 10,
            y: height-126,
            width: 180,
            height: 113
        });
        page.drawText(question[i], {
            x: 40,
            y: height-126-30,
            size: 28,
            font: arialFont,
            color: rgb(0, 0.1, 0.156),
            maxWidth: width-80
        });
        const form = pdfDoc.getForm();
        const radioGroup = form.createRadioGroup(question[i]);

        for(var j = 0; j < answers[i].length; j++){
            if(answers[i][j] == rightAnswer[i]){
                page.drawText(answers[i][j], {
                    x: 70,
                    y: height-126-30-40-(40*j),
                    size: 18,
                    font: arialFont,
                    color: rgb(0.537, 0.702, 0.114),
                });
                radioGroup.addOptionToPage(answers[i][j], page, { height: 15, width: 15, x: 43,  y: height-126-30-40-(40*j) });
                radioGroup.select(answers[i][j]);
            }
            else{
                page.drawText(answers[i][j], {
                    x: 70,
                    y: height-126-30-40-(40*j),
                    size: 18,
                    font: arialFont,
                    color: rgb(0, 0.1, 0.156),
                });
                radioGroup.addOptionToPage(answers[i][j], page, { height: 15, width: 15, x: 43,  y: height-126-30-40-(40*j) });
            }
        }
        page.drawImage(chartImage, {
            x: 30,
            y: height-126-30-40-(40*j)-300,
            width: 500,
            height: 300,
        });
        form.flatten();
    }
    const pdfBytes = await pdfDoc.save();
    const d = new Date();
    const time = d.getTime();
    download(pdfBytes, "QUIZ PDF" + time.toString() , "application/pdf");

    /*
        // TIME
        const d = new Date();
        let time = d.getTime();
        //var right_answer = quizdata.data;
        var qu = {} //quizdata.question;
        var aw = {} //quizdata.answers;


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
     */
}