
@extends('layouts.app')


@section('content')

<div class="chat-container row justify-content-center">
    <div class="chat-area">
        <div class="card">
            <div class="card-header">チャット</div>
            <div class="card-body chat-card">
            <!-- comment-dataにコメント埋め込み -->
                <div id="comment-data"></div>
                <script>
                    // edit()は編集ボタン押下時に呼ばれる
                    function edit(comment){
                        document.getElementById( "input-comment" ).value = comment;
                        alert(comment);
                    

                    }
                </script>
            </div>
        </div>
    </div>
</div>
        <form method="POST" action="{{route('add')}}">
    @csrf
    <div class="comment-container row justify-content-center">
        <div class="input-group comment-area">
        <!--SHIFT + ENTERでも送信可能 -->
                <textarea class="form-control" id="input-comment" name="comment" placeholder="メッセージを送信 (shift + Enter)"
                aria-label="With textarea"
                onkeydown="if(event.shiftKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
                <button type="submit" id="submit" class="btn btn-outline-primary comment-btn">送信</button>
        </div>
    </div>
</form>
        
    </div>
@endsection

@section('js')
<script src="{{ asset('js/comment.js') }}"></script>
@endsection

