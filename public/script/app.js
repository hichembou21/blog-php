'use strict';

let choice = document.querySelector('#inputGroupSelect01');
let divM = document.querySelector('.avatar-c-m');
let divF = document.querySelector('.avatar-c-f');

let sectionUpdate = document.querySelector('.update-user');
let updateLink = document.querySelector('#update-link');

choice.addEventListener('change', function () {
    
    if (this.value === "0") {
        divM.style.display = 'flex';
        divF.style.display = 'none';
    } else {
        divF.style.display = 'flex'; 
        divM.style.display = 'none';       
    }
});

// updateLink.addEventListener('click', function () {
    
//     sectionUpdate.style.display = 'flex';
// });

