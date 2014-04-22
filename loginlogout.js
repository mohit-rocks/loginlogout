/**
 * @file
 * Defines Javascript behaviors for the loginlogout module.
 */

(function ($, Drupal, drupalSettings) {
  "use strict";
  Drupal.behaviors.loginlogout = {
    attach: function (context) {
      loginlogoutAttach(context);
    }
  };

  /* Loops over urls and replaces them when found. */
  function loginlogoutAttach(context) {
    var login_destination = drupalSettings.loginlogout.urls;
    for(var url in login_destination) {
      $("a[href='"+ url + "']").attr('href',  drupalSettings.loginlogout.urls[url]);
    }
  }

})(jQuery, Drupal, drupalSettings);
