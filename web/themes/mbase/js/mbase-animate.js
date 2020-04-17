/**
 * @file
 * Provides function to help easy animation.
 */

var Drupal = Drupal || {};

(function ($, Drupal, drupalSettings) {
  "use strict";
  var animate = drupalSettings.mbase.animate;

  // Switch case.
  for (var ani_event in animate) {
    switch (ani_event) {
      case 'noEvent':
        ma_apply_static_classes(animate.onLoad);
      break;

      case 'click':
        var selectors = ma_selects_for_event(animate.click, 'click');
        $(selectors).on("click",function() {
          ma_apply_dynamic_classes(animate.click, this);
        });
      break;

      case 'hover':
        var selectors = ma_selects_for_event(animate.hover, 'hover');
        $(selectors).on("mouseenter mouseleave", function() {
          ma_apply_dynamic_classes(animate.hover, this);
        });
      break;

      case 'mouseover':
        var selectors = ma_selects_for_event(animate.mouseover, 'mouseover');
        $(selectors).on("mouseenter", function() {
          ma_apply_dynamic_classes(animate.mouseover, this);
        });
      break;

      case 'mousedown':
        var selectors = ma_selects_for_event(animate.mousedown, 'mousedown');
        $(selectors).on("mousedown", function() {
          ma_apply_dynamic_classes(animate.mousedown, this);
        });
      break;

      case 'mouseenter':
        var selectors = ma_selects_for_event(animate.mouseenter, 'mouseenter');
        $(selectors).on("mouseenter", function() {
          ma_apply_dynamic_classes(animate.mouseenter, this);
        });
      break;

      case 'mouseleave':
        var selectors = ma_selects_for_event(animate.mouseleave, 'mouseleave');
        $(selectors).on("mouseleave", function() {
          ma_apply_dynamic_classes(animate.mouseleave, this);
        });
      break;

      case 'mousemove':
        var selectors = ma_selects_for_event(animate.mousemove, 'mousemove');
        $(selectors).on("mousemove", function() {
          ma_apply_dynamic_classes(animate.mousemove, this);
        });
      break;

      case 'mouseout':
        var selectors = ma_selects_for_event(animate.mouseout, 'mouseout');
        $(selectors).on("mouseout", function() {
          ma_apply_dynamic_classes(animate.mouseout, this);
        });
      break;

      case 'mouseup':
        var selectors = ma_selects_for_event(animate.mouseup, 'mouseup');
        $(selectors).on("mouseup", function() {
          ma_apply_dynamic_classes(animate.mouseup, this);
        });
      break;

      case 'change':
        var selectors = ma_selects_for_event(animate.change, 'change');
        $(selectors).on("change", function() {
          ma_apply_dynamic_classes(animate.change, this);
        });
      break;

      case 'select':
        var selectors = ma_selects_for_event(animate.select, 'select');
        $(selectors).on("change", function() {
          ma_apply_dynamic_classes(animate.select, this);
        });
      break;

      case 'scroll':
        var selectors = ma_selects_for_event(animate.scroll, 'scroll');
        $(selectors).on("scroll", function() {
          ma_apply_dynamic_classes(animate.scroll, this);
        });
      break;

      case 'load':
        var selectors = ma_selects_for_event(animate.load, 'load');
        $(selectors).on("load", function() {
          ma_apply_dynamic_classes(animate.load, this);
        });
      break;

      case 'resize':
        var selectors = ma_selects_for_event(animate.resize, 'resize');
        $(selectors).on("resize", function() {
          ma_apply_dynamic_classes(animate.resize, this);
        });
      break;

      case 'error':
        var selectors = ma_selects_for_event(animate.error, 'error');
        $(selectors).on("error", function() {
          ma_apply_dynamic_classes(animate.error, this);
        });
      break;

      case 'keydown':
        var selectors = ma_selects_for_event(animate.keydown, 'keydown');
        $(selectors).on("keydown", function() {
          ma_apply_dynamic_classes(animate.keydown, this);
        });
      break;

      case 'keypress':
        var selectors = ma_selects_for_event(animate.keypress, 'keypress');
        $(selectors).on("keypress", function() {
          ma_apply_dynamic_classes(animate.keypress, this);
        });
      break;

      case 'keyup':
        var selectors = ma_selects_for_event(animate.keyup, 'keyup');
        $(selectors).on("keyup", function() {
          ma_apply_dynamic_classes(animate.keyup, this);
        });
      break;

      case 'blur':
        var selectors = ma_selects_for_event(animate.blur, 'blur');
        $(selectors).on("blur", function() {
          ma_apply_dynamic_classes(animate.blur, this);
        });
      break;

      case 'focus':
        var selectors = ma_selects_for_event(animate.focus, 'focus');
        $(selectors).on("focus", function() {
          ma_apply_dynamic_classes(animate.focus, this);
        });
      break;

      case 'focusin':
        var selectors = ma_selects_for_event(animate.focusin, 'focusin');
        $(selectors).on("focusin", function() {
          ma_apply_dynamic_classes(animate.focusin, this);
        });
      break;

      case 'focusout':
        var selectors = ma_selects_for_event(animate.focusout, 'focusout');
        $(selectors).on("focusout", function() {
          ma_apply_dynamic_classes(animate.focusout, this);
        });
      break;

      case 'submit':
        var selectors = ma_selects_for_event(animate.submit, 'submit');
        $(selectors).on("submit", function() {
          ma_apply_dynamic_classes(animate.submit, this);
        });
      break;

      default:
    }
  }

  // Function to call the actions in switch.
  function ma_apply_static_classes(ani_actions) {
    for (var actions in ani_actions) {
      var temp_selectors = ma_build_selectors(ani_actions[actions]);
      $(temp_selectors).addClass('animated').addClass(actions);
    }
  }
  // Function to call the actions in switch.
  function ma_apply_dynamic_classes(ani_actions, thisobj) {
    for (var actions in ani_actions) {
      if (ani_actions[actions] !== null) {
        for (var selector_key in ani_actions[actions]) {
          if (ani_actions[actions][selector_key] !== null) {
            if ($(thisobj).is(ani_actions[actions][selector_key])) {
              var animate_class = actions;
              $(thisobj).addClass('animated').addClass(animate_class)
                .delay(1200)
                .queue(function() {
                  $(thisobj).removeClass(animate_class);
                  $(thisobj).removeClass('animated');
                  $(this).dequeue();
                });
            }
          }
        }
      }
    }
  }

  // Helper function to build the comma seperated selectors.
  function ma_build_selectors(classes) {
    var selector = '';
    var counter = 0;
    for (var key in classes) {
      if (counter) {
        selector = selector + ", ";
      }
      counter++;
      selector = selector + classes[key];
    }
    return selector;
  }

  // Helper function to get all selectors for an event.
  // @todo make the unique classes.
  function ma_selects_for_event(event, events1) {
    var selector = '';
    var counter = 0;
    for (var key in event) {
      for (var action in event[key]) {
        if (counter) {
          selector = selector + ", ";
        }
        counter++;
        selector = selector + event[key][action];
      }
    }
    return selector;
  }

})(jQuery, Drupal, drupalSettings);
