$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
    $('.notification').popover('show');
    setTimeout(() => {
        $('.notification').popover('hide');
    }, 3000);

    let commentForm = document.querySelector("form.comment-form");

    commentForm.addEventListener("submit", (e) => {
        let commentContent = document.querySelector(".comment").value;
        e.preventDefault();
        ajaxComment(commentContent);
    });
});


function ajaxComment(commentContent) {
    let request = "createcomment.php";
    let xhr = new XMLHttpRequest();
    xhr.open("POST", request, true);
    // to use the post method we must set the request headers
    // depending on the form data being sent
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
      if(this.status == 200) {
        let output = JSON.parse(this.responseText);
        console.log(output);
        outputNewComment(output);
      }
    }
    xhr.send("comment=" + commentContent);
}

function outputNewComment(output) {
    

}