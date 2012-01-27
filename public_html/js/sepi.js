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

$(document).ready(function(){
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
});

