/* Dynamic Popup Script */
jQuery(document).ready(function($) {

    const popupContainer = $('#dynamic-popup-container');
    const closeButton = $('#dynamic-popup-close');
    const overlay = $('#dynamic-popup-overlay');
    // Convert localized delay (string) to integer, fallback to default if invalid
    const popupDelay = (typeof dynamicPopupSettings !== 'undefined' && dynamicPopupSettings.delay)
        ? parseInt(dynamicPopupSettings.delay, 10) || 5000
        : 5000;

    let popupTimer;

    // Function to show the popup
    function showPopup() {
        if (popupContainer.length) { // Check if popup exists
             // Use class for smoother transition control
            popupContainer.addClass('visible');
        }
    }

    // Function to hide the popup
    function hidePopup() {
        if (popupContainer.length) {
            popupContainer.removeClass('visible');
        }
    }

    // Set timer to show popup after delay
    // Ensure delay is a valid number >= 0
    if (typeof popupDelay === 'number' && popupDelay >= 0) {
         popupTimer = setTimeout(showPopup, popupDelay);
         console.log('Dynamic Popup: Timer set for ' + popupDelay + 'ms.');
    } else {
        console.error('Dynamic Popup: Invalid delay value provided (' + popupDelay + '). Cannot set timer.');
    }


    // Close popup when close button is clicked
    if (closeButton.length) {
        closeButton.on('click', function(e) {
            e.preventDefault();
            hidePopup();
            if (popupTimer) clearTimeout(popupTimer); // Clear timer if closed manually
            console.log('Dynamic Popup: Closed via button.');
        });
    }

    // Close popup when overlay is clicked
    if (overlay.length) {
        overlay.on('click', function(e) {
            // Make sure the click is directly on the overlay, not the content box
            if (e.target === this) {
                hidePopup();
                if (popupTimer) clearTimeout(popupTimer); // Clear timer if closed manually
                console.log('Dynamic Popup: Closed via overlay click.');
            }
        });
    }

    // Optional: Close popup on 'Esc' key press
    $(document).on('keydown', function(e) {
        if (e.key === "Escape" && popupContainer.hasClass('visible')) {
            hidePopup();
            if (popupTimer) clearTimeout(popupTimer);
            console.log('Dynamic Popup: Closed via ESC key.');
        }
    });

    // Add a console log to confirm the script is running
    console.log('Dynamic Popup script loaded.');

});