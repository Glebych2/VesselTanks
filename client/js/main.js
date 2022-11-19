"use strict";


const serverUrl = 'http://localhost/vsltanks2/server/v1';
const clientUrl = 'http://localhost/vsltanks2/client';

let cookieCount;

let someEle;

// document.addEventListener("click", event => {
//     console.log(event.target);
//     someEle = event.target;
//     console.log(someEle);
//     console.log(someEle.id);
//     let sdf = document.getElementById(someEle.id);
//     let sdfParent = sdf.parentElement;
//
//     console.log(sdfParent);
//
// });
//
// document.addEventListener('keyup', function(event){
//     if (event.key === 'Delete') {
//         console.log(event.target);
//         console.log('Key: ', event.key);
//     }
//
// });



document.addEventListener("DOMContentLoaded", function(event)
{
    console.log('First load.');
    let vesselName = sessionStorage.getItem('vesselName');

    console.log('window.addEventListener = '+vesselName);

    if (document.getElementById('footerVesselName')){
        document.getElementById('footerVesselName').innerText = vesselName;
    }
    window.onresize = function() {
        resize_info();
    };

    let cookieDate = localStorage.getItem('cookieDate');

    // Если записи про кукисы нет или она просрочена на 1 год, то показываем информацию про кукисы
    if((!cookieDate || (+cookieDate + 31536000000) < Date.now())  &&  window.matchMedia('(min-width: 54em)').matches){
        document.getElementById('cookieMsg').classList.add('show');
    }

});

//==После нажатия на кнопку OK, сообщение об использовании куков удаляется=============================
function cookieOk() {
    localStorage.setItem( 'cookieDate', Date.now() );
    document.getElementById('cookieMsg').remove();
}

function resize_info()
{
    console.log('screen3!!!!!!!');
    if (window.matchMedia('(min-width: 30em) and (orientation: portrait)').matches) {
     //   console.log('screen1');
     //   menu.innerHTML = menuMobileStr;
    } else {
    //    console.log('screen2');

    //    menu.innerHTML = menuStr;
    }

}

//==Эта функция принадлежит свернутому меню в мобильной версии, а при клике отображает или прячет элементы меню=======================
function myFunction(){
    let mobilMenuPressed = document.querySelector(".mobil-menu");
    if (mobilMenuPressed.style.display === 'flex'){
        console.log('myFunction pressed1');
        mobilMenuPressed.removeAttribute("style");
        mobilMenuPressed.setAttribute("style","display:none");
    }else{
        mobilMenuPressed.removeAttribute("style");
        mobilMenuPressed.setAttribute("style","display:flex");
        console.log('myFunction pressed2');
    }
}

//===================БЛОК ДЛЯ РАБОТЫ =================================================================================================
//==Добавляем или скрываем пункт меню "admin" и выбираем нужную страниу для коммуникации в зависимости от уровня пользователя========================================
//getCookie('user_role') === '3' ?  document.getElementById('itemAdmin').hidden = false : document.getElementById('itemAdmin').hidden = true;

if (getCookie('user_role') === '3') {
    document.getElementById('itemAdmin').hidden = false;
    if (document.getElementById('connectFeedback')) {
        document.getElementById('connectFeedback').setAttribute('href', "connectAdmin.php");
        getMessages(1);
    }
}else if (getCookie('user_role') === '1' || getCookie('user_role') === '2' || getCookie('user_role') === '4') {
    document.getElementById('itemAdmin').hidden = true;
    if (document.getElementById('connectFeedback')) {
        document.getElementById('connectFeedback').setAttribute('href', "connect.php");
      //  document.getElementById('exampleInputEmail').value =
    }
}else{
    document.getElementById('itemAdmin').hidden = true;
    if (document.getElementById('connectFeedback')){
        document.getElementById('connectFeedback').setAttribute('href', "error.php");
    }
}

