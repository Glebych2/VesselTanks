'use strict'






//==В этой функции запрашиваем БД и получаем данные по топливным танкам по id судна
function getTanksQuantity(id)
//function getVolume(id)
{
    const serverUrl = 'http://localhost/vsltanks/server/api/v1';
    const request = new XMLHttpRequest();
    // request.open('GET', `${serverUrl}/vessel/${id}/${vslId}`);
    request.open('GET', `${serverUrl}/tank/${id}`);
    request.send('');

    return new Promise(function(resolve, reject) {
        request.onreadystatechange = () => {
            if (request.status === 200 && request.readyState === 4) {

                const tanks = JSON.parse(request.responseText);
                sessionStorage.setItem('storageTanksQuantity', tanks.length);
                //   console.log(tanks.length);
                //   console.log(getCookie('token'));
                resolve(tanks);
            }
        };
    })
}


