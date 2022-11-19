"use strict"
let posX;
let posY;
let colorSvg1 = 0;
let colorSvg2 = 155;
let colorSvg3 = 255;
let we = '';

function multiMax (first, ... remainingNumbers){
    var sorted = remainingNumbers .sort (function (a, b) {
        return b - a;
    });
    return first * sorted[0];
}

function* testGen(){
    yield 2;
    yield* testInGen();
    yield 5;
}

function* testInGen() {
    yield 3;
    yield 4;
}
const testCheck = testGen();


function svgMouseClick() {
    // if (we === 0){
    //     we = 1;
    //    // alert(we);
    //     moveRect(we);
    // }else{
    //     we = 0;
    //   //  alert(we);
    //     moveRect(we);
    // }
   // moveRect();

    let item;
   // while (!(item=testCheck.next()).done){
      //  alert(item.value);
   // }
   let q =  counter1();
    let qq = 0;

   if (q>5){
       qq = counter2();
   }
   if (document.getElementById('svgText2')){
       document.getElementById('svgText2').remove();
       document.getElementById('svg_rectangle3').innerHTML += `<text x="30" y="70" fill="#ED6E46" font-size="50"  font-family="'Leckerli One', cursive" id="svgText2">${qq}</text>`;
    //   document.getElementById('svgText2').setAttribute('x', posX+10);
    //   document.getElementById('svgText2').setAttribute('y', posY+95);
    //   document.getElementById('svgText2').setAttribute('width', 300-posX / 6);
   }else{
       document.getElementById('svg_rectangle3').innerHTML += `<text x="30" y="70" fill="#ED6E46" font-size="50"  font-family="'Leckerli One', cursive" id="svgText2">${qq}</text>`;
   }

    const currentLocation = location.href;
   console.log(currentLocation);

    document.getElementById('svgText').textContent = q;
    console.log(document.getElementById('svgText').textContent);
   // alert('test = '+multiMax(3, 5,66,2,5,7,44,8,23,12));
   // we = `<rect id='a_rectangle${testCheck.next().value}' x="10" width="200" height="100" style="fill:rgb(255,0,50)" onmousedown="test()"/>`;
   // document.getElementById('svgTest').innerHTML += we;
}



let max = (a, b) => a > b ? a : b;
function backCallTest(test) {
    test();
}

function test() {
  //  alert('max = '+ max(45, 39));
    moveRect('a_rectangle2');
}

//==========ЗАМЫКАНИЯ ПРИМЕР============================================================================
function makeCounter() {
    let count = 0;
    return function() {
        return count++;
    };
}

let counter1 = makeCounter();
let counter2 = makeCounter();

//==========ПРИМЕР ФУНКЦИИ ОБРАТНОГО ВЫЗОВА С ИСПОЛЬЗОВАНИЕМ ЗАМЫКАНИЯ===================================
const makePizza = function (title, cb) {
    console.log(`Заказ ${cb} на приготовление пиццы «${title}» получен. Начинаем готовить…`);
   // setTimeout(cb, 6000);
    if(cb >= 5){
        alert('А вот и couter2 активизировался - '+counter2());
    }

}

const readBook = function () {
    console.log('Читаю книгу «Колдун и кристалл»…');
}

const eatPizza = function () {
    console.log('Ура! Пицца готова, пора подкрепиться.');
}
//=======================================================================================================

function svgMouseDown(recID){
    let elem = '';
    elem = document.getElementById(recID).nodeName;
  //  alert(elem);
    makePizza('Пеперонни',eatPizza());
    readBook();
  //  alert(counter1());
    counter1();

        moveRect(recID);
}

//==========================================================================================================


function svg3MouseDown(recID){
    let elem = '';
    elem = document.getElementById(recID).id;
   //   alert(elem);
    //  alert(counter1());
    setInterval(moveRect(recID), 3000);
  //  moveRect(recID);

}

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

// myFunc(function(){
//     return function(){
//         alert('backCall Function');
//     };
// });




