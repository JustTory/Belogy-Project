$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $('.notification').popover('show');
    setTimeout(() => {
        $('.notification').popover('hide');
    }, 3000);

    let fileInputs = document.querySelectorAll('#inputFile');
    fileInputs.forEach(fileInput => {
        fileInput.addEventListener('change', (e) => {
            let fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });
    });
    
});

