<?php
/**
 * Title: Testimonials Section
 * Slug: g2f-theme/testimonials
 * Categories: g2f-theme
 * Keywords: testimonials, reviews, quotes, carousel
 * Description: Testimonials carousel with avatar placeholders
 */

$testimonials = array(
	array(
		'quote'   => '"Reinvented my work approach!"',
		'body'    => 'G2F Design completely transformed how I think about visual communication. The results were immediate and the process was seamless from start to finish.',
		'name'    => 'Brian Clark',
		'role'    => 'VP of Marketing at Snapchat',
		'initials'=> 'BC',
	),
	array(
		'quote'   => '"Exceptional design quality"',
		'body'    => 'Working with G2F Design was a game-changer for our brand. Their attention to detail and creative vision exceeded all expectations.',
		'name'    => 'Sarah Johnson',
		'role'    => 'CEO at TechStart',
		'initials'=> 'SJ',
	),
	array(
		'quote'   => '"Professional and creative team"',
		'body'    => 'The team at G2F Design delivered beyond our expectations. Their creative approach and professional attitude made the entire process seamless.',
		'name'    => 'Michael Chen',
		'role'    => 'Product Director at DesignCo',
		'initials'=> 'MC',
	),
);
?>

<section class="g2f-testimonials">

	<div class="g2f-testimonials__header">
		<h2 class="g2f-testimonials__title">Trusted by <strong>Teams Like Yours.</strong></h2>
		<p class="g2f-testimonials__subtitle">Real results from real clients — see what they say about working with G2F Design.</p>
	</div>

	<div class="g2f-testimonial-carousel">
		<div class="g2f-testimonial-track">
			<?php foreach ( $testimonials as $i => $t ) : ?>
			<div class="g2f-testimonial<?php echo $i === 0 ? ' active' : ''; ?>" data-index="<?php echo $i; ?>">
				<h3 class="g2f-testimonial__quote"><?php echo esc_html( $t['quote'] ); ?></h3>
				<p class="g2f-testimonial__body"><?php echo esc_html( $t['body'] ); ?></p>
				<div class="g2f-testimonial__avatar">
					<span class="g2f-avatar-initials"><?php echo esc_html( $t['initials'] ); ?></span>
				</div>
				<p class="g2f-testimonial__name"><?php echo esc_html( $t['name'] ); ?></p>
				<p class="g2f-testimonial__role"><?php echo esc_html( $t['role'] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>

		<div class="g2f-testimonial-dots">
			<?php foreach ( $testimonials as $i => $t ) : ?>
			<button class="g2f-testimonial-dot<?php echo $i === 0 ? ' active' : ''; ?>" data-slide="<?php echo $i; ?>" aria-label="<?php echo esc_attr( $t['name'] ); ?>"></button>
			<?php endforeach; ?>
		</div>
	</div>

</section>
