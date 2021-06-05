let limit = 5;
let offset = 0; // default offset;
let reachedEnd = false;
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

    $('.posts').on('click', '.async-task', function() {
        addLoading();
    });

    $('.async-task').click(() => {
		addLoading();
	});

    $(".input-create").click(() => {
        $(".form-create").submit();
        addLoading();
    });

    $(".edit-profile-btn").click(() => {
       outputEditBtns();
    });

    $('.posts').on('click', '.like-btn', function() { // add dynamically event handler to all ".like-btn"
        let likeBtn = $(this).get(0);
        let postID = $(this).data('postid');
        let isLiked = checkIsLiked(likeBtn);
        let likeIcon = likeBtn.childNodes[1];
        let totalLikePost = likeBtn.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.firstElementChild;
        ajaxLike(postID, isLiked, likeIcon, totalLikePost);
    });

    let userID = $('.user-profile').data('userid');

    $(window).scroll(function() {
        if((($(window).scrollTop() + $(window).height()) >= $(document).height()) && reachedEnd == false) {
            offset += 5;
            console.log("loading new posts from record " + offset + " to " + (offset + 5) + " (limit = " + limit + ")");
            let xhr = new XMLHttpRequest();
            let request = "getmoreposts.php?offset=" + offset + "&limit=" + limit + "&userID=" + userID;
            xhr.open("GET", request, true);
            xhr.onload = function() {
                if(this.status == 200) {
                    let newPostList = JSON.parse(this.responseText);
                    //console.log(newPostList);
                    outputNewPosts(newPostList);
                }
            }
            xhr.send();
        }
    });
});

function outputNewPosts(newPostList) {
    let currentUserID = newPostList['currentUserID'];
    if(newPostList['posts'] != '') {
        let output = '';
        newPostList['posts'].forEach(post => {
            let isLikedClass = [];
            if(post['liked'] == true) {
                isLikedClass.push("text-danger");
                isLikedClass.push("bi-heart-fill");
            }
            else {
                isLikedClass.push("text-dark");
                isLikedClass.push("bi-heart");
            }

            let ownedPostButton = ` <a class="ml-auto edit-btn async-task" href="editpost.php?id=${post['post_ID']}">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>`;
            output += `
                <div class="row my-5">
                    <div class="col-md-8 offset-md-2">
                        <a class="a-post async-task" href="post.php?id=${post['post_ID']}">
                            <div class="card post">`;

                if (post['post_img_url'] != null) {
                    output += `
                                <img class="card-img-top post-img" src="image.php?postID=${post['post_ID']}" alt="Post image">`;
                }
                output += `
                                <div class="card-body post-body pb-2">
                                    <div class="title-edit d-flex">
                                        <h5 class="card-title post-title font-weight-normal">${post['post_title']}</h5>`;
                if(checkOwnedPostOrAdmin(post['post_author_ID'], currentUserID, newPostList['userRole'])){
                    output += ownedPostButton;
                }
                    output +=`
                                    </div>
                                    <p class="card-text post-content">${readMoreAtIndex(post['post_content'], post['post_ID'])}</p>
                                    <div class="author-date d-flex mt-4">
                                        <a class="${outputUserRoleColor(post['user_role'])} font-weight-bold d-flex align-items-center" href="profile.php?id=">
                                            <img class="avatar-post mr-2" src="image.php?defaultAvatar" alt="">
                                            ${post['user_username']}
                                        </a>
                                        <p class="font-weight-light my-2 post-info ml-auto">${post['post_date_time']}</p>
                                    </div>
                                    <div class="no-like-cmt d-flex mt-2">
                                        <p class="post-info mb-0 mr-3"><i class="bi bi-heart-fill text-danger"></i> ${post['post_no_likes']}</p>
                                        <p class="post-info mb-0"><i class="bi bi-chat-left-fill text-secondary"></i> ${post['post_no_comments']}</p>
                                    </div>
                                    <hr class="mb-2">
                                    <div class="interaction">
                                        <div class="row">
                                            <div class="col-md-6 d-flex justify-content-center">
                                                <button type="button" data-postid="${post['post_ID']}" name="like-submit" class="like-btn ${isLikedClass[0]} text-center">
                                                    <i class="like-logo bi ${isLikedClass[1]}"></i>
                                                    Like
                                                </button>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-center">
                                                <a class="text-dark text-center cmt-btn async-task" href="post.php?id=${post['post_ID']}">
                                                    <i class="bi bi-chat-left"></i>
                                                    Comment
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                `;
            });
        $(".posts").append(output);
    }
    else {
        reachedEnd = true;
        console.log("Reached end = " + reachedEnd);
        $(".loading").css("display", "none");
        $(".main-cont").append( `
        <div class="row my-3 mt-5 ending">
            <div class="col-md-8 offset-md-2 d-flex justify-content-center">
            <p class="text-secondary font-italic">Phew! You've reached the end. That was fun, wasn't it? </p>
            </div>
        </div>`)
    }

}

