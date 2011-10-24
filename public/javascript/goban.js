function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}


$(function(){
    $( '.goban.edit .action' ).click(function(el){
        el = $(el.target);
        var index = el.parent().index( );
        var form = el.parents('.goban .board').next();
        if ( ! el.hasClass( 'stone' ) ) {
            el.addClass( 'stone black' );
            $('<input type="hidden" name="stones[' + index + ']" id="stones_' + index + '" value="X" />').appendTo(form);
        } else {
            if ( el.hasClass('black') ) {
                el.removeClass('black').addClass('white');
                form.find('#stones_' + index).val('O');
            } else {
                el.removeClass('stone white');
                form.find('#stones_' + index).remove();
            }
        }
    });
    var forms = $('<form action="?id='+getUrlVars()['id']+'&edit='+getUrlVars()['edit']+'" method="post"><a href="?id='+getUrlVars()['id']+'">Annuler</a> <button type="submit" name="edit" >Valider</button></form>').appendTo( $('.goban.edit') );
    forms.each( function( i, form ) {
        form = $( form );
        form.prev().find( '.action.stone' ).each( function( j, action ) {
            var index = $( action ).parent().index();
            var value = 'O';
            if ( $( action ).hasClass( 'black' ) ) {
                value = 'X';
            }
            $('<input type="hidden" name="stones[' + index + ']" id="stones_' + index + '" value="' + value + '" />').appendTo(form);
        });
    }); 
    
    
});
