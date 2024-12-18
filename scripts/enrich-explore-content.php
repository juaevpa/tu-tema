<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

$places_data = array(
    // NATURALEZA
    'sierra-de-vernissa' => array(
        'title' => 'Sierra de Vernissa',
        'category' => 'naturaleza',
        'content' => 'La Sierra de Vernissa representa uno de los espacios naturales más importantes de Xàtiva...',
        'meta' => array(
            'coordinates' => array('lat' => '38.9853', 'lng' => '-0.5196'),
            'difficulty' => 'Media',
            'best_season' => 'Primavera y Otoño'
        )
    ),
    'fuente-25-canos' => array(
        'title' => 'Fuente de los 25 Caños',
        'category' => 'naturaleza',
        'content' => 'Emblemática fuente del siglo XVIII, uno de los monumentos hidráulicos más importantes...',
        'meta' => array(
            'address' => 'Plaza de la Fuente, Xàtiva',
            'construction_year' => '1788'
        )
    ),
    'jardin-del-beso' => array(
        'title' => 'Jardín del Beso',
        'category' => 'naturaleza',
        'content' => 'El Jardín del Beso es uno de los espacios más románticos y legendarios de Xàtiva, un rincón donde la historia y la naturaleza se entrelazan para crear un ambiente único.

HISTORIA Y LEYENDA:
El jardín debe su nombre a una antigua leyenda de amor prohibido entre una dama noble y un caballero musulmán. Se dice que aquí compartieron su último beso antes de ser descubiertos.

CARACTERÍSTICAS:
• Extensión: 5.000 metros cuadrados
• Estilo: Jardín romántico mediterráneo
• Vegetación: Cipreses centenarios, rosales históricos, plantas aromáticas
• Elementos arquitectónicos: Fuentes históricas, pérgolas, bancos de época

PUNTOS DE INTERÉS:
• Fuente de los Enamorados
• Pérgola de las Glicinas
• Mirador del Atardecer
• Rincón de los Poetas
• Colección de rosas antiguas

INFORMACIÓN PRÁCTICA:
🕒 Horario:
- Verano: 8:00-22:00
- Invierno: 9:00-20:00
💐 Mejor época para visitar:
- Primavera (floración máxima)
- Atardecer (iluminación especial)

EVENTOS Y ACTIVIDADES:
• Conciertos nocturnos en verano
• Lecturas poéticas
• Exposiciones de arte al aire libre
• Ceremonias y fotografías nupciales',
        'meta' => array(
            'address' => 'Calle Jardín del Beso, Xàtiva',
            'best_time' => 'Atardecer',
            'features' => 'Fuentes históricas, pérgolas, jardín romántico'
        )
    ),
    'parque-alameda' => array(
        'title' => 'Parque de la Alameda',
        'category' => 'naturaleza',
        'content' => 'El Parque de la Alameda, pulmón verde histórico de Xàtiva, representa la perfecta fusión entre naturaleza y cultura urbana, ofreciendo un espacio de recreo y descanso para todos los visitantes.

HISTORIA:
Creado en el siglo XIX como paseo señorial, el parque ha evolucionado hasta convertirse en el principal espacio verde urbano de Xàtiva, manteniendo su esencia histórica mientras se adapta a las necesidades modernas.

CARACTERÍSTICAS:
• Extensión: 12 hectáreas
• Árboles centenarios: Más de 100 ejemplares catalogados
• Especies destacadas: Plátanos, palmeras, pinos y jacarandas
• Zonas diferenciadas: Área infantil, zona deportiva, área de descanso

INSTALACIONES:
• Parque infantil moderno y seguro
• Área de ejercicio para mayores
• Pista de petanca
• Quiosco-cafetería
• Fuentes de agua potable
• Bancos y zonas de descanso sombreadas

ACTIVIDADES:
• Ejercicio al aire libre
• Picnics familiares
• Eventos culturales
• Mercadillos artesanales
• Conciertos de verano

INFORMACIÓN PRÁCTICA:
🕒 Horario: Abierto 24 horas
♿ Accesibilidad: Total
🐕 Pet-friendly: Área específica para mascotas
🚲 Carril bici: Integrado en el parque

EVENTOS ESPECIALES:
• Festival de Primavera
• Cine de verano
• Feria del libro
• Mercado de Navidad',
        'meta' => array(
            'address' => 'Alameda de Xàtiva',
            'facilities' => 'Área infantil, zona deportiva, cafetería',
            'size' => '12 hectáreas'
        )
    ),

    // CULTURA
    'teatro-principal' => array(
        'title' => 'Teatro Principal',
        'category' => 'cultura',
        'content' => 'El Teatro Principal de Xàtiva, joya arquitectónica del siglo XIX, representa uno de los espacios culturales más emblemáticos de la ciudad, manteniendo viva la tradición teatral y musical.

HISTORIA:
Inaugurado en 1847, el teatro ha sido testigo de la evolución cultural de Xàtiva. Su arquitectura neoclásica y su acústica excepcional lo convierten en un espacio único para las artes escénicas.

ARQUITECTURA:
• Estilo: Neoclásico italiano
• Capacidad: 500 espectadores
• Elementos destacados:
  - Telón histórico pintado a mano
  - Palcos originales restaurados
  - Lámpara central de cristal
  - Frescos en el techo

PROGRAMACIÓN:
• Teatro clásico y contemporáneo
• Ópera y zarzuela
• Conciertos de música clásica
• Danza contemporánea
• Espectáculos infantiles

INFORMACIÓN PRÁCTICA:
🎭 Temporada principal: Septiembre a Mayo
🎟️ Venta de entradas:
- Taquilla: 2 horas antes de cada función
- Online: www.teatrexativa.es
- Teléfono: 96 228 XXXX

VISITAS GUIADAS:
• Martes y jueves: 11:00 y 17:00
• Duración: 45 minutos
• Reserva previa necesaria
• Incluye: Backstage y camerinos históricos',
        'meta' => array(
            'address' => 'Calle Teatro, Xàtiva',
            'capacity' => '500 personas',
            'year_built' => '1847',
            'style' => 'Neoclásico italiano'
        )
    ),
    'casa-cultura' => array(
        'title' => 'Casa de la Cultura',
        'category' => 'cultura',
        'content' => 'La Casa de la Cultura de Xàtiva es un centro dinámico y multidisciplinar que actúa como epicentro de la vida cultural de la ciudad, ubicado en un edificio histórico completamente rehabilitado.

INSTALACIONES:
• Biblioteca pública con más de 50.000 volúmenes
• Sala de exposiciones temporales (400m²)
• Salón de actos (capacidad 200 personas)
• Aulas de estudio y trabajo
• Sala multimedia y de investigación
• Archivo histórico digitalizado

ACTIVIDADES REGULARES:
• Exposiciones de arte contemporáneo
• Conferencias y charlas culturales
• Talleres creativos para todas las edades
• Presentaciones de libros
• Ciclos de cine independiente
• Conciertos de pequeño formato

SERVICIOS:
📚 Biblioteca:
- Préstamo de libros y material audiovisual
- Hemeroteca
- Zona infantil
- Acceso a internet gratuito

🎨 Exposiciones:
- Programación anual
- Artistas locales y nacionales
- Temáticas variadas

INFORMACIÓN PRÁCTICA:
🕒 Horario:
- Lunes a viernes: 9:00-21:00
- Sábados: 10:00-14:00
- Domingos: Cerrado

PROGRAMAS ESPECIALES:
• Club de lectura mensual
• Encuentros con autores
• Actividades infantiles de fin de semana
• Cursos y talleres trimestrales',
        'meta' => array(
            'address' => 'Plaza de la Cultura, Xàtiva',
            'activities' => 'Exposiciones, conferencias, talleres',
            'capacity' => '200 personas (salón principal)'
        )
    ),
    'museo-bellas-artes' => array(
        'title' => 'Museo de Bellas Artes',
        'category' => 'cultura',
        'content' => 'El Museo de Bellas Artes de Xàtiva alberga una extraordinaria colección que abarca desde el siglo XV hasta la actualidad, representando la rica herencia artística de la región valenciana.

COLECCIONES PERMANENTES:
• Arte Gótico Valenciano (s. XV-XVI)
• Pintura Barroca (s. XVII-XVIII)
• Arte Contemporáneo Local
• Colección de Fotografía Histórica

OBRAS DESTACADAS:
• Retablo de Santa Ana (s. XV)
• "Vista de Xàtiva" por Joaquín Sorolla
• Colección de pinturas de José Ribera
• Esculturas modernistas locales

SALAS TEMÁTICAS:
1. Sala Medieval
2. Galería de Retratos Históricos
3. Arte Sacro
4. Pintura Contemporánea
5. Sala de Exposiciones Temporales

SERVICIOS:
🎨 Visitas guiadas:
- Martes a sábado: 11:00 y 17:00
- Grupos: Reserva previa
- Idiomas: Español, valenciano, inglés

📚 Centro de documentación:
- Biblioteca especializada
- Archivo fotográfico
- Documentación histórica

ACTIVIDADES EDUCATIVAS:
• Talleres para escolares
• Conferencias de arte
• Restauración en directo
• Cursos de historia del arte

INFORMACIÓN PRÁCTICA:
🕒 Horario:
- Martes a sábado: 10:00-20:00
- Domingos: 10:00-14:00
- Lunes: Cerrado

💶 Entrada:
- General: 4€
- Reducida: 2€
- Domingos: Gratuita',
        'meta' => array(
            'collection_size' => '500 obras',
            'highlights' => 'Pinturas góticas, arte contemporáneo',
            'address' => 'Calle Museo, Xàtiva',
            'year_founded' => '1919'
        )
    ),

    // HISTORIA
    'castillo-xativa' => array(
        'title' => 'Castillo de Xàtiva',
        'category' => 'historia',
        'content' => 'El Castillo de Xàtiva, corona majestuosa de la ciudad, es una de las fortalezas más importantes y mejor conservadas de la Comunidad Valenciana, testimonio de más de dos milenios de historia.

HISTORIA:
El conjunto fortificado, de origen íbero y romano, alcanz�� su máximo esplendor durante la época medieval, siendo una pieza clave en el control del territorio valenciano y escenario de importantes acontecimientos históricos.

ARQUITECTURA Y ESTRUCTURA:
• Castillo Menor (Castell Menor):
  - Origen íbero-romano
  - Torres de vigilancia
  - Aljibes históricos
  - Capilla de Santa Fe

• Castillo Mayor (Castell Major):
  - Palacio gótico
  - Torres defensivas
  - Prisión de Estado
  - Museo del Castillo

PUNTOS DE INTERÉS:
1. Prisión de Estado:
   - Celda del Duque de Calabria
   - Prisión de Fernando de Aragón
   - Exposición histórica

2. Palacio Real:
   - Salón del Trono
   - Estancias nobles
   - Miradores panorámicos

3. Sistema Defensivo:
   - Murallas almohades
   - Torres de vigilancia
   - Fosos medievales

INFORMACIÓN PRÁCTICA:
🕒 Horario:
- Verano (abril-octubre): 10:00-19:00
- Invierno (noviembre-marzo): 10:00-18:00

💶 Precios:
- Adultos: 3€
- Estudiantes/Jubilados: 2€
- Niños <8 años: Gratis

🎫 Servicios incluidos:
- Audioguía en varios idiomas
- Mapa de la fortaleza
- Acceso a todas las zonas
- Visitas guiadas (consultar horarios)

RECOMENDACIONES:
• Calzado cómodo
• Agua y protección solar
• Cámara fotográfica
• 2-3 horas de visita

EVENTOS ESPECIALES:
• Recreaciones históricas
• Conciertos de verano
• Visitas nocturnas teatralizadas
• Exposiciones temporales',
        'meta' => array(
            'visit_duration' => '2-3 horas',
            'price' => '3€',
            'coordinates' => array('lat' => '38.9889', 'lng' => '-0.5198'),
            'best_time' => 'Amanecer y atardecer para fotografía'
        )
    ),
    'colegiata-basilica' => array(
        'title' => 'Colegiata Basílica de Santa María',
        'category' => 'historia',
        'content' => 'La Colegiata Basílica de Santa María es uno de los máximos exponentes del gótico valenciano y un testimonio excepcional de la importancia histórica de Xàtiva.

HISTORIA:
Construida entre los siglos XVI y XVIII sobre una antigua mezquita, la Colegiata representa la evolución arquitectónica y artística de Xàtiva, desde el gótico hasta el barroco.

ARQUITECTURA:
• Estilo: Gótico valenciano con elementos renacentistas
• Estructura: Tres naves con capillas laterales
• Torre campanario: 56 metros de altura
• Cúpula: Decoración barroca del siglo XVIII

ELEMENTOS DESTACADOS:
1. Portada Principal:
   - Estilo plateresco
   - Esculturas de santos
   - Medallones decorativos

2. Capilla del Santo Cáliz:
   - Reliquia histórica
   - Decoración gótica
   - Pinturas murales

3. Museo Catedralicio:
   - Arte sacro
   - Orfebrería
   - Documentos históricos

TESOROS ARTÍSTICOS:
• Retablo Mayor (s. XVI)
• Órgano histórico restaurado
• Pinturas de Vicente López
• Colección de orfebrería sacra

INFORMACIÓN PRÁCTICA:
🕒 Horario de visitas:
- Lunes a sábado: 10:00-13:30 y 17:00-19:30
- Domingos: Solo culto

💶 Entrada:
- General: 2€
- Grupos: 1.5€
- Menores 12 años: Gratis

SERVICIOS:
• Visitas guiadas (reserva previa)
• Audioguías disponibles
• Acceso adaptado
• Tienda de recuerdos

EVENTOS ESPECIALES:
• Conciertos de música sacra
• Celebraciones litúrgicas especiales
• Exposiciones temporales
• Visitas nocturnas en verano',
        'meta' => array(
            'style' => 'Gótico-Renacentista',
            'year_built' => 'Siglo XVI-XVIII',
            'address' => 'Plaza de la Seu, Xàtiva',
            'highlights' => 'Retablo Mayor, Capilla del Santo Cáliz'
        )
    ),
    'museo-almodi' => array(
        'title' => 'Museo del Almodí',
        'category' => 'historia',
        'content' => 'El Museo del Almodí, ubicado en el antiguo almacén de grano medieval, es un testimonio vivo de la historia de Xàtiva y un centro cultural de primer orden.

HISTORIA:
Construido en el siglo XVI como almacén de grano (almodí), el edificio es un ejemplo excepcional de la arquitectura civil gótica valenciana. En 1981 fue reconvertido en museo municipal.

COLECCIONES:
• Arqueología:
  - Restos íberos y romanos
  - Cerámica medieval
  - Elementos arquitectónicos

• Etnografía:
  - Utensilios tradicionales
  - Indumentaria histórica
  - Oficios antiguos

• Arte:
  - Pintura local
  - Escultura religiosa
  - Fotografía histórica

EXPOSICIONES PERMANENTES:
1. "Xàtiva Histórica":
   - Evolución urbana
   - Personajes ilustres
   - Documentos históricos

2. "Vida Cotidiana":
   - Recreación de espacios
   - Objetos domésticos
   - Tradiciones locales

SERVICIOS:
🎨 Actividades didácticas:
- Talleres escolares
- Visitas temáticas
- Conferencias

📚 Centro de documentación:
- Archivo histórico
- Biblioteca especializada
- Fototeca

INFORMACIÓN PRÁCTICA:
🕒 Horario:
- Martes a sábado: 10:00-14:00 y 16:00-19:00
- Domingos: 10:00-14:00
- Lunes: Cerrado

💶 Entrada:
- General: 2€
- Reducida: 1€
- Domingos: Gratuita

ACTIVIDADES ESPECIALES:
• Noche de los Museos
• Jornadas de puertas abiertas
• Exposiciones temporales
• Talleres familiares',
        'meta' => array(
            'collection' => 'Arqueología y etnografía',
            'building_type' => 'Gótico civil',
            'year_founded' => '1981',
            'address' => 'Calle Corretgeria, Xàtiva'
        )
    ),
    'portal-leon' => array(
        'title' => 'Portal del León',
        'category' => 'historia',
        'content' => 'El Portal del León, una de las puertas más emblemáticas de la antigua muralla medieval de Xàtiva, representa un testimonio excepcional de la arquitectura defensiva medieval.

HISTORIA:
Construido en el siglo XIV como parte del sistema defensivo de la ciudad, debe su nombre a la figura escultórica de un león que corona su entrada, símbolo del poder y la nobleza de Xàtiva.

ARQUITECTURA:
• Estilo: Gótico militar
• Materiales: Sillería de piedra caliza
• Altura: 15 metros
• Anchura: 8 metros

ELEMENTOS DESTACADOS:
• Arco de medio punto
• Matacán defensivo
• León escultórico
• Escudos heráldicos
• Almenas originales

CURIOSIDADES HISTÓRICAS:
• Punto de control medieval
• Escenario de importantes eventos
• Única puerta con decoración escultórica
• Testigo de asedios históricos

ESTADO DE CONSERVACIÓN:
• Restaurado en el siglo XX
• Conserva elementos originales
• Visitable interior y exterior
• Integrado en la ruta turística

INFORMACIÓN PRÁCTICA:
🕒 Visitable: 24 horas (exterior)
📸 Punto fotográfico destacado
🚶‍♂️ Parte de la ruta medieval
♿ Acceso adaptado exterior

ACTIVIDADES:
• Visitas guiadas temáticas
• Recreaciones históricas
• Punto de encuentro cultural
• Fotografía nocturna',
        'meta' => array(
            'construction_year' => 'Siglo XIV',
            'style' => 'Gótico militar',
            'address' => 'Plaza del Portal del León',
            'coordinates' => array('lat' => '38.9867', 'lng' => '-0.5156')
        )
    ),

    // GASTRONOMÍA
    'bodegas-xativa' => array(
        'title' => 'Bodegas Xàtiva',
        'category' => 'gastronomia',
        'content' => 'Las Bodegas Xàtiva representan la tradición vinícola de la región, ofreciendo una experiencia única que combina historia, cultura y gastronomía local.

HISTORIA Y TRADICIÓN:
Establecidas en el siglo XIX, estas bodegas mantienen vivas las técnicas tradicionales de elaboración y conservación del vino, adaptándolas a los estándares modernos.

PRODUCTOS DESTACADOS:
• Vinos locales:
  - Tinto crianza
  - Blanco verdil
  - Rosado monastrell
  - Cava artesanal

• Vermuts artesanales:
  - Rojo tradicional
  - Blanco especiado
  - Reserva especial

EXPERIENCIAS:
1. Catas guiadas:
   - Degustación de vinos
   - Maridaje con productos locales
   - Explicación de elaboración

2. Visitas a bodegas:
   - Proceso de vinificación
   - Salas de barricas
   - Antiguas cavas

ACTIVIDADES:
• Tours guiados
• Catas comentadas
• Cursos de iniciación
• Eventos especiales
• Maridajes gastronómicos

INFORMACIÓN PRÁCTICA:
🕒 Horario:
- Martes a sábado: 10:00-14:00 y 16:00-20:00
- Domingos: 10:00-14:00

💶 Precios:
- Visita simple: 5€
- Visita + cata: 15€
- Grupos: Consultar

SERVICIOS:
• Tienda especializada
• Sala de catas
• Eventos privados
• Cursos formativos',
        'meta' => array(
            'products' => 'Vinos locales, vermut artesanal',
            'visit_duration' => '1-2 horas',
            'address' => 'Calle Bodegas, Xàtiva',
            'booking_required' => true
        )
    ),
    'mercado-municipal' => array(
        'title' => 'Mercado Municipal',
        'category' => 'gastronomia',
        'content' => 'El Mercado Municipal de Xàtiva es el corazón gastronómico de la ciudad, un espacio donde tradición y frescura se dan la mano cada día.

HISTORIA:
Inaugurado en 1925, el edificio modernista del Mercado Municipal ha sido testigo de la evolución comercial y social de Xàtiva, manteniendo viva la tradición del comercio local.

SECCIONES:
• Frutas y Verduras:
  - Productos locales de la huerta
  - Frutas de temporada
  - Verduras ecológicas

• Carnicería y Charcutería:
  - Carnes locales
  - Embutidos tradicionales
  - Productos artesanales

• Pescadería:
  - Pescado fresco diario
  - Mariscos
  - Productos del Mediterráneo

• Panadería y Dulces:
  - Pan artesanal
  - Dulces típicos
  - Productos de horno

ESPECIALIDADES LOCALES:
• Embutidos tradicionales
• Quesos artesanales
• Conservas caseras
• Productos de temporada
• Hierbas aromáticas

ACTIVIDADES:
• Showcookings mensuales
• Degustaciones
• Talleres gastronómicos
• Eventos temáticos
• Rutas guiadas

INFORMACIÓN PRÁCTICA:
🕒 Horario:
- Lunes a viernes: 7:00-14:00
- Sábados: 7:00-15:00
- Domingos: Cerrado

SERVICIOS:
• Parking cercano
• Servicio a domicilio
• Puestos adaptados
• Zona de degustación
• WiFi gratuito

EVENTOS ESPECIALES:
• Semana Gastronómica
• Feria del Producto Local
• Mercado Nocturno (verano)
• Jornadas Temáticas',
        'meta' => array(
            'year_built' => '1925',
            'address' => 'Plaza del Mercado, Xàtiva',
            'schedule' => 'Lunes a Sábado, 7:00-14:00',
            'parking' => 'Disponible en zona azul'
        )
    ),
    'arros-al-forn' => array(
        'title' => 'Arrós al Forn',
        'category' => 'gastronomia',
        'content' => 'El Arrós al Forn (arroz al horno) es uno de los platos más emblemáticos de la gastronomía setabense, una receta que representa la esencia de la cocina tradicional valenciana.

HISTORIA Y TRADICIÓN:
Este plato ancestral, heredado de la tradición culinaria valenciana, aprovechaba el calor residual de los hornos de pan para cocinar un arroz sustancioso y lleno de sabor.

CARACTERÍSTICAS:
• Plato tradicional valenciano
• Cocción en horno de leña
• Cazuela de barro
• Ingredientes locales

INGREDIENTES PRINCIPALES:
• Arroz bomba valenciano
• Garbanzos cocidos
• Costillas de cerdo
• Morcilla local
• Patatas
• Tomates
• Ajos tiernos
• Azafrán

LUGARES RECOMENDADOS:
🍚 Restaurantes tradicionales:
- Casa Pepe
- El Forn Antic
- Restaurante La Vall
- Casa María

EXPERIENCIA GASTRONÓMICA:
• Preparación tradicional
• Cocción en horno de leña
• Presentación en cazuela
• Maridaje con vinos locales

EVENTOS Y ACTIVIDADES:
• Jornadas gastronómicas
• Talleres de cocina tradicional
• Demostraciones culinarias
• Catas comentadas

INFORMACIÓN PRÁCTICA:
🕒 Temporada: Todo el año
💶 Precio medio: 12-15€
👥 Ración: Individual
🍷 Maridaje: Vino tinto local

CURIOSIDADES:
• Plato de los domingos
• Receta familiar
• Variaciones locales
• Premio gastronómico local',
        'meta' => array(
            'price_range' => '12-15€',
            'best_season' => 'Todo el año',
            'restaurants' => 'Casa Pepe, El Forn Antic',
            'traditional_dish' => true
        )
    ),
    'dulces-tradicionales' => array(
        'title' => 'Dulces Tradicionales',
        'category' => 'gastronomia',
        'content' => 'Los dulces tradicionales de Xàtiva representan siglos de tradición pastelera, con recetas transmitidas de generación en generación que deleitan tanto a locales como a visitantes.

ESPECIALIDADES:
1. Arnadí:
   • Dulce típico de calabaza
   • Almendras molidas
   • Decoración tradicional
   • Origen medieval

2. Coca de Llanda:
   • Bizcocho tradicional
   • Aroma de limón
   • Textura esponjosa
   • Receta centenaria

3. Pasteles de Boniato:
   • Relleno dulce natural
   • Masa hojaldrada
   • Elaboración artesanal
   • Postre navideño

PASTELERÍAS TRADICIONALES:
🍰 Establecimientos recomendados:
- Pastelería San José
- Horno del Carmen
- Dulces Artesanos María
- La Antigua Pastelería

EVENTOS ESPECIALES:
• Feria del Dulce Artesano
• Semana Santa (dulces típicos)
• Navidad (especialidades festivas)
• Demostraciones de elaboración

TEMPORADAS:
📅 Calendario de dulces:
- Primavera: Monas de Pascua
- Verano: Helados artesanales
- Otoño: Buñuelos de calabaza
- Navidad: Turrones y pasteles

INFORMACIÓN PRÁCTICA:
🕒 Horarios pastelerías:
- Lunes a sábado: 8:00-14:00 y 17:00-20:30
- Domingos: 8:00-14:00

ACTIVIDADES:
• Talleres de repostería
• Catas guiadas
• Visitas a obradores
• Demostraciones en vivo',
        'meta' => array(
            'specialties' => 'Arnadí, Coca de llanda, Pasteles de boniato',
            'best_places' => 'Pastelería San José, Horno del Carmen',
            'seasonal_products' => true,
            'price_range' => '2-15€'
        )
    ),
    'plaza-mercat' => array(
        'title' => 'Plaza del Mercat',
        'category' => 'historia',
        'content' => 'La Plaza del Mercat es el corazón hist��rico y social de Xàtiva, un espacio público que ha sido testigo de la evolución de la ciudad durante siglos.

HISTORIA:
Centro neurálgico desde época medieval, esta plaza ha sido escenario de mercados, celebraciones y eventos históricos desde el siglo XIII, manteniendo su importancia hasta la actualidad.

ARQUITECTURA:
• Estilo: Conjunto histórico-artístico
• Época: Siglos XIII-XX
• Superficie: 2.500 m²
• Edificios notables circundantes

ELEMENTOS DESTACADOS:
• Fachadas históricas
• Soportales medievales
• Pavimento tradicional
• Fuente central histórica
• Mobiliario urbano de época

ACTIVIDADES ACTUALES:
• Mercado semanal tradicional
• Eventos culturales
• Terrazas gastronómicas
• Punto de encuentro social
• Festivales temáticos

EDIFICIOS NOTABLES:
1. Casas Señoriales:
   - Arquitectura nobiliaria
   - Escudos heráldicos
   - Balcones de forja

2. Comercios Históricos:
   - Tiendas centenarias
   - Cafés tradicionales
   - Artesanía local

EVENTOS ANUALES:
• Feria medieval
• Mercado de Navidad
• Fiestas patronales
• Conciertos al aire libre

INFORMACIÓN PRÁCTICA:
🕒 Acceso: 24 horas
🚗 Parking: Zona azul cercana
🚶‍♂️ Punto de inicio rutas turísticas
🍷 Zona de restauración

CURIOSIDADES:
• Antigua zona de mercado medieval
• Escenario de proclamaciones reales
• Centro de la vida social
• Conserva pavimento original',
        'meta' => array(
            'historical_period' => 'Siglo XIII-actualidad',
            'square_size' => '2.500 m²',
            'address' => 'Plaza del Mercat, Xàtiva',
            'coordinates' => array('lat' => '38.9871', 'lng' => '-0.5167')
        )
    ),
    // Continuaré con más lugares...
);

function update_explore_content() {
    global $places_data;
    
    foreach ($places_data as $slug => $place) {
        $post_data = array(
            'post_title' => $place['title'],
            'post_content' => $place['content'],
            'post_type' => 'xativa_explore',
            'post_status' => 'publish',
            'post_name' => $slug
        );

        $existing_post = get_page_by_path($slug, OBJECT, 'xativa_explore');
        
        if ($existing_post) {
            $post_data['ID'] = $existing_post->ID;
            $post_id = wp_update_post($post_data);
        } else {
            $post_id = wp_insert_post($post_data);
        }

        if ($post_id) {
            wp_set_object_terms($post_id, $place['category'], 'explore_category');
            
            foreach ($place['meta'] as $key => $value) {
                update_post_meta($post_id, $key, $value);
            }
            
            echo "Actualizado: {$place['title']}\n";
        }
    }
}

update_explore_content();
echo "Actualización completada.\n"; 