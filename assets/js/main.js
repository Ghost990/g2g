/**
 * G2F Design Theme - Main JavaScript
 * GSAP + ScrollTrigger powered micro-interactions & animations
 */

(function () {
	'use strict';

	// Reduced motion preference
	const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	// Touch device detection
	const isTouch = window.matchMedia('(hover: none)').matches;

	/**
	 * DOM Ready
	 */
	document.addEventListener('DOMContentLoaded', function () {
		initPageLoad();
		initStickyHeader();
		initMobileMenu();
		initSmoothScroll();
		initProjectFilter();
		initClientMarquee();
		initTestimonialSlider();
		initBackToTop();

		if (!reducedMotion) {
			initLogoAnimation();
			initHeaderEntrance();
			initHomeHeroEntrance();
			initHeroAnimations();
			initScrollReveal();
			initProjectCardHover();
			initMagneticButton();
			initButtonArrowHover();
		}
	});

	// =========================================================
	// PAGE LOAD FADE-IN
	// =========================================================
	function initPageLoad() {
		if (reducedMotion) return;

		document.body.style.opacity = '0';

		if (typeof gsap !== 'undefined') {
			gsap.to(document.body, {
				opacity: 1,
				duration: 0.55,
				ease: 'power1.out',
			});
		} else {
			document.body.style.transition = 'opacity 0.5s ease';
			requestAnimationFrame(() => {
				document.body.style.opacity = '1';
			});
		}
	}

	// =========================================================
	// CUSTOM CURSOR
	// =========================================================
	function initCustomCursor() {
		if (isTouch || typeof gsap === 'undefined') return;

		// Create cursor elements
		const cursor = document.createElement('div');
		cursor.className = 'g2f-cursor';
		cursor.innerHTML = `
			<div class="g2f-cursor__dot"></div>
			<div class="g2f-cursor__ring"></div>
			<span class="g2f-cursor__label">VIEW</span>
		`;
		document.body.appendChild(cursor);

		const dot = cursor.querySelector('.g2f-cursor__dot');
		const ring = cursor.querySelector('.g2f-cursor__ring');

		// Quick setters for performance
		const xDot = gsap.quickTo(dot, 'x', { duration: 0.1, ease: 'power3' });
		const yDot = gsap.quickTo(dot, 'y', { duration: 0.1, ease: 'power3' });
		const xRing = gsap.quickTo(ring, 'x', { duration: 0.35, ease: 'power3' });
		const yRing = gsap.quickTo(ring, 'y', { duration: 0.35, ease: 'power3' });
		const xLabel = gsap.quickTo(cursor.querySelector('.g2f-cursor__label'), 'x', { duration: 0.35, ease: 'power3' });
		const yLabel = gsap.quickTo(cursor.querySelector('.g2f-cursor__label'), 'y', { duration: 0.35, ease: 'power3' });

		document.addEventListener('mousemove', (e) => {
			xDot(e.clientX);
			yDot(e.clientY);
			xRing(e.clientX);
			yRing(e.clientY);
			xLabel(e.clientX);
			yLabel(e.clientY);
		});

		// Hover states
		const interactiveEls = document.querySelectorAll('a, button, [role="button"], .g2f-btn-arrow, .g2f-header-cta a');
		interactiveEls.forEach((el) => {
			el.addEventListener('mouseenter', () => cursor.classList.add('is-hovering'));
			el.addEventListener('mouseleave', () => cursor.classList.remove('is-hovering'));
		});

		// Project card state
		const projectCards = document.querySelectorAll('.g2f-project-card');
		projectCards.forEach((card) => {
			card.addEventListener('mouseenter', () => {
				cursor.classList.add('is-project');
				cursor.classList.remove('is-hovering');
			});
			card.addEventListener('mouseleave', () => {
				cursor.classList.remove('is-project');
			});
		});
	}

	// =========================================================
	// HERO TEXT ANIMATIONS
	// =========================================================
	function initHeroAnimations() {
		if (typeof gsap === 'undefined') return;

		const heroHeadings = document.querySelectorAll(
			'.g2f-hero-about__heading, .g2f-hero-services__heading, .g2f-cover-hero h1, .g2f-cover-hero h2, .g2f-hero h1, .g2f-hero h2, .g2f-hero-project__title'
		);

		heroHeadings.forEach((heading) => {
			// Split words into spans
			const words = heading.innerText.split(' ');
			heading.innerHTML = words
				.map((w) => `<span class="g2f-word" style="display:inline-block; overflow:hidden; padding-bottom:0.1em; margin-right:0.25em"><span class="g2f-word-inner" style="display:inline-block">${w}</span></span>`)
				.join('');

			const wordInners = heading.querySelectorAll('.g2f-word-inner');

			// On the homepage the eyebrow runs first; inner pages keep a snappy delay
			const headingDelay = document.querySelector('.g2f-hero .g2f-hero-cover') ? 0.65 : 0.15;

			gsap.from(wordInners, {
				y: '105%',
				opacity: 0,
				duration: 0.85,
				ease: 'power3.out',
				stagger: 0.07,
				delay: headingDelay,
			});
		});

		// Sub-headings / paragraphs in hero areas
		const heroSubs = document.querySelectorAll(
			'.g2f-hero-about__content p, .g2f-hero-services__content p, .g2f-cover-hero p, .g2f-hero-project__breadcrumb'
		);
		if (heroSubs.length) {
			gsap.from(heroSubs, {
				y: 20,
				opacity: 0,
				duration: 0.7,
				ease: 'power2.out',
				stagger: 0.1,
				delay: 0.5,
			});
		}

		// Hero vertical label
		const heroLabels = document.querySelectorAll(
			'.g2f-hero-about__label, .g2f-hero-services__label, .g2f-hero-project__label'
		);
		if (heroLabels.length) {
			gsap.from(heroLabels, {
				opacity: 0,
				x: -10,
				duration: 0.6,
				ease: 'power2.out',
				delay: 0.3,
			});
		}
	}

	// =========================================================
	// SCROLL REVEAL (ScrollTrigger)
	// =========================================================
	function initScrollReveal() {
		if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

		gsap.registerPlugin(ScrollTrigger);

		const triggerPoint = 'top 88%';

		// About section columns
		const aboutImageCol = document.querySelector('.g2f-about-image-col, .g2f-about-inner .g2f-about-image-col');
		const aboutTextCol = document.querySelector('.g2f-about-text-col, .g2f-about-inner .g2f-about-text-col');

		if (aboutImageCol) {
			gsap.from(aboutImageCol, {
				x: -60,
				opacity: 0,
				duration: 0.9,
				ease: 'power2.out',
				scrollTrigger: { trigger: aboutImageCol, start: triggerPoint, once: true },
			});
		}
		if (aboutTextCol) {
			gsap.from(aboutTextCol, {
				x: 60,
				opacity: 0,
				duration: 0.9,
				ease: 'power2.out',
				delay: 0.1,
				scrollTrigger: { trigger: aboutTextCol, start: triggerPoint, once: true },
			});
		}

		// Service rows — alternating directions
		const serviceRows = document.querySelectorAll('.g2f-service-row');
		serviceRows.forEach((row, i) => {
			gsap.from(row, {
				x: i % 2 === 0 ? -50 : 50,
				opacity: 0,
				duration: 0.85,
				ease: 'power2.out',
				scrollTrigger: { trigger: row, start: triggerPoint, once: true },
			});
		});

		// Project cards — stagger reveal
		const projectCards = document.querySelectorAll('.g2f-project-card');
		if (projectCards.length) {
			gsap.from(projectCards, {
				y: 50,
				opacity: 0,
				scale: 0.96,
				duration: 0.7,
				ease: 'power2.out',
				stagger: { amount: 0.4 },
				scrollTrigger: {
					trigger: projectCards[0].closest('.g2f-projects-grid, .g2f-latest-projects') || projectCards[0],
					start: triggerPoint,
					once: true,
				},
			});
		}

		// Portfolio text section
		const portfolioSection = document.querySelector('.g2f-portfolio-split');
		if (portfolioSection) {
			const heading = portfolioSection.querySelector('h2');
			const para = portfolioSection.querySelector('p');
			const btn = portfolioSection.querySelector('.g2f-btn-arrow');
			const items = [heading, para, btn].filter(Boolean);

			gsap.from(items, {
				y: 35,
				opacity: 0,
				duration: 0.75,
				ease: 'power2.out',
				stagger: 0.12,
				scrollTrigger: { trigger: portfolioSection, start: triggerPoint, once: true },
			});
		}

		// Testimonials
		const testimonialSection = document.querySelector('.g2f-testimonials-section, .g2f-testimonial-slider');
		if (testimonialSection) {
			gsap.from(testimonialSection, {
				y: 30,
				opacity: 0,
				duration: 0.7,
				ease: 'power2.out',
				scrollTrigger: { trigger: testimonialSection, start: triggerPoint, once: true },
			});
		}

		// Clients section
		const clientsSection = document.querySelector('.g2f-clients-section');
		if (clientsSection) {
			gsap.from(clientsSection, {
				y: 25,
				opacity: 0,
				duration: 0.65,
				ease: 'power2.out',
				scrollTrigger: { trigger: clientsSection, start: triggerPoint, once: true },
			});
		}

		// CTA bar
		const ctaBar = document.querySelector('.g2f-cta-bar-section, .g2f-cta-footer');
		if (ctaBar) {
			gsap.from(ctaBar, {
				scale: 0.97,
				opacity: 0,
				duration: 0.7,
				ease: 'power2.out',
				scrollTrigger: { trigger: ctaBar, start: triggerPoint, once: true },
			});
		}

		// Services detail blocks (inner pages)
		const serviceDetailBlocks = document.querySelectorAll('.g2f-service-detail-block');
		serviceDetailBlocks.forEach((block, i) => {
			gsap.from(block, {
				y: 40,
				opacity: 0,
				duration: 0.75,
				ease: 'power2.out',
				delay: i * 0.05,
				scrollTrigger: { trigger: block, start: triggerPoint, once: true },
			});
		});

		// Generic fade-in for remaining animated elements
		const fadeEls = document.querySelectorAll('.g2f-fade-in');
		fadeEls.forEach((el) => {
			gsap.from(el, {
				y: 25,
				opacity: 0,
				duration: 0.65,
				ease: 'power2.out',
				scrollTrigger: { trigger: el, start: triggerPoint, once: true },
			});
		});
	}

	// =========================================================
	// PROJECT CARD HOVER
	// =========================================================
	function initProjectCardHover() {
		if (typeof gsap === 'undefined') return;

		const cards = document.querySelectorAll('.g2f-project-card');

		cards.forEach((card) => {
			const img = card.querySelector('img');
			const exploreBtn = card.querySelector('.g2f-project-explore, a');

			if (img) {
				card.addEventListener('mouseenter', () => {
					gsap.to(img, { scale: 1.05, duration: 0.5, ease: 'power2.out' });
				});
				card.addEventListener('mouseleave', () => {
					gsap.to(img, { scale: 1, duration: 0.5, ease: 'power2.out' });
				});
			}

			if (exploreBtn) {
				gsap.set(exploreBtn, { y: 6, opacity: 0.7 });
				card.addEventListener('mouseenter', () => {
					gsap.to(exploreBtn, { y: 0, opacity: 1, duration: 0.3, ease: 'power2.out' });
				});
				card.addEventListener('mouseleave', () => {
					gsap.to(exploreBtn, { y: 6, opacity: 0.7, duration: 0.25, ease: 'power2.in' });
				});
			}
		});
	}

	// =========================================================
	// MAGNETIC BUTTON (GET IN TOUCH)
	// =========================================================
	function initMagneticButton() {
		if (isTouch || typeof gsap === 'undefined') return;

		const magnetBtns = document.querySelectorAll('.g2f-header-cta a, .g2f-header-cta .wp-block-button__link');

		magnetBtns.forEach((btn) => {
			btn.addEventListener('mousemove', (e) => {
				const rect = btn.getBoundingClientRect();
				const cx = rect.left + rect.width / 2;
				const cy = rect.top + rect.height / 2;
				const dx = (e.clientX - cx) * 0.35;
				const dy = (e.clientY - cy) * 0.35;

				gsap.to(btn, {
					x: dx,
					y: dy,
					duration: 0.35,
					ease: 'power2.out',
				});
			});

			btn.addEventListener('mouseleave', () => {
				gsap.to(btn, {
					x: 0,
					y: 0,
					duration: 0.55,
					ease: 'elastic.out(1, 0.4)',
				});
			});
		});
	}

	// =========================================================
	// BUTTON ARROW HOVER
	// =========================================================
	function initButtonArrowHover() {
		if (typeof gsap === 'undefined') return;

		const arrowBtns = document.querySelectorAll('.g2f-btn-arrow, .g2f-btn-arrow-light');

		arrowBtns.forEach((btn) => {
			// Find the arrow character or last word
			btn.addEventListener('mouseenter', () => {
				gsap.to(btn, { letterSpacing: '0.05em', duration: 0.25, ease: 'power2.out' });
			});
			btn.addEventListener('mouseleave', () => {
				gsap.to(btn, { letterSpacing: '0em', duration: 0.2, ease: 'power2.in' });
			});
		});
	}

	// =========================================================
	// LOGO ANIMATION — multi-phase GSAP timeline
	// =========================================================
	function initLogoAnimation() {
		if (typeof gsap === 'undefined') return;

		const logoSvg = document.querySelector('.g2f-logo-link svg');
		if (!logoSvg) return;

		const paths = Array.from(logoSvg.querySelectorAll('path'));
		if (paths.length < 25) return;

		// Path groups (identified by SVG structure):
		// [0-19]  CREATIVE STUDIO small text chars
		// [20-22] G, 2, F main letterforms
		// [23-29] decorative accent / overlap marks
		const smallText  = paths.slice(0, 20);
		const bigLetters = paths.slice(20, 23);
		const marks      = paths.slice(23);

		// ── Pre-set initial hidden state immediately — no flash ──
		gsap.set(logoSvg,    { filter: 'blur(10px)' });
		gsap.set(bigLetters, { opacity: 0, y: -18, scale: 0.75, transformOrigin: '50% 50%' });
		gsap.set(marks,      { opacity: 0, scale: 0.05, transformOrigin: '50% 50%' });
		gsap.set(smallText,  { opacity: 0, y: 9 });

		const tl = gsap.timeline({
			delay: 0.25,
			onComplete: () => gsap.set(logoSvg, { clearProps: 'filter' }),
		});

		// ── Phase 1: SVG blooms out of blur while letters arrive ──
		tl.to(logoSvg, {
			filter: 'blur(0px)',
			duration: 0.85,
			ease: 'power3.out',
		}, 0);

		// ── Phase 2: G, 2, F drop in with weighted snap ──────────
		tl.to(bigLetters, {
			opacity: 1,
			y: 0,
			scale: 1,
			duration: 0.68,
			ease: 'back.out(1.7)',
			stagger: 0.09,
		}, 0.06);

		// ── Phase 3: Accent marks pop in from random order ───────
		tl.to(marks, {
			opacity: 1,
			scale: 1,
			duration: 0.5,
			ease: 'elastic.out(1, 0.5)',
			stagger: { each: 0.055, from: 'random' },
		}, '-=0.4');

		// ── Phase 4: Small text ripples up left→right ────────────
		tl.to(smallText, {
			opacity: 1,
			y: 0,
			duration: 0.28,
			ease: 'power3.out',
			stagger: { each: 0.022, from: 'start' },
		}, '-=0.32');

		// ── Phase 5: Whole logo settles with elastic micro-bounce ─
		tl.fromTo(
			logoSvg,
			{ scale: 1.03, transformOrigin: 'left center' },
			{ scale: 1, duration: 0.55, ease: 'elastic.out(1, 0.4)', clearProps: 'scale,transform' },
			'-=0.1'
		);
	}

	// =========================================================
	// HEADER ENTRANCE — nav items + CTA stagger in from above
	// =========================================================
	function initHeaderEntrance() {
		if (typeof gsap === 'undefined') return;
		if (window.innerWidth <= 768) return; // hidden on mobile, skip

		const navItems = document.querySelectorAll('.g2f-header-nav .wp-block-navigation-item');
		const cta      = document.querySelector('.g2f-header-cta');
		if (!navItems.length) return;

		const tl = gsap.timeline({ delay: 0.65 });

		// Nav links drop in, one by one
		tl.from(navItems, {
			opacity: 0,
			y: -12,
			duration: 0.45,
			ease: 'power3.out',
			stagger: 0.07,
		});

		// CTA pill arrives after the last nav link
		if (cta) {
			tl.from(cta, {
				opacity: 0,
				y: -12,
				x: 10,
				duration: 0.45,
				ease: 'back.out(1.5)',
			}, '-=0.12');
		}
	}

	// =========================================================
	// HOME HERO ENTRANCE — timeline for all hero elements
	// =========================================================
	function initHomeHeroEntrance() {
		if (typeof gsap === 'undefined') return;

		const heroCover = document.querySelector('.g2f-hero .g2f-hero-cover');
		if (!heroCover) return; // only runs on homepage

		const verticalStrip = document.querySelector('.g2f-hero .g2f-vertical-text-strip');
		const allParas       = heroCover.querySelectorAll('.wp-block-cover__inner-container p');
		const eyebrow        = allParas[0] || null;
		const description    = allParas.length > 1 ? allParas[allParas.length - 1] : null;
		const separator      = heroCover.querySelector('.g2f-hero-separator, .wp-block-separator');

		const tl = gsap.timeline({ delay: 0.35 });

		// Left vertical text strip slides in from left edge
		if (verticalStrip) {
			tl.from(verticalStrip, {
				x: -56,
				opacity: 0,
				duration: 0.8,
				ease: 'power3.out',
				clearProps: 'transform,opacity',
			}, 0);
		}

		// ©2025 eyebrow floats up
		if (eyebrow) {
			tl.from(eyebrow, {
				opacity: 0,
				y: 14,
				duration: 0.55,
				ease: 'power3.out',
			}, 0.18);
		}

		// Separator line draws from left
		if (separator) {
			tl.from(separator, {
				scaleX: 0,
				transformOrigin: 'left center',
				duration: 0.7,
				ease: 'power3.inOut',
				clearProps: 'transform,transformOrigin',
			}, 0.88);
		}

		// Description paragraph fades up last
		if (description) {
			tl.from(description, {
				opacity: 0,
				y: 14,
				duration: 0.55,
				ease: 'power3.out',
			}, 1.0);
		}
	}

	// =========================================================
	// MOBILE MENU (HAMBURGER)
	// =========================================================
	function initMobileMenu() {
		const hamburger = document.querySelector('.g2f-hamburger');
		if (!hamburger) return;

		// Build the full-screen overlay
		const overlay = document.createElement('div');
		overlay.className = 'g2f-mobile-overlay';
		overlay.setAttribute('aria-hidden', 'true');
		overlay.innerHTML = `
			<button class="g2f-mobile-close" aria-label="Close menu">
				<span></span><span></span>
			</button>
			<nav class="g2f-mobile-nav" aria-label="Mobile navigation">
				<a href="/">HOME</a>
				<a href="/about/">ABOUT US</a>
				<a href="/services/">SERVICES</a>
				<a href="/gallery/">GALLERY</a>
				<a href="/contact/">CONTACT</a>
			</nav>
			<div class="g2f-mobile-overlay__cta">
				<a href="/contact/" class="g2f-mobile-overlay__cta-link">GET IN TOUCH →</a>
			</div>
		`;
		document.body.appendChild(overlay);

		const closeBtn = overlay.querySelector('.g2f-mobile-close');

		function openMenu() {
			overlay.classList.add('is-open');
			overlay.setAttribute('aria-hidden', 'false');
			hamburger.classList.add('is-active');
			hamburger.setAttribute('aria-expanded', 'true');
			document.body.style.overflow = 'hidden';
		}

		function closeMenu() {
			overlay.classList.remove('is-open');
			overlay.setAttribute('aria-hidden', 'true');
			hamburger.classList.remove('is-active');
			hamburger.setAttribute('aria-expanded', 'false');
			document.body.style.overflow = '';
		}

		hamburger.addEventListener('click', function () {
			overlay.classList.contains('is-open') ? closeMenu() : openMenu();
		});

		closeBtn.addEventListener('click', closeMenu);

		overlay.addEventListener('click', function (e) {
			if (e.target === overlay) closeMenu();
		});

		overlay.querySelectorAll('a').forEach(function (link) {
			link.addEventListener('click', closeMenu);
		});

		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && overlay.classList.contains('is-open')) closeMenu();
		});

		// Close menu on resize above mobile breakpoint
		window.addEventListener('resize', function () {
			if (window.innerWidth > 768 && overlay.classList.contains('is-open')) closeMenu();
		}, { passive: true });
	}

	// =========================================================
	// STICKY HEADER
	// =========================================================
	function initStickyHeader() {
		const header = document.querySelector('.site-header');
		if (!header) return;

		function updateHeaderHeight() {
			const adminBar = document.getElementById('wpadminbar');
			const adminBarH = adminBar ? adminBar.offsetHeight : 0;
			document.documentElement.style.setProperty(
				'--g2f-header-height',
				header.offsetHeight + 'px'
			);
			// Also expose for hero offset calc
			document.documentElement.style.setProperty(
				'--g2f-adminbar-height',
				adminBarH + 'px'
			);
		}
		updateHeaderHeight();
		window.addEventListener('resize', updateHeaderHeight, { passive: true });

		const scrollThreshold = 40;
		let ticking = false;

		function onScroll() {
			const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

			if (scrollTop > scrollThreshold) {
				header.classList.add('is-sticky');
				document.body.classList.add('header-is-sticky');
			} else {
				header.classList.remove('is-sticky');
				document.body.classList.remove('header-is-sticky');
			}
			ticking = false;
		}

		window.addEventListener('scroll', function () {
			if (!ticking) {
				requestAnimationFrame(onScroll);
				ticking = true;
			}
		}, { passive: true });
	}

	// =========================================================
	// SMOOTH SCROLL
	// =========================================================
	function initSmoothScroll() {
		document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
			anchor.addEventListener('click', function (e) {
				const targetId = this.getAttribute('href');
				if (targetId === '#') return;
				const target = document.querySelector(targetId);
				if (target) {
					e.preventDefault();
					const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
					const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;
					window.scrollTo({ top: targetPosition, behavior: 'smooth' });
				}
			});
		});
	}

	// =========================================================
	// PROJECT FILTER
	// =========================================================
	function initProjectFilter() {
		const tabs = document.querySelectorAll('.g2f-project-tab');
		const projects = document.querySelectorAll('.g2f-project-card');

		if (!tabs.length || !projects.length) return;

		const tabCategoryMap = {
			'all': 'all',
			'ux/ui': 'ux-ui',
			'art direction': 'art-direction',
			'photography': 'photography',
		};

		tabs.forEach((tab) => {
			const text = tab.textContent.trim().toLowerCase();
			tab.dataset.category = tabCategoryMap[text] || 'all';
			tab.style.removeProperty('opacity');
		});

		projects.forEach((project) => {
			const desc = project.querySelector('.g2f-project-info p')?.textContent?.toLowerCase() || '';
			if (desc.includes('ux/ui') || desc.includes('ux-ui') || desc.includes('website')) {
				project.dataset.category = 'ux-ui';
			} else if (desc.includes('branding') || desc.includes('visual identity') || desc.includes('brochure') || desc.includes('graphic design')) {
				project.dataset.category = 'art-direction';
			} else if (desc.includes('photography')) {
				project.dataset.category = 'photography';
			} else {
				project.dataset.category = 'ux-ui';
			}

			const hasImage = project.querySelector('.g2f-project-image, .g2f-project-image-placeholder, figure img');
			if (!hasImage) {
				const placeholder = document.createElement('div');
				placeholder.className = 'g2f-project-image-placeholder';
				project.insertBefore(placeholder, project.firstChild);
			}
		});

		tabs.forEach((tab) => {
			tab.style.cursor = 'pointer';

			tab.addEventListener('click', function () {
				const category = this.dataset.category;
				tabs.forEach((t) => t.classList.remove('active'));
				this.classList.add('active');

				// Animate tab indicator
				if (!reducedMotion && typeof gsap !== 'undefined') {
					gsap.from(this, { scaleX: 0.9, duration: 0.25, ease: 'back.out(2)', transformOrigin: 'center' });
				}

				projects.forEach((project) => {
					const projectCategory = project.dataset.category;
					if (category === 'all' || projectCategory === category) {
						project.style.display = '';
						if (!reducedMotion && typeof gsap !== 'undefined') {
							gsap.fromTo(project, { opacity: 0, y: 15 }, { opacity: 1, y: 0, duration: 0.35, ease: 'power2.out' });
						} else {
							project.style.opacity = '1';
							project.style.transform = 'translateY(0)';
						}
					} else {
						if (!reducedMotion && typeof gsap !== 'undefined') {
							gsap.to(project, {
								opacity: 0,
								y: 10,
								duration: 0.25,
								ease: 'power2.in',
								onComplete: () => { project.style.display = 'none'; },
							});
						} else {
							project.style.opacity = '0';
							setTimeout(() => { project.style.display = 'none'; }, 300);
						}
					}
				});
			});
		});
	}

	// =========================================================
	// CLIENT LOGO MARQUEE
	// =========================================================
	function initClientMarquee() {
		const marquees = document.querySelectorAll('.g2f-clients-marquee');
		marquees.forEach((marquee) => {
			const track = marquee.querySelector('.g2f-clients-track');
			if (!track) return;
			const items = track.innerHTML;
			track.innerHTML = items + items;
		});
	}

	// =========================================================
	// TESTIMONIAL SLIDER
	// =========================================================
	function initTestimonialSlider() {
		// Support both old (.g2f-testimonial-slider) and new (.g2f-testimonial-carousel) markup
		const sliders = document.querySelectorAll('.g2f-testimonial-slider, .g2f-testimonial-carousel');

		sliders.forEach((slider) => {
			const slides = slider.querySelectorAll('.g2f-testimonial');
			const dots   = slider.querySelectorAll('.g2f-testimonial-dot');
			if (!slides.length) return;

			let currentSlide = 0;
			let autoplayInterval;

			function showSlide(index) {
				slides.forEach((slide, i) => {
					slide.classList.toggle('active', i === index);
					slide.classList.toggle('is-active', i === index);
				});
				dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
				currentSlide = index;
			}

			function nextSlide() {
				showSlide((currentSlide + 1) % slides.length);
			}

			// Init first slide
			showSlide(0);

			dots.forEach((dot, index) => {
				dot.addEventListener('click', () => { showSlide(index); resetAutoplay(); });
			});

			function startAutoplay() { autoplayInterval = setInterval(nextSlide, 5000); }
			function resetAutoplay() { clearInterval(autoplayInterval); startAutoplay(); }

			startAutoplay();
			slider.addEventListener('mouseenter', () => clearInterval(autoplayInterval));
			slider.addEventListener('mouseleave', startAutoplay);
		});
	}

	// =========================================================
	// BACK TO TOP
	// =========================================================
	function initBackToTop() {
		const btn = document.querySelector('.g2f-back-to-top');
		if (!btn) return;

		window.addEventListener('scroll', function () {
			if (window.pageYOffset > 400) {
				btn.classList.add('is-visible');
			} else {
				btn.classList.remove('is-visible');
			}
		}, { passive: true });

		btn.addEventListener('click', function () {
			window.scrollTo({ top: 0, behavior: 'smooth' });
		});
	}

})();

/* ==========================================================================
   Projects Grid — Tab Filtering
   ========================================================================== */
document.addEventListener('DOMContentLoaded', function () {
	const tabs = document.querySelectorAll('.g2f-tab');
	const cards = document.querySelectorAll('.g2f-project-card');

	if (!tabs.length || !cards.length) return;

	tabs.forEach(function (tab) {
		tab.addEventListener('click', function () {
			// Toggle active
			tabs.forEach(function (t) { t.classList.remove('active'); });
			tab.classList.add('active');

			var filter = tab.getAttribute('data-filter');
			cards.forEach(function (card) {
				if (filter === 'all' || card.getAttribute('data-category') === filter) {
					card.style.display = '';
				} else {
					card.style.display = 'none';
				}
			});
		});
	});
});
