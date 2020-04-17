/**
 * @file
 * Preview for the Modern base theme.
 */

(function ($, Drupal, drupalSettings) {

  "use strict";

  Drupal.color = {
    logoChanged: false,
    callback: function (context, settings, form, farb, height, width) {
      // Change the logo to be the real one.
      if (!this.logoChanged) {
        $('.color-preview .color-preview-logo img').attr('src', drupalSettings.color.logo);
        this.logoChanged = true;
      }
      // Remove the logo if the setting is toggled off.
      if (drupalSettings.color.logo === null) {
        $('div').remove('.color-preview-logo');
      }
      // Quick fixes around color palette.
      var selected_scheme = $("#edit-scheme").val();
      if (selected_scheme) {
        var fix_footer_bg = drupalSettings.color.schemes[selected_scheme].footer_bg;
        $('.js-color-palette input[name="palette[footer_bg]"]').val(fix_footer_bg).css('background-color', fix_footer_bg);
      }

      // Store the current palette values.
      var base = $('.js-color-palette input[name="palette[base]"]').val();
      var header_link = $('.js-color-palette input[name="palette[header_link]"]').val();
      var sitename = $('.js-color-palette input[name="palette[sitename]"]').val();
      var headings = $('.js-color-palette input[name="palette[headings]"]').val();
      var borders = $('.js-color-palette input[name="palette[borders]"]').val();
      var link = $('.js-color-palette input[name="palette[link]"]').val();
      var text = $('.js-color-palette input[name="palette[text]"]').val();
      var body_bg = $('.js-color-palette input[name="palette[body_bg]"]').val();
      var footer_text = $('.js-color-palette input[name="palette[footer_text]"]').val();
      var footer_bg = $('.js-color-palette input[name="palette[footer_bg]"]').val();

      // Header.
      $('.clr-base-background-color').css('background-color',base);
      $('.clr-header-link-color').css('color',header_link);

      // Body.
      $('.clr-headings-color').css('color',headings);
      $('.clr-borders-color').css('border-color',borders);
      $('.clr-body-bg-background-color').css('background-color',body_bg);
      $('.clr-link-color').css('color',link);
      $('.clr-text-color').css('color',text);

      // Footer.
      $('.clr-footer-bg-background-color').css('background-color',footer_bg);
      $('.clr-footer-text-color').css('color',footer_text);

    }
  };
})(jQuery, Drupal, drupalSettings);
