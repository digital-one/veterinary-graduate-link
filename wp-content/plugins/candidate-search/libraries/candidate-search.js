$(function(){

activate_search = function(){
$('#candidate-search').on('submit',function(e){
        e.preventDefault();

      _form = $(this); 
       _form.off('submit');
    candidate_search(_form);
    });
}

candidate_search = function(_form){
    if(console) console.log('search')
var dat = _form.find(':input').serialize();
 if(console) console.log(dat);
 $.ajax( {
    type: "POST",
    url: MyAjax.ajaxurl,
    dataType: "json",
    data: dat,
    success: function(data) {
        if(console) console.log(data);
    	if(data.total_results==0){
        _message = 'Sorry, no results found.';
        show_notification(_message);
        activate_search();
        } else {
       _form.submit();
        }
    }
});

}

activate_search();
//
});