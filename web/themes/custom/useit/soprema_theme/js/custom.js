/**
 * @file
 * Soprema Custom JS.
 */

 (function ($, Drupal) {

  'use strict';

  Drupal.behaviors.customJS = {
    attach: function (context, settings) {
      // Remove .form-inline class
      $('.block-views .views-exposed-form .form--inline')
          .once( 'customJS' )
          .removeClass( 'form-inline' )
          .addClass('row form-cols');

      // Add .col-*-* class to form items
      $('.block-views .views-exposed-form .form-item.form-group')
          .once( 'customJS' )
          .wrap( '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 form__item"></div' );

      // Add .col-xs-12 class to form actions
      // and righ align
      $('.block-views .views-exposed-form .form-actions.form-group')
          .once( 'customJS' )
          .wrap( "<div class='col-xs-12 text-align-right form__actions'></div>" );


      // Taxonomy overview page
      var btn_text = $('.path-admin .list-inline.local-actions a').text();

      $('.path-admin .list-inline.local-actions a')
          .once('customJS')
          .removeClass('btn-xs btn-success')
          .addClass('btn-primary').html('<span class="glyphicon glyphicon-plus"></span>&nbsp;' + btn_text);

      $('form.taxonomy-overview-terms .form-actions .form-submit')
          //.once('customJS')
          .removeClass('btn-success')
          .addClass('btn-primary');



      /*** TAX TERMS DECISION TREE ***/
      /*** Show only one tree ***/
      let term_param = $.urlParam('term_id');
      let term_parents = [];
      $('table[data-drupal-selector="edit-terms"] a.menu-item__link').once('customJS').click(function (e) {
        if (term_param === null) {
          e.preventDefault();
          let term_id = $(this).closest('td').find('input.term-id').val();
          window.location.href = window.location.href + '?term_id=' + term_id ;
        }
      });
      $('table[data-drupal-selector="edit-terms"] a.menu-item__link', context).each(function () {
        let term_id = $(this).closest('td').find('input.term-id').val();
        let term_parent = $(this).closest('td').find('input.term-parent').val();
        let term_depth = $(this).closest('td').find('input.term-depth').val();

        if (term_param === null) {
          if (term_parent != 0 && term_depth != 0) {
            $(this).closest('tr').hide();
          }
        }
        else {
          if (term_id != term_param && term_parent != term_param) {
            $(this).closest('tr').hide();
          }
          else {
            term_parents.push(term_id);
          }

          if ($.inArray(term_parent, term_parents) !== -1 && term_parents.length > 0) {
            $(this).closest('tr').show();
          }
        }
      });
      /*** END TAX TERMS DECISION TREE***/


      // Select hierarchical select
      //$('.shs-container .shs-field-container .shs-select').once('customJS').addClass('form-control');

      // Form bordered tables
      $('form .field--name-field-pr-application .field-multiple-table').removeClass('table-bordered');
      $('form .field--name-field-pr-advantages .field-multiple-table').removeClass('table-bordered');
      $('form .field--name-field-pr-conditioning .field-multiple-table').removeClass('table-bordered');
      $('form .field--name-field-as-layers .field-multiple-table').removeClass('table-bordered');
      $('form .field--name-field-notification-links .field-multiple-table').removeClass('table-bordered');
      $('form .form-item .field-add-more-submit').removeClass('btn-info').addClass('btn-link');
      $('form.node-form .form-actions .form-submit').removeClass('btn-success').addClass('btn-primary');

    }
  };


   $.urlParam = function(name){
     let results = new RegExp('[\?&]' + name + '=([^]*)').exec(window.location.href);
     if (results==null){
       return null;
     }
     else{
       return results[1] || 0;
     }
   }

})(jQuery, Drupal);
