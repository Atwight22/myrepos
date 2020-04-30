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
            for (var i = data.comments.length-1; i >= 0;  i--) {
                var beforeDate = moment(data.comments[i].created_at, "YYYY-MM-DD HH:mm"); 
                var date = beforeDate.format('YYYY/MM/DD/ HH:mm');
                var html = `
                            <div class="media comment-visible">
                                <div class="media-body comment-body">
                                    <div class="row">
                                        <span class="comment-body-user" id="name">${data.comments[i].name}</span>
                                        <span class="comment-body-time" id="created_at">${date}</span>
                                        <button type="button" name="edit" value="${data.comments[i].comment}" onclick="edit(this.value,${data.comments[i].id})">編集</button>
                                        <button type="button" name="delete" value="${data.comments[i].comment}" onclick="del(this.value,${data.comments[i].id})">削除</button>
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