function moveRect1(){
    //  alert(document.getElementById('a_rectangle').getBoundingClientRect().width);
    document.getElementById('svgTest').addEventListener('mousemove', function (e) {


        let posX = e.clientX -e.currentTarget.getBoundingClientRect().left;
        let posY = e.clientY -e.currentTarget.getBoundingClientRect().top;
       // backCallTest(test);
        console.log('x = '+e.currentTarget.getBoundingClientRect().left);

        let svgTestWidth = document.getElementById('svgTest').getBoundingClientRect().width / 255;
        let svgTestHeight = document.getElementById('svgTest').getBoundingClientRect().height / 255;
        if (posX > e.currentTarget.getBoundingClientRect().right-document.getElementById('a_rectangle').getBoundingClientRect().width*2){
            posX = e.currentTarget.getBoundingClientRect().right-document.getElementById('a_rectangle').getBoundingClientRect().width*2;
        }
        if (posY > e.currentTarget.getBoundingClientRect().bottom-document.getElementById('a_rectangle').getBoundingClientRect().height*2){
            posY = e.currentTarget.getBoundingClientRect().bottom-document.getElementById('a_rectangle').getBoundingClientRect().height*2;
        }

        colorSvg1 = posX / svgTestWidth;

        colorSvg3 = posY / svgTestHeight;
        colorSvg2 = (colorSvg1 + colorSvg3) / 2;
        console.log('x = '+document.getElementById('a_rectangle').getBoundingClientRect().height);

        if (e.which === 1){
            document.getElementById('a_rectangle').setAttribute('x', posX);
            document.getElementById('a_rectangle').setAttribute('y', posY);
            document.getElementById('a_rectangle').style.fill = `rgb(${colorSvg1}, ${colorSvg2}, ${colorSvg3})`;
            document.getElementById('a_rectangle').setAttribute('rx', colorSvg1 / 2);
            document.getElementById('a_rectangle').setAttribute('width', 300-posX / 6);

            // document.getElementById('a_rectangle').setAttribute('ry', colorSvg3 / 2);
        }

    });
}

var moveRect = (rectElmnt) => {
    document.getElementById('svgTest').addEventListener('mousemove', function (e) {

        posX = e.clientX -e.currentTarget.getBoundingClientRect().left;
        posY = e.clientY -e.currentTarget.getBoundingClientRect().top;
       // backCallTest(test);
      //  console.log('x = '+e.currentTarget.getBoundingClientRect().left);

        let svgTestWidth = document.getElementById('svgTest').getBoundingClientRect().width / 255;
        let svgTestHeight = document.getElementById('svgTest').getBoundingClientRect().height / 255;
        if (posX > e.currentTarget.getBoundingClientRect().right-document.getElementById(rectElmnt).getBoundingClientRect().width){
            posX = e.currentTarget.getBoundingClientRect().right-document.getElementById(rectElmnt).getBoundingClientRect().width;
        }
        if (posY > e.currentTarget.getBoundingClientRect().bottom-document.getElementById(rectElmnt).getBoundingClientRect().height*2){
            posY = e.currentTarget.getBoundingClientRect().bottom-document.getElementById(rectElmnt).getBoundingClientRect().height*2;
        }

        colorSvg1 = posX / svgTestWidth;

        colorSvg3 = posY / svgTestHeight;
        colorSvg2 = (colorSvg1 + colorSvg3) / 2;
       // console.log('x = '+document.getElementById(rectElmnt).getBoundingClientRect().height);

        if (e.which === 1){
            document.getElementById(rectElmnt).setAttribute('x', posX);
            document.getElementById(rectElmnt).setAttribute('y', posY);
         //   document.getElementById('svgText2').setAttribute('x', posX+10);
         //   document.getElementById('svgText2').setAttribute('y', posY+95);
            document.getElementById(rectElmnt).firstElementChild.style.fill = `rgb(${colorSvg1}, ${colorSvg2}, ${colorSvg3})`;
            document.getElementById(rectElmnt).firstElementChild.setAttribute('rx', colorSvg1 / 2);
         //   document.getElementById(rectElmnt).setAttribute('width', 300-posX / 6);
          //  document.getElementById('svgText2').setAttribute('width', 300-posX / 6);
            // document.getElementById('a_rectangle').setAttribute('ry', colorSvg3 / 2);
        }

    });
};


let a = 0;
let elemRect = document.getElementById('a_rectangle');
let elemRect2 = document.getElementById('a_rectangle2');

// elemRect.addEventListener('mousedown', function () {
// //    moveRect.test = 'TEST';
// //    alert('mousedown'+ moveRect.test);
//     moveRect();
// });



// elemRect.addEventListener('mousedown', function () {
// //    moveRect.test = 'TEST';
// //    alert('mousedown'+ moveRect.test);
//   //  alert('mousedown a_rectangle');
//     moveRect('a_rectangle');
// });
//
// elemRect2.addEventListener('mousedown', function () {
// //    moveRect.test = 'TEST';
//     alert('mousedown a_rectangle2');
//     moveRect('a_rectangle2');
// });



document.getElementById('svgRect').addEventListener('dblclick', function (e) {
    e.preventDefault();
    alert('test = '+multiMax(3, 5,2,5,7,0,8,23,12));
    document.getElementById('a_rectangle1').cloneNode(true);
    const objTest = {prop1:'gopa'};
    const objTest2 = {prop2:'novij god'};
    Object.setPrototypeOf(objTest, objTest2);
    if ("prop2" in objTest){
        alert(objTest.prop1+ ' '+objTest.prop2);
    }

});

