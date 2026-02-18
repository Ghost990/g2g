# G2F Design Theme — Audit Report

> **Scope:** Full code audit of the WordPress FSE block theme at `/home/ankyr/Work/DEV/g2g/`  
> **Date:** 2026-02-18  
> **Files reviewed:** All 9 pattern files, 8 templates, 2 template parts, `functions.php`, `theme.json`, `assets/css/custom.css` (1454 lines), `assets/js/main.js`

---

## 🔴 Critical Issues (blocks broken, recovery needed)

### 1. `outermost/icon-block` Plugin Dependency — 9 Instances, 8 Files

**Files:**
- `parts/header.html:30`
- `parts/footer.html:31`
- `patterns/button-arrow.php:17`
- `patterns/button-arrow-light.php:17`
- `patterns/about-section.php:63`
- `patterns/services-section.php:69, 114, 183`
- `patterns/portfolio-text.php:72`
- `patterns/projects-grid.php:105`

**Why it's critical:** Every arrow button in the theme uses `<!-- wp:outermost/icon-block -->`. Without "The Icon Block" plugin installed, the WordPress block editor will flag **all nine** of these as **"This block contains unexpected or invalid content"** recovery prompts. The Site Editor will show broken blocks in both the header and footer template parts.

**Frontend behaviour (without plugin):** The SVG renders fine — WordPress preserves the HTML between block comment markers. So the site *looks* correct. But the editor is unusable until the plugin is installed.

**Fix:** Require "The Icon Block" plugin in the theme's README/documentation, and optionally add a notice in `functions.php`:

```php
// In functions.php
function g2f_check_icon_block_plugin() {
    if ( ! is_plugin_active( 'icon-block/icon-block.php' ) ) {
        add_action( 'admin_notices', function() {
            echo '<div class="notice notice-warning"><p><strong>G2F Theme:</strong> The <a href="https://wordpress.org/plugins/icon-block/">Icon Block plugin</a> is required for arrow buttons to work correctly in the editor.</p></div>';
        } );
    }
}
add_action( 'admin_init', 'g2f_check_icon_block_plugin' );
```

---

### 2. Missing `anchor` Attribute — Block Validation Errors on Insert

**Files and lines:**
- `patterns/hero-section.php:11` — HTML has `id="home"`, JSON has no `"anchor":"home"`
- `patterns/about-section.php:11` — HTML has `id="about"`, JSON has no `"anchor":"about"`
- `patterns/services-section.php:11` — HTML has `id="services"`, JSON has no `"anchor":"services"`
- `patterns/projects-grid.php:80` — HTML has `id="gallery"`, JSON has no `"anchor":"gallery"`

**Why it's critical:** WordPress block validation works by comparing the *saved HTML* against the HTML that the block *would generate* from its attributes. The `id="..."` attributes are present in the raw HTML but **not** in the block JSON attributes. When a user inserts these patterns into a page and saves, the editor re-parses the block. The generator produces HTML without `id`, finds it doesn't match the saved HTML (which has `id`), and shows a **block recovery prompt**.

The correct WordPress API for adding `id` to a block is the `anchor` attribute:

**Fix:** Add `"anchor":"home"` (etc.) to each block's JSON comment and the `id` attribute to the rendered HTML:

```html
<!-- BEFORE (broken): -->
<!-- wp:group {"tagName":"section","className":"g2f-hero",...} -->
<section id="home" class="wp-block-group g2f-hero" ...>

<!-- AFTER (correct): -->
<!-- wp:group {"tagName":"section","className":"g2f-hero","anchor":"home",...} -->
<section id="home" class="wp-block-group g2f-hero" ...>
```

Apply to all four patterns listed above. Also note that `anchor` support needs to be enabled — for `core/group` it's already on by default in WP 6.4+.

---

### 3. Non-Standard `style.display` on Testimonial Group Blocks

**File:** `patterns/testimonials.php:67, 95`

```html
<!-- wp:group {"className":"g2f-testimonial","style":{"display":"none"},...} -->
<div class="wp-block-group g2f-testimonial" style="display:none">
```

**Why it's critical:** `display` is **not a supported style property** in the WordPress block API's `style` object (WP 6.5). WordPress's block serializer will not produce `style="display:none"` from the block attributes, so when the editor validates the block it finds a mismatch and shows a recovery prompt. Additionally, after editing and saving, the `display:none` may be stripped, breaking the slider initial state.

