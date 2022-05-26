var homeAutoFillFired = false;

$(function () {
    "use strict";

    var updatePreviousAddressAttributes = function () {
        var i = 0;
        var children = $('.prev-address');
        children.each(function (index, child) {
            $(child).find('.prev-address').html(i + 1);
            $(child).find('input,textarea,select').each(function () {
                var name = $(this).attr('name');
                $(this).attr('name', name.replace(/(prev-address\[\d+\])(.*)/g, 'prev-address[' + i + ']$2'));
            });

            i++;
        });

        if (children.length > 1) {
            $('.remove-prev-address').show();
        } else {
            $('.remove-prev-address').hide();
        }
    };

    $(".remove-prev-address").click(function (e) {
        e.preventDefault();
        $(this).closest('.prev-address').remove();
        updatePreviousAddressAttributes();
        // $('form').validator('update');
    });

    $(".add-prev-address").click(function (e) {
        e.preventDefault();
        var new_child = $('.prev-address:first').clone(true).insertAfter('.prev-address:last');
        new_child.find('input,textarea,select').val('');
        updatePreviousAddressAttributes();
        // $('form').validator('update');
    });

    var homeAddressPreAutofillOnChange = function () {
        if (!homeAutoFillFired
            && $("#postcode").val().trim().length > 4) {
            $(".home-address-autofill").fadeIn();
            homeAutoFillFired = true;
        }
    };


    // Hide home address details beyond building and postcode
    $(".home-address-autofill").show();
    $("#postcode")
        .change(homeAddressPreAutofillOnChange)
        .keypress(homeAddressPreAutofillOnChange);

    // display the extra fields if they're already pre-filled by the browser on load
    homeAddressPreAutofillOnChange();

    if (typeof pca !== 'undefined') {
        pca.on("load", function (type, id, control) {
            control.listen(
                "populate",
                function (address) {
                    homeAddressPreAutofillOnChange();
                    $("input.home-address").change();
                }
            );
        });
    }
});
