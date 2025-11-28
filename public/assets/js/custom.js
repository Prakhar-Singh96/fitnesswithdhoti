// Function to trigger the existing login modal
function showLoginModal() {
    $('#login_modal').modal('show');
}

// Simple function to toggle a search bar (you may need to adapt this)
function toggleSearch() {
    // This example assumes you have a hidden search bar element you want to show
    $('.header-search-bar').slideToggle();
}

document.addEventListener("DOMContentLoaded", function() {

    // 1. Initialize Slick Slider for Video Feed
    // Ensure jQuery is loaded before this runs
    if ($('.video-carousel').length) {
        $('.video-carousel').slick({
            dots: false,
            infinite: false, /* Stop at end so user knows */
            speed: 300,
            slidesToShow: 6, /* Desktop: 6 items */
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1400,
                    settings: { slidesToShow: 5 }
                },
                {
                    breakpoint: 1200,
                    settings: { slidesToShow: 4 }
                },
                {
                    breakpoint: 992,
                    settings: { slidesToShow: 3 }
                },
                {
                    breakpoint: 768,
                    settings: { slidesToShow: 2 }
                }
            ]
        });
    }

    // 2. Video Hover & Sound Logic
    const videoCards = document.querySelectorAll('.video-card');

    videoCards.forEach(card => {
        const video = card.querySelector('video');
        const soundBtn = card.querySelector('.btn-sound-toggle');
        const icon = soundBtn.querySelector('i');

        // MOUSE ENTER: Play Video (Muted)
        card.addEventListener('mouseenter', () => {
            if (video.paused) {
                var playPromise = video.play();
                if (playPromise !== undefined) {
                    playPromise.catch(error => { console.log("Autoplay prevented"); });
                }
            }
        });

        // MOUSE LEAVE: Pause & Reset
        card.addEventListener('mouseleave', () => {
            video.pause();
            // video.currentTime = 0; // Optional: Reset to start

            // Auto-mute when leaving
            video.muted = true;
            icon.classList.remove('la-volume-up');
            icon.classList.add('la-volume-mute');
        });

        // SOUND TOGGLE
        if (soundBtn) {
            soundBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                if (video.muted) {
                    video.muted = false;
                    icon.classList.remove('la-volume-mute');
                    icon.classList.add('la-volume-up');
                } else {
                    video.muted = true;
                    icon.classList.remove('la-volume-up');
                    icon.classList.add('la-volume-mute');
                }
            });
        }
    });

    if ($('.category-product-slider').length) {
        $('.category-product-slider').slick({
            dots: false,
            infinite: false, /* Loop band kar diya */
            speed: 300,
            slidesToShow: 5, /* 👈 यहाँ हमने 5 कर दिया है */
            slidesToScroll: 1,
            arrows: true,
            responsive: [
                {
                    breakpoint: 1600,
                    settings: { slidesToShow: 5 }
                },
                {
                    breakpoint: 1400,
                    settings: { slidesToShow: 4 }
                },
                {
                    breakpoint: 992,
                    settings: { slidesToShow: 3 }
                },
                {
                    breakpoint: 768,
                    settings: { slidesToShow: 2, arrows: false }
                }
            ]
        });
    }

    if ($('.testimonial-slider').length) {
        $('.testimonial-slider').slick({
            dots: true,          /* Show dots below */
            arrows: false,       /* Hide arrows for cleaner look */
            infinite: true,      /* Loop forever */
            speed: 800,          /* Transition speed */
            slidesToShow: 2,     /* Show 2 reviews at once on PC */
            slidesToScroll: 1,
            autoplay: true,      /* ✅ Automatic Sliding */
            autoplaySpeed: 4000, /* ✅ Changes every 4 seconds */
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1 /* Show 1 review on mobile/tablet */
                    }
                }
            ]
        });
    }

});
