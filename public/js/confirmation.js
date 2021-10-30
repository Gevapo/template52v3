/**
 * https://bootstrap-confirmation.js.org/index.html
 */

jQuery(function ($) {
    $(document).ready(function () {
        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            title: 'Weet je het zeker?',
            content: 'Deze actie is onomkeerbaar!',
            btnOkClass: 'btn btn-xs btn-danger',
            btnOkLabel: '<i class="fa fa-share" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ja',
            btnCancelClass: 'btn btn-xs btn-info',
            btnCancelLabel: '<i class="fas fa-ban" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Stop!',
        });
    });//einde doc.ready
});
