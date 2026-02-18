/**
 * G2F Design Theme - Main JavaScript
 */

(function() {
	'use strict';

	/**
	 * DOM Ready
	 */
	document.addEventListener('DOMContentLoaded', function() {
		initScrollAnimations();
		initStickyHeader();
		initSmoothScroll();
		initProjectFilter();
		initClientMarquee();
		initTestimonialSlider();
	});

	/**
	 * Scroll Animations
	 * Uses Intersection Observer for performance
	 */
	function initScrollAnimations() {
		const animatedElements = document.querySelectorAll('.g2f-fade-in, .g2f-slide-left, .g2f-slide-right');

		if (!animatedElements.length) return;

		const observer = new IntersectionObserver(
			(entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-visible');
						observer.unobserve(entry.target);
					}
				});
			},
			{
				threshold: 0.1,
				rootMargin: '0px 0px -50px 0px'
			}
		);

		animatedElements.forEach((el) => observer.observe(el));
	}

	/**
	 * Sticky Header
	 */
	function initStickyHeader() {
		const header = document.querySelector('.site-header');

		if (!header) return;

		let lastScrollTop = 0;
		const scrollThreshold = 100;

		window.addEventListener('scroll', function() {
			const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

			if (scrollTop > scrollThreshold) {
				header.classList.add('is-sticky');
			} else {
				header.classList.remove('is-sticky');
			}

			lastScrollTop = scrollTop;
		}, { passive: true });
	}

	/**
	 * Smooth Scroll for anchor links
	 */
	function initSmoothScroll() {
		document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
			anchor.addEventListener('click', function(e) {
				const targetId = this.getAttribute('href');

				if (targetId === '#') return;

				const target = document.querySelector(targetId);

				if (target) {
					e.preventDefault();

					const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
					const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;

					window.scrollTo({
						top: targetPosition,
						behavior: 'smooth'
					});
				}
			});
		});
	}

	/**
	 * Project Filter
	 */
	function initProjectFilter() {
		const tabs = document.querySelectorAll('.g2f-project-tab');
		const projects = document.querySelectorAll('.g2f-project-card');

		if (!tabs.length || !projects.length) return;

		tabs.forEach((tab) => {
			tab.addEventListener('click', function() {
				const category = this.dataset.category;

				// Update active tab
				tabs.forEach((t) => t.classList.remove('active'));
				this.classList.add('active');

				// Filter projects
				projects.forEach((project) => {
					const projectCategory = project.dataset.category;

					if (category === 'all' || projectCategory === category) {
						project.style.display = '';
						setTimeout(() => {
							project.style.opacity = '1';
							project.style.transform = 'translateY(0)';
						}, 50);
					} else {
						project.style.opacity = '0';
						project.style.transform = 'translateY(20px)';
						setTimeout(() => {
							project.style.display = 'none';
						}, 300);
					}
				});
			});
		});
	}

	/**
	 * Client Logo Marquee
	 */
	function initClientMarquee() {
		const marquees = document.querySelectorAll('.g2f-clients-marquee');

		marquees.forEach((marquee) => {
			const track = marquee.querySelector('.g2f-clients-track');

			if (!track) return;

			// Clone items for seamless loop
			const items = track.innerHTML;
			track.innerHTML = items + items;
		});
	}

	/**
	 * Testimonial Slider
	 */
	function initTestimonialSlider() {
		const sliders = document.querySelectorAll('.g2f-testimonial-slider');

		sliders.forEach((slider) => {
			const slides = slider.querySelectorAll('.g2f-testimonial');
			const dots = slider.querySelectorAll('.g2f-testimonial-dot');

			if (!slides.length) return;

			let currentSlide = 0;
			let autoplayInterval;

			function showSlide(index) {
				slides.forEach((slide, i) => {
					slide.style.display = i === index ? 'block' : 'none';
					slide.style.opacity = i === index ? '1' : '0';
				});

				dots.forEach((dot, i) => {
					dot.classList.toggle('active', i === index);
				});

				currentSlide = index;
			}

			function nextSlide() {
				const next = (currentSlide + 1) % slides.length;
				showSlide(next);
			}

			// Initialize
			showSlide(0);

			// Dot click handlers
			dots.forEach((dot, index) => {
				dot.addEventListener('click', () => {
					showSlide(index);
					resetAutoplay();
				});
			});

			// Autoplay
			function startAutoplay() {
				autoplayInterval = setInterval(nextSlide, 5000);
			}

			function resetAutoplay() {
				clearInterval(autoplayInterval);
				startAutoplay();
			}

			startAutoplay();

			// Pause on hover
			slider.addEventListener('mouseenter', () => clearInterval(autoplayInterval));
			slider.addEventListener('mouseleave', startAutoplay);
		});
	}

})();
