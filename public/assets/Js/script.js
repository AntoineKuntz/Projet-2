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


if(document.querySelector('form.delete')){
    let form = document.querySelector('form.delete');  // <= Tu selection ta balise form
    let btn = document.querySelector('.btnDelete'); // <= Tu selection tpn btn submit


    form.addEventListener('submit', (e)=>{  //<= tu ecoute l'évènement submit 
        e.preventDefault();        // <= tu empêche l'envoie du formulaire
        if(confirm('Est ce que Fx est le Wilder du mois ?')){   // <= Si tu click sur ok la valeur est true
            form.submit();       // <= Alors tu envoie ton formulaire
        }else{
            alert('Pour moi si ;D');  // <== Dans ton cas ne met pas de else si tu veux pas d'action
        }
    })
}