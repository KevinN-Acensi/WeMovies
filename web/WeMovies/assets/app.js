// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import 'bootstrap';
import bsCustomFileInput from 'bs-custom-file-input';

// start the Stimulus application
import './bootstrap';
const $ = require('jquery');

bsCustomFileInput.init();

$(document).ready(function() {
    $('.checkbox-genre').click(function() {
        var values = $('.checkbox-genre:checkbox:checked').map(function() {
            return this.value;
        }).get();

        $("#form_listGenre").val(values);
        $("#genre_form").submit();
    });
});