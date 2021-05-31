let limit = 5;
let offset = 0; // default offset;
let reachedEnd = false;
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
    $('.notification').popover('show');
    setTimeout(() => {
        $('.notification').popover('hide');
    }, 3000);


    $(".input-create").click(() => {
        $(".form-create").submit();
    });

    $(window).scroll(function() {
        if((($(window).scrollTop() + $(window).height()) >= $(document).height()) && reachedEnd == false) {
            offset += 5;
            console.log("loading new posts from record " + offset + " to " + (offset + 5) + " (limit = " + limit + ")");
            let xhr = new XMLHttpRequest();
            let request = "getmoreposts.php?offset=" + offset + "&limit=" + limit;
            xhr.open("GET", request, true);
            xhr.onload = function() {
                if(this.status == 200) {
                    //console.log(this.responseText);
                    let newPostList = JSON.parse(this.responseText);
                    outputNewPosts(newPostList);
                }
            }
            xhr.send();
        }
    });

});

function outputNewPosts(newPostList) {
    if(newPostList != '') {
        let output = '';
        newPostList.forEach(post => {
            output += `
                <div class="row my-3">
                    <div class="col-md-8 offset-md-2">
                        <a class="a-post" href="post.php?id=${post['post_ID']}">
                            <div class="card post">`;

                if (post['post_img_url'] != null) {
                    output += `
                                <img class="card-img-top post-img" src="${post['post_img_url']}" alt="Post image">`;
                }
                output += `
                                <div class="card-body post-body pb-2">
                                    <h5 class="card-title post-title font-weight-normal">${post['post_title']}</h5>
                                    <p class="card-text post-content">${post['post_content']}</p>
                                    <div class="author-date d-flex mt-4">
                                        <a class="text-dark font-weight-bold d-flex align-items-center" href="profile.php?id=">
                                            <img class="avatar-post mr-2" src="images/default/defaultUserAvatar.png" alt="">
                                            ${post['user_username']}
                                        </a>
                                        <p class="font-weight-light my-2 post-info ml-auto">${post['post_date_time']}</p>
                                    </div>
                                    <div class="no-like-cmt d-flex mt-2">
                                        <p class="post-info mb-0 mr-3"><i class="bi bi-hand-thumbs-up-fill text-primary"></i> 25</p>
                                        <p class="post-info mb-0"><i class="bi bi-chat-left-fill text-secondary"></i> 8</p>
                                    </div>
                                    <hr class="mb-2">
                                    <div class="interaction">
                                        <div class="row">
                                            <a class="text-dark col-md-6 text-center" href="#">
                                                <i class="bi bi-hand-thumbs-up"></i>
                                                Like
                                            </a>
                                            <a class="text-dark col-md-6 text-center" href="post.php?id=${post['post_ID']}">
                                                <i class="bi bi-chat-left"></i>
                                                Comment
                                            </a>
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

