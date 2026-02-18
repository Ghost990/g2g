# WordPress SVG Icon Solutions for Block Editor

## The Problem

When using `<!-- wp:html -->` blocks to embed SVG icons in WordPress patterns, the editor displays raw SVG code instead of the rendered icon. This is because the HTML block is designed for raw code input and doesn't visually render SVG content in the editor.

## Solutions

### Solution 1: The Icon Block Plugin (Recommended)

**Plugin:** [The Icon Block](https://wordpress.org/plugins/icon-block/)

The most elegant solution for your use case. Registers a proper block that displays SVG icons beautifully in both editor and frontend.

**Key Features:**
- 290+ native WordPress icons including social logos
- Use any custom SVG icon by pasting code
- Proper visual preview in editor (not raw code!)
- Icon controls: link, rotate, alignment, colors, border, padding, margin
- Fully compatible with Site Editor
- Can register custom icon libraries

**Usage:**
1. Install and activate the plugin
2. Replace `<!-- wp:html -->` SVG blocks with the Icon Block
3. Either select from library or paste custom SVG code
4. Icons display properly in both editor and frontend

**Custom Icon Library Registration:**
```php
// In functions.php or custom plugin
add_filter( 'icon_block_libraries', function( $libraries ) {
    $libraries['g2f-arrows'] = array(
        'name' => 'G2F Arrows',
        'icons' => array(
            array(
                'name' => 'arrow-right',
                'icon' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.125 10H16.875" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.25 4.375L16.875 10L11.25 15.625" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            ),
        ),
    );
    return $libraries;
});
```

### Solution 2: SVG Block Plugin

**Plugin:** [SVG Block](https://wordpress.org/plugins/svg-block/)

Another solid option with more icon libraries.

**Key Features:**
- 3000+ icons from Bootstrap Icons, Ionicons, Dashicons, WordPress Icons
- Upload or input custom SVG images
- Live preview in editor

### Solution 3: Create Custom Arrow Block (Developer Approach)

For maximum control, create a simple custom block for your arrow icons.

**Block Registration (PHP):**
```php
// In functions.php
function g2f_register_arrow_block() {
    register_block_type( __DIR__ . '/blocks/arrow-icon' );
}
add_action( 'init', 'g2f_register_arrow_block' );
```

**block.json:**
```json
{
    "apiVersion": 3,
    "name": "g2f/arrow-icon",
    "title": "Arrow Icon",
    "category": "design",
    "icon": "arrow-right-alt",
    "description": "Display an arrow icon",
    "supports": {
        "align": true,
        "color": {
            "text": true,
            "background": false
        }
    },
    "attributes": {
        "direction": {
            "type": "string",
            "default": "right"
        }
    },
    "textdomain": "g2f-theme",
    "editorScript": "file:./index.js",
    "render": "file:./render.php"
}
```

### Solution 4: Use Dashicons (Simplest)

WordPress includes built-in Dashicons that render properly in the editor.

**In Patterns:**
```html
<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}}} -->
<p style="font-style:normal;font-weight:600"><a href="#">EXPLORE</a> <span class="dashicons dashicons-arrow-right-alt"></span></p>
<!-- /wp:paragraph -->
```

**CSS for Dashicons:**
```css
.dashicons-arrow-right-alt {
    vertical-align: middle;
    margin-left: 8px;
}
```

### Solution 5: Font-Based Icons (Icon Fonts)

Use icon fonts like Font Awesome which render as text characters.

**Enqueue in functions.php:**
```php
function g2f_enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'g2f_enqueue_font_awesome');
add_action('enqueue_block_editor_assets', 'g2f_enqueue_font_awesome');
```

**In Patterns:**
```html
<!-- wp:paragraph -->
<p><a href="#">EXPLORE</a> <i class="fa-solid fa-arrow-right"></i></p>
<!-- /wp:paragraph -->
```

## Comparison Table

| Solution | Editor Preview | Complexity | Flexibility | Maintenance |
|----------|---------------|------------|-------------|-------------|
| Icon Block Plugin | ✅ Excellent | Low | High | Plugin updates |
| SVG Block Plugin | ✅ Good | Low | High | Plugin updates |
| Custom Block | ✅ Full control | Medium-High | Maximum | Self-maintained |
| Dashicons | ✅ Native | Very Low | Limited icons | Built-in |
| Icon Fonts | ✅ Good | Low | High | External CDN |

## Recommendation for G2F Theme

**Primary Recommendation: Icon Block Plugin**

Best balance of features, ease of use, and editor experience. You can:
1. Use built-in WordPress icons for common needs
2. Register your custom arrow icon as a library
3. Get proper visual preview in the editor
4. Maintain all the styling controls you need

**Implementation Steps:**
1. Install "The Icon Block" plugin
2. Register your arrow SVG as a custom icon library (optional)
3. Replace `<!-- wp:html -->` blocks in patterns with Icon Block
4. Style using existing CSS or block controls

## Resources

- [The Icon Block - WordPress.org](https://wordpress.org/plugins/icon-block/)
- [Adding Custom Icons to Icon Block](https://nickdiego.com/adding-custom-icons-to-the-icon-block/)
- [SVG Block - WordPress.org](https://wordpress.org/plugins/svg-block/)
- [WordPress Block Editor Handbook - Icons](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-icons/)
- [Dashicons Reference](https://developer.wordpress.org/resource/dashicons/)