**Fix:** Remove `"style":{"display":"none"}` from the block JSON and the `style="display:none"` from the HTML. Use a CSS class to hide non-active slides instead, controlled by JavaScript:

```css
/* In custom.css */
.g2f-testimonial { display: none; }
.g2f-testimonial.is-active { display: block; }
```

Then in `main.js`, `showSlide()` toggles `.is-active` instead of setting `style.display`.

The pattern HTML should become:
```html
<!-- wp:group {"className":"g2f-testimonial","layout":{...}} -->
<div class="wp-block-group g2f-testimonial">
```

---

### 4. Inline Style on Anchor in `portfolio-text.php` — Block Validation Mismatch

**File:** `patterns/portfolio-text.php:69`

```html
<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1.2"}},"textColor":"white","fontSize":"medium","fontFamily":"inter"} -->
<p class="has-white-color ..." style="font-style:normal;font-weight:600;line-height:1.2">
  <a href="#" style="color:inherit;text-decoration:none">SOLUTIONS</a>
</p>
```

**Why it's critical:** The anchor has `style="color:inherit;text-decoration:none"` as an **inline style** that is **not represented in the block attributes JSON**. The block editor regenerates paragraph HTML from its attributes and won't include the anchor's inline style. On the next save/re-open cycle the editor detects the mismatch and flags block recovery.

**Fix:** Remove the inline style from the anchor. The `color:inherit` is handled by the group's `textColor:"white"` attribute + `has-link-color` CSS cascade. For `text-decoration:none`, add it to `theme.json` globally (already done via `elements.link.typography.textDecoration: "none"`).

```html
<!-- Fixed: just remove style="" from the anchor -->
<p class="has-white-color ..." style="font-style:normal;font-weight:600;line-height:1.2">
  <a href="#">SOLUTIONS</a>
</p>
```

---

## 🟠 Important Issues (design/functionality affected)

### 5. Duplicate `style.css` Enqueue in FSE Theme

**File:** `functions.php:69-76`

```php
wp_enqueue_style(
    'g2f-theme-style',
    get_stylesheet_uri(),  // This is style.css
    ...
);
```

**Why it's important:** WordPress FSE (block) themes automatically enqueue `style.css` via the block system's global stylesheet mechanism. Adding a second `wp_enqueue_style()` call for the same file creates **two `<link>` tags** for `style.css` on every page load — a wasted HTTP request and double CSS parse. 

**Fix:** Remove the `g2f-theme-style` enqueue handle entirely. Keep only `g2f-theme-custom` (custom.css):

```php
function g2f_theme_enqueue_assets() {
    $theme_version = wp_get_theme()->get( 'Version' );
    // style.css is auto-enqueued by WordPress FSE system — do not re-enqueue
    wp_enqueue_style(
        'g2f-theme-custom',
        get_template_directory_uri() . '/assets/css/custom.css',
        array(), // No dependency on style handle anymore
        $theme_version
    );
    wp_enqueue_script( ... );
}
```

---

### 6. Google Fonts Preconnect Unnecessary (Fonts Are Self-Hosted)

**File:** `functions.php:214-232`

```php
function g2f_theme_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array( 'href' => 'https://fonts.googleapis.com', 'crossorigin' );
        $urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'g2f_theme_resource_hints', 10, 2 );
```

**Why it's important:** Both Roboto and Inter are **self-hosted** in `/assets/fonts/`. Preconnecting to Google Fonts servers serves no purpose — there are no requests to those domains. This adds unnecessary DNS lookups and may mislead future developers into thinking Google Fonts are still being used.

There is also a **PHP array bug**: `'crossorigin'` without `=> true` is stored at numeric index `0`, not as the `crossorigin` key. The correct format is `'crossorigin' => true`.

**Fix:** Remove the entire function and `add_filter` call. If you ever need preconnect hints for self-hosted fonts, use `preload` instead.

---

### 7. Missing `id="contact"` Anchor — Broken Navigation

**Files:** `parts/header.html` (GET IN TOUCH → `#contact`), `parts/footer.html:18` (mailto link)

