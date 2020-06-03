@extends('layouts.app')

@section('content')
<div class="container">
    <div id='user_operation'>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('強制連想法') }}</div>
                    <div class="card-body">

                        <div id="area_word1">
                            <p>ここに単語が表示されます</p>
                        </div>
                            <div class="col-md-6" style="padding-top: 8px">
                            <form id="form_word1">
                                <input type="radio" name="celected_class" value='1' checked="checked">
                                <label for="class_noun">名詞</label>
                                <input type="radio" name="celected_class" value='2'>
                                <label for="class_verb">動詞</label>
                                <input type="radio" name="celected_class" value='3'>
                                <label for="class_adj">形容詞</label>
                                    <input type="button" value="next word" class="btn btn-primary" onclick='ajax_get_word(area_word1, form_word1)' >
                            </form>
                            </div>

                        <div id="area_word2">
                            <p>ここに単語が表示されます</p>
                        </div>
                            <div class="col-md-6" style="padding-top: 8px">
                            <form id="form_word2">
                                <input type="radio" name="celected_class" value='1' checked="checked">
                                <label for="class_noun">名詞</label>
                                <input type="radio" name="celected_class" value='2'>
                                <label for="class_verb">動詞</label>
                                <input type="radio" name="celected_class" value='3'>
                                <label for="class_adj">形容詞</label>
                                    <input type="button" value="next word" class="btn btn-primary" onclick='ajax_get_word(area_word2, form_word2)' >
                            </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- javascript --}}
    <script type="text/javascript">
        function celect_mode(name_form){
            // console.log('id -> ', document.getElementById(name_form.id))
            for(var i=0; i<document.getElementById(name_form.id).celected_class.length; i++){
                if(document.getElementById(name_form.id).celected_class[i].checked){
                    return mode = document.getElementById(name_form.id).celected_class[i].value;
                }
            }
        }

        function ajax_get_word(id_area, name_form){
            console.log('start test function')
            var id_target = id_area.id;
            let word = null;

            var mode = celect_mode(name_form);
            // var mode = '1';
            console.log('mode -> ' + mode + '  type -> ' +  typeof mode)
            console.log('id_target -> ' + id_target + '  type -> ' +  typeof id_target)

            $.ajax({
                url: './get_word'
                ,type: 'get'
                ,data: { mode: mode }
                ,dataType: 'json'
            }).done(function (data) { // 1つめは通信成功時のコールバック
                console.log('data ' + data, typeof data);
                Object.keys(data).forEach(function (key) {
                    console.log(key + " -> " + data[key] + " ....");
                });
                word = data.word;
                console.log('Got back ' + word, typeof word);
                document.getElementById(id_target).innerHTML = '<p>'+word+'</p>';
            }).fail(function(){
                    console.error("読み込み失敗");
            });
        }
    </script>

</div>
@endsection
