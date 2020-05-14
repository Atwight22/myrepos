
@extends('layouts.app')


@section('content')


<div class="chat-container row justify-content-center">
    <div class="chat-area">
        <div class="card">
            <div class="card-header" >チャット</div>
            <div class="card-body chat-card">
           
            <!-- comment-dataにコメント埋め込み -->
                <div id="comment-data"></div>
                <script>
               
                    // delete()は削除ボタン押下時に呼ばれる
                    function del(comment,id){
                        document.getElementById( "input-comment" ).value = comment;
                        document.getElementById("id").value = id;
                       
                    
                            if( confirm("本当に削除しますか？") ) {
                               
                                document.send.action = "{{route('delete')}}";
                                document.getElementById('submit').disabled = false;
                                document.getElementById('submit').click();
                                console.log(id,comment);
                            }
                    }
                    // edit()は編集ボタン押下時に呼ばれる
                    function edit(comment,id){
                        document.getElementById( "input-comment" ).value = comment;    
                        document.getElementById("id").value = id;
                        console.log(id,comment);
                        
                    }

                    function copy(comment){
                        navigator.clipboard.writeText(comment);
                        alert("コピーしました。");
                    }


                </script>
            </div>
        </div>
    </div>
</div>

        <form name="send" method="POST" action="{{route('add')}}">
            @csrf
            <div class="comment-container row justify-content-center">
                <div class="input-group comment-area">
                <!--SHIFT + ENTERでも送信可能 -->
                        <input type="hidden" name="comment_id" id="id">
                        <textarea class="form-control" id="input-comment" name="comment" placeholder="メッセージを送信 (shift + Enter)"
                        aria-label="With textarea"
                        onkeydown="if(event.shiftKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
                        <button type="submit" id="submit" class="btn btn-outline-primary comment-btn">送信</button>
                        
        </div>
    </div>
</form>
        <script>

            // DOMContentLoadedは最初のHTMLの読み込みが完了したら、css、画像、サブフレームの読み込みが完了するのを待たずに実行する。
            window.addEventListener('DOMContentLoaded',function(){
            document.getElementById('submit').disabled = true;
            //keyupはキーが離されたときイベント発生
            document.getElementById('input-comment').addEventListener('keyup',function(){
            // 入力値が1文字以下
            if (this.value.length < 1) {
                // 非活性
                document.getElementById('submit').disabled = true;
            } else {
                // 活性
                document.getElementById('submit').disabled = false;
            }
            },false);
            //changeは入力値が変更されたときイベント発生
            document.getElementById('input-comment').addEventListener('change',function(){
            if (this.value.length < 1) {
            document.getElementById('submit').disabled = true;
            }
            },false);
            },false);

               


                
        </script>

      
    </div>

@endsection



@section('js')
<script src="{{ asset('js/comment.js') }}"></script>
@endsection

