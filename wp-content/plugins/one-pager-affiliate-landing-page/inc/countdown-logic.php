<?php
// Countdown Logic for One-Pager Affiliate Landing Page Plugin

/**
 * Calculate remaining time until a provided target date.
 *
 * @param string $date Target date string (e.g., 'YYYY-MM-DD HH:MM:SS').
 * @return array|string Associative array with days, hours, minutes, seconds or expiration message.
 */
function opalp_get_countdown($date) {
    // Instantiate DateTime objects for current moment and target
    $current_date = new DateTime();
    $target_date  = new DateTime($date);

    // If the target date is in the past, return an expiration notice
    if ($target_date < $current_date) {
        return 'Countdown expired';
    }

    // Compute the interval between now and the target date
    $interval = $current_date->diff($target_date);

    // Return structured remaining time values
    return [
        'days'    => $interval->days,
        'hours'   => $interval->h,
        'minutes' => $interval->i,
        'seconds' => $interval->s,
    ];
}

/**
 * Render HTML markup and inline JavaScript for a live countdown timer.
 *
 * @param string $date Target date string used both server- and client-side.
 */
function opalp_render_countdown_script($date) {
    // Fetch current countdown values or expiration message
    $countdown_data = opalp_get_countdown($date);
    if (is_string($countdown_data)) {
        // Display expiration text and exit
        echo '<p>' . esc_html($countdown_data) . '</p>';
        return;
    }

    // Output initial countdown HTML structure
    echo '<div id="opalp-countdown">
        <span id="days">' . esc_html($countdown_data['days']) . '</span> days
        <span id="hours">' . esc_html($countdown_data['hours']) . '</span> hours
        <span id="minutes">' . esc_html($countdown_data['minutes']) . '</span> minutes
        <span id="seconds">' . esc_html($countdown_data['seconds']) . '</span> seconds
    </div>';

    // Inline JavaScript to update countdown every second
    echo '<script>
        // Convert provided date string to a timestamp
        const targetDate = new Date("' . esc_js($date) . '").getTime();
        const countdownElement = document.getElementById("opalp-countdown");

        function updateCountdown() {
            // Calculate remaining time in milliseconds
            const now = new Date().getTime();
            const distance = targetDate - now;

            // If countdown has passed, show expiration message
            if (distance < 0) {
                countdownElement.innerHTML = "Countdown expired";
                return;
            }

            // Derive days, hours, minutes, seconds from remaining time
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Update countdown display
            countdownElement.innerHTML = `${days} days ${hours} hours ${minutes} minutes ${seconds} seconds`;
        }

        // Start the countdown updates on a one-second interval
        setInterval(updateCountdown, 1000);
    </script>';
}
?>