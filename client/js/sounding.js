"use strict";

let levelNod = [];
let tempNod = [];
let densNod = [];
let mtNod = [];
let vlmNod = [];
let pcntNod = [];
let ulgNod = [];
let checkBoxNod = [];
let tnkDrwHeightNod = [];
let tnkDrwPercentNod = [];
//let btnBackground = "rgba(141,172,170,0.5)";
let btnBackground = "rgba(128,128,128,0.5)";
let btnBackgroundActive = "rgba(128,128,128)";

window.addEventListener("load", function () {
    document.getElementById("tab-mdo").style.zIndex = 2;
    document.getElementById("tab-hfo").style.zIndex = 3;
    document.getElementById("tab-other").style.zIndex = 1;
    document.getElementById("btn-mdo").style.background = btnBackground;
    document.getElementById("btn-hfo").style.background = btnBackgroundActive;
    document.getElementById("btn-other").style.background = btnBackground;
    document.getElementById("btn-mdo").style.color = btnBackground;
    document.getElementById("btn-other").style.color = btnBackground;

    let idVessel = sessionStorage.getItem('idVesselSelect')*1;
    vesselTanks(idVessel);
    soundingDates(idVessel);
    ftanks();
    TestCSS();
   // soundTrimNames(1);
});

//==Реагируем на событие click когда выбираем судно в элементе select
let selectVessel = document.getElementById('vessel');
selectVessel.addEventListener("click", function(){
   // let idVessel = sessionStorage.getItem('idVesselSelect')*1; //== В sessionStorage получаем id судна с которым мы работаем в данный момент
    let  idVessel = selectVessel.value;
    sessionStorage.setItem('idVesselSelect', idVessel); //== В sessionStorage сохраняем id судна с которым мы работаем в данный момент
    vesselTanks(idVessel);                                          //== Выводим таблицу с танками и их наглядное представление
    soundingDates(idVessel);                                        //== Выводим ранее сохраненные замеры по датам
  //  selectDatesPressed();
    ftanks();                                                        //== Выводим данные в соответствующие инпуты согласно сохраненным замерам
});


//==Выбираем и выводим выбранную вкладку======================================================
document.querySelectorAll('.tab-ref').forEach(function (el) {
    el.addEventListener('click', function () {
        let chosenTab = el.getAttribute('href');
        let firstTab = 3,secondTab= 2, thirdTab = 1;
        let tabColor1 = btnBackgroundActive, tabColor2 = btnBackground, tabColor3 = btnBackground;
        let btnColor1 = "rgba(0, 0, 0)", btnColor2 = btnBackground, btnColor3 = btnBackground;
        if (chosenTab === '#tab-hfo'){
        } else if (chosenTab === '#tab-mdo'){
            firstTab = 1; secondTab = 3; thirdTab = 2;
            tabColor1 = btnBackground;
            tabColor2 = btnBackgroundActive;
            tabColor3 = btnBackground;
            btnColor1 = btnBackground;
            btnColor2 = "rgb(0,0,0)";
            btnColor3 = btnBackground;
        } else if (chosenTab === '#tab-other'){
            firstTab = 2; secondTab = 1; thirdTab = 3;
            tabColor1 = btnBackground;
            tabColor2 = btnBackground;
            tabColor3 = btnBackgroundActive;
            btnColor1 = btnBackground;
            btnColor2 = btnBackground;
            btnColor3 = "rgb(0,0,0)";
        }
        document.getElementById("tab-hfo").style.zIndex = firstTab;
        document.getElementById("tab-mdo").style.zIndex = secondTab;
        document.getElementById("tab-other").style.zIndex = thirdTab;
        document.getElementById("btn-hfo").style.background = tabColor1;
        document.getElementById("btn-mdo").style.background = tabColor2;
        document.getElementById("btn-other").style.background = tabColor3;
        document.getElementById("btn-hfo").style.color = btnColor1;
        document.getElementById("btn-mdo").style.color = btnColor2;
        document.getElementById("btn-other").style.color = btnColor3;
        console.log(el.getAttribute('href'));
    });
  //  let tdArr = document.getElementsByTagName('input');
});



let eventInput = new InputEvent('input', {
    bubbles: true,                                   //==если true, тогда событие всплывает
    cancelable: false
});
let event = new Event('input');
let clickEvent = new Event('click');
let changeInInput = new Event('onchange');


//=======HEADER BUTTONS====================================================================================

//=Запрашиваем все ранее сохраненные даты замеров танков и выводим в select ================================
function soundingDates(idVessel) {
    let userIdInCookies = 1;
    if (getCookie('user')){
        userIdInCookies = getCookie('user');
    }
    let str = '';
    const elem = document.querySelector('#save-of-time-id');
   // elem.removeChild();
    getVslDates(userIdInCookies, idVessel).then(dates => {


        dates.forEach(date => {
            str += `
                <option class="saved-time" data_option="${date.dateId}"  id="saved-time-${date.dateId}"> ${date.dateTime} </option>        
               `;
        });

        if (elem){
            elem.innerHTML = str;
        }
        console.log('time select: '+ elem.innerHTML);
    });

}

function loadPressed(){
    let idVessel = sessionStorage.getItem('idVesselSelect')*1;
    soundingDates(idVessel);
  //  console.log(tankTest[0][1]);
}

function insertPressed() {
    let savedSound = JSON.parse(sessionStorage.getItem('savedSound'));
    let dates2 = savedSound.tankParam;
    for (let i = 0; i < dates2[4].length; i++){
        console.log(document.querySelector('#tsound' + dates2[4][i]).dispatchEvent(eventInput));

        document.querySelector('#tsound' + dates2[4][i]).dispatchEvent(event);
    }
}

//=Перед заполнением sound очищаем инпуты===============================================
function inputDataClear() {
    let level1 = document.getElementsByName('level0'); //=Массив HFO storage танков
    let level2 = document.getElementsByName('level1'); //=Массив HFO daily танков
    let level3 = document.getElementsByName('level2'); //=Массив MGO танков

    let vlm = document.getElementsByName('vlm'); //=Массив MGO танков

    let ulg = document.getElementsByName('ulg'); //=Массив MGO танков

    let temp1 = document.getElementsByName('temp0'); //=Массив HFO storage танков
    let temp2 = document.getElementsByName('temp1'); //=Массив HFO daily танков
    let temp3 = document.getElementsByName('temp2'); //=Массив MGO танков

    let dens1 = document.getElementsByName('dens0'); //=Массив HFO storage танков
    let dens2 = document.getElementsByName('dens1'); //=Массив HFO daily танков
    let dens3 = document.getElementsByName('dens2'); //=Массив MGO танков

    let mt1 = document.getElementsByName('mt0'); //=Массив HFO storage танков
    let mt2 = document.getElementsByName('mt1'); //=Массив HFO daily танков
    let mt3 = document.getElementsByName('mt2'); //=Массив MGO танков

    let pcnt = document.getElementsByName('pcnt'); //=Массив танков

    let checkBoxs = document.getElementsByName('tankChecks0');
    let checkBoxs2 = document.getElementsByName('tankChecks1');
    let checkBoxs3 = document.getElementsByName('tankChecks2');

    let tnkDrwHeight = document.getElementsByClassName('hfo-tank-level');

    let tnkDrwPercent = document.getElementsByClassName('hfo-tank-percent');

    levelNod.length = 0;
    levelNod.push.apply(levelNod, level1);
    levelNod.push.apply(levelNod, level2);
    levelNod.push.apply(levelNod, level3);

    tempNod.length = 0;
    tempNod.push.apply(tempNod, temp1);
    tempNod.push.apply(tempNod, temp2);
    tempNod.push.apply(tempNod, temp3);

    densNod.length = 0;
    densNod.push.apply(densNod, dens1);
    densNod.push.apply(densNod, dens2);
    densNod.push.apply(densNod, dens3);

    mtNod.length = 0;
    mtNod.push.apply(mtNod, mt1);
    mtNod.push.apply(mtNod, mt2);
    mtNod.push.apply(mtNod, mt3);

    pcntNod.length = 0;
    pcntNod.push.apply(pcntNod, pcnt);

    vlmNod.length = 0;
    vlmNod.push.apply(vlmNod, vlm);

    ulgNod.length = 0;
    ulgNod.push.apply(ulgNod, ulg);

    checkBoxNod.length = 0;
    checkBoxNod.push.apply(checkBoxNod, checkBoxs);
    checkBoxNod.push.apply(checkBoxNod, checkBoxs2);
    checkBoxNod.push.apply(checkBoxNod, checkBoxs3);

    tnkDrwHeightNod.length = 0;
    tnkDrwHeightNod.push.apply(tnkDrwHeightNod, tnkDrwHeight);

    tnkDrwPercentNod.length = 0;
    tnkDrwPercentNod.push.apply(tnkDrwPercentNod, tnkDrwPercent);

    for (let i = 0; i < levelNod.length; i++)
    {
        levelNod[i].value = '';
        vlmNod[i].value = '';
        ulgNod[i].value = '';
        pcntNod[i].value = '';
        tempNod[i].value = 15;
        densNod[i].value = 1.0;
        mtNod[i].value = '';
        tnkDrwHeightNod[i].style.height = "0%";
        tnkDrwPercentNod[i].innerHTML = "";
    }
}



//==Эта функция заполняет инпуты при возврате на страницу 'sounding' данными из массива, где они были сохранены при оставлении странтцы================
function loadSavedFromInputs() {

    let savedSound = JSON.parse(sessionStorage.getItem('savedSound'));
    console.log('JSON = '+savedSound.date,savedSound.comment,savedSound.dateSoundUserId, savedSound.tankParam[0][0]);

    document.querySelector('#comment-id').value = savedSound.comment;
    document.querySelector('#trim-id').value = savedSound.trim;

    inputDataClear();

    //   let element = document.getElementById('tsoundLShfo');
    //   element.dispatchEvent(event);
    //======================================================================================

    let dates2 = savedSound.tankParam;
    let a = 0;

    //==Перебираем в цикле массив и возвращаем ранее сохраненные данные в инпуты=====================================
    for (let i = 0; i < dates2[4].length; i++){
       // console.log('////////dates2[0][i] = '+ document.querySelector('#tsound' + dates2[4][i]));
        document.querySelector('#tsound' + dates2[4][i]).value = dates2[0][i]*1;

        // inputSelected.dispatchEvent(event); //==навешиваем событие 'input' на програмный ввод ранее сохраненнвх замеров
        document.querySelector('#tsound' + dates2[4][i]).dispatchEvent(event);
        document.querySelector('#ttemp' + dates2[4][i]).value = dates2[1][i]*1;
        document.querySelector('#tdens' + dates2[4][i]).value = dates2[2][i]*1;
        document.querySelector('#tmt' + dates2[4][i]).value = dates2[5][i]*1;
        document.querySelector('#tpercent' + dates2[4][i]).value = dates2[6][i]*1;

        //==Показываем уровень на графическом представлении танков========================
        document.getElementById('percent' + dates2[4][i]).innerHTML = dates2[6][i];
        document.querySelector('.level-' + dates2[4][i]).style.height = dates2[6][i] + "%";
        document.querySelector('#tvol' + dates2[4][i]).value = dates2[7][i]*1;
        document.querySelector('#tullage' + dates2[4][i]).value = dates2[8][i]*1;

        //==Возвращаем состояние чекбоксов==============================================
        dates2[9][i]?document.querySelector('#checkbox' + dates2[4][i]).checked=true:document.querySelector('#checkbox' + dates2[4][i]).checked=false
        document.querySelector('#checkbox' + dates2[4][i]).value = dates2[9][i];
        checkBoxClick();
    }
    document.querySelector('#idHfoBefore').value = savedSound.hfoBefore;
    document.querySelector('#idMdoBefore').value = savedSound.mdoBefore;

   // document.querySelector('#hfoDiff').value = document.querySelector('#hfoTotal').value - savedSound.hfoBefore;
    document.querySelector('#mdoDiff').value = savedSound.mdoDiffInCollection;
       // console.log('Quantity of events = '+ a);

}





