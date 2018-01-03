/* 
 * JQuery Validator For Materializecss v.1 (https://github.com/SernikDev/JQuery-Validator-For-Materialize)
 * Copyright: 2018 Łukasz Zięć
 * MIT License (https://github.com/SernikDev/JQuery-Validator-For-Materialize/blob/master/LICENSE)
 */

$(document).ready(function () {

    $('form').on('submit', function (e) {
        e.preventDefault();

        var t = this;
        var d = $('input[type!=submit], textarea', t);
        var k = $('input[data-result=valid], textarea[data-result=valid]', t);
        var emptyError = "Pole nie może być puste";

        d.each(function () {
            var k = this;
            var tag = $(this).attr('id');
            var data = $(this).attr('data-result');

            if (!data) {
                addDataResultAttribute(k, 'invalid');
                checkIfErrorMessageAlreadyExists(k, tag, emptyError);
                $(k).addClass('invalid');
            }
        });

        if (d.length === k.length) {
            $.ajax({
                type: $(this).attr('method'),
                cache: false,
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'html',
                success: function (data) {
                    // Get some response from server side script
                }
            });
        }
    });

    $('input[type!=submit], textarea').on('blur', function () {
        var id = $(this).attr('id');
        var t = this;
        var emptyError = "Pole nie może być puste";
        var emailError = "Adres email jest niepoprawny";
        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

        /* Empty input validation with content message while data is required */
        if (!$(t).val() && $(t).attr('data-required') === 'required') {
            $(t).removeClass('valid').addClass('invalid');
            checkIfErrorMessageAlreadyExists(t, id, emptyError);
        } else {
            $(t).removeClass('invalid');
            $('span[data-id="' + id + '"]').remove();
            addDataResultAttribute(t, '');
        }
        ;

        /* Email input validation with content message whie data is required */
        if ($(t).val() && $(t).attr('data-type') === 'email' && $(t).attr('data-required') === 'required') {
            if (pattern.test($(t).val())) {
                $(t).addClass('valid');
                addDataResultAttribute(t, 'valid');
            } else {
                $(t).addClass('invalid');
                checkIfErrorMessageAlreadyExists(t, id, emailError);
            }
        }

        /* Add valid class for simple filled text fields */
        if ($(t).val() && $(t).attr('data-type') === 'text' && $(t).attr('data-required') === 'required') {
            $(t).addClass('valid');
            addDataResultAttribute(t, 'valid');
        }
    });

    function addDataResultAttribute(selector, result) {
        $(selector).attr('data-result', result);
    }

    function checkIfErrorMessageAlreadyExists(selector, id, message) {
        $('span[data-id="' + id + '"]').remove();
        if (!$('span[data-id="' + id + '"]').length) {
            $(selector).after('<span class="err msg" data-id="' + id + '">' + message + '</span>');
            addDataResultAttribute(selector, 'invalid');
        }
    }
});