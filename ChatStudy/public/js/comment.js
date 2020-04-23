$(function() {
    get_data();
});

function get_data() {
    $.ajax({
        url: "result/ajax/",
        dataType: "json",
        // 成功した場合
        success: data => {
            $("#comment-data")
                .find(".comment-visible")
                .remove();
            // 新着コメントを最下位表示にする
            for (var i = 0; i < data.comments.length;  i++) {
                var html = `
                            <div class="media comment-visible">
                                <div class="media-body comment-body">
                                    <div class="row">
                                        <span class="comment-body-user" id="name">${data.comments[i].name}</span>
                                        <span class="comment-body-time" id="created_at">${data.comments[i].created_at}</span>
                                    </div>
                                    <span class="comment-body-content" id="comment">${data.comments[i].comment}</span>
                                </div>
                            </div>
                        `;
        
                $("#comment-data").append(html);
            }
        },
        error: () => {
            alert("ajax Error");
        }
    });

    setTimeout("get_data()", 5000);
}

$('.comment').click(function(){
    var index = $('.comment').index(this);
    edit_comment(index);
});

function edit_comment(index){
    $.ajax({
        url: "result/ajax/",
        dataType: "json",
        // 成功した場合
        success: data => {
            $('textarea[name="comment"]').val(data.comments[index].comment);
        }
    });

}