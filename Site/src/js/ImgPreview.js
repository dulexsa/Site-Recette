/**
 * Created by stocchetjo on 17.03.2017.
 */
var loadFile = function(event) {
    oldimg = $('.preview').attr('src');
    var preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
    newimg = preview.src;
    if(newimg.indexOf('/null') > -1) {
        preview.src = oldimg;
    }
};

$('.submit-button').on('click', function(event) {
    alert('This is a dummy submit button. It does nothing.');
    event.preventDefault();
});