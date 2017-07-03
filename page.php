<?php

get_header();

if(have_posts()):
    while(have_posts()):
        the_post();
        /**
         * 拡張Postクラスを作成
         * @var $extends ero\model\extendPost
         */
        $extends = ero\Controller::getExtendPost($post);
        ?>
        <div class="container">

            <article id="post-<?php the_ID(); ?>" class="col-xs-1 main-center detail <?php post_class(); ?>">

                <h2><?php print the_title(); ?></h2>

                <div class="movie-info message">
                    <?php
                    the_content();
                    wp_link_pages();
                    next_posts_link();
                    previous_posts_link();
                    ?>
                </div>

                <div class="clearfix"></div>

            </article>

            <?php get_sidebar(); ?>

        </div>

        <?php
    endwhile;
endif;

get_footer();