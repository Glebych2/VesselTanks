'use strict'


function tankConfig(a) {
    let elem  = document.querySelector('#tankConfigTable');
    let str = '';
    for (let i = 0; i<a; i++){
        str = `
               <tr class="hfo-row">     
                   <td><input type="number" name="tnkname${i}" id="tnkname${i}"></td>
                   <td><input type="number" name="tnkVol${i}" id="tnkVol${i}"></td>
                   <td><input type="number" name="tnkHeight${i}" id="tnkHeight${i}"></td>
               </tr>
              `;
        elem.innerHTML += str;
        console.log(str);
    }
    if (str !== ''){
        elem.innerHTML +=  `<button type="submit" class="btn btn-primary">Submit</button>`;
    }

}


function tanksQuantity(){
    let tnksQty = document.getElementById('configTankQuantity').value;
  //  alert(tnksQty);
    tankConfig(tnksQty);
//    let elem  = document.querySelector('#tankConfigTable');
 //   elem.innerHTML +=  `<button type="submit" class="btn btn-primary" formenctype="multipart/form-data">Submit</button>`;
}
tanksQuantity();