//=Выбираем ранее сохраненную дату замеров посылаем запрос в БД и выводим данные в таблицу==================
function selectDatesPressed() {
    let id=1;

    let select = document.getElementById('save-of-time-id');
    select.addEventListener("click", function(){
        sessionStorage.removeItem('savedSound');
        id = select.options[select.selectedIndex].attributes.data_option.value; //==При выборе в выпадающем списке даты замера получаем id этой даты
        console.log('option id = ' + id);

        getDate(id).then(dates => {
            console.log(dates);

            document.querySelector('#comment-id').value = dates[0].comment;
            document.querySelector('#trim-id').value = dates[0].trim;
            getTrim();

            inputDataClear();


         //   let element = document.getElementById('tsoundLShfo');
         //   element.dispatchEvent(event);
            //======================================================================================

            dates.forEach(function(date, i, dates){
                // console.log(date.level);

                //==Показываем уровень на графическом представлении танков========================
               // console.log(document.querySelector('.level-' + date.tank_abbrev));
                if (date.level !== null){
                    document.querySelector('#tsound' + date.tank_abbrev).value = date.level*1;
                    document.querySelector('#tsound' + date.tank_abbrev).dispatchEvent(event); //==навешиваем событие 'input' на програмный ввод ранее сохраненнвх замеров
                }
                if (date.temp !== null){
                    document.querySelector('#ttemp' + date.tank_abbrev).value = date.temp*1;
                }
                if (date.density !== null){
                    document.querySelector('#tdens' + date.tank_abbrev).value = date.density*1;
                }

            });
        });
    });
}
selectDatesPressed();


function nowPressed(){
    let now = moment().format();
  //  let now = moment().format('YYYY-MM-DDThh:mm:ss');
    alert(now.slice(0,19));
    document.querySelector('#time-now-id').value = now.slice(0,19);

}



//==В функции inputCollection() собираем данные которые нужно сохранить в БД============================================
function inputCollection() {
    //==Собираем данные для сохраненмя в БД=======================================================
    const date = document.getElementById('time-now-id').value;     //==Дата-время========
    const comment = document.getElementById('comment-id').value;   //==Комментарий=======
    const trim = document.getElementById('trim-id').value;         //==Дифферент судна===
    const dateSoundUserId = getCookie('user');                        //==Дифферент судна===
    const hfoBefore = document.getElementById('idHfoBefore').value;      //==Кол-во HFO топлива перед бункровкой===
    const mdoBefore = document.getElementById('idMdoBefore').value;      //==Кол-во MDO топлива перед бункровкой===
    const hfoDiffInCollection = document.getElementById('hfoDiff').value;
    const mdoDiffInCollection = document.getElementById('mdoDiff').value;
    const tankParam = [[], [], [], [], [], [], [], [], [], []];


    //=Перед заполнением sound очищаем инпуты===============================================
    let level1 = document.getElementsByName('level0'); //=Массив HFO storage танков
    let level2 = document.getElementsByName('level1'); //=Массив HFO daily танков
    let level3 = document.getElementsByName('level2'); //=Массив MGO танков

    let vlm = document.getElementsByName('vlm'); //=Массив MGO танков

    let ulg = document.getElementsByName('ulg'); //=Массив MGO танков

    let temp1 = document.getElementsByName('temp0'); //=Массив HFO storage танков
    let temp2 = document.getElementsByName('temp1'); //=Массив HFO daily танков
    let temp3 = document.getElementsByName('temp2'); //=Массив MGO танков

    let dens1 = document.getElementsByName('dens0'); //=Массив HFO storage танков
    let dens2 = document.getElementsByName('dens1'); //=Массив HFO daily танков
    let dens3 = document.getElementsByName('dens2'); //=Массив MGO танков

    let mt1 = document.getElementsByName('mt0'); //=Массив HFO storage танков
    let mt2 = document.getElementsByName('mt1'); //=Массив HFO daily танков
    let mt3 = document.getElementsByName('mt2'); //=Массив MGO танков

    let pcnt = document.getElementsByName('pcnt'); //=Массив танков

    let checkBoxs = document.getElementsByName('tankChecks0');
    let checkBoxs2 = document.getElementsByName('tankChecks1');
    let checkBoxs3 = document.getElementsByName('tankChecks2');

    levelNod.length = 0;
    levelNod.push.apply(levelNod, level1);
    levelNod.push.apply(levelNod, level2);
    levelNod.push.apply(levelNod, level3);

    tempNod.length = 0;
    tempNod.push.apply(tempNod, temp1);
    tempNod.push.apply(tempNod, temp2);
    tempNod.push.apply(tempNod, temp3);

    densNod.length = 0;
    densNod.push.apply(densNod, dens1);
    densNod.push.apply(densNod, dens2);
    densNod.push.apply(densNod, dens3);

    mtNod.length = 0;
    mtNod.push.apply(mtNod, mt1);
    mtNod.push.apply(mtNod, mt2);
    mtNod.push.apply(mtNod, mt3);

    pcntNod.length = 0;
    pcntNod.push.apply(pcntNod, pcnt);

    vlmNod.length = 0;
    vlmNod.push.apply(vlmNod, vlm);

    ulgNod.length = 0;
    ulgNod.push.apply(ulgNod, ulg);

    checkBoxNod.length = 0;
    checkBoxNod.push.apply(checkBoxNod, checkBoxs);
    checkBoxNod.push.apply(checkBoxNod, checkBoxs2);
    checkBoxNod.push.apply(checkBoxNod, checkBoxs3);
    //==Уровень, температура, плотность топлива и id танка, данные собираются из массивов input элементов===
    //console.log('mtNod = ' + mtNod);
    for (let i = 0; i < levelNod.length; i++)
    {
        tankParam[0][i] = levelNod[i].value;
        tankParam[1][i] = tempNod[i].value;
        tankParam[2][i] = densNod[i].value;
        let str = levelNod[i].attributes.class.value; //==получаем значение аттрибутов class в которых были сохранены id танков при создании инпутов==
        console.log(str);
        tankParam[3][i] = str.substr(6,3);        //==сохраняем в массиве id танков======
        console.log(tankParam[3][i]);
        let strId = levelNod[i].id; //==получаем значение аттрибутов class в которых были сохранены id танков при создании инпутов==
        tankParam[4][i] = strId.substr(6);     //==получаем абривиатуру танков  из id инпутов==
       // console.log(levelNod.length);
        console.log(i+' = '+tankParam[4][i]);
        tankParam[5][i] = mtNod[i].value;
        tankParam[6][i] = pcntNod[i].value;
        tankParam[7][i] = vlmNod[i].value;
        tankParam[8][i] = ulgNod[i].value;
        checkBoxNod[i].checked?tankParam[9][i] = true:tankParam[9][i]=false;

    }
    let savedSoundTemp = JSON.stringify({date, comment, trim, dateSoundUserId, hfoBefore, mdoBefore, hfoDiffInCollection, mdoDiffInCollection, tankParam});
    sessionStorage.setItem('savedSound', savedSoundTemp);
    let savedSound2 = JSON.parse(savedSoundTemp);
    console.log('JSON = '+savedSound2.date,savedSound2.comment,savedSound2.dateSoundUserId, savedSound2.tankParam[4][0]);

    return savedSoundTemp;
}


function savePressed() {

 //   const serverUrl = 'http://localhost/vsltanks/server/api/v1';

    //==Отправляем собранные данные на сервер методом POST===========
    const request = new XMLHttpRequest();
    request.open('POST', `${serverUrl}/date`);
    request.send(inputCollection());
    request.onreadystatechange = () => {
        if (request.status === 200 && request.readyState === 4) {
            alert('Saved!');
        }
    };
}
//======================================================================================================================




//==Удаляем из БД ранее сохраненные, но ставшие ненужными старые замеры=================
function deletePressed(){
    let select = document.querySelector('#save-of-time-id');
    select.addEventListener('click', () => {
      // alert(select.value);
    });
    removeDate(select.options[select.selectedIndex].attributes.data_option.value); //==функция в которой отправляется REMOVE запрос==========
    loadPressed();                                                                 //==обновляем выпадающий список сохраненных дот замеров===
}


//======================================================================================================================
//==========БЛОК ДЛЯ ВЫВОДА РЕПОРТА=====================================================================================
//======================================================================================================================

//===Выводим отчет в модальное окно=====================================================================================

let modal = document.getElementById("myModal");

