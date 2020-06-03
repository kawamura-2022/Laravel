@extends('layouts.app')

{{-- TODO アカウント登録内容の変更ができるように--}}
@section('content')
<div class="container">
    <p>
        ユーザネーム -> {{$username}}<br>
        メールアドレス -> {{$email}}<br>
        登録日 -> {{$created_at}}<br>
        <br><h5>単語数</h5>
        名詞 -> {{$num_noun}}<br>
        動詞 -> {{$num_verb}}<br>
        形容詞 -> {{$num_adj}}<br>
    </p>

</div>
@endsection
