"use strict";

window.addEventListener("load", function () {
    let vesselId = sessionStorage.getItem('idVesselSelect');
    tanksButtons(vesselId);
    const tankId = sessionStorage.getItem('choosenTankId');

    getOneTankTable(tankId);
    if (window.screen.width <= 600){
        gridContainer.setAttribute("style","grid-template-columns: 100% 0");
    }

});
//let select2 = document.getElementById('vessel');

select.addEventListener("click" , function () {
    console.log('You are in tables');
    let vesselId = sessionStorage.getItem('idVesselSelect');
    const elemTanksButtons  = document.querySelector('#tanksButtonsConfig');
    tanksButtons(vesselId, elemTanksButtons);
    const tankId = sessionStorage.getItem('choosenTankId');
    getOneTankTable(tankId);
    if (window.screen.width <= 600){
        gridContainer.setAttribute("style","grid-template-columns: 100% 0");
    }
});


//==Во вкладке 'Table' меняем пропорции grid контейнера в зависимости от размера экрана====================
let tableClick = document.querySelector('.tables-sub-container');
let gridContainer = document.querySelector('.table-container');
let tableClickTrig = 0;

gridContainer.addEventListener("click", function () {
    const screenWidth = window.screen.width;
    if (screenWidth <= 600){
        if (tableClickTrig === 0){
            gridContainer.setAttribute("style","grid-template-columns: 100 0%");
            tableClickTrig = 1;
        }else if (tableClickTrig === 1){
            gridContainer.setAttribute("style","grid-template-columns: 100% 0");
            tableClickTrig = 0;
        }
    }else if (screenWidth <= 1024 && screenWidth > 600){
        gridContainer.setAttribute("style","grid-template-columns: 30% 70%");
    }else if (screenWidth > 1024){
        gridContainer.setAttribute("style","grid-template-columns: 20% 80%");
    }
    console.log(screenWidth);
})


//== Формируем кнопки с названиями танков которые соответствуют id судна=========================
function tanksButtons(idVessel){
    let strTanksButtons  = '';
    const elemTanksButtons  = document.querySelector('#tanksButtons');
    getTanksQuantity(idVessel).then(tanks=>{
        tanks.forEach(function(tank, i, tanks){
            strTanksButtons += `<tr><td><input type="button" data-tankId="${tank.tank_id}" onclick="tankPressed(${tank.tank_id})" id="tankButtonInTable${tank.tank_id}" value="${tank.tank_name}"></td></tr>`;
        });
        elemTanksButtons.innerHTML = strTanksButtons;
    })
    .catch(value => {
        if (value){
            //==Если запрос
            elemTanksButtons.innerHTML = '';
        }
    });
}


//==При нажатии на кнопку вызывается функция getOneTankTable(tankId) в которую передается id выбранного танка================================
function tankPressed(tankId) {
    sessionStorage.setItem('choosenTankId', tankId);
    getOneTankTable(tankId);
}



//=Создаем таблицу вывода информации по танкам
function tankTable(tableRow) {

    let str = '';
    if (window.screen.width <= 600){
        str = `
               <tr class="table-row">
                   <td class="td-cell">${tableRow.sound}</td>
                   <td class="td-cell">`+(Math.round(tableRow.negativeTwo*10)/10).toFixed(1)+`</td>
                   <td class="td-cell">`+(Math.round(tableRow.negativeOne*10)/10).toFixed(1)+`</td>
                   <td class="td-cell">`+(Math.round(tableRow.negativeHalf*10)/10).toFixed(1)+`</td>
                   <td class="td-cell">`+(Math.round(tableRow.zero*10)/10).toFixed(1)+`</td>
                   <td class="td-cell">`+(Math.round(tableRow.half*10)/10).toFixed(1)+`</td>
                   <td class="td-cell">`+(Math.round(tableRow.One*10)/10).toFixed(1)+`</td>
                   <td class="td-cell">`+(Math.round(tableRow.Two*10)/10).toFixed(1)+`</td>
                   <td class="td-cell">`+(Math.round(tableRow.Three*10)/10).toFixed(1)+`</td>
                   <td class="td-cell">`+(Math.round(tableRow.Four*10)/10).toFixed(1)+`</td>
                   <td class="td-cell">`+(Math.round(tableRow.Five*10)/10).toFixed(1)+`</td>
                   <td class="td-cell">`+(Math.round(tableRow.negativeTwo*10)/10).toFixed(1)+`</td>
               </tr>
              `;
    }else{
        str = `
               <tr class="table-row">
                   <td class="td-cell">${tableRow.sound}</td>
                   <td class="td-cell">${tableRow.negativeTwo}</td>
                   <td class="td-cell">${tableRow.negativeOne}</td>
                   <td class="td-cell">${tableRow.negativeHalf}</td>
                   <td class="td-cell">${tableRow.zero}</td>
                   <td class="td-cell">${tableRow.half}</td>
                   <td class="td-cell">${tableRow.One}</td>
                   <td class="td-cell">${tableRow.Two}</td>
                   <td class="td-cell">${tableRow.Three}</td>
                   <td class="td-cell">${tableRow.Four}</td>
                   <td class="td-cell">${tableRow.Five}</td>
                   <td class="td-cell">${tableRow.ullage}</td>
               </tr>
              `;
    }

    return str;

}