// Get the button that opens the modal
//let btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
function openReport() {
    let tableHfo = document.getElementById("idTableHfo");
   // let totalRowCount = tableHfo.rows.length;

    let tbodyRowCount = tableHfo.tBodies[0].rows.length; //==Получаем количество строк в таблице HFO=================================================================
    let hfoTanksReportRow = document.getElementById("hfoTanksReportTableTbody");
    let strTableRow  = '';
    let strTableHead = '';
    let totalHfo = 0;

    //==Перебираем строки рабочей таблицы HFO для вывода в финальный отчет===========================================
    let strHead = `
               <tr class="tr-report-head">
                        <td class="tdUpperPart"></td>
                        <td class="tdUpperPart"></td>
                        <td class="tdUpperPart"></td>
                        <td class="tdUpperPart">DATE:</td>
                        <td class="tdUpperPart">30 July 2021</td>
                        <td class="tdUpperPart">SW TEMP</td>
                        <td class="tdUpperPart">18C</td>
                        <td class="tdUpperPart">TRIM:</td>
                        <td class="tdUpperPart">1.0</td>
                        <td class="tdUpperPart"></td>
                    </tr>
                    <tr class="tr-report-head">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>11:43</td>
                        <td>ER TEMP:</td>
                        <td>32C</td>
                        <td>PLACE:</td>
                        <td>LONG BEACH</td>
                        <td></td>
                    </tr>
              `;
    strTableHead += strHead;

    tanksReportGeneral.innerHTML = strTableHead;
    for (let i = 1; i <= tbodyRowCount; i++){
        totalHfo = totalHfo + tableHfo.rows[i].cells[10].children[0].value*1;

        let str = `
               <tr class="hfo-row">
                   <td class="tdRowsInReport">${tableHfo.rows[i].cells[0].innerHTML}</td>
                   <td class="tdRowsInReport">${tableHfo.rows[i].cells[1].innerHTML}</td>
                   <td class="tdRowsInReport">${tableHfo.rows[i].cells[5].children[0].value}</td>
                   <td class="tdRowsInReport">${tableHfo.rows[i].cells[3].children[0].value}</td>
                   <td class="tdRowsInReport">${tableHfo.rows[i].cells[4].children[0].value}</td>
                   <td class="tdRowsInReport">${tableHfo.rows[i].cells[8].children[0].value}</td>
                   <td class="tdRowsInReport">${tableHfo.rows[i].cells[9].children[0].value}</td>
                   <td class="tdRowsInReport">${tableHfo.rows[i].cells[9].children[0].value}</td>
                   <td class="tdRowsInReport">${tableHfo.rows[i].cells[10].children[0].value}</td>
                   <td class="tdRowsInReport">${tableHfo.rows[i].cells[7].children[0].value}</td>
               </tr>
              `;
        strTableRow += str;
    }
    hfoTanksReportRow.innerHTML = strTableRow;
    let str = `
               <tr class="hfo-row">
                    <td class="tdTotal"></td><td></td><td></td><td></td><td></td><td></td><td></td>
                    <td class="tdTotal">Total HFO</td>
                    <td class="tdTotal">${totalHfo}</td>
                    <td class="tdTotal">MT</td>
               </tr>
              `;
    hfoTanksReportRow.innerHTML += str;

    let tableMdo = document.getElementById("idTableMdo");
    // let totalRowCount = tableHfo.rows.length;
    tbodyRowCount = tableMdo.tBodies[0].rows.length; //==Получаем количество строк в таблице MDO=================================================================
    let mdoTanksReportRow = document.getElementById("mdoTanksReportTableTbody");
    let strTableRow2  = '';
    let totalMdo = 0;
    //==Перебираем строки рабочей таблицы MDO для вывода в финальный отчет===========================================
    for (let i = 1; i <= tbodyRowCount; i++){
        totalMdo = totalMdo + tableMdo.rows[i].cells[10].children[0].value*1;
        let str = `
               <tr class="hfo-row">
                   <td class="tdRowsInReport">${tableMdo.rows[i].cells[0].innerHTML}</td>
                   <td class="tdRowsInReport">${tableMdo.rows[i].cells[1].innerHTML}</td>
                   <td class="tdRowsInReport">${tableMdo.rows[i].cells[5].children[0].value}</td>
                   <td class="tdRowsInReport">${tableMdo.rows[i].cells[3].children[0].value}</td>
                   <td class="tdRowsInReport">${tableMdo.rows[i].cells[4].children[0].value}</td>
                   <td class="tdRowsInReport">${tableMdo.rows[i].cells[8].children[0].value}</td>
                   <td class="tdRowsInReport">${tableMdo.rows[i].cells[9].children[0].value}</td>
                   <td class="tdRowsInReport">${tableMdo.rows[i].cells[9].children[0].value}</td>
                   <td class="tdRowsInReport">${tableMdo.rows[i].cells[10].children[0].value}</td>
                   <td class="tdRowsInReport">${tableMdo.rows[i].cells[7].children[0].value}</td>
               </tr>
              `;
        strTableRow2 += str;
    }
    mdoTanksReportRow.innerHTML = strTableRow2;

    let strMdo = `
               <tr class="hfo-row">
                    <td class="tdTotal"></td><td></td><td></td><td></td><td></td><td></td><td></td>
                    <td class="tdTotal">Total MDO</td>
                    <td class="tdTotal">${totalMdo}</td>
                    <td class="tdTotal">MT</td>
               </tr>
              `;

    mdoTanksReportRow.innerHTML += strMdo;

    modal.style.display = "block";

}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function callPrint() {
    const printCSS = '<link rel="stylesheet" href="http://localhost/vsltanks/client/css/style-sounding.css" type="text/css" />';
    const printReport = document.getElementById('myModal').innerHTML;
    const windowPrint = window.open('','','left=50,top=50,width=100%,height=100%,toolbar=0,scrollbars=1,status=0');
    windowPrint.document.write(printCSS);
    windowPrint.document.write(printReport);
    // windowPrint.document.write(printImg);
    // windowPrint.document.write(printText);
    windowPrint.document.close();
  //  windowPrint.focus();
    windowPrint.print();
    windowPrint.close();
}

let printReport =()=>{
    callPrint();
}
//==========КОНЕЦ БЛОКА ДЛЯ ВЫВОДА РЕПОРТА==============================================================================
//======================================================================================================================



//======================================================================================================================
//========БЛОК ФУНКЦИЙ ДЛЯ ИЗМЕНИЯ В ИМПУТАХ ОДНОГО ТАНКА В СООТВЕТСТВИИ С ВВЕДЕННЫМИ ПОЛЬЗОВАТЕЛЕМ ДАННЫМИ=============
//======================================================================================================================
function percent(arrTank){
    if (document.querySelector('#tpercent' + arrTank.tank_abbrev)){
        document.querySelector('#tpercent' + arrTank.tank_abbrev).addEventListener('input'||'change', function () {
            if (document.querySelector('#tpercent' + arrTank.tank_abbrev).value > 100){
                document.querySelector('#tpercent' + arrTank.tank_abbrev).value = 100;
            } else if (document.querySelector('#tpercent' + arrTank.tank_abbrev).value < 0){
                document.querySelector('#tpercent' + arrTank.tank_abbrev).value = 0;
            }
            let percent = document.querySelector('#tpercent' + arrTank.tank_abbrev).value;
            document.getElementById('percent' + arrTank.tank_abbrev).innerHTML = percent;
            document.querySelector('.level-' + arrTank.tank_abbrev).style.height = percent + "%";
            let storageTanksQuantity = sessionStorage.getItem('storageTanksQuantity');

            //  document.querySelector(levelHfo[i]).style.height = percent + "%";
            //  document.getElementById(textOnTank[i]).innerHTML = percent;
            document.querySelector('#tvol' + arrTank.tank_abbrev).value = Math.round((document.querySelector('#maxVol' + arrTank.tank_abbrev).value / 100 * percent)*100)/100;
            let mt = document.querySelector('#tvol' + arrTank.tank_abbrev).value *
                (document.querySelector('#tdens' + arrTank.tank_abbrev).value-(document.querySelector('#ttemp' + arrTank.tank_abbrev).value-15)*0.000515);
            document.querySelector('#tmt' + arrTank.tank_abbrev).value = Math.round(mt*100)/100;
            document.querySelector('#hfoTotal').dispatchEvent(clickEvent);
        });
    }
}

function temperature(arrTank){
    if (document.querySelector('#ttemp' + arrTank.tank_abbrev)){
        document.querySelector('#ttemp' + arrTank.tank_abbrev).addEventListener('input'||'change', function () {
            if (document.querySelector('#ttemp' + arrTank.tank_abbrev).value > 150){
                document.querySelector('#ttemp' + arrTank.tank_abbrev).value = 150;
            } else if (document.querySelector('#ttemp' + arrTank.tank_abbrev).value < 5){
                document.querySelector('#ttemp' + arrTank.tank_abbrev).value = 5;
            }
            let mt = document.querySelector('#tvol' + arrTank.tank_abbrev).value *
                (document.querySelector('#tdens' + arrTank.tank_abbrev).value-(document.querySelector('#ttemp' + arrTank.tank_abbrev).value-15)*0.000515);
            document.querySelector('#tmt' + arrTank.tank_abbrev).value = Math.round(mt*100)/100;
            document.querySelector('#hfoTotal').dispatchEvent(clickEvent);
        });
    }

}

function density(arrTank){
    if (document.querySelector('#tdens' + arrTank.tank_abbrev)){
        document.querySelector('#tdens' + arrTank.tank_abbrev).addEventListener('input'||'change', function () {
            if (document.querySelector('#tdens' + arrTank.tank_abbrev).value > 1.2){
                document.querySelector('#tdens' + arrTank.tank_abbrev).value = 1.2;
            } else if (document.querySelector('#tdens' + arrTank.tank_abbrev).value < 0.6){
                document.querySelector('#tdens' + arrTank.tank_abbrev).value = 0.6;
            }
            let mt = document.querySelector('#tvol' + arrTank.tank_abbrev).value *
                (document.querySelector('#tdens' + arrTank.tank_abbrev).value-(document.querySelector('#ttemp' + arrTank.tank_abbrev).value-15)*0.000515);
            document.querySelector('#tmt' + arrTank.tank_abbrev).value = Math.round(mt*100)/100;
            document.querySelector('#hfoTotal').dispatchEvent(clickEvent);
        });
    }
}

function volume(arrTank){
    console.log(arrTank.tank_id);
    let percent = Math.round((document.querySelector('#tvol' + arrTank.tank_abbrev).value /
        (document.querySelector('#maxVol' + arrTank.tank_abbrev).value / 100))*10)/10;

    document.querySelector('#ttemp' + arrTank.tank_abbrev).value;

    let dens = getDensity(document.querySelector('#ttemp' + arrTank.tank_abbrev).value/1, document.querySelector('#tdens' + arrTank.tank_abbrev).value/1);
    let mt = document.querySelector('#tvol' + arrTank.tank_abbrev).value * dens;

    document.querySelector('#tmt' + arrTank.tank_abbrev).value = Math.round(mt*100)/100;


   // console.log('count = ' + document.querySelector('#tmt' + arrTank.tank_abbrev).value);
    document.getElementById('percent' + arrTank.tank_abbrev).innerHTML = percent;
    document.querySelector('#tpercent' + arrTank.tank_abbrev).value =  percent;
    document.querySelector('.level-' + arrTank.tank_abbrev).style.height = percent + "%";
    if (document.querySelector('#checkbox' + arrTank.tank_abbrev).checked){
        document.querySelector('#hfoTotal').value = document.querySelector('#tmt' + arrTank.tank_abbrev).value;

    }
}
//========КОНЕЦ БЛОКА ФУНКЦИЙ ДЛЯ ИЗМЕНИЯ В ИМПУТАХ ОДНОГО ТАНКА В СООТВЕТСТВИИ С ВВЕДЕННЫМИ ПОЛЬЗОВАТЕЛЕМ ДАННЫМИ======
//======================================================================================================================




//==функция для вывода суммы топлива в танках отмеченных чекбоксами======================================
function total(arrTank){
   // document.querySelector('#tmt' + arrTank.tank_abbrev).dispatchEvent(event);
    let checkBoxs = document.getElementsByName('tankChecks0');
    let checkBoxs2 = document.getElementsByName('tankChecks1');
    let checkBoxs3 = document.getElementsByName('tankChecks2');
    if (document.querySelector('#tmt' + arrTank.tank_abbrev)){
        document.querySelector('#tmt' + arrTank.tank_abbrev).addEventListener('input'||'change', function () {
            let checks = document.getElementsByName('mt0');
            let checks2 = document.getElementsByName('mt1');
            let checks3 = document.getElementsByName('mt2');

            let mtTotal = 0;
            let mdoMtTotal = 0;

            for (let i = 0; i < checks.length; i++)
            {
                if (checks[i].value && checkBoxs[i].checked){

                    mtTotal = mtTotal + checks[i].value*1;
                }
            }
            for (let i = 0; i < checks2.length; i++)
            {
                if (checks2[i].value && checkBoxs2[i].checked){
                    mtTotal = mtTotal + checks2[i].value*1;
                }
            }
            for (let i = 0; i < checks3.length; i++)
            {
                if (checks3[i].value && checkBoxs3[i].checked){
                    mdoMtTotal = mdoMtTotal + checks3[i].value*1;
                }
            }
            document.querySelector('#hfoTotal').value = Math.round(mtTotal*100)/100;
            document.querySelector('#mdoTotal').value = Math.round(mdoMtTotal*100)/100;
            console.log(document.querySelector('#mdoTotal').value);
        });
    }
    if (document.querySelector('#hfoTotal')) {
        document.querySelector('#hfoTotal').addEventListener('click' || 'change', function () {
            let checks = document.getElementsByName('mt0');
            let checks2 = document.getElementsByName('mt1');
            let checks3 = document.getElementsByName('mt2');
            let mtTotal = 0;
            let mdoMtTotal = 0;

            for (let i = 0; i < checks.length; i++)
            {
                if (checks[i].value && checkBoxs[i].checked){
                    mtTotal = mtTotal + checks[i].value*1;
                 //   console.log(mtTotal);
                }
            }
            for (let i = 0; i < checks2.length; i++)
            {
                if (checks2[i].value && checkBoxs2[i].checked){
                    mtTotal = mtTotal + checks2[i].value*1;
                }
            }
            for (let i = 0; i < checks3.length; i++)
            {
                if (checks3[i].value && checkBoxs3[i].checked){
                    mdoMtTotal = mdoMtTotal + checks3[i].value*1;
                    //console.log('mdoTotal');
                }
            }
            document.querySelector('#hfoTotal').value = Math.round(mtTotal*100)/100;
            document.querySelector('#mdoTotal').value = Math.round(mdoMtTotal*100)/100;
            //==Производим расчет разницы между инпутом before и инпутом total при кликах на чекбоксах и выводим результат в инпут different
            if (document.getElementById('hfoCheckbox').checked){
                // console.log('CHECKED');
                document.getElementById('hfoDiff').value = document.getElementById('hfoTotal').value - document.getElementById('idHfoBefore').value;
            }
            if (document.getElementById('mdoCheckbox').checked){
                // console.log('CHECKED');
                document.getElementById('mdoDiff').value = document.getElementById('mdoTotal').value - document.getElementById('idMdoBefore').value;
            }
        });
    }
}



