$(document).ready(function () {
    $ummu.mygallery.photos.show();
    $ummu.mygallery.photos.btn_mygallery_photos_submit();

    bsCustomFileInput.init()

    var btn = document.getElementById('btnResetForm')
    var form = document.querySelector('form')
    btn.addEventListener('click', function() {
        form.reset()
    })
});