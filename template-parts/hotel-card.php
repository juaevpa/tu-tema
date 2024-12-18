<?php
$rating = get_post_meta(get_the_ID(), 'rating', true);
$address = get_post_meta(get_the_ID(), 'address', true);
$phone = get_post_meta(get_the_ID(), 'phone', true);
?>
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <?php if (has_post_thumbnail()) : ?>
        <div class="aspect-video">
            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>" 
                 alt="<?php echo esc_attr(get_the_title()); ?>"
                 class="w-full h-full object-cover">
        </div>
    <?php endif; ?>
    
    <div class="p-4">
        <h3 class="text-[#0e141b] text-xl font-bold mb-2"><?php the_title(); ?></h3>
        
        <?php if ($rating) : ?>
            <div class="flex items-center gap-1 text-[#4e7097] mb-2">
                <i class="ph ph-star-fill"></i>
                <span><?php echo esc_html($rating); ?>/5</span>
            </div>
        <?php endif; ?>

        <?php if ($address) : ?>
            <div class="flex items-center gap-2 text-[#4e7097] text-sm mb-1">
                <i class="ph ph-map-pin"></i>
                <span><?php echo esc_html($address); ?></span>
            </div>
        <?php endif; ?>

        <?php if ($phone) : ?>
            <div class="flex items-center gap-2 text-[#4e7097] text-sm mb-3">
                <i class="ph ph-phone"></i>
                <span><?php echo esc_html($phone); ?></span>
            </div>
        <?php endif; ?>

        <a href="<?php the_permalink(); ?>" 
           class="inline-block bg-[#1979e6] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#1565c0] transition-colors">
            Ver detalles
        </a>
    </div>
</div> 