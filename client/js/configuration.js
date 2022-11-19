'use strict'

//const serverUrl = 'http://localhost/vsltanks/server/api/v1';
//const clientUrl = 'http://localhost/vsltanks/client';
let newVsl = 0;

//==При открытии страницы Configuration грузим в инпуты данные по текущему судну========================
window.addEventListener("load", function () {

    let id = sessionStorage.getItem('idVesselSelect');
    let massiveNum = 0;
   // tanksButtons(id);
    getVesselImg(id, 1).then(vessels =>{
        vessels.forEach((vessel, index)=> {     // Для выбора из полученного массива нужного судна, перебераем массив и находим нужный элемент
            if (vessel.vessel_id === id) {
                massiveNum = index;             // и сохраняем его в переменной  massiveNum
            }
        });
        document.getElementById('configVesselName').value = vessels[massiveNum].vessel_name;
        document.getElementById('configVesselImo').value = vessels[massiveNum].vessel_imo;
        document.getElementById('configVesselCall').value = vessels[massiveNum].vessel_call_sign;
        document.getElementById('configVesselNumber').value = vessels[massiveNum].vessel_official_number;
        document.getElementById('configVesselPort').value = vessels[massiveNum].vessel_port_registry;
        document.getElementById('configVesselFlag').value = vessels[massiveNum].vessel_flag;
       // document.getElementById('vesselConfigButton').disabled = true;

    });
    let delBtnContainer = document.querySelector('.vessel6'); //==div контайнер для кнопок back и delete на странице для конфигурации танков
   // delBtnContainer.innerHTML += `<button type="button" class="btn btn-danger" id="delTable">Delete</button>`;
});



//==При клике на странице Configuration грузим в инпуты данные по текущему судну========================
document.getElementsByClassName('menu').id = "menuInHeader";

let menuInHead = document.getElementsByClassName('menu')[0];

menuInHead.addEventListener("click" || "load" , function () {
    console.log('You are in configuration');
    let id = sessionStorage.getItem('idVesselSelect');
   // getVessel(id);
    let massiveNum = 0;
    getVesselImg(id, 1).then(vessels =>{
        vessels.forEach((vessel, index)=> {      // Для выбора из полученного массива нужного судна, перебераем массив и находим нужный элемент
            if (vessel.vessel_id === id) {
                massiveNum = index;             // и сохраняем его в переменной  massiveNum
            }
        });
        document.getElementById('configVesselName').value = vessels[massiveNum].vessel_name;
        document.getElementById('configVesselImo').value = vessels[massiveNum].vessel_imo;
        document.getElementById('configVesselCall').value = vessels[massiveNum].vessel_call_sign;
        document.getElementById('configVesselNumber').value = vessels[massiveNum].vessel_official_number;
        document.getElementById('configVesselPort').value = vessels[massiveNum].vessel_port_registry;
        document.getElementById('configVesselFlag').value = vessels[massiveNum].vessel_flag;
      //  console.log('vessels[massiveNum].vessel_name'+vessels[massiveNum].vessel_name);
    });
});


let tankNameInput = document.getElementById('configTankName');//==Получаем элемент input по его id где вводится название нового танка
if (tankNameInput){
    tankNameInput.addEventListener('change', function () {
        let idVessel = sessionStorage.getItem('idVesselSelect');
        console.log('OK');
        let str = tankNameInput.value;                                     //==Название танка из инпута сохраняем в переменной str
        console.log(str);
        let abbrevInput = str.toLowerCase();                               //==Все буквы в названии танка переводим в нижний регистр

        abbrevInput = abbrevInput.replace('no', '');  //==Удаляем из названия танка 'no'
        abbrevInput = abbrevInput.replace('tank', '');//==Удаляем из названия танка 'tank'
        abbrevInput = abbrevInput.replace('tk', '');  //==Удаляем из названия танка 'tk'
        abbrevInput = abbrevInput.replace(/[\])}[{(]/g, ''); //==Удаляем из названия танка скобки
        abbrevInput = abbrevInput.replace(/[\s.,%]/g, '');  //==Удаляем пробелы

        let tankAbbrevInput = document.getElementById('configTankAbbrev'); //==Получаем элемент input по его id где вводится аббревиатура нового танка
        tankAbbrevInput.value = abbrevInput;                                        //==Вводим в input сформированную выше аббревиатуру нового танка

        let tankTableNameInput = document.getElementById('configTankTableName'); //==Получаем элемент input по его id где вводится аббревиатура нового танка и id судна
        tankTableNameInput.value = 'id'+idVessel+'_'+ abbrevInput;                         //==Вводим в input сформированное id судна и аббревиатуру нового танка

    });
}