//==В этой функции запрашиваем таблицу замеров по id танка и выводим на странице Tables
function getOneTankTable(idTank){
    const elemRow  = document.querySelector('#oneTankRows');
    console.log(elemRow);
    const elemTanksName  = document.querySelector('#tfootTrTankName');
    oneTankTable(idTank).then(tankRows => {

        let strHeadTableRow  = '';

        strHeadTableRow  = `<th><div>SOUND</div></th>`;

        let trimColumnArr = JSON.parse(sessionStorage.getItem('trimColumnArr'));

        for (let i = 0; i < trimColumnArr.length; i++) {
            strHeadTableRow  += `<th><div>${trimColumnArr[i].COLUMN_NAME}</div></th>`;

        }
        // trimColumnArr.forEach(trimColumn=>{
        //     strHeadTableRow  += `<th><div>${trimColumn.COLUMN_NAME}</div></th>`;
        // })
        strHeadTableRow  += `<th><div>ULLAGE</div></th>`;

        const elemHeadRow  = document.querySelector('#headTankTable');

        elemHeadRow.innerHTML = strHeadTableRow;
        let strTableRow  = '';

      //  const elemRow  = document.querySelector('#oneTankRows');

        tankRows.forEach(function(row, i, tankRows){
            strTableRow += tankTable(row);
        });
        if (elemRow){
            elemRow.innerHTML = strTableRow;
        }

        elemTanksName.innerHTML = `<td>${tankRows[0].tank_name}</td>`;
        console.log(elemTanksName);
        //==Перехватываем ошибку 404 т.е. отсутствует таблица в БД==================================
    }).catch(function() {
       // console.log('there is no the table');
        const tankButton = document.getElementById("tankButtonInTable"+idTank);
        if (elemRow){
            elemRow.innerHTML = `<tr></tr><tr><td colspan="12"><h3 style="text-align: center ">ERROR 404: There is no the table - ${tankButton.value}</h3></td></tr>`;
        }

        elemTanksName.innerHTML = `<td>${tankButton.value}</td>`;

    });
}


//==В данной функции запрашиваем БД и получаем таблицу замеров одного танка по его id
function oneTankTable(id)
{
    let tankRows = [];

    if (!sessionStorage.getItem(`${id}`)){
     //   const serverUrl = 'http://localhost/vsltanks2/server/v1';
        const request = new XMLHttpRequest();
        request.open('GET', `${serverUrl}/sound/${id}`);
        request.send('');
        return new Promise(function(resolve, reject) {
            request.onreadystatechange = () => {
                if (request.status === 200 && request.readyState === 4) {
                    tankRows = JSON.parse(request.responseText);
                    sessionStorage.setItem(`${id}`, request.responseText); //==для уменьшения запросов к БД сохраняем в sessionStorage
                //    console.log(getCookie('token'));
                    resolve(tankRows);
                }else if (request.status === 404){
                    // alert('There is no the table '+ id);
                    reject();
                }
            };
        })
    }else{
        return new Promise(function(resolve, reject) {
            tankRows = JSON.parse(sessionStorage.getItem(`${id}`)); //==если есть в sessionStorage, то берем данные оттуда
          //  console.log(tankRows[1]);
            resolve(tankRows);
        })
    }

}

