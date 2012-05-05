/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var config = {
                linkShowAdvancedTab: false,
                scayt_autoStartup: true,
                enterMode: Number(2),
                toolbar_Full: [['Styles', 'Bold', 'Italic', 'Underline', 'SpellChecker', 'Scayt', '-', 'NumberedList', 'BulletedList'],
                                ['Link', 'Unlink'], ['Undo', 'Redo', '-', 'SelectAll']]

            };

$(document).on('ready', function(){
    //var useCKeditor = useCKeditor || false;
    if(typeof(useCKeditor) != 'undefined') {
        $( 'textarea.editor' ).ckeditor(config);
    }
    $('.toggle-notes').click(function () {
        var tr_parent = $(this).closest('tr');
        tr_parent.toggleClass('selected-tr');
        var tr_div = tr_parent.next('.tr-notes').toggleClass('selected-tr').find('div:first');
        tr_div.slideToggle('fast');
    });
    $('.notas form').each(function (i) {
        var $form = $(this);
        //alert($form.attr('id'));
        $form.submit(function (event) {
            event.preventDefault();
            //var $form = $(this),
            data = $form.serialize(),
            action = $form.attr('action');
            
            $.post(action, data, function (response) {
                $form.get(0).reset();
                $form.parents('.form').before(response);
                //alert(response);
            });
        });
    });
    $(".nota").alert();
    $('input.datepicker').each(function () {
        $(this).datepicker({
            showButtonPanel : true,
            dateFormat: 'yy-mm-dd',
            altFormat: 'dd MM, yy',
            altField: $(this).siblings('.alternate')
        });
    });
    if(typeof(useDropkick) != 'undefined') {
        $('.dk').dropkick({
            theme: 'main',
            change: function (value, label) {
                alert('You picked: ' + label + ':' + value);
            }
        });
    }
    if(typeof(useFileupload) != 'undefined') {
        $('#demo1').axuploader({
            url:'/documentos/upload/',
            onFinish:function(txt, files){
                alert('All files uploaded server return:' + txt);
            }
        });

    }
});

