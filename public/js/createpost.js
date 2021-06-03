$(document).ready(function() {
    $('#inputFile').change((e) => {
        let fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });

    removeErrorOnFocus("#inputTitle", "#errorTitle");
	removeErrorOnFocus("#inputContent", "#errorContent");
	removeErrorOnFocus("#inputFile", "#errorFile");
});

function removeErrorOnFocus(IDInputError, IDMsgError) {
	$(IDInputError).focus(function () {
		$(IDInputError).removeClass("border-error");
		$(IDMsgError).empty();
	});
}

