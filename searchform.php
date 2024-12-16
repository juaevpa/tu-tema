<?php
$unique_id = wp_unique_id('search-form-');
?>

<label class="flex flex-col min-w-40 !h-10 max-w-64">
    <div class="flex w-full flex-1 items-stretch rounded-xl h-full">
        <div class="text-[#4e7097] flex border-none bg-[#e7edf3] items-center justify-center pl-4 rounded-l-xl border-r-0">
            <i class="ph ph-magnifying-glass text-xl"></i>
        </div>
        <input type="search" 
               id="<?php echo esc_attr($unique_id); ?>"
               placeholder="<?php echo esc_attr_x('Search', 'placeholder', 'tu-tema'); ?>"
               value="<?php echo get_search_query(); ?>"
               name="s"
               class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#0e141b] focus:outline-0 focus:ring-0 border-none bg-[#e7edf3] focus:border-none h-full placeholder:text-[#4e7097] px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal" />
    </div>
</label> 