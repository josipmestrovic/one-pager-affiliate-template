(function($) {
    'use strict';
    
    $(document).ready(function() {
        // Initialize play button functionality
        initializeVideoPlayButton();
        
        // Handle thumbnail clicks for video switching
        $('.video-carousel a').on('click', function(e) {
            e.preventDefault();
            
            const $this = $(this);
            const videoCarousel = $this.closest('.video-carousel');
            const videoSrc = $this.data('video-src');
            
            // Update active state on thumbnails
            videoCarousel.find('a').removeClass('active');
            $this.addClass('active');
            
            // Get the video element and update its source
            const videoElement = videoCarousel.find('video.active-video');
            
            // Pause current video if playing
            videoElement[0].pause();
            
            // Update video source
            videoElement.attr('src', videoSrc);
            
            // Load the new video
            videoElement[0].load();
            
            // Autoplay the video after loading
            videoElement[0].play();
            
            // Hide play button when switching videos since we're autoplaying
            hidePlayButton(videoCarousel);
        });
    });
    
    // Initialize the video play button functionality
    function initializeVideoPlayButton() {
        // Handle play button click - only for starting the video
        $('.video-play-button').on('click', function(e) {
            e.stopPropagation(); // Prevent event from bubbling to video element
            
            const videoContainer = $(this).closest('.video-container');
            const videoElement = videoContainer.find('video')[0];
            
            if (videoElement) {
                videoElement.play();
            }
        });
        
        // Add event listeners to all videos
        $('.video-carousel video').each(function() {
            const video = this;
            const $video = $(video);
            const videoCarousel = $video.closest('.video-carousel');
            
            // Play/Pause event listener
            video.addEventListener('play', function() {
                $video.addClass('playing');
                hidePlayButton(videoCarousel);
            });
            
            video.addEventListener('pause', function() {
                $video.removeClass('playing');
                showPlayButton(videoCarousel);
            });
            
            video.addEventListener('ended', function() {
                $video.removeClass('playing');
                showPlayButton(videoCarousel);
            });
            
            // Remove click listener on video - let native controls handle it
            $video.off('click');
        });
    }
    
    // Helper functions to show/hide the play button
    function showPlayButton(carousel) {
        carousel.find('.video-play-button').removeClass('hidden');
    }
    
    function hidePlayButton(carousel) {
        carousel.find('.video-play-button').addClass('hidden');
    }
    
})(jQuery);