@extends('layouts.app')

@section('content')

    <div class="chat-container row justify-content-center">
        <div class="chat-area">
            <div class="card">
                <div class="card-header">チャット</div>
                    <div class="card-body chat-card">
                        @include('components.comment')
                        @include('components.comment')
                        @include('components.comment')
                        @include('components.comment')
                        @include('components.comment')
                        @include('components.comment')
                        @include('components.comment')
                        @include('components.comment')
                        @include('components.comment')
                        @include('components.comment')
                        @include('components.comment')
                        @include('components.comment')
                        @include('components.comment')
                        @include('components.comment')
                        @include('components.comment')
                        @include('components.comment')
                    </div>
                 </div>
            </div>
        </div>
        <form method="POST" action="{{route('add')}}">
                <div class="comment-container row justify-content-center">
                    <div class="input-group comment-area">
                        <input type="file" name="file" style="display:none"></input>
                        <button id="upload_chat_button" class="btn btn-small btn-inverse"><i class="icon-upload icon-white"></i></button>
                        <textarea class="form-control" id="comment" name="comment" placeholder="input message" aria-lavel="With textarea"></textarea>
                        <button type="input-group-prepend button" class="btn btn-outline-primary comment-btn">送信</button>
                    </div>
                </div>
        </form>
                <div class="card-body chat-card">
                    @foreach ($comments as $item)
                    @include('components.comment', ['item' => $item])
                    @endforeach
                </div>
        
    </div>
@endsection
