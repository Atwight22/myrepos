var id =  getId();
$(function() {
    
  
    get_data(id);
    

});

function getId(){
    return $.ajax({
        type: 'GET',
        url: 'getId/',
        dataType : "json",
        async:false,
    }).responseText;
}

// getId().done(function(result) {
//     //成功時の処理
// }).fail(function(result) {
//     //失敗時の処理
// });

// function getId(){
//     return $.ajax({
//          type : "GET",
//          url : "getId/",
//          dataType : "json",
//          cache : false,
//          async:false,
         
//     }).responseText;
//  }
 
//  getId().done(function(data, status, xhr) {
//     //成功時の処理
    
//  }).fail(function(XMLHttpRequest, status, errorThrown) {
//     //失敗時の処理
//     alert("Ajax/error");
 
//  });





// function get_id(){

 
//     $.ajax({
//         type: 'GET',
//         url: "getId/", // url: は読み込むURLを表す
//         dataType: 'json', // 読み込むデータの種類を記入
//         async:false,
       
//     }).done(function (results) {
//             // 通信成功時の処理
          
           
//             console.log("results : " + results);
//            return results;
           
//     }).fail(function (jqXHR, textStatus, errorThrown) {
//             // 通信失敗時の処理
//             alert('ファイルの取得に失敗しました。');
//             console.log("ajax通信に失敗しました");
//             console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
//             console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
//             console.log("errorThrown    : " + errorThrown.message); // 例外情報
          
//     });
   
//     }
  



function get_data(id) {
   
    $.ajax({
        url: "result/ajax/",
        dataType: "json",
        // 成功した場合
        success: data => {
            $("#comment-data")
                .find(".comment-visible")
                .remove(); 
                console.log("aaa" + id);
            // 新着コメントを最下位表示にする
            for (var i = data.comments.length-1; i >= 0;  i--) {
               console.log("bbb" + data.comments[i].login_id);
                // ログイン時のユーザＩＤとコメント登録時のユーザＩＤを比較して合致すれば編集削除ボタン押下できる仕様にする？
                var beforeDate = moment(data.comments[i].created_at, "YYYY-MM-DD HH:mm"); 
                var date = beforeDate.format('YYYY/MM/DD/ HH:mm');
               
                var html = `
                            <div class="media comment-visible">
                                <div class="media-body comment-body">
                                    <div class="row">
                                        <span class="comment-body-user" id="name">${data.comments[i].name}</span>
                                        <span class="comment-body-time" id="created_at">${date}</span>
                                        
                                        
                                            <button type="button" class="comment-copy" id="copy" value="${data.comments[i].comment}" onclick="copy(this.value)">コピー</button>
                                            <button type="button" class="comment-edit" id="edit" name="edit" value="${data.comments[i].comment}" onclick="edit(this.value,${data.comments[i].id})">編集</button>
                                            <button type="button" class="comment-delete" id="delete" name="delete" value="${data.comments[i].comment}" onclick="del(this.value,${data.comments[i].id})" >削除</button>
                                           
                                            
                                        
                                       
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



