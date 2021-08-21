const fs = require('fs');
var http = require("request");

// Grab fidenza
//
let baseUrl = 'https://artblocks-mainthumb.s3.amazonaws.com/78000';

function numTo3(num) {
    let numStr = (num + '');
    while (numStr.length < 3) {
        numStr = "0" + numStr;
    }
    return numStr;
}


async function fetch() {
    for (let i = 0; i < 10; i++) {
        for (let j = 0; j < 100; j++) {
            doReq((i * 100) + j, 0);
        }
        await sleep(10000);
    }
}


function sleep(ms) {
  return new Promise((resolve) => {
    setTimeout(resolve, ms);
  });
}

function doReq(i, attempt) {

    let url = baseUrl + numTo3(i) + ".png";
    console.log(url);
    http(url,{encoding: 'binary'}, function(err, res, body) {
        if (err) { console.log(err); }
        try {
            fs.writeFileSync('fidenza/' + i + '.png', body, 'binary');
        } catch (e) {
            console.log(e, body);
            setTimeout(() => {
                console.log('retrying ' + url + ' attempt ' + attempt);
                doReq(i, attempt + 1)
            }, 10000);
        }
    });
}

fetch();