function outputUserRoleColor(userRole) {
    if(userRole == 'admin') {
        return "text-danger";
    }
    else return "text-dark";
}

function addLoading() {
	$('.navbar').css("opacity", "40%");
	$('.main-cont').css("opacity", "40%");
	$('.loading-logo').removeClass('d-none');
}

function checkOwnedPostOrAdmin(postAuthorID, currentUserID, userRole) {
    if(postAuthorID == currentUserID || userRole == 'admin')
        return true;
    else return false;
}

function readMoreAtIndex(postContent, postID) {
    if (postContent.length > 190) {
        let postContentCut = postContent.substr(0, 190);
        let lastSpacePost = postContentCut.lastIndexOf(' ');

        if(lastSpacePost != -1)
            finalPostContent = postContentCut.substr(0, lastSpacePost);
        else finalPostContent = postContentCut;

        finalPostContent  += `... <a class="text-secondary async-task" href="post.php?id=${postID}">Read more</a>`;
        return finalPostContent;
    }
    else return postContent;
}

function checkIsLiked(likeBtn) {
    if(likeBtn.classList.contains("text-danger")) {
        return true;
    } else return false;
}

function switchLikeIconAnimation(isLiked, likeIcon) {
    likeIcon.classList.add("heart-anim");
    setTimeout(() => {
        likeIcon.classList.remove("heart-anim");
    }, 400);
    if(isLiked == true) {
        likeIcon.classList.remove("bi-heart");
        likeIcon.classList.add("bi-heart-fill");
        likeIcon.parentNode.classList.remove('text-dark')
        likeIcon.parentNode.classList.add('text-danger');
    }
    else {
        likeIcon.classList.remove("bi-heart-fill")
        likeIcon.classList.add("bi-heart");
        likeIcon.parentNode.classList.remove('text-danger')
        likeIcon.parentNode.classList.add('text-dark');
    }
}

function checkAddOrRemoveLike(postID, isLiked) {
    let addLike =  "&addlike=true";
    let removeLike = "&removelike=true";
    let dataSend = "id=" + postID;
    if(isLiked == true) dataSend += removeLike;
    else dataSend += addLike;
    return dataSend;
}

function ajaxLike(postID, isLiked, likeIcon, totalLikePost) {
    let xhr = new XMLHttpRequest();
    dataSend = checkAddOrRemoveLike(postID, isLiked);
    let request = "likemanager.php";
    xhr.open("POST", request, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if(this.status == 200) {
            let newTotalPostLike = JSON.parse(this.responseText)['post_no_likes'];
            if(newTotalPostLike != "error") {
                updateTotalLikePost(newTotalPostLike, totalLikePost);
                isLiked = !isLiked;
                switchLikeIconAnimation(isLiked, likeIcon);
            } else {
                location.reload();
                $(window).scrollTop(0);
            }
        }
    }
    xhr.send(dataSend);
}

function updateTotalLikePost(newTotalLike, totalLikePost) {
    let icon = `<i class="bi bi-heart-fill text-danger"></i>  `;
    totalLikePost.innerHTML = icon + newTotalLike;
}

function outputEditBtns() {
    $('.option-btn-wrapper').toggleClass('d-none');
    $('.coverbg').toggleClass('low-opacity');
    $('.main-avatar').toggleClass('low-opacity');
}
