<?php
// Countdown Logic for One-Pager Affiliate Landing Page Plugin

function opalp_get_countdown($date) {
    $current_date = new DateTime();
    $target_date = new DateTime($date);

    if ($target_date < $current_date) {
        return 'Countdown expired';
    }

    $interval = $current_date->diff($target_date);

    return [
        'days' => $interval->days,
        'hours' => $interval->h,
        'minutes' => $interval->i,
        'seconds' => $interval->s
    ];
}

function opalp_render_countdown_script($date) {
    $countdown_data = opalp_get_countdown($date);
    if (is_string($countdown_data)) {
        echo '<p>' . esc_html($countdown_data) . '</p>';
        return;
    }

    echo '<div id="opalp-countdown">
        <span id="days">' . esc_html($countdown_data['days']) . '</span> days
        <span id="hours">' . esc_html($countdown_data['hours']) . '</span> hours
        <span id="minutes">' . esc_html($countdown_data['minutes']) . '</span> minutes
        <span id="seconds">' . esc_html($countdown_data['seconds']) . '</span> seconds
    </div>';

    echo '<script>
        const targetDate = new Date("' . esc_js($date) . '").getTime();
        const countdownElement = document.getElementById("opalp-countdown");

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                countdownElement.innerHTML = "Countdown expired";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownElement.innerHTML = `${days} days ${hours} hours ${minutes} minutes ${seconds} seconds`;
        }

        setInterval(updateCountdown, 1000);
    </script>';
}
?>