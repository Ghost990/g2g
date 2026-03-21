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
		initBackToTop();
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
	 * Sticky Header with Shrink Animation
	 */
	function initStickyHeader() {
		const header = document.querySelector('.site-header');

		if (!header) return;

		// Set header height as CSS var for content offset
		function updateHeaderHeight() {
			const adminBar = document.getElementById('wpadminbar');
			const adminBarHeight = adminBar ? adminBar.offsetHeight : 0;
			document.documentElement.style.setProperty(
				'--g2f-header-height',
				(header.offsetHeight + adminBarHeight) + 'px'
			);
		}
		updateHeaderHeight();
		window.addEventListener('resize', updateHeaderHeight, { passive: true });

		const scrollThreshold = 40;
		let lastScrollY = window.pageYOffset;
		let ticking = false;

		function onScroll() {
			const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

			if (scrollTop > scrollThreshold) {
				if (!header.classList.contains('is-sticky')) {
					header.classList.add('is-sticky');
					document.body.classList.add('header-is-sticky');
				}
			} else {
				if (header.classList.contains('is-sticky')) {
					header.classList.remove('is-sticky');
					document.body.classList.remove('header-is-sticky');
				}
			}

			lastScrollY = scrollTop;
			ticking = false;
		}

		window.addEventListener('scroll', function() {
			if (!ticking) {
				requestAnimationFrame(onScroll);
				ticking = true;
			}
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
	 * WordPress strips data-* attributes from block markup, so we assign them dynamically
	 */
	function initProjectFilter() {
		const tabs = document.querySelectorAll('.g2f-project-tab');
		const projects = document.querySelectorAll('.g2f-project-card');

		if (!tabs.length || !projects.length) return;

		// Category mapping for tabs (text content → category slug)
		const tabCategoryMap = {
			'all': 'all',
			'ux/ui': 'ux-ui',
			'art direction': 'art-direction',
			'photography': 'photography'
		};

		// Assign data-category to tabs based on text content
		tabs.forEach((tab) => {
			const text = tab.textContent.trim().toLowerCase();
			const category = tabCategoryMap[text] || 'all';
			tab.dataset.category = category;

			// Remove inline opacity style so CSS can control it
			tab.style.removeProperty('opacity');
		});

		// Assign data-category to project cards based on description text
		// Also inject placeholder images if missing
		projects.forEach((project) => {
			const description = project.querySelector('.g2f-project-info p')?.textContent?.toLowerCase() || '';

			if (description.includes('ux/ui') || description.includes('ux-ui') || description.includes('website')) {
				project.dataset.category = 'ux-ui';
			} else if (description.includes('branding') || description.includes('visual identity') || description.includes('brochure') || description.includes('graphic design')) {
				project.dataset.category = 'art-direction';
			} else if (description.includes('photography')) {
				project.dataset.category = 'photography';
			} else {
				project.dataset.category = 'ux-ui'; // Default category
			}

			// Inject placeholder if no image exists
			const hasImage = project.querySelector('.g2f-project-image, .g2f-project-image-placeholder, figure img');
			if (!hasImage) {
				const placeholder = document.createElement('div');
				placeholder.className = 'g2f-project-image-placeholder';
				project.insertBefore(placeholder, project.firstChild);
			}
		});

		// Set up click handlers with cursor pointer
		tabs.forEach((tab) => {
			tab.style.cursor = 'pointer';

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
					if (i === index) {
						slide.classList.add('is-active');
						slide.style.opacity = '1';
					} else {
						slide.classList.remove('is-active');
						slide.style.opacity = '0';
					}
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

	/**
	 * Back to Top Button
	 */
	function initBackToTop() {
		const btn = document.querySelector('.g2f-back-to-top');
		if (!btn) return;

		window.addEventListener('scroll', function() {
			if (window.pageYOffset > 400) {
				btn.classList.add('is-visible');
			} else {
				btn.classList.remove('is-visible');
			}
		}, { passive: true });

		btn.addEventListener('click', function() {
			window.scrollTo({ top: 0, behavior: 'smooth' });
		});
	}
