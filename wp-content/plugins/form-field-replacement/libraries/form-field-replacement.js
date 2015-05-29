$(function(){

init_form_field_replace = function(){
    //checkbox replacements

    var _checkboxes = $('input[type=checkbox]');
    _checkboxes.each(function(){
        var _parent_li = $(this).parents('li').eq(0),
            _box = $("<div>", {class: "checkbox"}),
            _label = $('label',_parent_li);
            _this = $(this);
        _parent_li.addClass('replace-checkbox');
        //_this.before(_box).hide();
          _this.before(_box);
        if($(_this).is(':checked')){
            _box.addClass('checked');
        }
        $(_box).add(_label).on('click',function(){
            if(_box.hasClass('checked')){
                _box.removeClass('checked');
                $(this).next().prop('checked', false);
              //  $(this).next().attr('checked', false)
            } else {
                _box.addClass('checked');
               // $(this).next().attr('checked', true)
                $(this).next().prop('checked', true);
            }
         
        })
    })


    //radio replacements

    var _radios = $('input[type=radio]');
    _radios.each(function(){
        var _parent_li = $(this).parents('li').eq(0),
            _box = $("<div>", {class: "radio"}),
            _label = $('label',_parent_li);
            _this = $(this);
        _parent_li.addClass('replace-radio');
        //_this.before(_box).hide();
          _this.before(_box);
        if($(_this).is(':checked')){
            _box.addClass('checked');
        }
        $(_box).add(_label).on('click',function(){
            _name = $(this).next().attr('name');
            _this_radio = $(this).next();
            _sibling_radios = $('input[name='+_name+']').not(_this_radio);
            _sibling_radios.each(function(){
                 $(this).next().prop('checked', false);
                 $(this).prev().removeClass('checked');
            })
            if(_box.hasClass('checked')){
                _box.removeClass('checked');
                $(this).next().prop('checked', false);
              //  $(this).next().attr('checked', false)
            } else {
                _box.addClass('checked');
               // $(this).next().attr('checked', true)
                $(this).next().prop('checked', true);
            }
         
        })
    })



    //file input replacements

    var _fields = $('input[type=file]');
    _fields.each(function(){
         _selector = $("<div>", {class: "file-select"}),
         _this = $(this),
         _parent_li = _this.parents('li'),
         _label = $('.gfield_label',_parent_li).text();
         _selector.append('<span class="button">Select</span>').prepend('<span class="value">'+_label+'</span>');
         _parent_li.css({
            'position':'relative'
         })
         _this.wrap('<div class="file-select-wrap" />').after(_selector);
         _this.on('change',function(){
            $('.value',_parent_li).text(_this.val());
         })
    })

    //select replacements
    var _selects = $('select');
    _selects.each(function(){
        _this = $(this)
        _parent_li = _this.parents('li'), 
        _label = $('.gfield_label',_parent_li).text();
        _this.select2({
            'placeholder':_label
        })
    })

  }

if($('.gfield_html').length<1){
       init_form_field_replace();
}
//init_form_field_replace();


});