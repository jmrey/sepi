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
    $( 'textarea.editor' ).ckeditor(config);
});