The header has `<a href="#contact">GET IN TOUCH</a>` and navigation link `href="#contact"`, but **no element in any pattern has `id="contact"`**. The JavaScript smooth-scroll (`initSmoothScroll`) silently fails to scroll anywhere when clicking "GET IN TOUCH" since `document.querySelector("#contact")` returns null.

**Fix:** Add an `anchor` attribute to the footer's `g2f-footer` group block:

```html
<!-- wp:group {"tagName":"footer","anchor":"contact","className":"g2f-footer",...} -->
<footer id="contact" class="wp-block-group g2f-footer ...">
```

---

### 8. Navigation `ref: ""` in Header — Empty Navigation Block

**File:** `parts/header.html:16`

```html
<!-- wp:navigation {"ref":"","overlayMenu":"never",...} -->
```

**Why it's important:** The empty `ref:""` means no saved navigation is assigned to the header's Navigation block. In the editor this shows the "Start empty or select menu" prompt. On the frontend, the navigation renders as an empty `<nav>` with no links — just the four static `navigation-link` children defined inline. Those inline children work for the initial pattern insert, but once a user saves the navigation as a named menu, the `ref` stays empty.

**Fix:** The inline `wp:navigation-link` items should work fine for a single-page site. Consider removing the empty `ref:""` (or setting `"ref":null`) to avoid confusion, and document that users should save the navigation via the Site Editor.

---

### 9. Hardcoded 446px Block Gap in Header — Tablet Layout Breaks

**File:** `parts/header.html:13`

```html
<!-- wp:group {"style":{"spacing":{"blockGap":"446px"}},...} -->
```

This 446px gap between the navigation links and the "GET IN TOUCH" CTA button is hardcoded in pixels. At tablet widths (768–1440px) this causes the header content to overflow or wrap awkwardly since there's no responsive CSS override for this specific blockGap value.

**Fix:** Replace the hardcoded gap with `justify-content: space-between` instead of a fixed gap, by using the flex layout's `justifyContent` property:

```html
<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"},...} -->
```
Remove the `blockGap:"446px"` entirely. This auto-distributes space between nav and CTA at any viewport width.

---

### 10. Missing `project` CPT Registration — `single-project.html` Template Non-Functional

**File:** `templates/single-project.html:28`, `functions.php` (no CPT registration)

The `single-project.html` template queries `"postType":"project"` and uses `<!-- wp:post-terms {"term":"project_category"} -->`. Neither the `project` custom post type nor the `project_category` taxonomy is registered anywhere in `functions.php`. The template will never be loaded since no `project` URLs exist.

**Fix:** Either register the CPT in `functions.php`:

```php
function g2f_register_project_post_type() {
    register_post_type( 'project', array(
        'labels'      => array( 'name' => __( 'Projects', 'g2f-theme' ) ),
        'public'      => true,
        'has_archive' => true,
        'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'taxonomies'  => array( 'project_category' ),
    ) );
    register_taxonomy( 'project_category', 'project', array(
        'labels' => array( 'name' => __( 'Project Categories', 'g2f-theme' ) ),
        'public' => true,
    ) );
}
add_action( 'init', 'g2f_register_project_post_type' );
```

Or remove `single-project.html` if projects are only displayed via the filterable grid pattern.

---

### 11. Hero Cover Has `background-color: #fff` Override — Text Invisible Without Image

**File:** `assets/css/custom.css:382`, `patterns/hero-section.php:27`

```css
.g2f-hero .wp-block-cover {
    background-color: #fff !important;
}
```

The hero cover block has `"url":""` (no image set) with `overlayColor: "black"`. In a normal Cover block without an image, the block would show the black overlay. But the CSS forces `background-color: #fff` which overrides even the black overlay background, making the hero render as **pure white**. Since all text in the hero is `textColor: "white"`, the text becomes **completely invisible** until a hero background image is set.

This catches new installations completely off-guard — the theme appears broken with no visual content.

**Fix:** Add a fallback background for the "no image" state in CSS:

```css
.g2f-hero .wp-block-cover:not(.has-background-dim) {
    background-color: #1a1a1a !important; /* Dark fallback */
}
/* Or use a placeholder gradient */
.g2f-hero .wp-block-cover {
    background: linear-gradient(135deg, #1a1a1a 0%, #333 100%) !important;
}
```

Alternatively, consider setting a default placeholder background image in the pattern itself (a bundled dark gradient PNG in `/assets/images/`).