//==Запрашиваем и выводим сообщения от пользователей если авторизован админ=================================
function getMessages(id)
{
    const request = new XMLHttpRequest();
    request.open('GET', `${serverUrl}/message/${id}`);
    request.send('');
    request.onreadystatechange = () => {
        if (request.status === 200 && request.readyState === 4) {
            let str = '';
            let i = 1;
          //  console.log(request.responseText);
            const messages = JSON.parse(request.responseText);
            messages.forEach(message => {
                str += ` 
                <div class="card text-white bg-dark border-dark mb-1" style="max-width: 70%; margin-left: 1rem;">
                    <div class="card-header" style="display: inline-flex;">Message # ${message.feedback_id}, 
                     User e-mail:  ${message.user_email} 
                        <div class="form-check" style="position: absolute; right: 1rem">
                            <input class="form-check-input" type="checkbox" id="blankCheckbox${message.feedback_id}" value="option1" aria-label="..." onchange="messageRead('${message.feedback_id}')">
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <h5 class="card-title">${message.feedback_time}</h5>
                        <p class="card-text">${message.feedback_message}</p>
                    </div> 
                     
                </div>     
               `;
                i++;
            });
            const elem = document.querySelector('#feedbackAdmin');
            elem.innerHTML = str;
        }
    };
}


function messageRead(id) {
    if (document.getElementById('blankCheckbox'+id).checked){
        readMessage(id);
       // alert('Message2 '+id+ ' read');
    //    document.getElementById('blankCheckbox'+id).checked = true;
    }
}

function readMessage(id)
{
    const request = new XMLHttpRequest();
    request.open('PATCH', `${serverUrl}/message/${id}`);
    request.send('');
    request.onreadystatechange = () => {
        if (request.status === 200 && request.readyState === 4) {
            console.log(request.responseText);
        }
    };
}

//=============================================================================================================================
//===============================================================================================================================
window.addEventListener("load", function () {
    const elem      = document.querySelector(".auth");
    const elemMobil = document.querySelector('.auth-mobil');
    if (getCookie('user') == null || getCookie('user') == 1){
       // document.cookie = "user=1";
        let strBtn = `
            <button class="button-auth" type="button" onclick="userAuth()">Log</button>
            <button class="button-auth" type="button" onclick="window.location.href = clientUrl + '/registration.php';">Reg</button> 
        `;

        elem.innerHTML = strBtn;
        elemMobil.innerHTML = strBtn;
        getVessel(1);
    }else{
        let strBtn = ` 
            <button class="button-auth" type="button" onclick="logout()">Exit</button>
        `;

        elem.innerHTML = strBtn;
        elemMobil.innerHTML = strBtn;
        if (getCookie('user')){
            console.log('main.js/189 user id = '+getCookie('user'));
            getVessel(getCookie('user')); //Получаем доступ к судам связанным с авторизованным пользователем
            document.getElementById('inputUserId').value = getCookie('user');
        }else{
            getVessel(1);
        }

    }
    if (select.options[select.selectedIndex]){
        select.options[select.selectedIndex].selected = sessionStorage.getItem('idVesselSelect');
        console.log(select.options[select.selectedIndex].selected);
    }


    let vesselName = sessionStorage.getItem('vesselName');

    console.log('window.addEventListener = '+vesselName);

    if (document.getElementById('footerVesselName')){
        document.getElementById('footerVesselName').innerText = vesselName;
    }
 //   console.log('inputUserId = '+document.getElementById('inputUserId'));
   // document.getElementById('inputUserId').value = getCookie('user');
});




function getVessels()
{
    const request = new XMLHttpRequest();
    request.open('GET', `${serverUrl}/vessel`);
    request.send('');
    request.onreadystatechange = () => {
        if (request.status === 200 && request.readyState === 4) {
            let str = '';
            let i = 1;
            console.log(request.responseText);
            const vessels = JSON.parse(request.responseText);
            vessels.forEach(vessel => {
                str += `
                <option class="vessel-name" value="${i}"> ${vessel.vessel_name} </option>        
               `;
                i++;
            });
            const elem = document.querySelector('#vessel');
            elem.innerHTML = str;
        }
    };
}

