$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $('.notification').popover('show');
    setTimeout(() => {
        $('.notification').popover('hide');
    }, 3000);

    $('#inputFile').change((e) => {
        let fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
});

