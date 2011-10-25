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
        var form = el.parents('.goban.edit .board').parent();
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
});