//=функция для корректировки плотности в зависимости от температуры=======
function getDensity(temp, dens15){
    let oneDegCorr;
    let density = 1.0;

    if(dens15 >= 0.66 && dens15 <= 0.669){
        oneDegCorr = 0.000949;
    }else if(dens15 >= 0.67 && dens15 <= 0.679){
        oneDegCorr = 0.000936;
    }else if(dens15 >= 0.68 && dens15 <= 0.689){
        oneDegCorr = 0.000923;
    }else if(dens15 >= 0.69 && dens15 <= 0.699){
        oneDegCorr = 0.00091;
    }else if(dens15 >= 0.7 && dens15 <= 0.7099){
        oneDegCorr = 0.000897;
    }else if(dens15 >= 0.71 && dens15 <= 0.7199){
        oneDegCorr = 0.000884;
    }else if(dens15 >= 0.72 && dens15 <= 0.7299){
        oneDegCorr = 0.00087;
    }else if(dens15 >= 0.73 && dens15 <= 0.7399){
        oneDegCorr = 0.000857;
    }else if(dens15 >= 0.74 && dens15 <= 0.7499){
        oneDegCorr = 0.000844;
    }else if(dens15 >= 0.75 && dens15 <= 0.7599){
        oneDegCorr = 0.000832;
    }else if(dens15 >= 0.76 && dens15 <= 0.7699){
        oneDegCorr = 0.000818;
    }else if(dens15 >= 0.77 && dens15 <= 0.7799){
        oneDegCorr = 0.000805;
    }else if(dens15 >= 0.78 && dens15 <= 0.7899){
        oneDegCorr = 0.000792;
    }else if(dens15 >= 0.79 && dens15 <= 0.7999){
        oneDegCorr = 0.000778;
    }else if(dens15 >= 0.8 && dens15 <= 0.8099){
        oneDegCorr = 0.000765;
    }else if(dens15 >= 0.81 && dens15 <= 0.8199){
        oneDegCorr = 0.000752;
    }else if(dens15 >= 0.82 && dens15 <= 0.8299){
        oneDegCorr = 0.000738;
    }else if(dens15 >= 0.83 && dens15 <= 0.8399){
        oneDegCorr = 0.000725;
    }else if(dens15 >= 0.84 && dens15 <= 0.8499){
        oneDegCorr = 0.000712;
    }else if(dens15 >= 0.85 && dens15 <= 0.8599){
        oneDegCorr = 0.000699;
    }else if(dens15 >= 0.86 && dens15 <= 0.8699){
        oneDegCorr = 0.000686;
    }else if(dens15 >= 0.87 && dens15 <= 0.8799){
        oneDegCorr = 0.000673;
    }else if(dens15 >= 0.88 && dens15 <= 0.8899){
        oneDegCorr = 0.00066;
    }else if(dens15 >= 0.89 && dens15 <= 0.8999){
        oneDegCorr = 0.000647;
    }else if(dens15 >= 0.9 && dens15 <= 0.9099){
        oneDegCorr = 0.000633;
    }else if(dens15 >= 0.91 && dens15 <= 0.9199){
        oneDegCorr = 0.00062;
    }else if(dens15 >= 0.92 && dens15 <= 0.9299){
        oneDegCorr = 0.000607;
    }else if(dens15 >= 0.93 && dens15 <= 0.9399){
        oneDegCorr = 0.000594;
    }else if(dens15 >= 0.94 && dens15 <= 0.9499){
        oneDegCorr = 0.000581;
    }else if(dens15 >= 0.95 && dens15 <= 0.9599){
        oneDegCorr = 0.000567;
    }else if(dens15 >= 0.96 && dens15 <= 0.9699){
        oneDegCorr = 0.000554;
    }else if(dens15 >= 0.97 && dens15 <= 0.9799){
        oneDegCorr = 0.000541;
    }else if(dens15 >= 0.98 && dens15 <= 0.9899){
        oneDegCorr = 0.000528;
    }else if(dens15 >= 0.99 && dens15 <= 1.01){
        oneDegCorr = 0.000515;
    }else {oneDegCorr = 0.000554;}

    density = (dens15 - ((temp - 15) * oneDegCorr));
    return density;
}



//=Функция getTrim() получает с инпута дифферент и вычисляет ближайшие существующие столбцы в таблицце БД=====
//=Сохраняет в sessionStorage
function getTrim() {
    let trimColumnArr = JSON.parse(sessionStorage.getItem('trimColumnArr'));
    if (document.querySelector('#trim-id')) {
        document.querySelector('#trim-id').addEventListener('input' || 'change', function () {
            sessionStorage.setItem('trimFromInput', document.querySelector('#trim-id').value);
            let trim = document.querySelector('#trim-id').value*1;
            let trimReal=0;
            let minVal=0;
            let maxVal=0;
            trimColumnArr.forEach(function (trimColumn, i, trimColumnArr) {
                if (trim < (trimColumnArr[i].COLUMN_NAME*1) && i === 0){
                    trimReal = trimColumnArr[0].COLUMN_NAME;
                    sessionStorage.setItem('trim',trimReal);
                    sessionStorage.setItem('minVal', trimColumnArr[i].COLUMN_NAME*1);
                    sessionStorage.setItem('maxVal', trimColumnArr[i].COLUMN_NAME*1);
                    //    document.querySelector('#trim-id').value = trimReal;
                }else if (trim < (trimColumnArr[i].COLUMN_NAME*1) && trim > (trimColumnArr[i-1].COLUMN_NAME*1)){
                    minVal = trimColumnArr[i-1].COLUMN_NAME;
                    sessionStorage.setItem('minVal',minVal);
                }else if (trim > (trimColumnArr[i].COLUMN_NAME*1) && (i+1) === trimColumnArr.length){
                    trimReal = trimColumnArr[i].COLUMN_NAME;
                    sessionStorage.setItem('trim',trimReal);
                    sessionStorage.setItem('minVal', 0);
                    sessionStorage.setItem('maxVal', 0);
                    document.querySelector('#trim-id').value = trimReal;
                }else if (trim > (trimColumnArr[i].COLUMN_NAME*1) && trim < (trimColumnArr[i+1].COLUMN_NAME)){
                    maxVal = trimColumnArr[i+1].COLUMN_NAME;
                    sessionStorage.setItem('maxVal',maxVal);
                }else if (trim === (trimColumnArr[i].COLUMN_NAME*1)){
                    trimReal = trimColumnArr[i].COLUMN_NAME;
                    sessionStorage.setItem('trim',trimReal);
                    sessionStorage.setItem('minVal', trim);
                    sessionStorage.setItem('maxVal', trim);
                }
            });
            // for (let i = 0; i < trimColumnArr.length; i++) {
            //    // console.log((i+1) + '>' + trimColumnArr.length);
            //     if (trim < (trimColumnArr[i].COLUMN_NAME*1) && i === 0){
            //         trimReal = trimColumnArr[0].COLUMN_NAME;
            //         sessionStorage.setItem('trim',trimReal);
            //         sessionStorage.setItem('minVal', 0);
            //         sessionStorage.setItem('maxVal', 0);
            //     //    document.querySelector('#trim-id').value = trimReal;
            //     }else if (trim < (trimColumnArr[i].COLUMN_NAME*1) && trim > (trimColumnArr[i-1].COLUMN_NAME*1)){
            //         minVal = trimColumnArr[i-1].COLUMN_NAME;
            //         sessionStorage.setItem('minVal',minVal);
            //     }else if (trim > (trimColumnArr[i].COLUMN_NAME*1) && (i+1) === trimColumnArr.length){
            //         trimReal = trimColumnArr[i].COLUMN_NAME;
            //         sessionStorage.setItem('trim',trimReal);
            //         sessionStorage.setItem('minVal', 0);
            //         sessionStorage.setItem('maxVal', 0);
            //         document.querySelector('#trim-id').value = trimReal;
            //     }else if (trim > (trimColumnArr[i].COLUMN_NAME*1) && trim < (trimColumnArr[i+1].COLUMN_NAME)){
            //         maxVal = trimColumnArr[i+1].COLUMN_NAME;
            //         sessionStorage.setItem('maxVal',maxVal);
            //     }else if (trim === (trimColumnArr[i].COLUMN_NAME*1)){
            //         trimReal = trimColumnArr[i].COLUMN_NAME;
            //         sessionStorage.setItem('trim',trimReal);
            //         sessionStorage.setItem('minVal', 0);
            //         sessionStorage.setItem('maxVal', 0);
            //     }
            // }
          //  console.log('minVal = ' + minVal + ', maxVol =' + maxVal + ', trimReal =' + trimReal);
        });
    }
}

getTrim();


//======================================================================================================================
//=======БЛОК ДЛЯ РАБОТЫ С ЧЕКБОКСАМИ===================================================================================
//=====================================================================================================================

//=Для выбора всех чекбоксов HFO танков или отмены выбора - щелкаем на чекбоксе заголовка 1ой вкладки
document.getElementById("mainCheckboxHfo").onclick = function(){
    let checks = document.getElementsByName('tankChecks0');
    let checks2 = document.getElementsByName('tankChecks1');
   // console.log('checkbox.checked');

    for (let i = 0; i < checks.length; i++)
    {
        checks[i].checked = document.getElementById("mainCheckboxHfo").checked;
        checkBoxClick();
    }
    for (let i = 0; i < checks2.length; i++)
    {
        checks2[i].checked = document.getElementById("mainCheckboxHfo").checked;
        checkBoxClick();
    }
}

//=Для выбора всех чекбоксов MDO танков или отмены выбора - щелкаем на чекбоксе заголовка 2ой вкладки
document.getElementById("mainCheckboxMdo").onclick = function(){
    let checks = document.getElementsByName('tankChecks2');

    for (let i = 0; i < checks.length; i++)
    {
        checks[i].checked = document.getElementById("mainCheckboxMdo").checked;
        checkBoxClick();
    }
}