//==Функция для вывода кнопок с названиями танков================================================================
function tanksButtons(idVessel, elemTanksButtons){
    getTanksQuantity(idVessel).then(tanks=>{
        let strTanksButtons  = '';

        tanks.forEach(function(tank, i, tanks){
            strTanksButtons += `<tr><td><input type="button" data-tankId="${tank.tank_id}" onclick="tankConfigPressed(${tank.tank_id})" value="${tank.tank_name}"></td></tr>`;

        });
        if (elemTanksButtons){
            elemTanksButtons.innerHTML += strTanksButtons;
        }


    });
}
// function tanksButtons(idVessel){
//     getTanksQuantity(idVessel).then(tanks=>{
//         let strTanksButtons  = '';
//
//         const elemTanksButtons  = document.querySelector('#tanksButtonsConfig');
//
//
//         tanks.forEach(function(tank, i, tanks){
//             strTanksButtons += `<tr><td><input type="button" data-tankId="${tank.tank_id}" onclick="tankConfigPressed(${tank.tank_id})" value="${tank.tank_name}"></td></tr>`;
//
//         });
//         elemTanksButtons.innerHTML = strTanksButtons;
//
//     });
// }

//==Эта функция обрабатывает нажатия на кнопки танков и выводит данные танка в инпуты формы====
function tankConfigPressed(tankId){
    let vesselId = sessionStorage.getItem('idVesselSelect');
    if (tankId){
        sessionStorage.setItem('choosenTankId', tankId);

        let btnCont = document.getElementById('tank-submit');
        console.log(tankId);
        getTank(tankId).then(tank => {
            console.log('tank= ' + tank[0]);
            document.getElementById('configTankName').value = tank[0].tank_name;
            document.getElementById('configTankVolume').value = tank[0].tank_volume;
            document.getElementById('configTankHeight').value = tank[0].tank_height;
            document.getElementById('configTankAbbrev').value = tank[0].tank_abbrev;
            document.getElementById('configTankVesselId').value = vesselId;
            document.getElementById('currentTankId').value = tankId;
            document.getElementById('currentTankId2').value = tankId; //==скрытый инпут в форме для отправки файла .csv
        })
    }else{
        document.getElementById('configTankVesselId').value = vesselId;
        document.getElementById('configTankName').value = '';
        document.getElementById('configTankVolume').value = '';
        document.getElementById('configTankHeight').value = '';
        document.getElementById('configTankAbbrev').value = '';
        document.getElementById('currentTankId').value = '';

    }
    //configTankTableName
}
// function getVesselImg(id, imgTrig)
// {
//     const request = new XMLHttpRequest();
//     request.open('GET', `${serverUrl}/vessel/${id}/${imgTrig}`);
//     request.send('');
//     request.onreadystatechange = () => {
//         if (request.status === 200 && request.readyState === 4) {
//             console.log(request.responseText);
//             const vessels = JSON.parse(request.responseText);
//             console.log(vessels);
//             // document.getElementById('idVincent').src = clientUrl + "/img/san-fernando.jpg";
//             //  document.getElementById('idVincent').src = 'file:///C:/xampp/htdocs/vsltanks/server/api/v1/assets/upload/images/9717228/9717228_1.jpg';
//
//             document.getElementById('idVincent').src = serverUrl + vessels[0].directory_path + vessels[0].image_name;
//             //   let qwe = document.getElementById('idVincent').src;
//             sessionStorage.setItem('vesselName', vessels[0].vessel_name);
//
//             //   console.log(qwe);
//
//         }
//     };
// }

let tnkCnfg = document.getElementById("tanksConfig"); //==кнопка Next для перехода для конфигурации танков
let btn = document.getElementById("configVessel");    //==страница для конфигурации судна
let backbtn = document.getElementById("configTanks"); //==страница для конфигурации танков

if (tnkCnfg){
    tnkCnfg.addEventListener('click', function () {
        console.log('tankConfig Pressed');


        btn.style.display = 'none';
        backbtn.style.display = 'grid';
        btn.setAttribute('background', "blue");
        console.log( btn.getAttribute('background'));

        let id = sessionStorage.getItem('idVesselSelect');
        const elemTanksButtons  = document.querySelector('#tanksButtonsConfig');
        // elemTanksButtons.innerHTML = '';
        const strNewTank = `<tr><td><input type="button" data-tankId="234" onclick="tankConfigPressed()" value="NEW TANK"></td></tr>`;
        newVsl = sessionStorage.getItem('newVesselConfig');

        if (newVsl === '0'){
            tanksButtons(id, elemTanksButtons); //==функция для вывода кнопок танков на странице конфигурации==
        }

        elemTanksButtons.innerHTML = strNewTank;

        //  document.querySelector('#delTable').style.display = 'none';

    });
}

