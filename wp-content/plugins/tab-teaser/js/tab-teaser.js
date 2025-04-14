(function() {
    document.addEventListener('DOMContentLoaded', function() {

        // 1. Grab user settings from the localized object
        const originalTitle    = document.title;
        const inactiveTitle    = tabTeaserData.inactiveTitle || "Return to shopping!";
        const enableFlashing   = (tabTeaserData.enableFlashing === '1');
        const flashingInterval = parseInt(tabTeaserData.flashingInterval, 10) || 2;

        const originalFavicon = document.querySelector("link[rel='icon']") || document.createElement('link');
        originalFavicon.rel = 'icon';
        document.head.appendChild(originalFavicon);

        const inactiveFavicon = tabTeaserData.inactiveFavicon;
        const pluginUrl = tabTeaserData.pluginUrl;
        let originalFaviconHref = originalFavicon.href;

        let intervalId = null;
        let toggle     = false;
        let faviconIntervalId = null;

        // 2. Flashing logic
        function startFlashingTitle() {
            if (!intervalId) {
                intervalId = setInterval(() => {
                    document.title = toggle ? inactiveTitle : originalTitle;
                    toggle = !toggle;
                }, flashingInterval * 1000);
            }
        }

        function startFlashingFavicon() {
            if (!faviconIntervalId) {
                faviconIntervalId = setInterval(() => {
                    const newFavicon = document.createElement('link');
                    newFavicon.rel = 'icon';
                    newFavicon.href = toggle
                        ? `${pluginUrl}inactive-favicons/${inactiveFavicon}?t=${new Date().getTime()}`
                        : originalFaviconHref;

                    // Remove all existing favicons to ensure the browser updates it
                    const existingFavicons = document.querySelectorAll("link[rel='icon']");
                    existingFavicons.forEach(favicon => favicon.parentNode.removeChild(favicon));

                    // Add the new favicon
                    document.head.appendChild(newFavicon);
                }, flashingInterval * 1000);
            }
        }

        // 3. Single set
        function setInactiveTitle() {
            document.title = inactiveTitle;
        }

        function setInactiveFavicon() {
            if (inactiveFavicon) {
                console.log('Setting inactive favicon:', pluginUrl + 'inactive-favicons/' + inactiveFavicon);
                const newFavicon = document.createElement('link');
                newFavicon.rel = 'icon';
                newFavicon.href = `${pluginUrl}inactive-favicons/${inactiveFavicon}?t=${new Date().getTime()}`;

                // Remove all existing favicons to ensure the browser updates it
                const existingFavicons = document.querySelectorAll("link[rel='icon']");
                existingFavicons.forEach(favicon => favicon.parentNode.removeChild(favicon));

                // Add the new favicon
                document.head.appendChild(newFavicon);
            }
        }

        // 4. Stop flashing and restore original
        function stopFlashingTitle() {
            if (intervalId) {
                clearInterval(intervalId);
                intervalId = null;
            }
            document.title = originalTitle;
            toggle = false;
        }

        function stopFlashingFavicon() {
            if (faviconIntervalId) {
                clearInterval(faviconIntervalId);
                faviconIntervalId = null;

                // Restore the original favicon
                const newFavicon = document.createElement('link');
                newFavicon.rel = 'icon';
                newFavicon.href = originalFaviconHref;

                // Remove all existing favicons to ensure the browser updates it
                const existingFavicons = document.querySelectorAll("link[rel='icon']");
                existingFavicons.forEach(favicon => favicon.parentNode.removeChild(favicon));

                // Add the original favicon back
                document.head.appendChild(newFavicon);
            }
        }

        function restoreOriginalFavicon() {
            console.log('Restoring original favicon:', originalFaviconHref);
            const newFavicon = document.createElement('link');
            newFavicon.rel = 'icon';
            newFavicon.href = originalFaviconHref;

            // Remove all existing favicons to ensure the browser updates it
            const existingFavicons = document.querySelectorAll("link[rel='icon']");
            existingFavicons.forEach(favicon => favicon.parentNode.removeChild(favicon));

            // Add the original favicon back
            document.head.appendChild(newFavicon);
        }

        // 5. Ensure original title if tab is initially visible
        if (!document.hidden) {
            document.title = originalTitle;
        }

        // 6. Handle visibility changes
        document.addEventListener("visibilitychange", function() {
            if (document.hidden) {
                // Tab is inactive
                if (enableFlashing) {
                    startFlashingTitle();
                    startFlashingFavicon();
                } else {
                    setInactiveTitle();
                    setInactiveFavicon();
                }
            } else {
                // Tab is active
                stopFlashingTitle();
                stopFlashingFavicon();
                restoreOriginalFavicon();
            }
        });
    });
})();
