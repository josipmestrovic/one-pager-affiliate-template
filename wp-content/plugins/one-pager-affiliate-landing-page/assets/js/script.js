// Scripts for One-Pager Affiliate Landing Page Plugin

document.addEventListener('DOMContentLoaded', function() {
    console.log('One-Pager Affiliate Landing Page Plugin loaded.');

    if (typeof jQuery !== 'undefined' && typeof jQuery.fn.wpColorPicker === 'function') {
        jQuery('.opalp-color-picker').wpColorPicker();
    }
});


