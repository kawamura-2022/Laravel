@extends('layouts.app')

<head>
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <script src="/js/scrollreveal.min.js"></script>
</head>

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            @auth
                <div class="title m-b-md">
                    さあ，言葉以上のアイデアを創り出そう
                </div>

            @else
                <div class="title m-b-md">
                    単語の組み合わせは有限<br>
                    でも，あなたの可能性は無限大
                </div>

                <div>
                    <a class="btn btn-primary" href="#features">Learn More</a>
                </div>

                <section id='features'>
                        <div id='box_left'>
                            <p class="b-break">
                                　僅か４項目を埋めるだけで，あなた専用の辞書を用意することができます.その辞書は，強制連想法を行うための辞書です．
                                辞書への登録方法は２つあります．１つ目は手動での単語登録です．
                                ２つ目の方法は，ユーザが入力した文章を単語レベルへと分割し，登録したい単語を選んでいく方法です．本サイト特有の方法で，自然言語処理の技術を応用したものになっています．
                                登録する項目は，名前，メアド，パスワード ，プライバシーの設定です．<br>
                                　プライバシーの設定をオフにしていただくと，あなた専用の辞書を作るのと同時に，
                                あなたが選んだ単語を全世界のユーザが利用する可能な辞書へと登録します．
                                プライバシーの設定をオンにするとで，あなた専用の辞書のみ作成します．<br>
                                　(現在，共用の辞書の利用ページを作成中です．)
                            </p>

                            <div class="row justify-content-center">
                                <a class="btn btn-primary" href="{{ route('register') }}">新規登録</a>
                            </div>
                        </div>

                        <div id='box_right'>
                            <img class="top_img_size" src="{{ asset('images/free_regist.jpg') }}">
                            {{-- <a href="https://www.photo-ac.com/profile/810857">fujiwara</a>さんによる<a href="https://www.photo-ac.com/">写真AC</a>からの写真 --}}
                        </div>
                </section>

                    <div id='box_left'>
                        <img class="top_img_size" src="{{ asset('images/free_login.jpg') }}">
                        {{--<a href="https://www.photo-ac.com/profile/2128729">實悠希</a>さんによる<a href="https://www.photo-ac.com/">写真AC</a>からの写真 --}}
                    </div>
                    <div id='box_right'>
                        {{--  --}}
                        <div id="box_align_blank"></div>
                        <p class="b-break">　既にアカウント登録済みのあなたに伝えることはありません．<br>
                            　強制連想法を利用して，素晴らしいアイデアを創造してください．
                        </p>
                        <div class="row justify-content-center">
                            <a class="btn btn-primary" href="{{ route('login') }}">ログイン</a>
                        </div>
                    </div>
            @endauth
        </div>


    </div>


    <script type="text/javascript">
        ScrollReveal().reveal('.disp_from_left', {
            duration: 1000 //アニメーションの長さ
            ,delay: 800     //アニメーションの遅延
            ,reset: true  //もう一度同じアニメーションで表示させるか
            ,viewFactor : 0.99 //どれくらい見えたら表示するか
        });

        ScrollReveal().reveal('.disp_from_right', {

            duration: 1000 //アニメーションの長さ
            ,delay: 800     //アニメーションの遅延
            ,reset: true  //もう一度同じアニメーションで表示させるか
            ,viewFactor : 0.99 //どれくらい見えたら表示するか
        });
    </script>

            {{-- <div class="links">
                <a href="https://laravel.com/docs">Docs</a>
                <a href="https://laracasts.com">Laracasts</a>
                <a href="https://laravel-news.com">News</a>
                <a href="https://blog.laravel.com">Blog</a>
                <a href="https://nova.laravel.com">Nova</a>
                <a href="https://forge.laravel.com">Forge</a>
                <a href="https://vapor.laravel.com">Vapor</a>
                <a href="https://github.com/laravel/laravel">GitHub</a>
            </div> --}}

@endsection