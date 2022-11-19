"use strict";


const usersAdmin = document.querySelector(".users-admin");
const userVessels = document.querySelector("#userVessels");
const allVessels = document.querySelector("#allVessels");
let tableNod;


let userClick='etetet';

//==Загружаем таблицу с пользователями=====================================
window.addEventListener('DOMContentLoaded',  function () {
    getUsers().then(users =>{
        usersAdmin.innerHTML = users;
        // console.log('admin');
        // userClick = document.querySelector('#user1');
        // document.querySelector('#user1').addEventListener('click', function () {
        //     console.log('/////////////We are in admin///////////////////');
        // });
        // document.querySelector('.users-admin #usersTable').addEventListener('click',  () => {
        //     console.log('///////     We are in usersTable      ///////////');
        // });
        // console.log(userClick);
      //  console.log(userVessels);
      //  console.log('Inner HTML = '+document.querySelector('#usersTable thead').innerHTML);
        sortTable('#usersTable thead');

    });
    sessionStorage.setItem('idPressedButton', '');

})

//==Выбираем пользователя в таблице и выделяем цветом строку====
function userPressed(id) {
    console.log('////pressed button is '+id);
    let previousButton = '';
    if (sessionStorage.getItem('idPressedButton')){
        previousButton = sessionStorage.getItem('idPressedButton');
        document.getElementById('user'+previousButton).style.background = '';
        document.getElementById('user'+previousButton).nextElementSibling.style.background = '';
        document.getElementById('user'+previousButton).previousElementSibling.style.background = '';
    }

    let remember = document.getElementById('user'+id);
    document.getElementById('user'+id).style.background = 'GRAY';
    document.getElementById('user'+id).nextElementSibling.style.background = 'GRAY';
    document.getElementById('user'+id).previousElementSibling.style.background = 'GRAY';
    allVessels.style.display = 'none';
    userVessels.style.display = 'table-cell';
    let vesselsID = [];

    getUserVessels(id).then(user=>{
        userVessels.innerHTML = user;
        sortTable('#vesselsTable thead');
        tableNod = Array.from(document.querySelectorAll('#vesselsList tr th'));
        for (let elem of tableNod) {
            console.log('....................' + elem.id);
        }
    });
    sessionStorage.setItem('idPressedButton', id);

}


sortTable('#allVesselsTable thead');



//==Сортировка таблицы при клике по заголовкам================================================
function sortTable(str) {
    console.log(str);
    const getSort = ({ target }) => {      //== target это объект HTMLTableCellElement, используемый, чтобы представить TH и TD элементы.
        console.log('target = '+ target.dataset.order);
        //==При щелчке на выбранном для сортировке столбце меняем свойство атрибута data-order на противоположный 1 или -1 =============================
        // В зависимости от того чему равен data-order, будет смена стрелки "▲" "▼"
        const order = (target.dataset.order = -(target.dataset.order || -1));
        //==Остаточные параметры могут быть обозначены через три точки .... Буквально это значит: «собери оставшиеся параметры и положи их в массив».
        //==Остаточные параметры собирают все остальные аргументы, поэтому бессмысленно писать что-либо после них. Это вызовет ошибку.
        const index = [...target.parentNode.cells].indexOf(target); //==Индекс ячейки в строке заголовека=============================
        console.log('order = '+ order);
        //==Объект Intl.Collator является конструктором сортировщиков — объектов, включающих языка-зависимое сравнение строк.
        const collator = new Intl.Collator(['en', 'ru'], { numeric: true });
        //==Метод для правильного сравнения строк на разных языках, последующая их сортировать
        const comparator = (index, order) => (a, b) => order * collator.compare(
            a.children[index].innerHTML,
            b.children[index].innerHTML
        );

        for(const tBody of target.closest('table').tBodies)
            tBody.append(...[...tBody.rows].sort(comparator(index, order)));

        for(const cell of target.parentNode.cells)
            cell.classList.toggle('sorted', cell === target);
    };
  //  console.log('Inner HTML = '+document.querySelector(str).innerHTML);
    document.querySelectorAll(str).forEach(tableTH => tableTH.addEventListener('click', evt => getSort(evt)));
   // document.querySelectorAll(str).forEach(tableTH => tableTH.addEventListener('click', () => console.log('HELLO JACK!!!!')));
}

//==При нажатии на кнопку Add в thead, скрываем таблицу с судами пользователя и открываем таблицу со всеим судами====
function addVessel() {
   document.querySelector('#userVessels').style.display = 'none';
   document.querySelector('#allVessels').style.display = 'block';
    document.querySelector('#allVesselsList').innerHTML = '';

    getVesselsAdmin();

}





