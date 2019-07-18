var zoomify_url = 'https://openbookpublishers.com/resources/zoomify.php';

$(document).ready(function () {
    $('figure > img').each(function(i, obj) {
        img_url = $(this).prop('src');
        img_id  = $(this).prop('id');
        img_alt = encodeURI($(this).prop('alt'));
        doc_url = window.location.href.split('#')[0];
        return_url = encodeURI(doc_url + '#' + img_id);

        $(this).wrap($('<a>',{
            href: zoomify_url + '?src=' + $(this).prop('src') + '&return=' + return_url + '&caption=' + img_alt
        }))
    });
});