function checkBoxClick(){
    let checkBoxs = document.getElementsByName('tankChecks0');
    let checkBoxs2 = document.getElementsByName('tankChecks1');
    let checkBoxs3 = document.getElementsByName('tankChecks2');
    let checks = document.getElementsByName('mt0');
    let checks2 = document.getElementsByName('mt1');
    let checks3 = document.getElementsByName('mt2');

    let mtTotal = 0;
    let mdoMtTotal = 0;

    for (let i = 0; i < checks.length; i++)
    {
        if (checks[i].value && checkBoxs[i].checked){

            mtTotal = mtTotal + checks[i].value*1;
        }
    }
    for (let i = 0; i < checks2.length; i++)
    {
        if (checks2[i].value && checkBoxs2[i].checked){
            mtTotal = mtTotal + checks2[i].value*1;
        }
    }
    for (let i = 0; i < checks3.length; i++)
    {
        if (checks3[i].value && checkBoxs3[i].checked){
            mdoMtTotal = mdoMtTotal + checks3[i].value*1;
        }
    }
    document.querySelector('#hfoTotal').value = Math.round(mtTotal*100)/100;
    document.querySelector('#mdoTotal').value = Math.round(mdoMtTotal*100)/100;

    //==Производим расчет разницы между инпутом before и инпутом total при кликах на чекбоксах и выводим результат в инпут different
    if (document.getElementById('hfoCheckbox').checked){
        // console.log('CHECKED');
        document.getElementById('hfoDiff').value = document.getElementById('hfoTotal').value - document.getElementById('idHfoBefore').value;
    }
    if (document.getElementById('mdoCheckbox').checked){
        // console.log('CHECKED');
        document.getElementById('mdoDiff').value = document.getElementById('mdoTotal').value - document.getElementById('idMdoBefore').value;
    }


  //  console.log(mtTotal);

}
//document.querySelector('#tpercent' + arrTank.tank_abbrev).addEventListener('input'||'change', function () {



//==Кликнув на checkbox напротив HFO инпутов, фиксируем общее количество HFO топлива в первый инпут
function hfoCheckboxBefore(){
    if (document.getElementById('hfoCheckbox').checked){
       // console.log('CHECKED');
        document.getElementById('idHfoBefore').value = document.getElementById('hfoTotal').value;
    }else{
        document.getElementById('idHfoBefore').value = 0;
        document.getElementById('hfoDiff').value = 0;
    }
}

//==Кликнув на checkbox напротив MDO инпутов, фиксируем общее количество MDO топлива в первый инпут
function mdoCheckboxBefore() {
    if (document.getElementById('mdoCheckbox').checked){
        // console.log('CHECKED');
        document.getElementById('idMdoBefore').value = document.getElementById('mdoTotal').value;
    }else{
        document.getElementById('idMdoBefore').value = 0;
        document.getElementById('mdoDiff').value = 0;
    }
}
//=======КОНЕЦ БЛОКА ДЛЯ РАБОТЫ С ЧЕКБОКСАМИ===================================================================================
//=============================================================================================================================



//=Создаем таблицу для ввода и вывода информации по танкам
function tanksTable(arrTank, rowH) {
    console.log('MAX VOLUME = ' +arrTank.tank_maxlevel);
    let str = ``;
    if (arrTank){
        let str = `
               <tr class="hfo-row" data-tankId="${arrTank.tank_id}" style="height: ${rowH}rem">
                   <td class="td-maxVol"> ${arrTank.tank_name}<input class="max-Vol-${arrTank.tank_abbrev}" type="number" hidden value="${arrTank.tank_volume}" id="maxVol${arrTank.tank_abbrev}"></td>
                   <td class="td-maxVol td-maxVol-font" >${arrTank.tank_volume}</td>
                   <td class="td-with-checkbox"><input class="input-checkbox" type="checkbox" name="tankChecks${arrTank.tank_type_id}" id="checkbox${arrTank.tank_abbrev}" onclick="checkBoxClick()"></td>
                   <td><input class="level-${arrTank.tank_id} vert-keyboard" type="number" inputmode="numeric" data-tnkid="${arrTank.tank_id}"  onfocus="getFocus()"
                                name="level${arrTank.tank_type_id}" id="tsound${arrTank.tank_abbrev}" min="0" max="${arrTank.tank_maxlevel}" value="0"></td>
                   <td><input type="number" inputmode="numeric" name="vlm" id="tvol${arrTank.tank_abbrev}" step="0.1"></td>
                   <td><input type="number" inputmode="numeric" name="ulg" id="tullage${arrTank.tank_abbrev}"></td>
                   <td class="td-space"></td>
                   <td><input type="number" inputmode="numeric" name="pcnt" id="tpercent${arrTank.tank_abbrev}" min="0" max="100"></td>
                   <td><input type="number" inputmode="numeric" name="temp${arrTank.tank_type_id}" id="ttemp${arrTank.tank_abbrev}" min="1" max="200" value="15"></td>
                   <td><input type="number" inputmode="numeric" name="dens${arrTank.tank_type_id}" id="tdens${arrTank.tank_abbrev}" min="0.66" max="1.1" value="1.0" step="0.0001"></td>
                   <td><input type="number" inputmode="numeric" name="mt${arrTank.tank_type_id}" id="tmt${arrTank.tank_abbrev}"></td>
               </tr>
              `;
        return str;
    }else{
        console.log('SDSDAFAFAFASFDASFASFASFASFDAS');
        return str;
    }


}


//=== Выводим схематичное изображение танков=========================
function tanksDrawings(arrTank) {

    let str = `
                 <div class="hfo-tank">
                     <div class="hfo-tank-name">${arrTank.tank_name}</div>
                     <div class="hfo-tank-percent" id="percent${arrTank.tank_abbrev}"></div>
                     <div class="hfo-tank-vol"></div>
                     <div class="hfo-tank-level level-${arrTank.tank_abbrev}" id="level${arrTank.tank_abbrev}"></div>
                 </div>  
                  `;
    return str;
    }


//=и выводим в виде таблицы используя функцию tankTable()=========
function vesselTanks(idVessel){
    getTanksQuantity(idVessel).then(tanks => {
      //  console.log(tanks);
        console.log('tanks.length= '+tanks.length);
        let tblContainerH
        if (document.getElementsByClassName('container-for-table')[0]){
            tblContainerH = document.getElementsByClassName('container-for-table')[0].offsetHeight;
        }


        tblContainerH = tblContainerH / 10 / 16;
        let strTab1        = '';
        let strTab2        = '';
        let strDrwLeft     = '';
        let strDrwRight    = '';
        let strDrwDo       = '';


        const elemTab1     = document.querySelector('#tanksRowsOnFirstTab');
        const elemTab2     = document.querySelector('#tanksRowsOnSecondTab');
        elemTab1.innerHTML = '';
        elemTab2.innerHTML = '';
        //=Контейнеры для div тегов изображающих танки
        const elemDrwLeft  = document.querySelector('#hfo-drw-left1');
        const elemDrwRight = document.querySelector('#hfo-drw-right1');
        const elemDrwDo    = document.querySelector('#hfo-drw-right2');
        elemDrwLeft.innerHTML = '';
        elemDrwRight.innerHTML = '';
        elemDrwDo.innerHTML = '';
        // let i = 0;
       // getTanksQuantity(2);
        let storageTanksQuantity = sessionStorage.getItem('storageTanksQuantity');
        tanks.forEach(function(tank, i, tanks){

            //=Создаем таблицу для ввода и вывода информации по танкам
            if (tank.tank_type_id === '0' || tank.tank_type_id === '1') {

                strTab1 += tanksTable(tank);
                elemTab1.innerHTML = strTab1;

            }else if (tank.tank_type_id === '2'){

                strTab2 += tanksTable(tank);
                elemTab2.innerHTML = strTab2;
            }

            //=== Выводим схематичное изображение танков============
            if (tank.tank_type_id === '0') {
                strDrwLeft += tanksDrawings(tank);
                elemDrwLeft.innerHTML = strDrwLeft;
            }else if (tank.tank_type_id === '1'){
                strDrwRight += tanksDrawings(tank);
                elemDrwRight.innerHTML = strDrwRight;
            }else if (tank.tank_type_id === '2'){
                strDrwDo += tanksDrawings(tank);
                elemDrwDo.innerHTML = strDrwDo;
            }

        });

        lengthTankOnDrw(document.querySelectorAll("#hfo-drw-left1>.hfo-tank"));
        lengthTankOnDrw(document.querySelectorAll("#hfo-drw-right1>.hfo-tank"));
        lengthTankOnDrw(document.querySelectorAll("#hfo-drw-left2>.hfo-tank"));
        lengthTankOnDrw(document.querySelectorAll("#hfo-drw-right2>.hfo-tank"));
        loadSavedFromInputs();

     //   Keyboard.init();
    });
    // .catch(value => {
    //     if (value){
    //         console.log('YOU ARE IN catch = '+value);
    //         //==Если запрос
    //         document.getElementById('tanksRowsOnFirstTab').innerHTML = '';
    //         document.getElementById('tanksRowsOnSecondTab').innerHTML = '';
    //         document.getElementById('hfo-drw-left1').innerHTML = '';
    //         document.getElementById('hfo-drw-right1').innerHTML = '';
    //         document.getElementById('hfo-drw-right2').innerHTML = '';
    //     }
    //
    // });

}

//==Функция для расчета ширины изображения танка в зависимости от их количества=====================
function lengthTankOnDrw(matches) {
    let ws = 100 / matches.length - 0.5;                  //==Из массива узлов получаем кол-во танков и вычисляем ширину танка в %
    matches.forEach(match => {
        match.style.width = ws + "%"; //==В цикле присваиваем ширину каждому танку в %
    });
}

