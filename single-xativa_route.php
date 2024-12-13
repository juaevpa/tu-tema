<?php
get_header();
?>

<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="@container">
                    <div class="flex flex-col gap-6 px-4 py-10 @[480px]:gap-8">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl"
                                 style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>');">
                            </div>
                        <?php endif; ?>

                        <div class="flex flex-col gap-6">
                            <div class="flex flex-col gap-2">
                                <h1 class="text-[#0e141b] text-4xl font-black leading-tight tracking-[-0.033em]">
                                    <?php the_title(); ?>
                                </h1>
                                
                                <div class="flex gap-4 text-[#4e7097] text-sm">
                                    <?php 
                                    $distance = get_field('distance');
                                    $difficulty = get_field('difficulty');
                                    if ($distance): ?>
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                                                <path d="M237.66,178.34a8,8,0,0,1,0,11.32l-48,48a8,8,0,0,1-11.32,0L130.67,190a8,8,0,0,1,11.31-11.32L184,220.69l42.34-42.35A8,8,0,0,1,237.66,178.34ZM48,96H208a8,8,0,0,0,0-16H48a8,8,0,0,0,0,16Zm160,24H48a8,8,0,0,0,0,16H208a8,8,0,0,0,0-16Zm-160,40H208a8,8,0,0,0,0-16H48a8,8,0,0,0,0,16Z"></path>
                                            </svg>
                                            <?php echo esc_html($distance); ?> km
                                        </span>
                                    <?php endif; 
                                    
                                    if ($difficulty): 
                                        $difficulty_labels = [
                                            'easy' => 'Fácil',
                                            'medium' => 'Media',
                                            'hard' => 'Difícil',
                                            'expert' => 'Experto'
                                        ];
                                        $difficulty_colors = [
                                            'easy' => 'bg-green-100 text-green-800',
                                            'medium' => 'bg-yellow-100 text-yellow-800',
                                            'hard' => 'bg-orange-100 text-orange-800',
                                            'expert' => 'bg-red-100 text-red-800'
                                        ];
                                    ?>
                                        <span class="flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $difficulty_colors[$difficulty]; ?>">
                                            <?php echo $difficulty_labels[$difficulty]; ?>
                                        </span>
                                    <?php endif; ?>

                                    <?php 
                                    $gpx_file = get_field('gpx_file');
                                    if ($gpx_file): ?>
                                        <a href="<?php echo esc_url($gpx_file); ?>" 
                                           class="flex items-center gap-1 text-[#1979e6] hover:text-[#1461b8]"
                                           download>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256">
                                                <path d="M224,152v56a16,16,0,0,1-16,16H48a16,16,0,0,1-16-16V152a8,8,0,0,1,16,0v56H208V152a8,8,0,0,1,16,0Zm-101.66,5.66a8,8,0,0,0,11.32,0l40-40a8,8,0,0,0-11.32-11.32L136,132.69V40a8,8,0,0,0-16,0v92.69L93.66,106.34a8,8,0,0,0-11.32,11.32Z"></path>
                                            </svg>
                                            Descargar GPX
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="prose prose-slate max-w-none">
                                <?php the_content(); ?>
                            </div>

                            <?php if (get_field('map_embed')): ?>
                                <div class="aspect-video rounded-xl overflow-hidden">
                                    <?php echo get_field('map_embed'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</div>

<?php
get_footer();
?> 