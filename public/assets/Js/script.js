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


// Rate widget

let radios = document.querySelectorAll('input[type=radio][name="rate"]');
let rating = document.querySelector('.rating');

if(rating){
    rating.addEventListener('change', (e)=>{
    if(rating.querySelector('.active')){
        rating.querySelector('.active').classList.remove('active');
    }
    e.target.classList.add('active');
    })
}