//=Обрабатываем запросы с импутов и выводим полученную информацию в нужные импуты=======
function ftanks(){
    let vesselId = sessionStorage.getItem('idVesselSelect');
    getTanksQuantity(vesselId).then(tanks => {
     //   console.log('vesselId in tanks() = ' + vesselId);
        let mtTotal = 0;
        let vol = sessionStorage.getItem('volume');
        let tankTable = sessionStorage.getItem('tank');
        let sound = sessionStorage.getItem('sound');
        let ullage = sessionStorage.getItem('ullage');
        let minVal = sessionStorage.getItem('minVal');
        let maxVal = sessionStorage.getItem('maxVal');
        let trimFromInput = sessionStorage.getItem('trimFromInput');
        let trim1, trim2;
        let trimDiff;

        tanks.forEach(tank => {
         //   console.log('Massive tanks[] in tank()' + tanks[0].tank_id);
            if (document.querySelector('checkbox' + tank.tank_abbrev)){
                document.querySelector('checkbox' + tank.tank_abbrev).addEventListener( 'change', function () {
                    total(tank);
                    console.log('checkbox' + tank.tank_abbrev);

                });
            }

            if (document.querySelector('#tvol' + tank.tank_abbrev)) {
                document.querySelector('#tvol' + tank.tank_abbrev).addEventListener( 'click', function () {
                    

                    //=Сохраняем введенный объем и танк в sessionStorage
                    sessionStorage.setItem('tankID',tank.tank_id);
                    sessionStorage.setItem('volume', document.querySelector(('#tvol' + tank.tank_abbrev)).value );
                    sessionStorage.setItem('tank', tank.tank_table_name);
                    console.log('!!!!!!!!! click !!!!!!!!!');

                    if (document.querySelector(('#tvol' + tank.tank_abbrev)).value/1 > document.querySelector(('#maxVol' + tank.tank_abbrev)).value/1){
                        document.querySelector('#tvol' + tank.tank_abbrev).value = document.querySelector('#maxVol' + tank.tank_abbrev).value;
                        sessionStorage.setItem('volume', document.querySelector(('#tvol' + tank.tank_abbrev)).value );
                    }

                    vol = sessionStorage.getItem('volume');
                    tankTable = sessionStorage.getItem('tank');
                  //  trim = sessionStorage.getItem('trim');

                    //==========================   VOLUME    ====================================================================================================
                    //==Запрашиваем sound по выбранному танку, согласно отправленных объема и дифферента=========================================================

                    getVolume(tank.tank_id, vesselId,-1, -1, vol,1, 1,'sounding').then(volumew => {
                        document.querySelector('#tsound' + tank.tank_abbrev).value =  volumew[0].sound;
                        document.querySelector('#tullage' + tank.tank_abbrev).value =  volumew[0].ullage;
                    });

                    //==Обрабатываем информацию полученную в запросе и выводим в строке=========================

                    volume(tank);
                    document.querySelector('#hfoTotal').dispatchEvent(clickEvent);
                    document.querySelector('#mdoTotal').dispatchEvent(clickEvent);

                    // if (document.querySelector('#checkbox' + tank.tank_abbrev).checked){
                    //     document.querySelector('#hfoTotal').value = document.querySelector('#tmt' + tank.tank_abbrev).value;
                    // }
                   // console.log(document.querySelector('#tmt' + tank.tank_abbrev).value);
                });
            }


            if (document.querySelector('#tsound' + tank.tank_abbrev)){
             //   console.log('#tsound' + tank.tank_abbrev +'!!!!!!!!YES');
                document.querySelector('#tsound' + tank.tank_abbrev).addEventListener('input', function () {
                  //  console.log(document.querySelector(('#tsound' + tank.tank_abbrev)).value);

                    //=Сохраняем введенный уровень и танк в sessionStorage
                    sessionStorage.setItem('sound', document.querySelector(('#tsound' + tank.tank_abbrev)).value );
                    sessionStorage.setItem('tank', tank.tank_table_name);

                    sound = sessionStorage.getItem('sound');
                    tankTable = sessionStorage.getItem('tank');
                  //  trim = sessionStorage.getItem('trim');

                    //==Если trim введенный пользователем не совпадает с существующими столбцами в таблице, то мы получаем два ближайших значения,===
                    //==которые ранее функция getTrim() сохранила в sessionStorage===================================================================
                    minVal = sessionStorage.getItem('minVal');
                    maxVal = sessionStorage.getItem('maxVal');
                    trimFromInput = sessionStorage.getItem('trimFromInput');
                    trimDiff = (maxVal*1) - (minVal*1);
                    console.log(maxVal + ' - ' + minVal +'=' + trimDiff);


                    if (minVal === '0' && maxVal === '0'){
                        trim1 = trimFromInput;
                        trim2 = trimFromInput;
                    }else {
                        trim1 = minVal;
                        trim2 = maxVal;
                    }
                    console.log('trim1 = ' + trim1 + ', trim2 = ' + trim2);


                    //========================        SOUND        ==========================================================================================
                    //==Запрашиваем volume в нужном танке, согласно отправленных sound и дифферента============================================================

                    getVolume(tank.tank_id, vesselId, sound, -1,-1,trim1, trim2,'sounding').then(volumet => {
                        console.log('!!!!!!!!!!!!!!!!!!!!!!!!!!!!!YES!!!!!!!!!!!!!!!!!!!!!!!');
                        console.log('volMin = ' + volumet[0].min + ' ,volMax = ' + volumet[0].max);
                        //==Функция getVolume возвращает объект volumet значения которого получены из БД или из sessionStorage
                        //==В volumet[0].min кол-во топлива соответствующего минимальному близкому к фактическому дифференту, а соответствено в volumet[0].max кол-во топлива соответствующего максимальному близкому к фактическому дифференту
                        //==и если фактический дифферент совпадает со значением в БД, то volumet[0].min и volumet[0].max совпадают
                        if (volumet[0].min === volumet[0].max){
                            document.querySelector('#tvol' + tank.tank_abbrev).value =  volumet[0].max;
                            document.querySelector('#tullage' + tank.tank_abbrev).value =  volumet[0].ullage;
                        }else{
                           let volumeDiff = Math.round(Math.abs(volumet[0].min*1 - volumet[0].max*1)*100)/100;
                           console.log('volume diff = ' + volumeDiff);
                           let diff = (trimFromInput*1 >= 0) ? Math.round((trimFromInput*1 - minVal*1)*10)/10 : Math.round((maxVal*1 - trimFromInput*1)*10)/10;
                         //  if (trimFromInput*1 >= 0)?Math.round((trimFromInput*1 - minVal*1)*10)/10:Math.round((trimFromInput*1 - minVal*1)*10)/10;
                         //         Math.round((trimFromInput*1 - minVal*1)*10)/10;
                           console.log('diff = ' + diff);
                           let volumeAdd  = (volumeDiff / trimDiff) * diff;
                            document.querySelector('#tvol' + tank.tank_abbrev).value =  Math.round((volumet[0].max*1 + volumeAdd)*100) / 100;
                            document.querySelector('#tullage' + tank.tank_abbrev).value =  volumet[0].ullage;
                            console.log('volumeAdd = '+volumeAdd);
                        }

                        if (document.querySelector(('#tvol' + tank.tank_abbrev)).value/1 > document.querySelector(('#maxVol' + tank.tank_abbrev)).value/1){
                            document.querySelector('#tvol' + tank.tank_abbrev).value = document.querySelector('#maxVol' + tank.tank_abbrev).value;
                            //   sessionStorage.setItem('volume', document.querySelector(('#tvol' + tank.tank_abbrev)).value );
                           // console.log(document.querySelector('#tvol' + tank.tank_abbrev).value);
                        }

                        //==Обрабатываем информацию полученную в запросе и выводим в строке
                        volume(tank);
                        //==Назначаем инпуту с id=hfoTotal метод dispatchEvent, который сгенерирует програмно событие click
                        document.querySelector('#hfoTotal').dispatchEvent(clickEvent);
                        //==Назначаем инпуту с id=mdoTotal метод dispatchEvent, который сгенерирует програмно событие click
                        document.querySelector('#mdoTotal').dispatchEvent(clickEvent);
                      //  console.log(tank.tank_abbrev);
                    });
                });
            }

            if (document.querySelector('#tullage' + tank.tank_abbrev)){
                document.querySelector('#tullage' + tank.tank_abbrev).addEventListener('click', function () {
                    console.log(document.querySelector(('#tullage' + tank.tank_abbrev)).value);

                    //=Сохраняем введенный уровень и танк в sessionStorage

                    sessionStorage.setItem('ullage', document.querySelector(('#tullage' + tank.tank_abbrev)).value );
                    sessionStorage.setItem('tank', tank.tank_table_name);

                    ullage = sessionStorage.getItem('ullage');
                    tankTable = sessionStorage.getItem('tank');
                  //  trim = sessionStorage.getItem('trim');

                    minVal = sessionStorage.getItem('minVal');
                    maxVal = sessionStorage.getItem('maxVal');
                    trimFromInput = sessionStorage.getItem('trimFromInput');
                    trimDiff = (maxVal*1) - (minVal*1);
                    console.log(maxVal + ' - ' + minVal +'=' + trimDiff);


                    if (minVal === '0' && maxVal === '0'){
                        trim1 = trimFromInput;
                        trim2 = trimFromInput;
                    }else {
                        trim1 = minVal;
                        trim2 = maxVal;
                    }

                    //================     ULLAGE    ===========================================================================================
                    //==Запрашиваем volume в нужном танке, согласно отправленных ullage и дифферента============================================

                    getVolume(tank.tank_id, vesselId, -1, ullage,-1,trim1, trim2,'sounding').then(volumes => {
                        console.log('!!!!!!!!!!!!!!!!!!!!!!!!!!!!!YES!!!!!!!!!!!!!!!!!!!!!!!');
                        console.log('volMin = ' + volumes[0].min + ' ,volMax = ' + volumes[0].max);
                        if (volumes[0].min === volumes[0].max){
                            document.querySelector('#tvol' + tank.tank_abbrev).value =  volumes[0].max;
                            document.querySelector('#tsound' + tank.tank_abbrev).value =  volumes[0].sound;
                        }else {
                            let volumeDiff = Math.round(Math.abs(volumes[0].min * 1 - volumes[0].max * 1) * 100) / 100;
                            console.log('volumeDiff = ' + volumeDiff);
                           // let diff = Math.round((trimFromInput * 1 - minVal * 1) * 10) / 10;
                            let diff = (trimFromInput*1 >= 0) ? Math.round((trimFromInput*1 - minVal*1)*10)/10 : Math.round((maxVal*1 - trimFromInput*1)*10)/10;
                            //  if (trimFromInput*1 >= 0)?Math.round((trimFromInput*1 - minVal*1)*10)/10:Math.round((trimFromInput*1 - minVal*1)*10)/10;
                            //         Math.round((trimFromInput*1 - minVal*1)*10)/10;
                            console.log('diff = ' + diff);
                            let volumeAdd = volumeDiff / trimDiff * diff;
                            document.querySelector('#tvol' + tank.tank_abbrev).value =  Math.round((volumes[0].max*1 + volumeAdd)*100) / 100;
                            document.querySelector('#tsound' + tank.tank_abbrev).value =  volumes[0].sound;
                        }

                        if (document.querySelector(('#tvol' + tank.tank_abbrev)).value/1 > document.querySelector(('#maxVol' + tank.tank_abbrev)).value/1){
                            document.querySelector('#tvol' + tank.tank_abbrev).value = document.querySelector('#maxVol' + tank.tank_abbrev).value;
                            //   sessionStorage.setItem('volume', document.querySelector(('#tvol' + tank.tank_abbrev)).value );
                           // console.log(document.querySelector('#tvol' + tank.tank_abbrev).value);
                        }

                        //==Обрабатываем информацию полученную в запросе и выводим в строке
                        volume(tank);
                        document.querySelector('#hfoTotal').dispatchEvent(clickEvent);
                        document.querySelector('#mdoTotal').dispatchEvent(clickEvent);
                        console.log(tank.tank_abbrev);
                    });
                });
            }


            percent(tank);
            temperature(tank);
            density(tank);
            total(tank);
           // document.querySelector('#hfoTotal').dispatchEvent(event);
           // document.querySelector('#hfoTotal').dispatchEvent(clickEvent);

        });

    });
}

ftanks();
//=============================================================================================================================

//=В этой функции запрашиваем и получаем информацию по количеству или уровню топлива в танках в БД либо в sessionStorage

