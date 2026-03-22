<?php
/**
 * Title: Project Gallery Slider
 * Slug: g2f-theme/project-gallery
 * Categories: g2f-theme
 * Keywords: project, gallery, slider
 * Description: Full-width horizontal image slider for single project pages
 */

global $post;
if ( ! $post ) return;

// Get all images attached to this post
$images = get_attached_media( 'image', $post->ID );

// Fallback: use featured image if no attachments
if ( empty( $images ) ) {
	$thumb = get_the_post_thumbnail_url( $post->ID, 'full' );
	if ( $thumb ) {
		// Create fake image objects for display
		$images = array( (object)[ 'guid' => $thumb, 'post_title' => get_the_title() ] );
	}
}

if ( empty( $images ) ) return;

$images = array_values( $images );
$count  = count( $images );
?>
<style>
.g2f-project-gallery { width: 100vw; position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; background: #f5f5f5; overflow: hidden; }
.g2f-gallery-track { display: flex; transition: transform 0.45s cubic-bezier(0.4,0,0.2,1); will-change: transform; }
.g2f-gallery-slide { flex: 0 0 33.333%; min-width: 33.333%; aspect-ratio: 4/3; overflow: hidden; }
.g2f-gallery-slide img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.4s ease; }
.g2f-gallery-slide img:hover { transform: scale(1.03); }
.g2f-gallery-btn { position: absolute; top: 50%; transform: translateY(-50%); z-index: 10; width: 48px; height: 48px; border-radius: 50%; background: rgba(255,255,255,0.92); border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 16px rgba(0,0,0,0.15); transition: background 0.2s, transform 0.2s; }
.g2f-gallery-btn:hover { background: #fff; transform: translateY(-50%) scale(1.08); }
.g2f-gallery-btn--prev { left: 20px; }
.g2f-gallery-btn--next { right: 20px; }
.g2f-gallery-btn svg { width: 20px; height: 20px; stroke: #000; stroke-width: 2; fill: none; }
@media (max-width: 768px) { .g2f-gallery-slide { flex: 0 0 85%; min-width: 85%; } }
</style>

<div class="g2f-project-gallery" id="g2f-gallery-<?php echo $post->ID; ?>">
	<div class="g2f-gallery-track" id="g2f-track-<?php echo $post->ID; ?>">
		<?php foreach ( $images as $img ) :
			$src = is_object( $img ) && isset( $img->ID ) ? wp_get_attachment_image_url( $img->ID, 'large' ) : ( $img->guid ?? '' );
			$alt = is_object( $img ) && isset( $img->ID ) ? get_post_meta( $img->ID, '_wp_attachment_image_alt', true ) : get_the_title();
			if ( ! $src ) continue;
		?>
			<div class="g2f-gallery-slide">
				<img src="<?php echo esc_url( $src ); ?>" alt="<?php echo esc_attr( $alt ?: get_the_title() ); ?>" loading="lazy">
			</div>
		<?php endforeach; ?>
	</div>

	<?php if ( $count > 1 ) : ?>
	<button class="g2f-gallery-btn g2f-gallery-btn--prev" data-gallery="<?php echo $post->ID; ?>" aria-label="Previous">
		<svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
	</button>
	<button class="g2f-gallery-btn g2f-gallery-btn--next" data-gallery="<?php echo $post->ID; ?>" aria-label="Next">
		<svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
	</button>
	<?php endif; ?>
</div>

<script>
(function() {
	var gid = '<?php echo $post->ID; ?>';
	var track = document.getElementById('g2f-track-' + gid);
	if (!track) return;
	var slides = track.querySelectorAll('.g2f-gallery-slide');
	var total = slides.length;
	if (total <= 1) return;
	var current = 0;
	var visible = window.innerWidth <= 768 ? 1 : 3;

	function getSlideWidth() {
		return slides[0] ? slides[0].offsetWidth : 0;
	}

	function goTo(idx) {
		var max = total - visible;
		if (idx < 0) idx = 0;
		if (idx > max) idx = max;
		current = idx;
		track.style.transform = 'translateX(-' + (current * getSlideWidth()) + 'px)';
	}

	document.querySelectorAll('.g2f-gallery-btn[data-gallery="' + gid + '"]').forEach(function(btn) {
		btn.addEventListener('click', function() {
			if (btn.classList.contains('g2f-gallery-btn--prev')) {
				goTo(current - 1);
			} else {
				goTo(current + 1);
			}
		});
	});

	// Touch/swipe
	var startX = 0;
	track.addEventListener('touchstart', function(e) { startX = e.touches[0].clientX; }, {passive:true});
	track.addEventListener('touchend', function(e) {
		var diff = startX - e.changedTouches[0].clientX;
		if (Math.abs(diff) > 50) { goTo(current + (diff > 0 ? 1 : -1)); }
	}, {passive:true});

	window.addEventListener('resize', function() {
		visible = window.innerWidth <= 768 ? 1 : 3;
		goTo(current);
	});
})();
</script>