//==При нажатии на кнопку Add в строке, функция setUserVessel(id, vesselId) посылает запрос с id пользователя и с id выбранного судна, чтобы дать этому пользователю доступ к этому судну====
function add(vesselId) {
    console.log('..........ADD>>>>>>>>>>>>>  '+ vesselId);
    // let nod = Array.from(document.querySelectorAll('#allVesselsList tr td .vsl-id'));
    // for (let elem of nod) {
    //     console.log('....................' + elem.innerText);
   // }
    setUserVessel(sessionStorage.getItem('idPressedButton'), vesselId);
    document.getElementById("addTdBtn"+vesselId).remove(); //==Удаляем кнопку Del===================
    //==взамен нее вставляем кнопку Add===================
    document.getElementById("vesselIdTr"+vesselId).innerHTML += `
                                                                                          
                                        <td id="delTdBtn${vesselId}"><a class="btn btn-secondary btn-sm btn-block" onclick="deleteVesselFromUser(${vesselId})">Del</a></td>
                                        `;
    //  document.getElementById("vesselIdTr"+newUserVessel[0].vessel_id).style.background = 'GRAY';

    //==Добавляем элементам td в текущей строки класс 'vsl-id', в котором прописан background чтобы подсветить строку===============
    document.getElementById("vesselIdTr"+vesselId).firstElementChild.classList.add('vsl-id');
    document.getElementById("vesselIdTr"+vesselId).firstElementChild.nextElementSibling.classList.add('vsl-id');
    document.getElementById("vesselIdTr"+vesselId).firstElementChild.nextElementSibling.nextElementSibling.classList.add('vsl-id');

}





//==При нажатии на кнопку Del в строке, функция removeUserVessel(id, vesselId) посылает запрос с id пользователя и с id выбранного судна, чтобы закрыть этому пользователю доступ к этому судну====
function deleteVesselFromUser(vesselId){
    removeUserVessel(sessionStorage.getItem('idPressedButton'), vesselId);
    if (document.getElementById("delTdBtn"+vesselId)){
        document.getElementById("delTdBtn"+vesselId).remove(); //==Удаляем кнопку Add===================
    }
    //==взамен нее вставляем кнопку Del===================
    document.getElementById("vesselIdTr"+vesselId).innerHTML += `
                                                                                          
                                        <td id="addTdBtn${vesselId}"><a class="btn btn-secondary btn-sm btn-block" onclick="add(${vesselId})">Add</a></td>
                                        `;
    //==Удаляем из элементав td в текущей строки класс 'vsl-id', в котором прописан background чтобы снять подсветку строки===============
    document.getElementById("vesselIdTr"+vesselId).firstElementChild.classList.remove('vsl-id');
    document.getElementById("vesselIdTr"+vesselId).firstElementChild.nextElementSibling.classList.remove('vsl-id');
    document.getElementById("vesselIdTr"+vesselId).firstElementChild.nextElementSibling.nextElementSibling.classList.remove('vsl-id');
  //  getVesselsAdmin();
}




function changeUserLevel(roleId){
    alert(roleId);

    updateUserLevel(sessionStorage.getItem('idPressedButton'), roleId);
}

function changeUserVesselLevel(roleId, vesselId){
    alert(roleId + ' / ' + vesselId);

    updateUserVesselLevel(vesselId, roleId);
}

//==В этой функции запрашиваем информацию по пользователям====================
function getUsers()
{
    const serverUrl = 'http://localhost/vsltanks/server/api/v1';
    const request = new XMLHttpRequest();
    request.open('GET', `${serverUrl}/users`);
    request.send('');
    return new Promise(function(resolve, reject) {
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {
              //  console.log('users = ');
                const users = request.responseText;
               // console.log(getCookie('token'));
               // console.log('users = '+ users);
                resolve(users);
            }
        };
    })
}



//==Функция для вывода судов в таблице к которым имеет доступ выбранный пользователь====
function getUserVessels(id) {
    const serverUrl = 'http://localhost/vsltanks/server/api/v1';
    const request = new XMLHttpRequest();
    request.open('GET', `${serverUrl}/user/${id}`);
    request.send('');
    return new Promise(function(resolve, reject) {
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {
                //  console.log('users = ');
                const user = request.responseText;
                // console.log(getCookie('token'));
             //   console.log('user = '+ user);
                resolve(user);
            }
        };
    })
}