function getVolume(id, vslId, lvl, ulg, vlm, trim1, trim2, tblName)
//function getVolume(id)
{
    let volumeTempor = 0;
    function switchForTrim(trim, tableRow){
        switch (Number.parseFloat(trim)) {
            case -2:
                volumeTempor = tableRow.negativeTwo;
                console.log('Lsound-2 = ' + tableRow.negativeTwo);
                break;
            case -1:
                volumeTempor = tableRow.negativeOne;
                console.log('Lsound-1 = ' + tableRow.negativeOne);
                break;
            case -0.5:
                volumeTempor = tableRow.negativeHalf;
                console.log('Lsound-0.5 = ' + tableRow.negativeHalf);
                break;
            case 0:
                volumeTempor = tableRow.zero;
                console.log('Lsound 0 = ' + tableRow.zero);
                break;
            case 0.5:
                volumeTempor = tableRow.half;
                console.log('Lsound 0.5 = ' + tableRow.half);
                break;
            case 1:
                volumeTempor = tableRow.One;
                console.log('Lsound 1 = ' + tableRow.One);
                break;
            case 2:
                volumeTempor = tableRow.Two;
                console.log('Lsound 2 = ' + tableRow.Two);
                break;
            case 3:
                volumeTempor = tableRow.Three;
                console.log('Lsound 3 = ' + tableRow.Three);
                break;
            case 4:
                volumeTempor = tableRow.Four;
                console.log('Lsound 4 = ' + tableRow.Four);
                break;
            case 5:
                volumeTempor = tableRow.Five;
                console.log('Lsound 5 = ' + tableRow.Five);
                break;
            default:
                console.log('There is no such trim');
        }
    }
    let volumes = [];
    console.log('id = '+ id);
    console.log('vslId = '+ vslId);
    console.log('level = '+ lvl);
    console.log('ullage = '+ ulg);
    console.log('volume = '+ vlm);
    console.log('trim1 = '+ trim1);
    console.log('trim2 = '+ trim2);
    if (!trim1 || !trim2){
        sessionStorage.setItem('minVal', 0);
        sessionStorage.setItem('maxVal', 1);
        trim1 = 0;
        trim2 = 0;
    }
    if (!sessionStorage.getItem(`${id}`)) {
        const request = new XMLHttpRequest();
        request.open('GET', `${serverUrl}/tank/${id}/${vslId}/${lvl}/${ulg}/${vlm}/${trim1}/${trim2}/${tblName}`);
        //  request.open('GET', `${serverUrl}/tank/${id}`);
        request.send('');
        return new Promise(function (resolve, reject) {
            request.onreadystatechange = () => {
                if (request.status === 200 && request.readyState === 4) {
                    const volumes = JSON.parse(request.responseText);
                    console.log(volumes);
                    resolve(volumes);
                }
            };
        })
    }
    else{
        return new Promise(function(resolve, reject) {
            const tankTable = JSON.parse(sessionStorage.getItem(`${id}`));
            volumes = [
                {
                    max:1,
                    min:1,
                   // sound:"0",
                   // tank_abbrev:"hfo1s",
                   // tank_id:"37",
                   // tank_name:"HFO TK NO1 S",
                   // ullage:"0"
                }
            ]
            let vol1 = 0;
            let vol2 = 0;

            let volMin = Number.parseFloat(vlm);
            let volMax = Number.parseFloat(vlm);

           // let int_part = Math.trunc(lvl); //==Извлекаем целую часть числа
           // console.log('Whole part of lvl = '+int_part);
           // let float_part = Number((lvl-int_part).toFixed(2))*10; // //==Извлекаем дробную часть числа
          //  console.log('lvl after , = '+float_part);
            lvl=lvl*1;
          //  console.log(typeof lvl);
          //  console.log(lvl);

            tankTable.forEach(function (tableRow, i, tankTable) {
                if (lvl !== -1){
                    if (lvl >= Number.parseFloat(tankTable[i].sound) && lvl <= Number.parseFloat(tankTable[i+1].sound)){
                        //==Находим два ближайших значения к нашему замеру===========================
                        vol1 = Number.parseFloat(tankTable[i].sound);
                        vol2 = Number.parseFloat(tankTable[i+1].sound);
                        let float_part = Math.round((lvl - vol1)*10)/10;
                        console.log('different = ' + float_part);
                        console.log('vol1 = ' + vol1 + ' ,vol2 = ' + vol2);
                        let step = (vol2 - vol1);                    //==Определяем шаг чтобы работать с дробными замерами===========================
                        console.log('step = ' + step);
                        //==Если шаг 2===========================
                     //   if ((Number.parseFloat(lvl) - vol1) >= 1 && Number.parseFloat(lvl) < vol2){
                     //       float_part = float_part+1;

                     //   }
                        console.log('float_part = ' + float_part);
                        switchForTrim(trim1, tankTable[i]);
                        volMin = Number.parseFloat(volumeTempor);
                        console.log('volumeTempor1 = ' + volumeTempor);

                        switchForTrim(trim1, tankTable[i+1]);
                        volMax = Number.parseFloat(volumeTempor);
                        console.log('volumeTempor2 = ' + volumeTempor);


                        volumes[0].min = Math.round((volMin + (volMax-volMin)/step *float_part)*100)/100;

                        switchForTrim(trim2, tankTable[i]);
                        console.log('volumeTempor11 = ' + volumeTempor);
                        volMin = Number.parseFloat(volumeTempor);

                        switchForTrim(trim2, tankTable[i+1]);
                        volMax = Number.parseFloat(volumeTempor);
                        console.log('volumeTempor12 = ' + volumeTempor);

                        volumes[0].max = Math.round((volMin + (volMax-volMin)/step *float_part)*100)/100;

                        volumes[0].ullage = Math.round((tableRow.ullage*1 - float_part)*10)/10;
                       // console.log(lvlMin + ' >= ' + Number.parseFloat(tableRow.sound));
                        console.log('min = ' + volumes[0].min + ', max = '+ volumes[0].max);
                    }
                }
                if (ulg !== -1){
                    if (Number.parseFloat(ulg) <= Number.parseFloat(tankTable[i].ullage) && Number.parseFloat(ulg) >= Number.parseFloat(tankTable[i+1].ullage)){

                       // int_part = Math.trunc(ulg); // returns 3
                       // float_part = Number((ulg-int_part).toFixed(2))*10; // return 0.2

                        vol2 = Number.parseFloat(tankTable[i].ullage);
                        vol1 = Number.parseFloat(tankTable[i+1].ullage);
                        let float_part = Math.round((vol2 - ulg)*10)/10;
                        console.log('float_part = ' + float_part);
                        console.log('vol2 = '+ vol2);
                        console.log('vol1 = '+ vol1);
                        let step = (vol2 - vol1);
                        console.log('step = ' + step);

                      //  if ((Number.parseFloat(ulg) - vol1) >= 1 && Number.parseFloat(ulg) < vol2){
                      //      float_part = float_part+10;
                      //      console.log('float_part = ' + float_part);

                      //  }
                        switchForTrim(trim1, tankTable[i]);
                        volMin = Number.parseFloat(volumeTempor);
                        console.log('volumeTempor1 = ' + volumeTempor);

                        switchForTrim(trim1, tankTable[i+1]);
                        volMax = Number.parseFloat(volumeTempor);
                        console.log('volumeTempor2 = ' + volumeTempor);


                      //  volumes[0].min = volMin + (volMax-volMin)/step *float_part;
                        volumes[0].min = Math.round((volMin + (volMax-volMin)/step *float_part)*100)/100;
                        console.log('volMin = ' + volMin);
                        console.log('volumes[0].min = ' + volumes[0].min);

                        switchForTrim(trim2, tankTable[i]);
                        volMin = Number.parseFloat(volumeTempor);
                        console.log('volumeTempor11 = ' + volumeTempor);

                        switchForTrim(trim2, tankTable[i+1]);
                        volMax = Number.parseFloat(volumeTempor);
                        console.log('volumeTempor12 = ' + volumeTempor);

                        volumes[0].max = Math.round((volMin + (volMax-volMin)/step *float_part)*100)/100;

                        console.log('volumes[0].max = ' + volumes[0].max);
                        volumes[0].sound = Math.round((tankTable[i].sound*1+float_part)*10)/10;
                        console.log('Sound:' + tableRow.sound+ ' - ' + float_part + ' = ' + volumes[0].sound);
                        console.log(ulg + ' >= ' + Number.parseFloat(tableRow.ullage));
                    }
                }
                if (vlm !== -1){
                    if (volMin >= Number.parseFloat(tankTable[i].zero) && volMin <= Number.parseFloat(tankTable[i+1].zero)){
                        volumes[0].sound = tableRow.sound;
                        volumes[0].ullage = tableRow.ullage;
                        console.log('//==============================================================================//');
                        console.log('volumes[0].sound = ' + volumes[0].sound);
                        console.log('volumes[0].ullage = ' + volumes[0].ullage);
                        console.log(volMin + ' >= ' + Number.parseFloat(tableRow.zero));

                        console.log('Vsound = ' + tableRow.zero);
                    }
                }
            })
            let rty = (volumes[0].min + volumes[0].max)/2;
            console.log('volumes = ' + rty);
            console.log(volumes);
            resolve(volumes);
        })
    }
}

//==В этой функции запрашиваем информацию по танкам====================
function getTanks()
{
    const serverUrl = 'http://localhost/vsltanks2/server/v1';
    const request = new XMLHttpRequest();
    request.open('GET', `${serverUrl}/tank`);
    request.send('');
    return new Promise(function(resolve, reject) {
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {

                const tanks = JSON.parse(request.responseText);
                console.log(getCookie('token'));
                resolve(tanks);
            }
        };
    })
}


function getTanksQuantity(id)
//function getVolume(id)
{
    const serverUrl = 'http://localhost/vsltanks2/server/v1';
    const request = new XMLHttpRequest();
   // request.open('GET', `${serverUrl}/vessel/${id}/${vslId}`);
    request.open('GET', `${serverUrl}/tank/${id}`);
    request.send('');

    return new Promise(function(resolve, reject) {
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {
                const tanks = JSON.parse(request.responseText);
                sessionStorage.setItem('storageTanksQuantity', tanks.length);
                console.log(tanks);
             //   console.log(getCookie('token'));
                resolve(tanks);
            }else if (request.status !== 200){
            //  reject('requested status = '+request.status);
            }
        };
    })
}


function soundTrimNames() {
    const serverUrl = 'http://localhost/vsltanks2/server/v1';
    console.log('sound = ');
    const request = new XMLHttpRequest();
    request.open('GET', `${serverUrl}/sound`);
    //  request.open('GET', `${serverUrl}/tank/${id}`);
    request.send('');
    request.onreadystatechange = () => {
        if (request.status === 200 && request.readyState === 4) {
            const sound = request.responseText;
            console.log('sound = '+sound);
            sessionStorage.setItem('trimColumnArr', sound);
        }
    };
}
soundTrimNames();

function getDates()
//function getVolume(id)
{
    const request = new XMLHttpRequest();
    request.open('GET', `${serverUrl}/date`);
    //  request.open('GET', `${serverUrl}/tank/${id}`);
    request.send('');
    return new Promise(function(resolve, reject) {
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {

                const dates = JSON.parse(request.responseText);
                console.log(dates);
                resolve(dates);
            }
        };
    })
}

function getVslDates(id, vslId)
//function getVolume(id)
{
   // alert('id = '+ id + ', vslId = '+ vslId);
    const request = new XMLHttpRequest();
    request.open('GET', `${serverUrl}/date/${id}/${vslId}`);
    //  request.open('GET', `${serverUrl}/tank/${id}`);
    request.send('');
    return new Promise(function(resolve, reject) {
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {

                const dates = JSON.parse(request.responseText);
                console.log(dates);
                resolve(dates);
            }else{
                const elem = document.querySelector('#save-of-time-id');
                document.querySelector('#comment-id').value = '';
                let str = '';

                str = `
                <option class="saved-time" data_option="thereIsNo"  id="saved-time-thereIsNo">no saved date</option>        
               `;
                elem.innerHTML = str;
            }
        };
    })
}

function getDate(id)
//function getVolume(id)
{
   // alert('HEllo= '+id);
    const request = new XMLHttpRequest();
    request.open('GET', `${serverUrl}/date/${id}`);
    //  request.open('GET', `${serverUrl}/tank/${id}`);
    request.send('');
    return new Promise(function(resolve, reject) {
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {

                const dates = JSON.parse(request.responseText);
                console.log(dates);
                resolve(dates);
            }
            else if(request.status === 404){
                const errors = request.responseText;
                 console.log(errors);
                alert('ERROR '+ request.status + ': ' + request.statusText);
                // document.location.replace('error.php');
            }
        };
    });
}

function removeDate(id) {

    const request = new XMLHttpRequest();
    request.open('REMOVE', `${serverUrl}/date/${id}`, true);
    request.send('');
    request.onreadystatechange = () => {
        if (request.status === 200 && request.readyState === 4) {
            alert('Removed!');
        }
    }
}


