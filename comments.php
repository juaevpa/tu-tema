<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area px-4 py-6 border-t border-[#e7edf3]">
    <?php if (have_comments()): ?>
        <h2 class="text-[#0e141b] text-2xl font-bold mb-6">
            <?php
            $comments_number = get_comments_number();
            printf(
                _nx(
                    '%1$s comentario',
                    '%1$s comentarios',
                    $comments_number,
                    'comments title',
                    'tu-tema'
                ),
                number_format_i18n($comments_number)
            );
            ?>
        </h2>

        <ul class="comment-list space-y-6">
            <?php
            wp_list_comments([
                'style' => 'ul',
                'short_ping' => true,
                'callback' => function($comment, $args, $depth) {
                    ?>
                    <li id="comment-<?php comment_ID(); ?>" class="comment">
                        <article class="comment-body flex gap-4">
                            <?php echo get_avatar($comment, 60, '', '', ['class' => 'rounded-full']); ?>
                            
                            <div class="flex-1">
                                <header class="comment-meta mb-2">
                                    <h3 class="text-[#0e141b] text-base font-medium">
                                        <?php comment_author(); ?>
                                    </h3>
                                    <time class="text-[#4e7097] text-sm">
                                        <?php comment_date(); ?>
                                    </time>
                                </header>

                                <div class="comment-content prose prose-sm">
                                    <?php comment_text(); ?>
                                </div>

                                <?php if ($args['max_depth'] > $depth): ?>
                                    <div class="reply mt-2">
                                        <?php
                                        comment_reply_link([
                                            'depth' => $depth,
                                            'max_depth' => $args['max_depth'],
                                            'class' => 'text-[#1979e6] text-sm font-medium'
                                        ]);
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    </li>
                    <?php
                }
            ]);
            ?>
        </ul>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
            <nav class="comment-navigation flex justify-between mt-6">
                <div class="nav-previous">
                    <?php previous_comments_link(__('← Comentarios anteriores', 'tu-tema')); ?>
                </div>
                <div class="nav-next">
                    <?php next_comments_link(__('Comentarios siguientes →', 'tu-tema')); ?>
                </div>
            </nav>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>
        <p class="no-comments text-[#4e7097]">
            <?php _e('Los comentarios están cerrados.', 'tu-tema'); ?>
        </p>
    <?php endif; ?>

    <?php
    comment_form([
        'class_form' => 'comment-form mt-6',
        'class_submit' => 'flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#1979e6] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em]',
        'comment_field' => '<div class="comment-form-comment mb-4"><label for="comment" class="block text-[#0e141b] text-sm font-medium mb-2">' . _x('Comentario', 'noun') . '</label><textarea id="comment" name="comment" class="w-full rounded-xl border-[#d0dbe7] bg-slate-50 focus:border-[#1979e6] focus:ring-[#1979e6]" rows="4" required></textarea></div>',
    ]);
    ?>
</div> 