/**
 * Theme: KZS - Admin Panel
 * Author: Coderthemes
 * Module/App: Form Wizard
 */

import { Tab } from "bootstrap";
import '../plugins/bootstrap-wizard.js';

$(function () {
  "use strict";

  document.querySelectorAll('[data-bs-toggle="tab"]').forEach((e) => Tab.getOrCreateInstance(e))
  $('#basicwizard').bootstrapWizard();
  //
  $('#progressbarwizard').bootstrapWizard({
    onTabShow: function (tab, navigation, index) {
      var $total = navigation.find('li').length;
      var $current = index + 1;
      var $percent = ($current / $total) * 100;
      $('#progressbarwizard').find('.bar').css({ width: $percent + '%' });
    }
  });

  $('#btnwizard').bootstrapWizard({ 'nextSelector': '.button-next', 'previousSelector': '.button-previous', 'firstSelector': '.button-first', 'lastSelector': '.button-last' });

  $('#rootwizard').bootstrapWizard({
    'onNext': function (tab, navigation, index) {
      var form = $($(tab).data("targetForm"));
      if (form) {
        form.addClass('was-validated');
        if (form[0].checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
          return false;
        }
      }
    }
  });
});
