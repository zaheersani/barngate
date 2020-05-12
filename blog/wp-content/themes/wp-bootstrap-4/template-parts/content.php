<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_Bootstrap_4
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card mt-3r' ); ?>>
    <?php
    if ( !is_singular() ) :
        ?>

    <div class="card-post">
        <div class="thumbnail"><a href="<?=get_permalink()?>"> <img class="left" src="<?=get_the_post_thumbnail_url()?>"/></a></div>
        <div class="right">
            <?php the_title( '<h3 class="entry-title card-title h2">', '</h3>' ); ?>
            <?php the_category( '</span> <span class="badge badge-light badge-pill">' ); ?>
            <div class="separator"></div>
            <p>By: <a href="<?=get_author_posts_url( get_the_author_meta( 'ID' )) ?>"><?= esc_html( get_the_author() ) ?></a> <span class="visible-xs">Fecha: <?the_time('Y.m.d')?></span> </p>
            <div>
                <?php echo strip_tags(get_the_excerpt()); ?>
            </div>
            <div class="text-right contenedor-leer-mas">
                <a href="<?php echo esc_url( get_permalink() ); ?>" class="link-negro"><?php esc_html_e( 'Read more', 'wp-bootstrap-4' ); ?> <small class="oi oi-chevron-right ml-1"></small></a>
            </div>
        </div>
        <div class="hidden-xs">
        <h5><?the_time('d')?></h5>
        <h6><?the_time('F')?></h6>
        </div>
    </div>
<?php
    else : ?>

    <div class="card-body">

		<?php if ( is_sticky() ) : ?>
			<span class="oi oi-bookmark wp-bp-sticky text-muted" title="<?php echo esc_attr__( 'Sticky Post', 'wp-bootstrap-4' ); ?>"></span>
		<?php endif; ?>
        <?php wp_bootstrap_4_post_thumbnail(); ?>
		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title card-title h2">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title card-title h3"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" class="text-dark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta text-muted">
				<?php wp_bootstrap_4_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->



		<?php if( is_singular() || get_theme_mod( 'default_blog_display', 'excerpt' ) === 'full' ) : ?>
			<div class="entry-content">
				<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wp-bootstrap-4' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-4' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		<?php else : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
				<div class="">
					<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-primary btn-sm"><?php esc_html_e( 'Continue Reading', 'wp-bootstrap-4' ); ?> <small class="oi oi-chevron-right ml-1"></small></a>
				</div>
			</div><!-- .entry-summary -->
		<?php endif; ?>

	</div>
	<!-- /.card-body -->
    <?php

    endif; ?>


</article><!-- #post-<?php the_ID(); ?> -->
