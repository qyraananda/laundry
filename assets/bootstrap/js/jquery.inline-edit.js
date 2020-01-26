;(function($) {

    $.fn.inlineEdit = function(event, options, callback) {

        if(typeof(options) == 'function') {

            callback = options;
            options = {};

        }

        if(options == undefined) {

            options = {};

        }

        var IE = {

            inputClass: 'inline-edit-input',
            statusName: 'inline-edit-status',
            show: function(target){

                if(!IE.isShowing(target)) {

                    IE.setStatus(target, 1);
                    var text = $(target).text();
                    $(target).data('original-text', text)
                        .html(IE.inputTag(text, options));
                    IE.inputChild(target)
                        .focus()
                        .on('blur keypress', function(e){

                            if(e.type == 'blur' || (e.type == 'keypress' && e.keyCode == 13)) {

                                IE.hide(e, target);

                            }

                        });

                }

            },
            hide: function(e, target){

                if(IE.isShowing(target)) {

                    IE.setStatus(target, 0);
                    var text = IE.inputChild(target).val();
                    var originalText = $(target).data('original-text');

                    if(text == '') {

                        text = originalText;

                    }

                    $(target).text(text);

                    if(typeof(callback) == 'function') {

                        callback(text, originalText, $(target));

                    }

                }

            },
            inputChild: function(target){

                return $(target).find('.'+ IE.inputClass);

            },
            isShowing: function(target){

                return (IE.getStatus(target) == 1);

            },
            getStatus: function(target){

                return $(target).data(IE.statusName);

            },
            setStatus: function(target, status){

                $(target).data(IE.statusName, status);

            },
            inputTag: function(text, options){

                var type = options['type'];
                var attribute = '';
                var inputClass = IE.inputClass;

                if(typeof(options['attributes']) == 'object') {

                    $.each(options['attributes'], function(key, value){

                        if(key == 'class') {

                            inputClass += ' '+ value;

                        } else {

                            attribute += ' '+ key +'='+ value;

                        }

                    });

                }

                if(type == 'textarea') {

                    return '<textarea class="'+ inputClass +'" type="text"'+ attribute +'>'+ text +'</textarea>';

                }

                return '<input class="'+ inputClass +'" type="text" value="'+ text +'"'+ attribute +'>';

            }

        };

        $.each(this, function(key, target){

            $(target).data(IE.statusName, 0)
                .on(event, function(e){

                    IE.show(target);

                });

        });

    }

})(jQuery);