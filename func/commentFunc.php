<?php
    function getCommentList($conn, $postID, $limit, $offset = 0) {
        $sql = "SELECT DISTINCT c.cmt_ID, c.cmt_content, c.cmt_author_ID, u.user_username, c.cmt_date_created FROM comments c, users u, posts p WHERE c.cmt_author_ID = u.user_ID and c.cmt_post_ID = ? ORDER BY c.cmt_ID DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $postID, $limit, $offset);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results->fetch_all(MYSQLI_ASSOC);
    }

    function outputComment($conn, $comment, $type) {
        $output = '';
        $output .= '
        <div class="row my-2">
            <div class="col-md-8 offset-md-2">
                <div class="comment card">
                    <div class="user-cmt-info d-flex">
                        <a class="text-dark font-weight-bold d-flex align-items-center" href="profile.php?id=' . $comment['cmt_author_ID'] . '">
                            <img class="avatar-post mr-2" src="images/default/defaultUserAvatar.png" alt="">
                            ' . $comment['user_username'] . '
                        </a>
                        <p class="font-weight-light my-2 post-info ml-auto">' . outputContentDateTime($conn, $comment['cmt_date_created']) . '</p>
                    </div>
                    <p class="comment-content mt-2 mb-2">' . $comment['cmt_content'] . '</p>
                </div>
            </div>
        </div>
        ';

        if($type == "echo") echo $output;
        else if($type == "return") return $output;
    }

    function outputCommentList($conn, $commentList) {
        $output = '';
        foreach ($commentList as $comment) {
            $output .= outputComment($conn, $comment, "return");
        }
        echo $output;
    }

    function countComment($commentList) {

    }
?>