function getVessel(id)//==Здесь id пользователя по которому выводятся суда к которым он имеет доступ
{
    console.log('id in getVessel(id) = ' +id);
    const request = new XMLHttpRequest();
    request.open('GET', `${serverUrl}/vessel/${id}`);
    request.send('');
    request.onreadystatechange = () => {
        if (request.status === 200 && request.readyState === 4) {
            let str = '';
            let i = 1;
           // str = request.responseText;
           // console.log('str= '+str);
            const vessels = JSON.parse(request.responseText);
           // let dfg = document.getElementById('vesselParticularsName');
          //  dfg.innerHTML = str;
            console.log(vessels);
            let userRole = 1;
            userRole = getCookie('user_role');
          //  alert( 'admin = ' +  admin);
            vessels.forEach((vessel, index, vessels) => {
                console.log(index + ' = ' + i);
                console.log(vessels[index].vessel_id);
                if (vessels.length === 1 || vessels[index].vessel_id !== vessels[i].vessel_id){
                    if (userRole === '3'){
                        str += `
                            <option class="vessel-name" id="opVesselId_${vessel.vessel_id}" value="${vessel.vessel_id}" data-par="2"> ${vessel.vessel_name} </option>        
                            `;
                    }else{
                        str += `
                            <option class="vessel-name" id="opVesselId_${vessel.vessel_id}" value="${vessel.vessel_id}" data-par="${vessel.user_vessel_user_role}"> ${vessel.vessel_name} </option>        
                            `;
                    }

                    i = index;
                }
                console.log(str);
            });
            sessionStorage.setItem('case', i+1);//=Сохраним в sessionStorage кол-во судов к которым имеет доступ пользователь
            const elem = document.querySelector('#vessel');
            elem.innerHTML = str;
            const select = document.querySelector('#vessel').getElementsByTagName('option');
            let item = 1;
            if (sessionStorage.getItem('idVesselSelect')) {
                item = sessionStorage.getItem('idVesselSelect');
            }else{
                sessionStorage.setItem('idVesselSelect', 1);
            }
            console.log('vesselId = '+item);
            if (document.getElementById('vesselConfigButton')){
                document.getElementById('vesselConfigButton').disabled = true;
                document.getElementById('tankConfigButton').disabled = true;
                document.getElementById('delTank').disabled = true;
                document.getElementById('delTable').disabled = true;
                document.getElementById('submitTankTable').disabled = true;
            }

            for (let x = 0; x < select.length; x++) {
              //  console.log('select['+x+'].value = '+select[x].value +  ', item = '+ item);
                //==В зависимости от уровня доступа пользователя к судну, активируем или дезактивируем кнопки на странице конфигурации====
                if (select[x].value === item){
                    console.log('select[x].data-par = '+select[x].getAttribute('data-par'));
                    if (select[x].getAttribute('data-par') === '1'){
                        console.log('select[x].data-par = '+select[x].getAttribute('data-par'));
                        if (document.getElementById('vesselConfigButton')){
                            document.getElementById('vesselConfigButton').disabled = true;
                            document.getElementById('tankConfigButton').disabled = true;
                            document.getElementById('delTank').disabled = true;
                            document.getElementById('delTable').disabled = true;
                            document.getElementById('submitTankTable').disabled = true;
                        }
                    }else if(select[x].getAttribute('data-par') === '2'){
                        console.log('select[x].data-par = '+select[x].getAttribute('data-par'));
                        if (document.getElementById('vesselConfigButton')){
                            document.getElementById('vesselConfigButton').disabled = false;
                        }
                        if (document.getElementById('tankConfigButton')){
                            document.getElementById('tankConfigButton').disabled = false;
                        }
                        if (document.getElementById('delTable')){
                            document.getElementById('delTable').disabled = false;
                        }
                        if (document.getElementById('delTank')){
                            document.getElementById('delTank').disabled = false;
                        }
                        if (document.getElementById('submitTankTable')){
                            document.getElementById('submitTankTable').disabled = false;
                        }
                    }
                    select[x].selected = true;
                }
            }
        }
    };
}



//== Запрашиваем в БД адрес картинки, где переменная imgTrig нужна чтобы сообщить БД,что переменная id здесь это id судна=====================
function getVesselImg(id, imgTrig)
{
    const request = new XMLHttpRequest();
    request.open('GET', `${serverUrl}/vessel/${id}/${imgTrig}`);
    request.send('');
    return new Promise(function(resolve, reject) {
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {

                const vessels = JSON.parse(request.responseText);
              //  console.log('1.vessels = '+vessels[1].image_id);
                resolve(vessels);
            }else if (request.status !== 200){
                console.log('request.status = '+request.status);
                console.log('request.readyState = '+request.readyState);
            }
        };
    })
}