//==Функция обрабатывает нажотие кнопки 'NEW BUTTON' для конфигурации нового судна=======
function newVesselConfigPressed() {
   // alert('Hello new vessel');
    newVsl = 1;
    sessionStorage.setItem('newVesselConfig', newVsl);
    //==Делаем все кнопки активными под формами активными======================
    if (document.getElementById('vesselConfigButton')){
        document.getElementById('vesselConfigButton').disabled = false;
    }
    // if (document.getElementById('tankConfigButton')){
    //     document.getElementById('tankConfigButton').disabled = false;
    // }
    // if (document.getElementById('delTable')){
    //     document.getElementById('delTable').disabled = false;
    // }
    // if (document.getElementById('delTank')){
    //     document.getElementById('delTank').disabled = false;
    // }
    // if (document.getElementById('submitTankTable')){
    //     document.getElementById('submitTankTable').disabled = false;
    // }


    document.getElementById('configVesselName').value = '';
    document.getElementById('configVesselImo').value = '';
    document.getElementById('configVesselCall').value = '';
    document.getElementById('configVesselNumber').value = '';
 //   document.getElementById('configVesselPort').value = vessels[massiveNum].vessel_port_registry;
 //   document.getElementById('configVesselFlag').value = vessels[massiveNum].vessel_flag;
}

// const inputVesselName = document.getElementById('configVesselName');
// inputVesselName.addEventListener('focusin', function () {
//     inputVesselName.placeholder = '';
// });
// inputVesselName.addEventListener('focusout', function () {
//     inputVesselName.placeholder = 'VESSEL NAME';
// });
// const inputVesselImo = document.getElementById('configVesselImo');
// inputVesselImo.addEventListener('focusin', function () {
//     inputVesselImo.placeholder = '';
// });
// inputVesselImo.addEventListener('focusout', function () {
//     inputVesselImo.placeholder = 'VESSEL IMO';
// });



let backVesselCnfg = document.getElementById("backVesselConfig"); //==кнопка Back для возврата на страницу конфигурации судна

if (backVesselCnfg){
    backVesselCnfg.addEventListener('click', function () {
        console.log('Back Pressed');

        backbtn.style.display = 'none';
        btn.style.display = 'grid';
        backbtn.setAttribute('background', "blue");
        console.log( backbtn.getAttribute('background'));
    });
}


function currentTankDelete() {
    let id = sessionStorage.getItem('choosenTankId');

    if (window.confirm("Are you really want to delete the tank with id = " + id+'?')) {
        const serverUrl = 'http://localhost/vsltanks/server/api/v1';
        const request = new XMLHttpRequest();
        request.open('REMOVE', `${serverUrl}/tank/${id}`, true);
        request.send('');
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {
                alert('Removed!');
                location.reload();
                btn.style.display = 'none';
                backbtn.style.display = 'grid';

            }
        }
    }

}

function allRowsDelete() {
    let id = sessionStorage.getItem('choosenTankId');

    if (window.confirm("Are you really want to delete all rows of the tank with id " + id+'?')) {
        const serverUrl = 'http://localhost/vsltanks/server/api/v1';
        const request = new XMLHttpRequest();
        request.open('REMOVE', `${serverUrl}/sound/${id}`, true);
        request.send('');
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {
                alert('Removed!');
            }
        }
    }

}

function getTank(id, vslId = -1)
//function getVolume(id)
{
    const serverUrl = 'http://localhost/vsltanks/server/api/v1';
    const request = new XMLHttpRequest();
    // request.open('GET', `${serverUrl}/vessel/${id}/${vslId}`);
    request.open('GET', `${serverUrl}/tank/${id}/${vslId}`);
    request.send('');

    return new Promise(function(resolve, reject) {
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {

                const tank = JSON.parse(request.responseText);
              //  sessionStorage.setItem('storageTanksQuantity', tank.length);
                //   console.log(tanks.length);
                //   console.log(getCookie('token'));
                resolve(tank);
            }else if (request.status === 404){
                console.log('wat dermo 404');
            }
        };
    });

    // request.onreadystatechange = () => {
    //     if (request.status === 200 && request.readyState === 4) {
    //         const vessel = JSON.parse(request.responseText);
    //        console.log(vessel);
    //         sessionStorage.setItem('storageTanksQuantity', vessel[0].count);
    //     }
    // };
}





