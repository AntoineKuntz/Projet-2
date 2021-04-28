//Profil user infos
if(document.querySelector('.btnProfil')){
    let btnProfil = document.querySelector('.btnProfil');
    let profilDetails = document.querySelector('.profilDetails');

    btnProfil.addEventListener('click', ()=>{
        profilDetails.classList.toggle('active');  
    });  
}

let menuBtn = document.querySelector('.menuBtn');
let nav = document.querySelector('nav');

document.addEventListener('click', ()=>{
    nav.classList.toggle('active');
})