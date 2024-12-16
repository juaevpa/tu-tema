<?php
/**
 * Footer template
 *
 * @package Tu_Tema
 */
?>

        </div>
    </div>
    <footer class="mt-auto bg-white border-t border-[#e7edf3]">
        <div class="mx-auto max-w-[1440px] px-10 py-12">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <!-- Logo y descripción -->
                <div class="flex flex-col gap-4">
                    <a href="<?php echo home_url('/'); ?>" class="flex items-center gap-2 text-[#0e141b]">
                        <i class="ph ph-mountains text-xl"></i>
                        <span class="text-lg font-bold leading-tight tracking-[-0.015em]">Cycling Xàtiva</span>
                    </a>
                    <p class="text-[#4e7097] text-sm">
                        Descubre las mejores rutas ciclistas en Xàtiva y sus alrededores. Explora la historia, gastronomía y naturaleza de nuestra región.
                    </p>
                </div>

                <!-- Enlaces rápidos -->
                <div class="flex flex-col gap-4">
                    <h3 class="text-[#0e141b] font-bold">Enlaces rápidos</h3>
                    <ul class="flex flex-col gap-2">
                        <li>
                            <a href="<?php echo get_post_type_archive_link('xativa_route'); ?>" class="text-[#4e7097] text-sm hover:text-[#1979e6] transition-colors">
                                Rutas
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo get_post_type_archive_link('xativa_explore'); ?>" class="text-[#4e7097] text-sm hover:text-[#1979e6] transition-colors">
                                Explorar Xàtiva
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="text-[#4e7097] text-sm hover:text-[#1979e6] transition-colors">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo get_page_link(get_page_by_path('about')); ?>" class="text-[#4e7097] text-sm hover:text-[#1979e6] transition-colors">
                                Sobre nosotros
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contacto -->
                <div class="flex flex-col gap-4">
                    <h3 class="text-[#0e141b] font-bold">Contacto</h3>
                    <ul class="flex flex-col gap-2">
                        <li class="flex items-center gap-2 text-[#4e7097] text-sm">
                            <i class="ph ph-envelope"></i>
                            <a href="mailto:info@cyclingxativa.com" class="hover:text-[#1979e6] transition-colors">
                                info@cyclingxativa.com
                            </a>
                        </li>
                        <li class="flex items-center gap-2 text-[#4e7097] text-sm">
                            <i class="ph ph-phone"></i>
                            <a href="tel:+34960000000" class="hover:text-[#1979e6] transition-colors">
                                +34 96 000 00 00
                            </a>
                        </li>
                        <li class="flex items-center gap-2 text-[#4e7097] text-sm">
                            <i class="ph ph-map-pin"></i>
                            <span>Xàtiva, Valencia, España</span>
                        </li>
                    </ul>
                </div>

                <!-- Redes sociales -->
                <div class="flex flex-col gap-4">
                    <h3 class="text-[#0e141b] font-bold">Síguenos</h3>
                    <div class="flex gap-4">
                        <a href="#" class="text-[#4e7097] hover:text-[#1979e6] transition-colors">
                            <i class="ph ph-facebook-logo text-2xl"></i>
                        </a>
                        <a href="#" class="text-[#4e7097] hover:text-[#1979e6] transition-colors">
                            <i class="ph ph-instagram-logo text-2xl"></i>
                        </a>
                        <a href="#" class="text-[#4e7097] hover:text-[#1979e6] transition-colors">
                            <i class="ph ph-twitter-logo text-2xl"></i>
                        </a>
                        <a href="#" class="text-[#4e7097] hover:text-[#1979e6] transition-colors">
                            <i class="ph ph-strava-logo text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-8 pt-8 border-t border-[#e7edf3]">
                <p class="text-[#4e7097] text-sm text-center">
                    © <?php echo date('Y'); ?> Cycling Xàtiva. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html> 