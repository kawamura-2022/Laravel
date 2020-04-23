@extends('layouts.app')

<head>
    <link href="{{ asset('css/my_arrange.css') }}" rel="stylesheet">
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
            @endauth
            <br>
            <div>
                <a class="btn btn-primary" href="#features">Learn More</a>
            </div>
        </div>
    </div>

    {{-- title 以外のコンテンツ --}}
    @auth
        <section id='features'>
        <div class="flex-center position-ref">
            <div id='box_left' class="disp_from_right">
                <div id="box_align_blank_auth"></div>
                <p class="b-break">
                    　あなた専用の辞書に単語を登録します．本サイトでは文章を入力し，その文章から複数のキーワードを取り出すことができます．
                    そして，キーワードを登録することで，手動で登録するよりも簡単に辞書を構築していくことができます．<br>
                    　入力する文章として，コピペを利用することができます．
                </p>
                <div class="row justify-content-center">
                    <a class="btn btn-primary" href="{{ url('/word_split') }}">単語登録</a>
                </div>
            </div>

            <div id='box_right' class="flex-center position-ref full-height d-none d-sm-block">
                <img class="top_img_size disp_from_right" src="{{ asset('images/free_word_spliti.jpg') }}">
            </div>
        </div>
        </section>

        <section id='features'>
        <div class="flex-center position-ref">
            <div id='box_left' class="d-none d-sm-block">
                <img class="top_img_size disp_from_left" src="{{ asset('images/free_dispword_02.jpg') }}">
            </div>
            <div id='box_right' class="disp_from_left">
                <div id="box_align_blank_auth"></div>
                <p class="b-break">
                    　あなた専用の辞書と強制連想法を利用して，素晴らしいアイデアを創造できます．<br>
                    強制連想法はソフトバンクの創始者である孫正義も使用したことがある方法です．
                    孫正義は，二つの単語帳を用意し，同時に開き出てきた組み合わせでビジネスアイデアを作り出す練習を行っていました．
                    そして，”音声装置付きの多国語翻訳機”を思いつき企業へ売り込みをし，ソフトバンクの前身となる会社の立ち上げ資金を獲得することができました．
                </p>
                <div class="row justify-content-center">
                    <a class="btn btn-primary" href="{{ url('/word_display') }}">単語表示</a>
                </div>
            </div>
        </div>
        </section>

    @else
        <section id='features'>
        <div class="flex-center position-ref">
            <div id='box_left' class="disp_from_right">
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

            <div id='box_right' class="flex-center position-ref full-height d-none d-sm-block">
                <img class="top_img_size disp_from_right" src="{{ asset('images/free_regist.jpg') }}">
                {{-- <a href="https://www.photo-ac.com/profile/810857">fujiwara</a>さんによる<a href="https://www.photo-ac.com/">写真AC</a>からの写真 --}}
            </div>
        </div>
        </section>

        <section id='features'>
        <div class="flex-center position-ref">
            <div id='box_left' class="d-none d-sm-block">
                <img class="top_img_size disp_from_left" src="{{ asset('images/free_login.jpg') }}">
                {{--<a href="https://www.photo-ac.com/profile/2128729">實悠希</a>さんによる<a href="https://www.photo-ac.com/">写真AC</a>からの写真 --}}
            </div>
            <div id='box_right' class="disp_from_left">
                <div id="box_align_blank"></div>
                <p class="b-break">
                    　　既にアカウント登録済みのあなたに伝えることはありません．<br>
                    　強制連想法を利用して，素晴らしいアイデアを創造してください．
                </p>
                <div class="row justify-content-center">
                    <a class="btn btn-primary" href="{{ route('login') }}">ログイン</a>
                </div>
            </div>
        </div>
        </section>
    @endauth

    <script type="text/javascript">
        ScrollReveal().reveal('.disp_from_left', {
            origin: 'left'
            ,distance: '30vw'
            ,duration: 2500 //アニメーションの長さ
            ,delay: 800     //アニメーションの遅延
            ,reset: true  //もう一度同じアニメーションで表示させるか
            ,viewFactor : 0.35 //どれくらい見えたら表示するか
        });

        ScrollReveal().reveal('.disp_from_right', {
            origin: 'right'
            ,distance: '30vw'
            ,duration: 2500 //アニメーションの長さ
            ,delay: 800     //アニメーションの遅延
            ,reset: true  //もう一度同じアニメーションで表示させるか
            ,viewFactor : 0.35 //どれくらい見えたら表示するか
        });
    </script>

</div>
@endsection
