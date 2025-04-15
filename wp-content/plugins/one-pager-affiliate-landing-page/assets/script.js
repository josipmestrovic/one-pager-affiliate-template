document.addEventListener('DOMContentLoaded', function () {
    const starsContainers = document.querySelectorAll('.stars');

    starsContainers.forEach(container => {
        const stars = container.querySelectorAll('.star');
        const rating = parseFloat(container.getAttribute('data-rating'));

        stars.forEach((star, index) => {
            const starValue = index + 1;

            if (rating >= starValue) {
                star.style.color = '#FFDA6A';
                star.style.background = 'none';
            } else if (rating > starValue - 1 && rating < starValue) {
                const percentage = (rating - (starValue - 1)) * 100;
                star.style.color = 'transparent';
                star.style.background = `linear-gradient(to right, #FFDA6A ${percentage}%, #C4C4C4 ${percentage}%)`;
                star.style.backgroundClip = 'text';
                star.style.webkitBackgroundClip = 'text';
                star.style.webkitTextFillColor = 'transparent';
            } else {
                star.style.color = '#C4C4C4';
                star.style.background = 'none';
            }

            star.addEventListener('mouseover', () => {
                stars.forEach((s, i) => {
                    s.style.color = i <= index ? '#FFDA6A' : '#C4C4C4';
                    s.style.background = 'none';
                });
            });

            star.addEventListener('mouseout', () => {
                stars.forEach((s, i) => {
                    const sValue = i + 1;
                    if (rating >= sValue) {
                        s.style.color = '#FFDA6A';
                        s.style.background = 'none';
                    } else if (rating > sValue - 1 && rating < sValue) {
                        const percentage = (rating - (sValue - 1)) * 100;
                        s.style.color = 'transparent';
                        s.style.background = `linear-gradient(to right, #FFDA6A ${percentage}%, #C4C4C4 ${percentage}%)`;
                        s.style.backgroundClip = 'text';
                        s.style.webkitBackgroundClip = 'text';
                        s.style.webkitTextFillColor = 'transparent';
                    } else {
                        s.style.color = '#C4C4C4';
                        s.style.background = 'none';
                    }
                });
            });
        });
    });
});