---

### 12. Hero Left Strip Width Uncontrolled — Potential Layout Shift

**File:** `patterns/hero-section.php:17`, `assets/css/custom.css`

The `.g2f-vertical-text-strip` block has **no explicit width** in either the block attributes or CSS. Its width is determined purely by the `writing-mode: vertical-rl` text content (`"WELCOME TO G2F DESIGN"` at 14px bold). Different screen resolutions and font rendering may result in slightly different strip widths (estimated ~18–22px for rotated vertical text at 14px).

The CSS adds `padding-left: 60px !important` to the cover block, intending to leave a 60px white zone on the left of the image. But the strip's **actual width is independent of this 60px padding**. The result is that the left side of the hero has:
- Flex strip (~18–22px wide, white)
- Cover left padding (60px white) — this is *inside* the cover block

Total left white space = strip width + 60px ≈ ~80px, which differs from the design's intended ~60px.

**Fix:** Give the strip an explicit width matching the design spec (typically 60–80px):

```html
<!-- wp:group {"className":"g2f-vertical-text-strip","style":{"dimensions":{"minWidth":"60px"},...}} -->
```

Or via CSS:
```css
.g2f-vertical-text-strip {
    width: 60px;
    min-width: 60px;
    flex-shrink: 0;
}
```

Then set cover `padding-left: 0 !important` (or remove the left padding rule) to avoid double white space.

---

## 🟡 Minor Issues (best practices, polish)

### 13. Typography Typo in `portfolio-text.php`

**File:** `patterns/portfolio-text.php:43`

```html
<p class="has-inter-font-family" ...>A Variaty Of</p>
```

"Variaty" should be **"Variety"**.

---

### 14. Roboto Font Weight 600 Maps to Weight 500 File

**File:** `theme.json` (typography.fontFamilies[0].fontFace)

```json
{
    "fontFamily": "Roboto",
    "fontWeight": "600",
    "src": ["file:./assets/fonts/roboto/Roboto-Medium.woff2"]
}
```

Roboto's Medium weight is **500**, not 600. There is no Roboto SemiBold. Mapping `font-weight: 600` to `Roboto-Medium.woff2` means the browser will apply the Medium (500) design when `font-weight: 600` is requested. This creates a subtle typographic inconsistency — elements with `fontWeight: "600"` render visually the same as `fontWeight: "500"`.

**Fix:** Either:
- Remove the 600 weight entry entirely (600 will then fall back to 700 Bold via font matching)
- Or map 600 → Bold (700): `"src": ["file:./assets/fonts/roboto/Roboto-Bold.woff2"]`

---

### 15. `theme.json` Uses Unstable Trunk Schema URL

**File:** `theme.json:2`

```json
"$schema": "https://schemas.wp.org/trunk/theme.json"
```

`trunk` refers to the development version of the schema, which may change at any time. IDE validation against a moving target can introduce false errors.

**Fix:** Use a versioned URL:
```json
"$schema": "https://schemas.wp.org/wp/6.5/theme.json"
```

---

### 16. Missing `id="contact"` on Portfolio, Clients, and Testimonials Sections

**Files:** `patterns/portfolio-text.php:12`, `patterns/clients-section.php:12`, `patterns/testimonials.php:11`

These sections have no `id` or `anchor` attribute. If users want to add navigation links to these sections in the future (e.g., a "Portfolio" nav link), they have no anchor to target.

**Fix:** Add anchors to the section group blocks. For example in `portfolio-text.php`:

```html
<!-- wp:group {"tagName":"section","anchor":"portfolio","className":"g2f-portfolio-split",...} -->
<section id="portfolio" class="wp-block-group g2f-portfolio-split ...">
```

---

### 17. Pattern Text Strings Not Translatable

**Files:** All pattern files in `patterns/`

All human-readable text strings in patterns (e.g., "WELCOME TO G2F DESIGN", "We Bring Creative Ideas To Life.", button labels "ABOUT US", "EXPLORE", etc.) are hardcoded in English. PHP pattern files support `__()` and `_x()` translation functions.

**Fix:** For strings in PHP variables or echo'd content, wrap in `__()`:

