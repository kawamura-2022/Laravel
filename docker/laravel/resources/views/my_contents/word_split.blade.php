@extends('layouts.app')

@section('content')
<div class="container">
    <div id='input_usertext'>
        <div class="row justify-content-center">
            <form name="form_user" class='custom_form'>
                <input type="checkbox" name="word_class" value="名詞" checked="checked">名詞
                <input type="checkbox" name="word_class" value="動詞" checked="checked">動詞
                <input type="checkbox" name="word_class" value="形容詞" checked="checked">形容詞
                <b>チェックボックスで，登録したい品詞を選んでください</b><br>

                {{-- <input type="text" id="user_text" value="" placeholder="文章を入力する"> --}}
                <textarea id="user_text" cols="50" rows="3" placeholder="文章を入力する" ></textarea>
                <br>
                <input type="button" class="btn btn-primary" value="分割実行" onclick="clearHTML();ajax_split_word();">

            </form>
        </div>
    </div>


    <div id='registermenu'>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('登録する単語一覧') }}</div>
                    <div class="card-body">
                        {{-- <form method="POST" action="{{ route('register') }}"> --}}
                            @csrf


                                {{-- jsのスクリプトで，htmlの要素がsubmit_wordへ，順番に入れられる --}}
                                <div id='submit_word'>
                                        <form name="form_word1">
                                            <b>単語1</b>
                                            <input type="radio" name="is_use" value=1 checked="checked">使う
                                            <input type="radio" name="is_use" value=0>使わない
                                            <br>

                                            <input type="text" name="word" placeholder="単語を入力する" value="">
                                            <input type="radio" name="word_class" value=1 checked="checked">名詞
                                            <input type="radio" name="word_class" value=2>動詞
                                            <input type="radio" name="word_class" value=3>形容詞
                                        </form>
                                        {{-- 行間調整 --}}
                                        <br>
                                </div>
                                <div id='add_word_form'>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="onclick"  onclick="createForm();">
                                                {{ __('登録する単語を増やす') }}
                                            </button>
                                        </div>
                                    </div><br>
                                </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="onclick" class="btn btn-primary" onclick="register_word2db();">
                                        {{ __('自分の辞書へと登録する') }}
                                    </button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        //ユーザが決めた設定で，単語を登録するフォーム form名を取る所以外は，事前に決めたid,name名で指定してある
        function register_word2db(){
            const startTime = Date.now();

            for(var i=0; i<document.forms.length; i++){
                // var use_doc = document.forms[i]; // 変数にしても型がおかしいのかエラーが出る．->formの名前を使う時は，インデックスで指定
                // console.log('doc.name -> ', document.forms[i].name);
                if(document.forms[i].is_use != null){
                    console.log('target form -> ', document.forms[i].name);

                    //DBへ登録する単語かを判定
                    var isRegister = 0;
                    for(var j=0; j<document.forms[i].is_use.length; j++){
                        if(document.forms[i].is_use[j].checked){
                            isRegister = document.forms[i].is_use[j].value;
                        }
                    }
                    console.log("Do we register? -> ", isRegister)
                    if(isRegister == 0){continue;}

                    //登録する，単語と品詞を取り出す
                    var target_word = document.forms[i].word.value;
                    if(target_word == ''){console.log('empty word in ', document.forms[i]); continue;}
                    for (var j=0; j<document.forms[i].word_class.length; j++){
                        // i番目のチェックボックスがチェックされているかを判定
                        if (document.forms[i].word_class[j].checked){
                            var target_class = document.forms[i].word_class[j].value;
                        }
                    }
                    console.log('target_word ->', target_word, ' target_class ->', target_class, typeof target_class);

                    //DBへ登録するAPI呼び出し
                    $.ajax({
                        url: './regist_word'
                        ,type: 'get'
                        ,data: { word: target_word
                                ,class : target_class
                        }
                        // ,async : true
                        ,dataType: 'json'
                    }).done(// 1つめは通信成功時のコールバック
                        function (response) {
                            console.log('get response');
                            console.log(response);
                        }).fail(function(response){
                                console.error("接続失敗 : ajax ./regist_word is failed");
                                console.error(response);
                        });
                }
            }

            alert('単語の登録を終了しました');
            clearHTML();
            createForm();

            const endTime = Date.now(); // 終了時間

            console.log(endTime - startTime); // 何ミリ秒かかったかを表示する
        }

        //API側で使う，品詞のリストを返す
        //form タグで使用したname,checkboxで使用したnameを指定してある
        function create_word_classes(){
            var word_classes=[];
            for (var i = 0; i < document.form_user.word_class.length; i++){
                // i番目のチェックボックスがチェックされているかを判定
                if (document.form_user.word_class[i].checked){
                    word_classes.push(document.form_user.word_class[i].value);
                }
            }
            // console.log(word_classes+word_classes.length)
            return word_classes;
        }

        function clearHTML(){
            console.log(document.getElementById('submit_word'), ' is clear');
            document.getElementById('submit_word').innerHTML = '';//既存の分割を消去
        }

        //適当なdiv に，htmlのコードを追加
        function insertHTML(res_word_dict){
            var cnt=1; //フォームの表示用の変数
            Object.keys(res_word_dict).forEach(function(key) {
                var word = res_word_dict[key][0];
                var word_class = res_word_dict[key][1];
                // console.log('foreach -> ', key, res_word_dict[key]);
                // console.log('word -> ', word, word_class);

                // var insert_html = '<b>'+word+'</b>'+'  '+word_class+'<br>'
                var radio_noun = '<input type="radio" name="word_class" value=1>名詞';
                var radio_verb = '<input type="radio" name="word_class" value=2>動詞';
                var radio_adj =  '<input type="radio" name="word_class" value=3>形容詞';
                if(word_class =='名詞'){
                    radio_noun = '<input type="radio" name="word_class" value=1 checked="checked">名詞';
                }else if(word_class =='動詞'){
                    radio_verb = '<input type="radio" name="word_class" value=2 checked="checked">動詞';
                }else{
                    radio_adj = '<input type="radio" name="word_class" value=3 checked="checked">形容詞';
                }
                var insert_html = '<form name="form_word'+key+'">'
                                    +'<b>単語'+cnt+' : </b>'
                                    +'<input type="radio" name="is_use" value=1 checked="checked">使う'
                                    +'<input type="radio" name="is_use" value=0>使わない' +'<br>'

                                    +'<input type="text" name="word" value='+word+'>'
                                    +radio_noun
                                    +radio_verb
                                    +radio_adj
                                    +'</form><br>';
                document.getElementById('submit_word').insertAdjacentHTML('beforeend', insert_html);
                cnt++;
            });
        }

        function ajax_split_word(){

            var input_text = document.getElementById("user_text").value;
            var word_classes = create_word_classes();

            // 抽出対象の品詞がない場合は，APIにリクエストしない
            if (word_classes.length == 0) {
                alert("項目が選択されていません。");
                createForm()
                return
            }else{
                document.getElementById('submit_word').innerHTML = '文字を分割しています<br>';//既存の分割を消去
            }

            //形態素解析するAPI呼び出し
            $.ajax({
                url: './get_splited_word'
                ,type: 'get'
                ,data: { text: input_text
                        ,word_class : word_classes
                 }
                ,dataType: 'json'
            }).done(function (res_word_dict) { // 1つめは通信成功時のコールバック
                console.log(res_word_dict, typeof res_word_dict)
                /*
                returned sample -> { '1': ['単語', '品詞'], '3': ['肉寿司', '形容詞'], '2': ['雷', '名詞'], '10': ['雷', '名詞']}
                */

                //登録する単語をユーザが選べるように，抽出した単語を<div id='submit_word'>へと挿入
                clearHTML();
                insertHTML(res_word_dict);
            }).fail(function(response){
                    console.error("読み込み失敗");
            });


        }

        function createForm(){
            // console.log('num form -> ', document.forms.length);
            var num_word = document.forms.length-1;
            var insert_html ='<form name="form_word'+num_word+'">'
                            +'<b>単語'+num_word+'</b>'
                            +'<input type="radio" name="is_use" value=1 checked="checked">使う'
                            +'<input type="radio" name="is_use" value=0>使わない<br>'
                            +'<input type="text" name="word" placeholder="単語を入力する" value="">'
                            +'<input type="radio" name="word_class" value=1 checked="checked">名詞'
                            +'<input type="radio" name="word_class" value=2>動詞'
                            +'<input type="radio" name="word_class" value=3>形容詞'
                            +'</form><br>';
            document.getElementById('submit_word').insertAdjacentHTML('beforeend', insert_html);
        }

    </script>



</div>
@endsection
