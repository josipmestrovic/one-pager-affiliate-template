document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('popup-container');
    if (popup) {
        console.log('Popup is hidden on load'); // Debugging log
        popup.classList.remove('popup-visible'); // Ensure popup is hidden on load
    }

    setTimeout(function () {
        if (popup) {
            console.log('Popup is now visible'); // Debugging log
            popup.classList.add('popup-visible'); // Add class to make popup visible
            popup.style.visibility = 'visible'; // Fallback to ensure visibility
        }
    }, 115000); // Delay of 5 seconds

    const closeButton = document.getElementById('popup-close');
    if (closeButton) {
        closeButton.addEventListener('click', function () {
            if (popup) {
                console.log('Popup is closed'); // Debugging log
                popup.classList.remove('popup-visible'); // Remove class to hide popup
                popup.style.visibility = 'hidden'; // Fallback to ensure it is hidden
            }
        });
    }
});