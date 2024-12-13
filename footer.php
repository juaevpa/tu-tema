        </div><!-- .layout-container -->
        <footer class="bg-[#0e141b] text-white py-10">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="font-bold mb-4">Sobre Nosotros</h3>
                        <p class="text-sm">Descubre las mejores rutas ciclistas de Xàtiva y sus alrededores.</p>
                    </div>
                    <div>
                        <h3 class="font-bold mb-4">Enlaces Rápidos</h3>
                        <ul class="text-sm">
                            <li class="mb-2"><a href="<?php echo get_post_type_archive_link('xativa_route'); ?>">Rutas</a></li>
                            <li class="mb-2"><a href="/blog">Blog</a></li>
                            <li class="mb-2"><a href="/about">Sobre Nosotros</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold mb-4">Contacto</h3>
                        <ul class="text-sm">
                            <li class="mb-2">Email: info@cyclingxativa.com</li>
                            <li class="mb-2">Tel: +34 XXX XXX XXX</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-bold mb-4">Síguenos</h3>
                        <div class="flex gap-4">
                            <!-- Añade aquí tus iconos de redes sociales -->
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm">
                    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html> 