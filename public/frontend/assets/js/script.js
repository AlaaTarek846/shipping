


$('.about_home').on('click' , () => {
    $('html , body').animate({
        scrollTop : $('#about').offset().top
    },1000)
} )

$('.achieve').on('click' , () => {
    $('html , body').animate({
        scrollTop : $('#achieve').offset().top
    },1000)
} )
$('.gallery-1').on('click' , () => {
    $('html , body').animate({
        scrollTop : $('#gallery-2').offset().top
    },1000)
} )
$('.video-1').on('click' , () => {
    $('html , body').animate({
        scrollTop : $('#video-2').offset().top
    },1000)
} )
$('.you-1').on('click' , () => {
    $('html , body').animate({
        scrollTop : $('#you-2').offset().top
    },1000)
} )
$('.contact-ul').on('click' , () => {
    $('html , body').animate({
        scrollTop : $('#contact').offset().top
    },1000)
} )

$(document).ready(function() {
    //Preloader
    preloaderFadeOutTime = 3000;
    function hidePreloader() {
    var preloader = $('.spinner-wrapper');
    preloader.fadeOut(preloaderFadeOutTime);
    }
    hidePreloader();
    });


    //margins.left, // x coord   margins.top, { // y coord
$('#generatePDF').click(function () {
    doc.fromHTML($('#htmlContent').html(), 15, 15, {
        'width': 700,
        'elementHandlers': specialElementHandlers
    });
    doc.save('img\Wk-7-German-G-6-Wiederholung.pdf');
});