```php
// Example in patterns/hero-section.php
<p class="g2f-vertical-text ...">
    <?php echo esc_html__( 'WELCOME TO G2F DESIGN', 'g2f-theme' ); ?>
</p>
```

Note: Strings within block markup comment (HTML output) in PHP patterns are technically renderable PHP strings and CAN use `esc_html__()`.

---

### 18. Scroll Animation CSS Classes Not Applied to Any Elements

**Files:** `assets/css/custom.css:1340-1385`, `assets/js/main.js:22-40`

The CSS defines `.g2f-fade-in`, `.g2f-slide-left`, `.g2f-slide-right` animation classes and `main.js` initializes an `IntersectionObserver` to apply `.is-visible` to them. However, **none of the pattern files add these classes to any elements**. The entire animation system exists in CSS and JS but is never triggered. No elements animate on scroll.

**Fix:** Add animation classes to pattern elements where scroll reveal is desired. For example in `about-section.php`:

```html
<!-- wp:column {"width":"490px","className":"g2f-slide-left"} -->
```

Or add them via JavaScript's `querySelectorAll` targeting semantic structure (e.g., all `.g2f-service-row` elements).

---

### 19. Client Marquee Has FOUC Before JS Runs

**File:** `patterns/clients-section.php`, `assets/js/main.js:176-190`

The CSS marquee animation does `translateX(-50%)` which requires the track to be double-length. The JS in `initClientMarquee()` duplicates the track content on DOM load. Before JS runs (or if JS fails), the marquee animates to `-50%` with only the original items, reaching an empty white space halfway through the animation.

**Fix:** Duplicate the content statically in the pattern markup itself (add a second set of logo images), so the track is already double-length before JS runs. Then JS's duplication step can be skipped or used as a safety check:

```html
<!-- In clients-section.php, add the logos twice in the track: -->
<!-- Logo 1-10 then Logo 1-10 again -->
```

---

### 20. Service Numbers (01, 02, 03) Hidden by CSS — Content in DOM but Invisible

**File:** `patterns/services-section.php:50, 95, 164`, `assets/css/custom.css:1167`

```css
.g2f-services-zigzag .g2f-service-row .wp-block-group > p:first-child {
    display: none !important;
}
```

The service number paragraphs (01, 02, 03) are present in the DOM but hidden. Screenreaders will announce them. If the CSS file fails to load, the numbers appear unexpectedly. The selector is also fragile — it hides the *first paragraph* of the service content group, which could hide actual content if the structure changes.

**Fix:** Remove the number paragraphs from the patterns entirely, or if the design requires them as hidden accessibility aids, use `aria-hidden="true"` and a visually-hidden CSS class.

---

### 21. Testimonials: Initial Dot Active State Mismatch

**File:** `patterns/testimonials.php:122`

```html
<span class="g2f-testimonial-dot" data-slide="0"></span>
<span class="g2f-testimonial-dot" data-slide="1"></span>
<span class="g2f-testimonial-dot active" data-slide="2"></span>
```

The third dot has `active` class in the initial markup, but the JS's `showSlide(0)` immediately sets the first dot active on DOMContentLoaded. This creates a 1-frame visual glitch where the wrong dot appears active before JS initializes.

**Fix:** Set the first dot as active in the initial markup:

```html
<span class="g2f-testimonial-dot active" data-slide="0"></span>
<span class="g2f-testimonial-dot" data-slide="1"></span>
<span class="g2f-testimonial-dot" data-slide="2"></span>
```

---

### 22. Dead CSS Selectors for Hero Vertical Text Strip

**File:** `assets/css/custom.css:350-362`

```css
.g2f-hero > .g2f-vertical-text,
.g2f-hero > .wp-block-group.g2f-vertical-text {
    position: absolute;
    left: 0;
    ...
}
```

The actual HTML structure is `.g2f-hero > .g2f-hero-wrapper > .g2f-vertical-text-strip`. The CSS selectors use the wrong class name (`.g2f-vertical-text` vs `.g2f-vertical-text-strip`) AND the wrong depth (direct child of `.g2f-hero` vs grandchild). These rules match **nothing** and are dead code.

**Fix:** Remove these dead selectors (lines 350–362). The hero layout currently works via the flex structure in `.g2f-hero-wrapper` — no additional positioning CSS is needed.

---

### 23. No `search.html` Template

