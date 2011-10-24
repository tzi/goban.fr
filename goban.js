$(function(){
    $( '.goban.edit .action' ).click(function(el){
        el = $(el.target);
        var index = el.parent().index( );
        var form = el.parents('.goban').next();
        if ( ! el.hasClass( 'stone' ) ) {
            el.addClass( 'stone black' );
            $('<input type="hidden" name="stone[' + index + ']" id="stone_' + index + '" value="X" />').appendTo(form);
        } else {
            if ( el.hasClass('black') ) {
                el.removeClass('black').addClass('white');
                form.find('#stone_' + index).val('O');
            } else {
                el.removeClass('stone white');
                form.find('#stone_' + index).remove();
            }
        }
    });
    var forms = $('<form action="?" method="post"><a href="?">Annuler</a> <button type="submit" name="edit" >Valider</button></form>').appendTo( $('.goban.edit').parent() );
    forms.each( function( i, form ) {
        form = $( form );
        form.prev().find( '.action.stone' ).each( function( j, action ) {
            var index = $( action ).parent().index();
            var value = 'O';
            if ( $( action ).hasClass( 'black' ) ) {
                value = 'X';
            }
            $('<input type="hidden" name="stone[' + index + ']" id="stone_' + index + '" value="' + value + '" />').appendTo(form);
        });
    }); 
    
    
});
