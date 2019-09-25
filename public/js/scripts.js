$(document).ready(function() {
    $(".navbar-burger").click(function() {
        $(".navbar-burger").toggleClass("is-active");
        $(".navbar-menu").toggleClass("is-active");
    });

    let hash = $(location).attr('hash');
    if(hash){
        $(hash).fadeOut(0).fadeIn(1500);
    }
});

PullToRefresh.init({
    mainElement: 'nav',
    triggerElement: 'nav',
    onRefresh: function(){ window.location.reload(); }
});

function replyPost(e){
    let post = $("#post-"+e.id)
    let form = post.find(".reply-post");
    form.show();
    console.log(form);
}

function cancelPost(e){
    let post = $("#post-"+e.id)
    let form = post.find("form");
    let controls = post.find("#controls");
    form.remove();
    controls.show();
}

function editPost(e){
    let post = $("#post-"+e.id);
    let details = post.find("#details");
    let controls = post.find("#controls");
    controls.hide();

    $.ajax({
        type: "GET",
        url: e.href,
        success: function(data){
            details.append(data);
        }
    });
}

function editPostStore(e){
    let post = $("#post-"+e.id);
    let form = post.find(".form-post");
    let controls = post.find("#controls");
    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success:function(){
            loadPost(e.id, form.attr('action'));
            form.remove();
            controls.show();
        }
    });
}

function loadPost(id, url){
    $.ajax({
        type: "GET",
        url: url+"/view",
        success: function(data){
            $("#post-"+id).find(".post").html(data);
        }
    });
}

function likePost(e){
    $.ajax({
        type: "POST",
        url: e.href,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(){
            loadPostLikes(e.id, e.href);
            if($(e).text().trim() == 'Like') {
                $(e).text('Unlike');
            } else {
                $(e).text('Like');
            }
        }
    });

}

function loadPostLikes(id, url){
    let post = $("#post-"+id);
    let likes = post.find("#likes");

    $.ajax({
        type: "GET",
        url: url+"/view",
        success: function(data){
            likes.html(data);
        }
    });
}

function deletePost(e){
    if(!confirm("Are you sure?")) return;
    $.ajax({
        type: "POST",
        url: e.href,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(){
            $("#post-" + e.id).fadeOut(300, function(){
                $(this).remove();
            });
            // /document.location.replace(document.referrer);
        }
    });
}

function cancelComment(e){
    let comment = $("#comment-"+e.id)
    let form = comment.find("form");
    let controls = comment.find("#controls");
    form.remove();
    controls.show();
}

function editComment(e){
    let comment = $("#comment-"+e.id);
    let details = comment.find("#details");
    let controls = comment.find("#controls");
    controls.hide();

    $.ajax({
        type: "GET",
        url: e.href,
        success: function(data){
            details.append(data);
        }
    });
}

function editCommentStore(e){
    let comment = $("#comment-"+e.id);
    let form = comment.find(".form-comment");
    let controls = comment.find("#controls");

    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success:function(){
            loadComment(e.id, form.attr('action'));
            form.remove();
            controls.show();
        }
    });
}

function loadComment(id, url){
    $.ajax({
        type: "GET",
        url: url+"/view",
        success: function(data){
            $("#comment-"+id).find(".comment").html(data);
        }
    });
}

function likeComment(e){
    $.ajax({
        type: "POST",
        url: e.href,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(){
            loadCommentLikes(e.id, e.href);
            if($(e).text().trim() == 'Like') {
                $(e).text('Unlike');
            } else {
                $(e).text('Like');
            }
        }
    });

}

function loadCommentLikes(id, url){
    let comment = $("#comment-"+id);
    let likes = comment.find("#likes");

    $.ajax({
        type: "GET",
        url: url+"/view",
        success: function(data){
            likes.html(data);
        }
    });
}

function deleteComment(e){
    if(!confirm("Are you sure?")) return;
    $.ajax({
        type: "POST",
        url: e.href,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(){
            $("#comment-" + e.id).fadeOut(300, function(){
                $(this).remove();
            });
            // /document.location.replace(document.referrer);
        }
    });
}
