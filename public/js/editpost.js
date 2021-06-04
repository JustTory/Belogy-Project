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

    let submitBtnList = document.querySelectorAll('.submit-btn');
    submitBtnList.forEach(submitBtn => {
        submitBtn.addEventListener('click', () => {
            addLoading();
        });
    });

    $(".input-create").click(() => {
        addLoading();
    });

    $(".input-create").click(() => {
        addLoading();
    });


});

function addLoading() {
	$('.navbar').css("opacity", "40%");
	$('.main-cont').css("opacity", "40%");
	$('.loading-logo').removeClass('d-none');
}

