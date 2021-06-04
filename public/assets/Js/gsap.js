if(document.querySelector('.home')){//Round

gsap.from(".roundBackround",{duration : 1, scale: .3, opacity:0} );
//Card help
gsap.from(".slider", {duration : 1, delay:.8, opacity: 0, x:200});
//text
gsap.from(".homeText1", {duration: 1, opacity: .4, x: -220});
gsap.from(".homeText2", {duration: 1, delay:1, opacity: 0, x: -220});

//line DOWN
gsap.from(".line", {duration: .5, delay:1, scaleY:0, transformOrigin: 'top'} );

gsap.from('.secondTitle', {
    opacity : 0,
    duration: 1,
    x:-130,
    scrollTrigger :{
    trigger: '.secondTitle',
    start: "top 75%",
}
});

gsap.from('.homeText3', {
    opacity : 0,
    duration: 1,
    x:220,
    scrollTrigger :{
    trigger: '.homeText3',
    start: "top 75%",
}
});

gsap.from('.homeText4', {
    opacity : 0,
    duration: 1,
    x:220,
    scrollTrigger :{
    trigger: '.homeText4',
    start: "top 65%",
}
});}
