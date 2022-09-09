// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import 'bootstrap';
import bsCustomFileInput from 'bs-custom-file-input';

// start the Stimulus application
import './bootstrap';
const $ = require('jquery');

bsCustomFileInput.init();

$(document).ready(function() {
    // When you click on genre checkbox
    $('.checkbox-genre').click(function() {
        // Stock all genre selected in var string
        var values = $('.checkbox-genre:checkbox:checked').map(function() {
            return this.value;
        }).get();

        // Put it in hidden input value
        $("#form_listGenre").val(values);
        // Submit the form
        $("#genre_form").submit();
    });
});