//== Получаем в БД адрес картинки и выводим в HTML в Vessel, если уже загружен=====================
function getTheVessel() {
    let idPic = '1';
    // Получаем в sessionStorage id выбранного в выпадающем списке судно
    if (sessionStorage.getItem('idVesselSelect')){
        idPic = sessionStorage.getItem('idVesselSelect');
    }
   // console.log('idPic === '+idPic);
    getVesselImg(idPic, 1).then(vessels => {                        // но если пользователь 'Admin', то сервер пришлет все суда
        let massiveNum = 0;
        let picBox = document.getElementById('vesselSlider');

        if (picBox){
            picBox.innerHTML = '';
        }

        vessels.forEach((vessel, index)=>{                                 // Для выбора из полученного массива нужного судна, перебераем массив и находим нужный элемент
            if (vessel.vessel_id === idPic){
               // console.log('vessel = '+vessel);
              //  console.log('index = '+index);
                massiveNum = index;                                         // и сохраняем его в переменной  massiveNum
                //==Формируем Url файла фотографии========================================================
                let strSource = serverUrl + vessels[massiveNum].directory_path + vessels[massiveNum].image_name;
                let str = `<div class="item" id="divPhotoId${vessels[massiveNum].image_id}"><img class="vessel-image" src="${strSource}" alt="San Vessel Photo" id="vesselPhotoId${vessels[massiveNum].image_id}"></div>`;
                //==Если фотографии нет, то грузим картинку NO PHOTO======================================
                if (!vessels[massiveNum].directory_path || !vessels[massiveNum].image_name){
                    str = `<div class="item" >
                            <img class="vessel-image" id="idVincent" src= "${serverUrl}/assets/upload/images/nophotogray.jpg" 
                            alt="San Vessel Photo">
                        </div>`;
                }

               // console.log(str);
                if (picBox){
                    picBox.innerHTML += str;
                }
            }

        });
        if (picBox){
            picBox.innerHTML += `<a class="previous" onclick="previousSlide()">&#10094;</a>
                        <a class="next" onclick="nextSlide()">&#10095;</a>`;
        }


        sessionStorage.setItem('vesselName', vessels[massiveNum].vessel_name);
        if (document.getElementById('vesselParticularsName')){
            document.getElementById('vesselParticularsName').innerText = vessels[massiveNum].vessel_name;
        }
        if (document.getElementById('vesselParticularsImo')){
            document.getElementById('vesselParticularsImo').innerText = vessels[massiveNum].vessel_imo;
        }
        if (document.getElementById('vesselParticularsCall')){
            document.getElementById('vesselParticularsCall').innerText = vessels[massiveNum].vessel_call_sign;
        }
        if (document.getElementById('vesselParticularsNumber')){
            document.getElementById('vesselParticularsNumber').innerText = vessels[massiveNum].vessel_official_number;
        }
        if (document.getElementById('vesselParticularsPort')){
            document.getElementById('vesselParticularsPort').innerText = vessels[massiveNum].vessel_port_registry;
        }
        if (document.getElementById('vesselParticularsFlag')){
            document.getElementById('vesselParticularsFlag').innerText = vessels[massiveNum].vessel_flag;
        }
    });
}