No search results template exists. Searches fall back to `index.html` which shows a generic blog-style listing. On a portfolio/agency site, this is typically fine for the MVP, but there's no "No results" friendly UI beyond the bare `index.html`.

**Fix:** Create `templates/search.html` with a proper search results header and results listing, or at minimum leave a note in the README.

---

### 24. No `languages/` Directory

**File:** `functions.php:55`

```php
load_theme_textdomain( 'g2f-theme', get_template_directory() . '/languages' );
```

The `languages/` directory does not exist in the theme. The function call is harmless (WordPress handles missing directories gracefully), but it indicates translation readiness that doesn't exist yet.

**Fix:** Create an empty `languages/` directory (add a `.gitkeep` file) and generate a `.pot` file when translation-ready strings are added to patterns.

---

### 25. `register_nav_menus` Not Needed for FSE Theme

**File:** `functions.php:43-47`

Classic navigation menus (`register_nav_menus`) are not used in FSE themes. Navigation is handled via the `core/navigation` block. The three registered menu locations (`primary`, `footer`, `social`) appear in the Appearance > Menus admin (which is hidden in FSE themes) and create confusion.

**Fix:** Remove `register_nav_menus()` call. It's harmless but unnecessary.

---

### 26. `about-section.php` Has Redundant `position:relative` Block Attribute

**File:** `patterns/about-section.php:14`

```html
<!-- wp:group {"style":{"position":{"type":"relative"}},...} -->
<div class="wp-block-group">
```

WordPress 6.5 does not output `position: relative` CSS from `style.position.type: "relative"` (only `sticky` is supported via the block API). The HTML output has no `style="position:relative"` inline style. The CSS in `custom.css:1254` correctly adds `position: relative` to `.g2f-about-section > .wp-block-group` directly.

**Fix:** Remove `"style":{"position":{"type":"relative"}}` from the block attribute JSON — it generates nothing and is misleading.

---

## 📋 SVG Icon Specific Issues

### SVG Registration in `functions.php`

The `g2f_theme_register_icon_library()` function registers two icons:
- `g2f-arrows/arrow-right-black` (stroke: black)
- `g2f-arrows/arrow-right-white` (stroke: white)

**Issue A — Filter name correctness:** The hook `icon_block_libraries` is correct for **The Icon Block plugin v2.0+** (current stable release). Older versions (pre-2.0) used a different hook. This is fine for current installs but worth documenting.

**Issue B — SVG stroke color is hardcoded, not `currentColor`:** All registered SVGs use literal stroke values:
```html
stroke="black"
stroke="white"
```
Best practice is to use `stroke="currentColor"` so the icon inherits CSS `color` and can be recolored via CSS without overriding the SVG directly. The current hover CSS (`svg path { stroke: white }`) works as a workaround, but using `currentColor` would be cleaner and more maintainable:

```html
<!-- Recommended: -->
<svg ...><path d="..." stroke="currentColor" .../></svg>
```

Then hover behavior can use `color` property instead of `stroke`:
```css
.g2f-button-arrow:hover {
    color: white; /* currentColor propagates to SVG stroke */
}
```

**Issue C — Inline SVG inside block content vs. library reference:** The `outermost/icon-block` block stores the SVG inline in the saved HTML (the content between the block comment markers). Even without the plugin, the SVG renders on the frontend. However, the `iconName` attribute (`"iconName":"g2f-arrows/arrow-right-black"`) references the custom library registered in functions.php — this means the icon ALSO needs to be correctly registered to render in the **editor**. If the library registration fails (filter not running, plugin not active), the editor shows a placeholder icon or recovery prompt.

**Issue D — SVG validation attributes are correct:** All SVGs have:
- ✅ `viewBox="0 0 20 20"` — correct
- ✅ `xmlns="http://www.w3.org/2000/svg"` — correct
- ✅ `fill="none"` — correct
- ✅ `stroke-width="1.5"` — correct
- ✅ `stroke-linecap="round" stroke-linejoin="round"` — correct
- ✅ `width="20" height="20"` — correct

No SVG attribute issues that would cause rendering problems.

**Issue E — Icon block `width` and `height` attributes:** The icon block uses `"width":"20px","height":"20px"`. The CSS overrides:
```css
.g2f-button-arrow .wp-block-outermost-icon-block svg {
    width: 20px;
    height: 20px;
}
```
This is redundant but harmless.

