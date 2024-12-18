<div class="mb-8">
    <h2 class="text-[#0e141b] text-xl font-bold mb-4">Filtros</h2>
    
    <div class="flex flex-wrap gap-4 mb-4">
        <?php
        $current_category = isset($_GET['hotel_category']) ? $_GET['hotel_category'] : '';
        $categories = get_terms(array(
            'taxonomy' => 'hotel_category',
            'hide_empty' => false,
        ));

        // Botón "Todos"
        $is_active = empty($current_category);
        ?>
        <button 
            onclick="filterHotels(this)" 
            data-category=""
            class="filter-btn px-4 py-2 rounded-lg text-sm font-medium <?php echo $is_active ? 'bg-[#1979e6] text-white' : 'bg-[#e7edf3] text-[#0e141b]'; ?>">
            Todos
        </button>

        <?php
        if (!empty($categories) && !is_wp_error($categories)) {
            foreach ($categories as $category) {
                $is_active = $current_category === $category->slug;
                ?>
                <button 
                    onclick="filterHotels(this)" 
                    data-category="<?php echo esc_attr($category->slug); ?>"
                    class="filter-btn px-4 py-2 rounded-lg text-sm font-medium <?php echo $is_active ? 'bg-[#1979e6] text-white' : 'bg-[#e7edf3] text-[#0e141b]'; ?>">
                    <?php echo esc_html($category->name); ?>
                </button>
                <?php
            }
        }
        ?>
    </div>
</div>
