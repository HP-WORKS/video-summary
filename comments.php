<ol class="comment-list">
    <?php wp_list_comments([], get_comments(['post_id' =>  $post->ID])); ?>
</ol>
<?php paginate_comments_links();comment_form(); ?>