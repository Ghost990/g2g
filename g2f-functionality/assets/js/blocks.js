/**
 * G2F Functionality - Block Frontend Scripts
 *
 * @package G2F_Functionality
 */

(function () {
	'use strict';

	/**
	 * Initialize all blocks when DOM is ready
	 */
	document.addEventListener('DOMContentLoaded', function () {
		initProjectGridBlocks();
		initTestimonialSliders();
		initClientMarquees();
	});

	/**
	 * Project Grid Block - Filtering functionality
	 */
	function initProjectGridBlocks() {
		const grids = document.querySelectorAll('.wp-block-g2f-project-grid');

		grids.forEach(function (grid) {
			const tabs = grid.querySelectorAll('.g2f-project-tab');
			const cards = grid.querySelectorAll('.g2f-project-card');

			if (tabs.length === 0 || cards.length === 0) {
				return;
			}

			tabs.forEach(function (tab) {
				tab.addEventListener('click', function () {
					const category = this.dataset.category;

					// Update active tab
					tabs.forEach(function (t) {
						t.classList.remove('active');
						t.setAttribute('aria-selected', 'false');
					});
					this.classList.add('active');
					this.setAttribute('aria-selected', 'true');

					// Filter cards
					cards.forEach(function (card) {
						const cardCategory = card.dataset.category;

						if (category === 'all' || cardCategory === category) {
							card.classList.remove('hidden');
							card.style.display = '';
						} else {
							card.classList.add('hidden');
							setTimeout(function () {
								if (card.classList.contains('hidden')) {
									card.style.display = 'none';
								}
							}, 400);
						}
					});
				});
			});
		});
	}

	/**
	 * Testimonial Slider Block - Carousel functionality
	 */
	function initTestimonialSliders() {
		const sliders = document.querySelectorAll('.wp-block-g2f-testimonial-slider');

		sliders.forEach(function (slider) {
			const testimonials = slider.querySelectorAll('.g2f-testimonial');
			const dots = slider.querySelectorAll('.g2f-testimonial-dot');
			const autoplay = slider.dataset.autoplay === 'true';
			const autoplaySpeed = parseInt(slider.dataset.autoplaySpeed, 10) || 5000;

			if (testimonials.length <= 1) {
				return;
			}

			let currentIndex = 0;
			let autoplayInterval = null;

			function showSlide(index) {
				// Hide all testimonials
				testimonials.forEach(function (testimonial, i) {
					testimonial.style.display = i === index ? '' : 'none';
				});

				// Update dots
				dots.forEach(function (dot, i) {
					dot.classList.toggle('active', i === index);
					dot.setAttribute('aria-selected', i === index ? 'true' : 'false');
				});

				currentIndex = index;
			}

			function nextSlide() {
				const next = (currentIndex + 1) % testimonials.length;
				showSlide(next);
			}

			function startAutoplay() {
				if (autoplay && !autoplayInterval) {
					autoplayInterval = setInterval(nextSlide, autoplaySpeed);
				}
			}

			function stopAutoplay() {
				if (autoplayInterval) {
					clearInterval(autoplayInterval);
					autoplayInterval = null;
				}
			}

			// Dot click handlers
			dots.forEach(function (dot, index) {
				dot.addEventListener('click', function () {
					showSlide(index);
					stopAutoplay();
					startAutoplay();
				});
			});

			// Pause autoplay on hover
			slider.addEventListener('mouseenter', stopAutoplay);
			slider.addEventListener('mouseleave', startAutoplay);

			// Keyboard navigation
			slider.setAttribute('tabindex', '0');
			slider.addEventListener('keydown', function (e) {
				if (e.key === 'ArrowLeft') {
					const prev = (currentIndex - 1 + testimonials.length) % testimonials.length;
					showSlide(prev);
					stopAutoplay();
					startAutoplay();
				} else if (e.key === 'ArrowRight') {
					nextSlide();
					stopAutoplay();
					startAutoplay();
				}
			});

			// Touch/swipe support
			let touchStartX = 0;
			let touchEndX = 0;

			slider.addEventListener('touchstart', function (e) {
				touchStartX = e.changedTouches[0].screenX;
			}, { passive: true });

			slider.addEventListener('touchend', function (e) {
				touchEndX = e.changedTouches[0].screenX;
				handleSwipe();
			}, { passive: true });

			function handleSwipe() {
				const swipeThreshold = 50;
				const diff = touchStartX - touchEndX;

				if (Math.abs(diff) > swipeThreshold) {
					if (diff > 0) {
						// Swipe left - next slide
						nextSlide();
					} else {
						// Swipe right - previous slide
						const prev = (currentIndex - 1 + testimonials.length) % testimonials.length;
						showSlide(prev);
					}
					stopAutoplay();
					startAutoplay();
				}
			}

			// Initialize
			showSlide(0);
			startAutoplay();
		});
	}

	/**
	 * Client Marquee Block - Animation control
	 */
	function initClientMarquees() {
		const marquees = document.querySelectorAll('.wp-block-g2f-client-marquee');

		marquees.forEach(function (marquee) {
			const track = marquee.querySelector('.g2f-clients-track');

			if (!track) {
				return;
			}

			const speed = parseInt(marquee.dataset.speed, 10) || 30;
			const direction = marquee.dataset.direction || 'left';

			// Set animation duration based on speed
			track.style.animationDuration = speed + 's';

			// Set animation direction
			if (direction === 'right') {
				track.style.animationDirection = 'reverse';
			}

			// Ensure seamless loop by checking content width
			function ensureSeamlessLoop() {
				const items = track.querySelectorAll('.g2f-client-item');
				const totalItems = items.length;

				// The track already has duplicated items from PHP
				// Just make sure the animation works smoothly
				if (totalItems > 0) {
					// Calculate if we need more duplicates for seamless looping
					const trackWidth = track.scrollWidth;
					const containerWidth = marquee.offsetWidth;

					// If track is smaller than 2x container, we might have issues
					if (trackWidth < containerWidth * 2) {
						console.warn('G2F Marquee: Not enough content for seamless loop');
					}
				}
			}

			// Handle reduced motion preference
			if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
				track.style.animationPlayState = 'paused';
			}

			// Initialize
			ensureSeamlessLoop();

			// Recalculate on resize
			let resizeTimeout;
			window.addEventListener('resize', function () {
				clearTimeout(resizeTimeout);
				resizeTimeout = setTimeout(ensureSeamlessLoop, 250);
			});
		});
	}

})();
