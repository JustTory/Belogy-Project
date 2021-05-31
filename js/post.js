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
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
      if(this.status == 200) {
        let newComment = JSON.parse(this.responseText);
        //console.log(newComment);
        outputNewComment(newComment);
        updateTotalPostComment(newComment['post_no_comments']);
      }
    }
    xhr.send("comment=" + commentContent);
}

function outputNewComment(newComment) {
    
  let output = `
        <div class="row my-2">
            <div class="col-md-8 offset-md-2">
                <div class="comment card">
                    <div class="user-cmt-info d-flex">
                        <a class="text-dark font-weight-bold d-flex align-items-center" href="profile.php?id=${newComment['user_ID']}">
                            <img class="avatar-post mr-2" src="images/default/defaultUserAvatar.png" alt="">
                            ${newComment['user_username']}
                        </a>
                        <p class="font-weight-light my-2 post-info ml-auto">${newComment['cmt_date_time']}</p>
                    </div>
                    <p class="comment-content mt-2">${newComment['cmt_content']}</p>
                </div>
            </div>
        </div>`;

  $(".comments").prepend(output);
  $(".empty-comment").remove();
}

function updateTotalPostComment(newTotalComment) {
    let icon = `<i class="bi bi-chat-left-fill text-secondary"></i> `;
    $("p.post-no-comments").html(icon + newTotalComment);
}