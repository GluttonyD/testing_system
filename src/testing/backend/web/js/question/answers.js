var answers_count=$('#question-form').data('count');
$(document).ready(function () {
   $(document).on('click','#add-answer',function (e) {
       e.preventDefault();
       answers_count++;
       var input='';
       input+='<div id="answer-'+answers_count+'" class="row">';
       input+='<div class="form-group col-md-9">';
       input+='<label for="answer-text">Текст ответа</label>';
       input+='<input id="answer-text" class="form-control" name="QuestionForm[answers]['+answers_count+'][text]">';
       input+='</div>';
       input+='<div class="form-group col-md-3">';
       input+='<label for="right-answer">Правильный?</label>';
       input+='<select id="right-answer" class="form-control select2" name="QuestionForm[answers]['+answers_count+'][is_right]">';
       input+='<option selected="selected" value="1">Да</option>';
       input+='<option value="0">Нет</option>';
       input+='</select>';
       input+='</div>';
       input+='</div>';
       $('#question-answers').append(input);
   });

   $(document).on('click','#remove-answer',function (e) {
      e.preventDefault();
      if(answers_count>0) {
          var answer_id = '#answer-' + answers_count;
          $(answer_id).remove(answer_id);
          answers_count--;
      }
   });
});