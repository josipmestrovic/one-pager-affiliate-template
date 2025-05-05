(function($) {
    'use strict';
    
    $(document).ready(function() {
        // Initialize play button functionality for both layouts
        initializeVideoPlayButton();
        
        // Handle thumbnail clicks for video switching (mobile carousel)
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
        // Handle play button click - only for starting the video (both mobile and desktop)
        $('.video-play-button').on('click', function(e) {
            e.stopPropagation(); // Prevent event from bubbling to video element
            
            const videoContainer = $(this).closest('.video-container, .grid-video-container');
            const videoElement = videoContainer.find('video')[0];
            
            if (videoElement) {
                // For desktop grid, pause all other videos first
                if ($(window).width() >= 600 && videoContainer.hasClass('grid-video-container')) {
                    pauseAllOtherVideos(videoElement);
                }
                
                videoElement.play();
            }
        });
        
        // Add event listeners to all videos in mobile carousel
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
        
        // Add event listeners to all videos in desktop grid
        $('.grid-video-container video').each(function() {
            const video = this;
            const $video = $(video);
            const videoContainer = $video.closest('.grid-video-container');
            
            // Play event listener - pause all other videos when this one plays
            video.addEventListener('play', function() {
                $video.addClass('playing');
                hidePlayButton(videoContainer);
                
                // If on desktop (≥ 600px), pause all other videos
                if ($(window).width() >= 600) {
                    pauseAllOtherVideos(video);
                }
            });
            
            video.addEventListener('pause', function() {
                $video.removeClass('playing');
                showPlayButton(videoContainer);
            });
            
            video.addEventListener('ended', function() {
                $video.removeClass('playing');
                showPlayButton(videoContainer);
            });
            
            // Add click listener to video element to handle native clicks too
            $video.on('click', function() {
                // If the video is already playing, do nothing (let native controls handle it)
                if (!$video.hasClass('playing')) {
                    // If on desktop (≥ 600px), pause all other videos first
                    if ($(window).width() >= 600) {
                        pauseAllOtherVideos(video);
                    }
                }
            });
        });
    }
    
    // Pause all other videos except the current one
    function pauseAllOtherVideos(currentVideo) {
        $('.desktop-grid video').each(function() {
            if (this !== currentVideo) {
                this.pause();
            }
        });
    }
    
    // Helper functions to show/hide the play button
    function showPlayButton(container) {
        container.find('.video-play-button').removeClass('hidden');
    }
    
    function hidePlayButton(container) {
        container.find('.video-play-button').addClass('hidden');
    }
    
})(jQuery);