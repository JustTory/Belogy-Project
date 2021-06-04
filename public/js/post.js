let isLiked;

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $('.notification').popover('show');
    setTimeout(() => {
        $('.notification').popover('hide');
    }, 3000);

    $(".input-create").click(() => {
        addLoading();
    });

    let commentForm = document.querySelector("form.comment-form");
    let likeBtn = document.querySelector(".like-btn");
    let postID = $('.like-btn').data('postid');

    if($('.like-logo').hasClass("bi-heart-fill")) isLiked = true
    else isLiked = false;

    commentForm.addEventListener("submit", (e) => {
        let commentContent = document.querySelector(".comment").value;
        e.preventDefault();
        if(checkComment(commentContent)) {
            ajaxComment(commentContent, postID);
        }
    });

    likeBtn.addEventListener("click", () => {
        ajaxLike(postID);
    });
});

function addLoading() {
	$('.navbar').css("opacity", "40%");
	$('.main-cont').css("opacity", "40%");
	$('.loading-logo').removeClass('d-none');
}

function checkComment(comment) {
    if(comment == '' ) {
        $(".error-msg").removeClass('d-none');
        return false;
    }
    else {
        $(".error-msg").addClass('d-none');
        return true;
    }
}

function removeInput() {
    $(".comment").val("");
}

function ajaxComment(commentContent, postID) {
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
        removeInput();
      }
    }
    xhr.send("comment=" + commentContent + "&id=" + postID);
}

function outputNewComment(newComment) {

  let output = `
        <div class="row my-2">
            <div class="col-md-8 offset-md-2">
                <div class="comment card">
                    <div class="user-cmt-info d-flex">
                        <a class="text-dark font-weight-bold d-flex align-items-center" href="profile.php?id=${newComment['user_ID']}">
                            <img class="avatar-post mr-2" src="image.php?defaultAvatar" alt="">
                            ${newComment['user_username']}
                        </a>
                        <p class="font-weight-light my-2 post-info ml-auto">${newComment['cmt_date_time']}</p>
                    </div>
                    <p class="comment-content mt-2 mb-2">${newComment['cmt_content']}</p>
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

function switchLikeIconAnimation() {
    $('.like-logo').addClass("heart-anim");
    setTimeout(() => {
        $('.like-logo').removeClass("heart-anim");
    }, 400);

    if(isLiked == true) {
        $('.like-logo').removeClass("bi-heart").addClass("bi-heart-fill");
        $('.like-btn').removeClass('text-dark').addClass('text-danger');
    }
    else {
        $('.like-logo').removeClass("bi-heart-fill").addClass("bi-heart");
        $('.like-btn').removeClass('text-danger').addClass('text-dark');
    }
}

function checkAddOrRemoveLike(postID) {
    let addLike =  "&addlike=true";
    let removeLike = "&removelike=true";
    let dataSend = "id=" + postID;
    if(isLiked == true) dataSend += removeLike;
    else dataSend += addLike;
    return dataSend;
}

function ajaxLike(postID) {
    let xhr = new XMLHttpRequest();
    dataSend = checkAddOrRemoveLike(postID);
    let request = "likemanager.php";
    xhr.open("POST", request, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if(this.status == 200) {
            let newTotalPostLike = JSON.parse(this.responseText)['post_no_likes'];
            if(newTotalPostLike != "error") {
                updateTotalLikePost(newTotalPostLike);
                isLiked = !isLiked;
                switchLikeIconAnimation();
            } else {
                location.reload();
                $(window).scrollTop(0);
            }
        }
    }
    xhr.send(dataSend);
}

function updateTotalLikePost(newTotalLike) {
    let icon = `<i class="bi bi-heart-fill text-danger"></i>  `;
    $("p.post-no-likes").html(icon + newTotalLike);
}