//document.addEventListener("DOMContentLoaded", function() { // событие загрузки страницы
//
//     // выбираем на странице все элементы типа textarea и input
//     document.querySelectorAll('input').forEach(function(e) {
//         // если данные значения уже записаны в sessionStorage, то вставляем их в поля формы
//         // путём этого мы как раз берём данные из памяти браузера, если страница была случайно перезагружена
//         if(e.value === '') e.value = window.sessionStorage.getItem(e.name, e.value);
//         // на событие ввода данных (включая вставку с помощью мыши) вешаем обработчик
//         e.addEventListener('input', function() {
//             // и записываем в sessionStorage данные, в качестве имени используя атрибут name поля элемента ввода
//             window.sessionStorage.setItem(e.name, e.value);
//         })
//     })
// });

window.onbeforeunload = function() {
    inputCollection();
    console.log('!!!!!!!!beforeunload!!!!!!!!!!!!!!!!!!!!!!!!!!');
  //  return "There are unsaved changes. Leave now?";
};


window.onload = function () {
    window.addEventListener('DOMContentLoaded', function(){         //==
        console.log('!!!!!!!!!!!!!!!!!!!ONLOAD!!!!!!!!!!!!!!!!!!!!!!!!!!!');
        loadSavedFromInputs();
    });

}

//==Клавиатуре для ввода цифр на мобильной версии==============================================
// const keyboard = [49, 50, 51, 52, 53, 54, 55, 56, 57, 48, 46];
// document.onkeypress = function (event) {
//     //console.log(event);
//     keyboard.push(event.charCode);
//     console.log(keyboard);
// }
// function init() {
//     let out = '';
//     for (let i=0; i < keyboard.length; i++){
//         if (i === 5 || i === 10){
//             out += '<div class="clearfix"></div>';
//         }
//         out += '<div class="some-key" data="' + keyboard[i] + '" >' + String.fromCharCode(keyboard[i]) + '</div>';
//     }
//     document.querySelector('#keyboard').innerHTML = out;
//
// }
//
// init();
//
// document.onkeypress = function (event) {
//     console.log(event.code);
// }
//
// document.querySelectorAll('#keyboard .some-key').forEach(function (element) {
//     element.onclick = function (event) {
//         document.querySelectorAll("input").forEach(element => {
//             element.addEventListener("focus", () => {
//                 this.open(element.value, currentValue => {
//                     element.value = currentValue;
//                 });
//             });
//         });
//         let code = this.getAttribute('data');
//         console.log(code);
//
//     }
// });



const Keyboard = {
    elements: {
        main: null,
        keysContainer: null,
        keys: [],
        inputElem: ['tsoundhfo1s', 'tsoundhfo2p', 'tsoundhfo3s'],
    },

    eventHandlers: {
        oninput: null,
        onclose: null
    },

    properties: {
        value: "",
        capsLock: false
    },


    init() {
        // Create main elements
        this.elements.main = document.createElement("div");
        this.elements.keysContainer = document.createElement("div");

        // Setup main elements
        this.elements.main.classList.add("keyboard", "keyboard--hidden");
        this.elements.keysContainer.classList.add("keyboard__keys");
        this.elements.keysContainer.appendChild(this._createKeys());

        this.elements.keys = this.elements.keysContainer.querySelectorAll(".keyboard__key");

        // Add to DOM
        this.elements.main.appendChild(this.elements.keysContainer);
        document.body.appendChild(this.elements.main);

        console.log('0000000000000000000000000000000000');

        // Automatically use keyboard for elements with .use-keyboard-input
        let tert = document.querySelectorAll('table>tbody>tr>td>input');

        document.querySelectorAll('table>tbody>tr>td>input').forEach(element => {
            console.log('11111111111111111111111111111111111'+element.id);
            element.addEventListener("focus", () => {
                console.log('2222222222222222222222222222222222222');
                this.open(element.value, currentValue => {
                    element.value = currentValue;
                    console.log('333333333333333333333333333333333333333');
                });
            });
        });

    },

    _createKeys() {
        const fragment = document.createDocumentFragment();
        const keyLayout = [
            "1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "backspace",
            "q", "w", "e", "r", "t", "z", "u", "i", "o", "p", "-",
            "arrowdown", "a", "s", "d", "f", "g", "h", "j", "k", "l","arrowup",
            "y", "x", "c", "v", "b", "n", "m", ".", "done", "space"
        ];

        // Creates HTML for an icon
        const createIconHTML = (icon_name) => {
            return `<i class="material-icons">${icon_name}</i>`;
        };

        keyLayout.forEach(key => {
            const keyElement = document.createElement("button");
            const insertLineBreak = ["backspace", "-", "arrowup", "done"].indexOf(key) !== -1;

            // Add attributes/classes
            keyElement.setAttribute("type", "button");
            keyElement.classList.add("keyboard__key");

            switch (key) {
                case "backspace":
                    keyElement.classList.add("keyboard__key--wide");
                    keyElement.innerHTML = createIconHTML("backspace");

                    keyElement.addEventListener("click", () => {
                        this.properties.value = this.properties.value.substring(0, this.properties.value.length - 1);
                        this._triggerEvent("oninput");
                    });

                    break;

                case "arrowup":
                    keyElement.classList.add("keyboard__key");
                    keyElement.innerHTML = createIconHTML("keyboard_arrow_up");

                    keyElement.addEventListener("click", () => {
                        console.log('this.properties.value = ' + this.properties.value);
                        let x = this.properties.value * 1 + 1;
                        this.properties.value = x;
                        this._triggerEvent("oninput");
                    });

                    break;

                case "arrowdown":
                    keyElement.classList.add("keyboard__key");
                    keyElement.innerHTML = createIconHTML("keyboard_arrow_down");

                    keyElement.addEventListener("click", () => {
                        console.log('this.properties.value = ' + this.properties.value);
                        let x = this.properties.value * 1 - 1;
                        this.properties.value = x;
                        this._triggerEvent("oninput");
                    });

                    break;


                case "caps":
                    keyElement.classList.add("keyboard__key--wide", "keyboard__key--activatable");
                    keyElement.innerHTML = createIconHTML("keyboard_capslock");

                    keyElement.addEventListener("click", () => {
                        this._toggleCapsLock();
                        keyElement.classList.toggle("keyboard__key--active", this.properties.capsLock);
                    });

                    break;

                case "enter":
                    keyElement.classList.add("keyboard__key--wide");
                    keyElement.innerHTML = createIconHTML("keyboard_return");

                    keyElement.addEventListener("click", () => {
                        this.properties.value += "\n";
                        this._triggerEvent("oninput");
                    });

                    break;

                case "space":
                    keyElement.classList.add("keyboard__key--extra-wide");
                    keyElement.innerHTML = createIconHTML("space_bar");

                    keyElement.addEventListener("click", () => {
                        this.properties.value += " ";
                        this._triggerEvent("oninput");
                    });

                    break;

                case "done":
                    keyElement.classList.add("keyboard__key--wide", "keyboard__key--dark");
                    keyElement.innerHTML = createIconHTML("check_circle");

                    keyElement.addEventListener("click", () => {
                        this.close();
                        this._triggerEvent("onclose");
                    });

                    break;

                default:
                    keyElement.textContent = key.toUpperCase();

                    keyElement.addEventListener("click", () => {
                        this.properties.value += this.properties.capsLock ? key.toUpperCase() : key.toLowerCase();
                        this._triggerEvent("oninput");
                    });

                    break;
            }

            fragment.appendChild(keyElement);

            if (insertLineBreak) {
                fragment.appendChild(document.createElement("br"));
            }
        });

        return fragment;
    },

    _triggerEvent(handlerName) {
        if (typeof this.eventHandlers[handlerName] == "function") {
            this.eventHandlers[handlerName](this.properties.value);
        }
    },

    _toggleCapsLock() {
        this.properties.capsLock = !this.properties.capsLock;

        for (const key of this.elements.keys) {
            if (key.childElementCount === 0) {
                key.textContent = this.properties.capsLock ? key.textContent.toUpperCase() : key.textContent.toLowerCase();
            }
        }
    },

    open(initialValue, oninput, onclose) {
        this.properties.value = initialValue || "";
        this.eventHandlers.oninput = oninput;
        this.eventHandlers.onclose = onclose;
        this.elements.main.classList.remove("keyboard--hidden");
    },

    close() {
        console.log('CLOSE');
        this.properties.value = "";
        this.eventHandlers.oninput = oninput;
        this.eventHandlers.onclose = onclose;
        this.elements.main.classList.add("keyboard--hidden");
    },
};




window.addEventListener("DOMContentLoaded", function () {

 //  Keyboard.init();
});




function getFocus() {
    // console.log('TTTTTTTTTTTTTTTTTT'+x);
    // let er = document.getElementById(x);

    // console.log(Keyboard);
    // er.addEventListener('click', ()=>{
    //     console.log('TTEEESSSTTT = '+er.value);
    // });
    // let elemt = document.getElementById('tsoundhfo1s');
    // console.log('ASSSSSSSSSSSSSSSSSS'+elemt.value);
    //
    // elemt.addEventListener('click', ()=>{
    //     console.log('HHHHHHHHHHHHHHHHHHHHHH'+elemt.value);
    // });
    // let inputsElemts = document.querySelectorAll('table>tbody>tr>td>input');
    // inputsElemts.forEach(element=> {
    //     console.log('HHHHHHssssssssssssssssHHHHHHH = '+element.value);
    //    // element.value = 111;
    // });

//     let inputsElemts = document.getElementsByTagName('input');
// //inputsElem.forEach(element=> {
//     for (let i = 0; i < inputsElemts.length; i++) {
//        // console.log(' getFocus() = '+  getFocus()[i].id);
//         console.log('HHHHHHssssssssssssssssHHHHHHH = '+inputsElemts[i].value);
//     }
//
//      return inputsElemts;
}

function TestCSS()
{
    const serverUrl = 'http://localhost/vsltanks2/client/css/style_sounding.css';
    const request = new XMLHttpRequest();
    request.open('GET', `${serverUrl}/tank`);
    request.send('');
    request.onreadystatechange = () => {
        if (request.status === 200 && request.readyState === 4) {
            const soundCss = request.responseText;
               // const tanks = JSON.parse(request.responseText);
         //   console.log(soundCss);
            sessionStorage.setItem('soundCss', soundCss);
             //   resolve(tanks);
            }
        };
}

var oldXMLHttpRequest = XMLHttpRequest;

XMLHttpRequest = function() {
    var xhr = new oldXMLHttpRequest();
    // получаем дескриптор прототипных setter/getter
    var descrGetSet = Object.getOwnPropertyDescriptor(
        Object.getPrototypeOf( xhr ),
        "onreadystatechange" );

    var newSet = function( val ) {
        console.log ( "setter" );
        descrGetSet.set.call( xhr, function() { // прототипный setter
            console.log( "Inject "+this.status ); // this.responseText
            return val.apply( xhr, arguments );
        } );
    }

    Object.defineProperty( xhr, "onreadystatechange", {
        set: newSet, // новый setter
        get: descrGetSet.get // старый getter
    } );

    return xhr;
}

let x = new XMLHttpRequest();
x.open( "GET", "http://localhost/vsltanks2/client/css/style_sounding.css" );
if ('soundCss'){
    x.abort();
    console.log('!!!!!!!!!!!!!!!!!!!!!!!!++++++++++ABORTED+++++++++++++++++++!!!!!!!!!!!!!!!!!!!!!!!!!');
}else{
    console.log('!!!!!!!!!!!!!!!!!!!!!!!!++++++++++SENT+++++++++++++++++++!!!!!!!!!!!!!!!!!!!!!!!!!');
    x.send( null );
    x.onreadystatechange = function () { console.log( this.responseText )};
}
