(function ($, Drupal) {
  Drupal.behaviors.sopremaAccessFront = {
    attach: function (context, settings) {

      $('a.reset-pass-link', context).click(function (e) {
        e.preventDefault();
        $('.block--soprema-access.soprema-access', context).toggleClass('reset-form-active');
      });

      $('a.go-back-link', context).click(function (e) {
        e.preventDefault();
        $('.block--soprema-access.soprema-access', context).toggleClass('reset-form-active');
      });




      var values = [];

      $.each($(".administrative-area").prop("options"), function(i, opt) {
        values[opt.value] = opt.textContent
      });

      console.log(values);

      console.log(values.join());

    }
  };
})(jQuery, Drupal);