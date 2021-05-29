$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
    $('.notification').popover('show');
    setTimeout(() => {
        $('.notification').popover('hide');
    }, 3000);
});