// возвращает куки с указанным name,
// или undefined, если ничего не найдено
function getCookie(name) {
    let matches = document.cookie.match(new RegExp(                                               //==Конструктор RegExp создаёт объект регулярного выражения для сопоставления текста с шаблоном.
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}




//==Обрабатываем если меняется выбор судна в выпадающем списке=========================================
//==<select class="select-vessel" name="vessel" id="vessel"> </select>
let select = document.getElementById('vessel');
console.log(select);

select.addEventListener("click", function () {

  //  let idPic = (select.options[select.selectedIndex].id).slice(11);
    let idPic = select.options[select.selectedIndex].value;
    console.log('idVesselSelect = ' + idPic);
    soundTrimNames();
    let vesselName = select.options[select.selectedIndex].text;
    let index = select.options[select.selectedIndex].index;
    let userLevel = select.options[select.selectedIndex].getAttribute('data-par');
    sessionStorage.setItem('idVesselSelect', idPic);           //==Сохраняем в id выбранного судна в sessionStorage для последующего использования
    sessionStorage.setItem('selectOptionIndex', index);
    sessionStorage.setItem('vesselName', vesselName);
    sessionStorage.setItem('newVesselConfig', 0);
    console.log(vesselName+',id='+idPic+' ,index='+index+' ,userLevel= '+userLevel);
    document.getElementById('footerVesselName').innerText = vesselName;
    if (userLevel === '1'){
        if (document.getElementById('vesselConfigButton')){
            document.getElementById('vesselConfigButton').disabled = true;
            document.getElementById('tankConfigButton').disabled = true;
            document.getElementById('delTable').disabled = true;
            document.getElementById('submitTankTable').disabled = true;
        }

    }else if (userLevel === '2'){
        if (document.getElementById('vesselConfigButton')){
            document.getElementById('vesselConfigButton').disabled = false;
            document.getElementById('tankConfigButton').disabled = false;
            document.getElementById('delTable').disabled = false;
            document.getElementById('submitTankTable').disabled = false;
        }

    }

    if (select.options[select.selectedIndex].value){
        getTheVessel();
    }
});



//==браузер полностью загрузил HTML, было построено DOM-дерево, но внешние ресурсы, такие как картинки (img) и стили (CSS), могут быть ещё не загружены
//==Получаем картинку по id судна сохраненного при выборе в select====================
document.addEventListener('DOMContentLoaded', function(){
    getTheVessel();
});

function userAuth() {
    sessionStorage.clear();
    window.location.href = clientUrl+'/auth.php';
}


function logout() {
    const request = new XMLHttpRequest();
    request.open('GET', `${serverUrl}/logout`);
    request.send('');
    request.onreadystatechange = () => {
        if (request.status === 200 && request.readyState === 4) {
            let strBtn = '';
            let i = 1;
           // console.log(request.responseText);
           // const users = JSON.parse(request.responseText);
            sessionStorage.clear();
            strBtn = `
            <button class="button-auth" type="button" onclick="userAuth()">Log</button>
            <button class="button-auth" type="button" onclick="window.location.href = '${clientUrl}/registration.php';">Reg</button> 
        `

            const elem     = document.querySelector('.auth');
            const elemMobil = document.querySelector('.auth-mobil');
            elem.innerHTML = strBtn;
            elemMobil.innerHTML = strBtn;
            document.getElementById('itemAdmin').hidden = true
            window.location.href = clientUrl+'/auth.php';
            //==Метод Location.reload() перезагружает ресурс из текущего URL подобно кнопке обновления браузера
          //  document.location.reload();
        }
    };



}

let imgChangeOnClick = document.getElementsByClassName('.vessel-image');

select.addEventListener("click", function () {
    //console.log('hello image!!!!');
   // imgChangeOnClick.src = 'http://localhost/vsltanks/server/api/v1/assets/upload/images/nophotogray.jpg';
})
// let strBtn = `
//             <button class="button-auth" type="button" onclick="logout()">Exit</button>
//         `
// const elem     = document.querySelector('.auth');
// elem.innerHTML = strBtn;



//======================================================================================================================
//==Слайдер=============================================================================================================
//======================================================================================================================

    /* Устанавливаем стартовый индекс слайда по умолчанию: */
    let slideIndex = 1;
    /* Вызываем функцию, которая реализована ниже: */
    showSlides(slideIndex);

    /* Увеличиваем индекс на 1 — показываем следующий слайд: */
    function nextSlide() {
        console.log('next');
        showSlides(slideIndex += 1);
    }

    /* Уменьшаем индекс на 1 — показываем предыдущий слайд: */
    function previousSlide() {
        console.log('previous');
        showSlides(slideIndex -= 1);
    }

    /* Устанавливаем текущий слайд: */
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    /* Функция перелистывания: */
    function showSlides(n) {
        /* Обращаемся к элементам с названием класса "item", то есть к картинкам: */
        let slides = document.getElementsByClassName("item");

        /* Проверяем количество слайдов: */
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }

        /* Проходим по каждому слайду в цикле for: */
        for (let slide of slides) {
            slide.style.display = "none";
        }
        /* Делаем элемент блочным: */
        if (slides[slideIndex - 1]){
            slides[slideIndex - 1].style.display = "block";
        }

    }

document.getElementById('footerIcon').addEventListener('click', function () {
   // alert('Message sent!!!!!');
});


