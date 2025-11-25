// =======================================
// 💡 SUYAGYA PREMIUM THEME - CUSTOM.JS
// =======================================

// Ensures the video player logic and other custom functions are loaded
document.addEventListener('DOMContentLoaded', function () {
    
    // --- Video Carousel Logic (Moved from inline script) ---
    const carousel = $('#videoCarousel');
    const videos = document.querySelectorAll('.video-slide');

    function pauseAllVideos() {
        videos.forEach(v => v.pause());
    }

    function playCenterVideo() {
        pauseAllVideos();
        document.querySelectorAll('#videoCarousel .slick-slide').forEach(slide => {
            if (slide.classList.contains('slick-center')) {
                const video = slide.querySelector('video');
                if (video) video.play();
            }
        });
    }

    // Initialize carousel (Check if it exists before initializing)
    if (carousel.length && !carousel.hasClass('slick-initialized')) {
        carousel.slick({
            centerMode: true,
            slidesToShow: 6,
            arrows: true,
            infinite: true,
            responsive: [
                { breakpoint: 992, settings: { slidesToShow: 2 } },
                { breakpoint: 576, settings: { slidesToShow: 1, centerMode: false } }
            ]
        });
    }

    // Play on init & after change
    if (carousel.length) {
        carousel.on('init', playCenterVideo);
        carousel.on('afterChange', playCenterVideo);
    }
    // ... (Keep existing Play/Pause and Mute/Unmute logic) ...
    // Note: The rest of the JS logic needs to be correctly moved here from the Blade files.
    
});