---

## 📐 Design Fidelity Notes

### Hero Section
The hero implementation broadly matches the design: full-width with a narrow white vertical text strip on the left and a dark-overlaid photo. **Issue:** The strip has no explicit width, relying on rotated text intrinsic sizing (~18-22px), while the design likely shows a fixed ~60px strip. The cover also adds 60px left padding, creating double white space on the left (~80px total vs. intended ~60px). The right side of the hero photo also gets a 60px white strip from the cover padding — the design appears to have the photo flush to the right edge of the viewport.

### About Section
The 2-column layout (490px image + 658px content) adds to 1218px with a 70px gap — perfectly matches the contentSize. The "About Us" vertical text rotated on the right side works via absolute positioning. **Issue:** The `right: -120px` + `transform: translateX(100%)` positions the text well outside the container. With `body { overflow-x: hidden }`, this text may be clipped at most viewport widths, particularly at 1440px where the about section has auto padding. The vertical "About Us" label effectively becomes invisible at many viewport sizes.

### Services Section
The zig-zag layout (image left/text right, text left/image right, image left/text right) is correctly implemented with `g2f-service-row` and `g2f-service-row-reverse`. **Issue:** The service number labels (01, 02, 03) are in the markup but hidden by CSS. The design shows these numbers, and hiding them diverges from the design. The services title has `font-style: italic` applied to the `<strong>` tag via CSS, but the design mockup shows normal (non-italic) bold text.