//==Функция для вывода всех судов в таблице с выделением цветом судов к которым имеет доступ выбранный пользователь====
function getVesselsAdmin() {
    const request = new XMLHttpRequest();
    request.open('GET', `${serverUrl}/vessel/-1`);
    request.send('');
    request.onreadystatechange = () => {
        return new Promise(function (resolve, reject) {
            request.onreadystatechange = () => {
                if (request.status === 200 && request.readyState === 4) {
                    const vessels = JSON.parse(request.responseText);
                    // console.log(getCookie('token'));
                       console.log('vessels = '+ vessels.length);
                    let vesselsID = [];
                    document.querySelector('#allVesselsList').innerHTML = '';
                    vessels.forEach(vessel => { //==Перебирем все суда и сравниваем с судами к которым имеет доступ пользователь====
                        let x = 0;
                        tableNod.forEach(tableNods=>{  //==Если находим совпадение то отмечаем это инкрементом переменной х.====
                            if (vessel.vessel_id === tableNods.id){
                                x++;
                            }
                        });
                            if (x === 1){ //==Выаодим строку таблицы с дополнительным классом vsl-id для изменения цвета строки====
                                x = 0;
                                document.querySelector('#allVesselsList').innerHTML += `<tr class="m-0" id="vesselIdTr${vessel.vessel_id}">
                                                                                            <td class="w-25 vsl-id">${vessel.vessel_id}</td>
                                                                                            <td class="w-50 vsl-id">${vessel.vessel_name}</td>
                                                                                            <td class="w-25 vsl-id">${vessel.vessel_imo}</td>
                                                                                            <td id="delTdBtn${vessel.vessel_id}"><a class="btn btn-secondary btn-sm btn-block" onclick="deleteVesselFromUser(${vessel.vessel_id})">Del</a></td>
                                                                                         </tr>`;
                            }else{ //==или без дополнительного класса====
                                document.querySelector('#allVesselsList').innerHTML += `<tr class="m-0" id="vesselIdTr${vessel.vessel_id}">
                                                                                            <td class="w-25">${vessel.vessel_id}</td>
                                                                                            <td class="w-50">${vessel.vessel_name}</td>
                                                                                            <td class="w-25">${vessel.vessel_imo}</td>
                                                                                            <td id="addTdBtn${vessel.vessel_id}"><a class="btn btn-secondary btn-sm btn-block" onclick="add(${vessel.vessel_id})">Add</a></td>
                                                                                         </tr>`;
                            }
                    });
                    resolve(vessels);
                }
            }
        });
    }
}



//==Функция посылает запрос с id пользователя и с id выбранного судна, чтобы дать этому пользователю доступ к этому судну====
function setUserVessel(id, vesselId) {
    const serverUrl = 'http://localhost/vsltanks/server/api/v1';
    const request = new XMLHttpRequest();
    request.open('GET', `${serverUrl}/userVessel/${id}/${vesselId}`);
    request.send('');
    return new Promise(function(resolve, reject) {
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {
                //  console.log('users = ');
                const newUserVessel = JSON.parse(request.responseText);
                // console.log(getCookie('token'));
                   console.log('user = '+ vesselId);
                resolve(newUserVessel);
            }
        };
    })
}



//==Функция посылает запрос с id пользователя и с id выбранного судна, чтобы закрыть этому пользователю доступ к этому судну====
function removeUserVessel(id, vesselId) {
    const serverUrl = 'http://localhost/vsltanks/server/api/v1';
    const request = new XMLHttpRequest();
    request.open('REMOVE', `${serverUrl}/userVessel/delete/${id}/${vesselId}`);
    request.send('');
    return new Promise(function(resolve, reject) {
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {
                //  console.log('users = ');
                const oldUserVessel = JSON.parse(request.responseText);
                // console.log(getCookie('token'));
                console.log('remove  = '+ vesselId);

                resolve(oldUserVessel);
            }
        };
    })
}


function updateUserLevel(id, roleId) {
    const serverUrl = 'http://localhost/vsltanks/server/api/v1';
    const request = new XMLHttpRequest();
    request.open('UPDATE', `${serverUrl}/user/update/${id}/${roleId}`);
    request.send('');
    return new Promise(function(resolve, reject) {
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {
                //  console.log('users = ');
                const oldUserVessel = JSON.parse(request.responseText);
                // console.log(getCookie('token'));
                console.log('update  = '+ vesselId);

                resolve(oldUserVessel);
            }
        };
    })
}


function updateUserVesselLevel(vesselId, roleId) {
    alert('in update request function');
    const serverUrl = 'http://localhost/vsltanks/server/api/v1';
    const request = new XMLHttpRequest();
    request.open('UPDATE', `${serverUrl}/userVessel/update/${vesselId}/${roleId}`);
    request.send('');
    return new Promise(function(resolve, reject) {
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {
                  console.log('users = ');
                const oldUserVessel = JSON.parse(request.responseText);
                // console.log(getCookie('token'));
                console.log('update  = '+ vesselId);

                resolve(oldUserVessel);
            }
        };
    })
}


