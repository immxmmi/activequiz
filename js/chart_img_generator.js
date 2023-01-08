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

// TODO - Slots
async function getChartDataBySessionID(sessionID) {
    // for (let slot = 1; slot < slots; slot++) {
    return generateChartBySessionAndSlot(sessionID, 'bar', 1);
    //  generateChartBySessionAndSlot(sessionID, 'pie', slot);
    //   generateChartBySessionAndSlot(sessionID, 'pie3d', slot);
    // }
}

function createChartLink(chartType, title, labels, data, question, xlabel, ylabel) {
    let labelsStr = labels.map(x => "'" + x + "'").toString();
    const height = 250;
    const weight = 350;
    // const url = `https://quickchart.io/chart?width=500&height=300&c={type:'${chartType}',data:{labels:[${labelsStr}], datasets:[{label:'${label}',data:[${data}]}]}}`;
    var url = `./backend/api/chart_img_api.php?type=${chartType}&height=${height}&weight=${weight}&title=${title}&labels=${labelsStr}&data=${data}&xlabel=${xlabel}&ylabel=${ylabel}`;
    return encodeURI(url);
}