### Portfolio Text Section
The split layout with large stacked Inter typography on the left and content on the right is correctly implemented. **Issues:**
1. The "Variaty" typo (#13 above)
2. The gradient "Creative / **Portfolio** With / A Variaty Of / Examples." typography — the mixed weight effect (light "Creative" then bold "Portfolio") should use h2/p with separate font-weight declarations rather than inline `<strong>` inside paragraphs for semantic correctness

### Projects Grid
The 3-column filterable grid is correctly implemented. **Issue:** The filter tabs' `data-category` attributes are assigned by JavaScript based on text content — this is fragile. If the tab text changes, the filter breaks. The `g2f-project-card` `data-category` is also assigned dynamically based on inferring category from the description text. This is error-prone for projects with ambiguous descriptions.

### Testimonials Slider
The JS-driven testimonial slider with dots works correctly. **Minor:** Auto-play at 5 seconds is standard. **Issue:** Keyboard navigation for the slider is not implemented — users cannot navigate between testimonials using keyboard alone (Tab/Enter on dots works, but arrow keys don't).

### Clients Marquee
The marquee animation is well-implemented with pause-on-hover. **Issue:** As noted, FOUC before JS doubles the track. All logo `src=""` attributes are empty placeholders — the marquee section will show empty `<img>` elements until real logos are added.

### Footer
The "Let's talk." design with the large 100px Inter heading matches the design well. **Issue:** Footer padding is hardcoded at `370px` on both sides (in the block attribute) for the initial `>1440px` case. The CSS media query at `1440px` adjusts it to `100px`, but there's a gap between ~1440-1920px where the block's hardcoded padding may override the CSS.

### Responsive Implementation
- ✅ 1440px breakpoint: Good coverage for font scaling
- ✅ 1024px breakpoint: Grid to 2-column, service rows to 50%
- ✅ 768px breakpoint: Everything stacks to 1-column
- ✅ 480px breakpoint: Font size reduction for hero/footer title
- ⚠️ Missing: No specific styles for the hamburger/mobile navigation menu — the Navigation block defaults to its own hamburger behavior, which may not match the design

---

## ✅ What's Working Well

1. **Block comment structure is valid** — All 9 patterns and 8 templates have balanced opening/closing block comments. No mismatched `<!-- wp:xxx -->`/`<!-- /wp:xxx -->` pairs detected.

2. **Self-hosted fonts are correctly configured** — Both Roboto and Inter are fully specified in `theme.json` with all required weights and mapped to local `.woff2` files. The `@font-face` rules are generated automatically by WordPress. No Google Fonts loading.

3. **Color palette in `theme.json` is clean and purposeful** — 10 monochromatic colors (`black`, `white`, `gray-light`, `gray-dark`, `text-primary`, `text-secondary`, `text-muted`, `text-footer`, `border-light`, `text-light`). Correctly uses `"defaultPalette": false` to hide core colors from the editor.

4. **Sticky header implementation is solid** — The JS uses a passive scroll listener, adds/removes `.is-sticky` class, and the CSS applies `position: fixed` + shadow + compact transitions. The admin bar offset is handled for both desktop and mobile (`top: 32px`/`46px`).

5. **JavaScript is clean vanilla ES5+ IIFE** — No jQuery, uses Intersection Observer, passive event listeners. `initProjectFilter()` gracefully handles the case where `data-category` attributes aren't in the server-side HTML (assigns them dynamically from text content).

6. **`theme.json` typography system is comprehensive** — 9 font sizes from 14px to 100px, fluid typography enabled, proper element styles for h1-h6 with correct font families, weights, and line heights.

7. **CSS architecture is well-organized** — Clear section comments, BEM-like class naming with `.g2f-*` prefix, logical responsive breakpoints. Custom properties (`--g2f-transition`, `--g2f-shadow`) used consistently.

8. **SVG attributes are technically correct** — All SVGs have proper `viewBox`, `xmlns`, `fill="none"`, and stroke attributes.

9. **Image sizes are registered with correct aspect ratios** — Hero (1688×868), Service (609×500), About (490×601), Project (386×316), Avatar (64×64) — all match the design dimensions.

10. **Testimonial slider handles multiple sliders** — `initTestimonialSlider()` uses `querySelectorAll` to support multiple slider instances on the same page. Autoplay, pause-on-hover, and dot navigation all work.

11. **Block styles are registered correctly** — `g2f-outline`, `g2f-solid`, `g2f-rounded`, `g2f-section`, `g2f-card` all registered with `register_block_style()` and corresponding CSS.

12. **Template hierarchy is complete for core use cases** — `front-page.html`, `index.html`, `page.html`, `single.html`, `archive.html`, `404.html`, `blank.html`, `full-width.html` all exist.

---

## 🔧 Recommended Fix Order

### Immediate (before going live)

1. **Install "The Icon Block" plugin** (#1) — Blocks are broken in editor without it. Required.
2. **Add `anchor` attributes to section blocks** (#2) — Fix hero, about, services, gallery patterns to use `"anchor":"home"` etc. in JSON. Prevents validation errors when patterns are inserted.
3. **Fix testimonial `display:none` block attributes** (#3) — Replace with CSS class. Prevents recovery prompts for the testimonials pattern.
4. **Remove inline `style` from portfolio anchor** (#4) — Quick one-liner fix. Prevents block validation mismatch.
5. **Add `id="contact"` anchor to footer** (#7) — Header CTA button is currently broken (scrolls nowhere).

### High Priority (first week)

6. **Fix hero CSS for "no image" state** (#11) — Prevents blank white hero on fresh installs.
7. **Remove duplicate stylesheet enqueue** (#5) — Performance fix, one line to delete.
8. **Remove Google Fonts preconnect** (#6) — Remove entire `g2f_theme_resource_hints` function.
9. **Fix header navigation gap** (#9) — Use `justifyContent: space-between` instead of `blockGap: "446px"`.
10. **Register `project` CPT or remove `single-project.html`** (#10).

### Medium Priority (before client handoff)

11. **Fix "Variaty" typo** (#13) — One word change.
12. **Fix testimonial dot initial state** (#21) — Move `active` class to first dot.
13. **Add `currentColor` to SVG icons** (SVG Issue B) — Cleaner hover states.
14. **Implement marquee FOUC fix** (#19) — Duplicate logos statically in pattern markup.
15. **Fix Roboto weight 600 mapping** (#14) — Map to Bold or remove weight 600.

### Polish / Best Practices (before v1.0 release)

16. Wrap pattern strings in `__()` for translations (#17)
17. Add scroll animation classes to pattern elements (#18)
18. Remove dead CSS selectors for hero vertical text (#22)
19. Add `search.html` template (#23)
20. Create `languages/` directory (#24)
21. Remove `register_nav_menus()` (#25)
22. Fix theme.json schema to versioned URL (#15)
23. Add `id` anchors to portfolio, clients, testimonials sections (#16)
24. Remove redundant `position: relative` block attribute from about section (#26)
25. Remove service number paragraphs from markup if design hides them (#20)
