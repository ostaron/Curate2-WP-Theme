<?php get_header(); ?>
 <?php if (have_posts()): while (have_posts()) : the_post(); ?>
	    <section class="hero">
	        <?php if ( get_field( 'hero_image') ) { ?>
            	<img src="<?php the_field( 'hero_image' ); ?>" />
            <?php } ?>
	    </section>
	<main role="main" class="main-home">
		<!-- front page intro section -->
		<section class="main-home_intro">
		    <div class="row large-margin-bottom">
                <div class="greeting main-home_one-col"><p class="text"><?php the_field( 'intro_text' ); ?></p></div>
                <div class="headshot main-home_one-col">
                    <?php if ( get_field( 'headshot') ) { ?>
                    	<img src="<?php the_field( 'headshot' ); ?>" />
                    <?php } ?>
                </div>
            </div>
            <div class="row large-margin-bottom">
                <div class="company-info">
                    <h1 class="company-info_name heading heading-main"><?php the_field( 'company_name' ); ?></h1>
                    <h3 class="company-info_tagline heading heading-tagline"><?php the_field( 'tag_line' ); ?></h3>
                    <p class="company-info_about text"><?php the_field( 'about_company' ); ?></p>
                </div>
            </div>
            <div>
                  <?php
                    $images = get_field('front_page_gallery');

                    if( $images ): ?>
                        <ul class="front-page-gallery row large-margin-bottom">
                            <?php foreach( $images as $image ): ?>
                                <li class="main-home_one-col">
                                         <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
    		    <?php endwhile; endif; ?>
            </div>
		</section>
        <!-- /section -->
        <!-- latest projects -->
		<section>
            <?php
                // captures user-selected categories from customizer settings, displays posts tagged as "featured"
                $categories = explode(",",  get_theme_mod( 'front_page_categories' ));
                // variable will alternate after each displayed post
                $inset_picture_goes_on_left = true;
                foreach($categories as $category_id) {
                    $post_type = 'portfolio_item';
                    $category_link = get_category_link( $category_id );
                    $category_name = get_cat_name( $category_id );
                    $args = array(
                        'post_type' => $post_type,
                        'cat' => $category_id,
                        'tag' => 'featured',
                    );
                    $the_query = new WP_Query($args);
                    if($the_query->have_posts()): while($the_query->have_posts()):$the_query->the_post();
                        include( locate_template( 'partials/front_page_features.php', false, false ) );
                        $inset_picture_goes_on_left = !$inset_picture_goes_on_left;
                    endwhile; endif;

                }
            ?>
        </section>
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
