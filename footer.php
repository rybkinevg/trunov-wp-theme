<?php get_template_part('template-parts/index/content', 'partners'); ?>

<section class="section footer-nav">
    <h2 class=" visually-hidden">Навигация в подвале</h2>
    <div class="row">
        <div class="col mb-4">
            <nav class="footer-nav__item">
                <h3 class="h6">Пресс-центр</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="/press-centr/news">Новости</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/press-centr/news_smi">Новости СМИ</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/nauchnye_i_uchebno_metodicheskie_trudy">Научные публикации</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/press-centr/archive/fotoarhiv/">Фотоархив</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/press-centr/archive/video-arhiv/">Видеоархив</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col mb-4">
            <nav class="footer-nav__item">
                <h3 class="h6">Прочее</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="/advocats">Адвокаты</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/uslugi">Услуги</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/for_advocats">Для адвокатов</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/rekvizits_sud">Реквизиты судов</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/contacts">Контакты</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col mb-4">
            <nav class="footer-nav__item">
                <h3 class="h6">Информация</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="/uslugi">Консультация</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/sos">SOS</a>
                    </li>
                </ul>
            </nav>
        </div>
</section>
<footer class="footer site__item">
    <section class="section">
        <h2 class="visually-hidden">Список услуг</h2>
        <div class="row">
            <?php

            $services = [
                'Физическим лицам',
                'Юридическим лицам',
                // 'Юридический бизнес'
            ];

            foreach ($services as $service) {

                $args = [
                    'post_type' => 'services',
                    'posts_per_page' => -1,
                    'post_parent__in' => [get_page_by_title($service, 'OBJECT', 'services')->ID]
                ];

                $query = new WP_Query($args);

                if ($query->have_posts()) {

            ?>

                    <div class="col d-none d-lg-block mb-4">
                        <h3 class="h6"><?= $service ?></h3>
                        <ul class="list-group list-group-flush footer-services__list">

                            <?php

                            while ($query->have_posts()) {

                                $query->the_post();

                            ?>

                                <li class="list-group-item">
                                    <a href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?></a>
                                </li>

                            <?php
                            }

                            ?>

                        </ul>
                    </div>

            <?php

                }

                wp_reset_postdata();
            }

            ?>
            <div class="col">
                <div class="footer__frame text-center mb-4">
                    <iframe name="f1f8d9cabeb1874" width="190px" height="300px" data-testid="fb:like_box Facebook Social Plugin" title="fb:like_box Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/plugins/like_box.php?app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Dfe9b9588d9a744%26domain%3Dtrunov.com%26origin%3Dhttp%253A%252F%252Ftrunov.com%252Ff3d72549ee6cc4c%26relation%3Dparent.parent&amp;color_scheme=dark&amp;container_width=0&amp;header=true&amp;height=300&amp;href=http%3A%2F%2Fwww.facebook.com%2FTrunovAjvarIPartnery&amp;locale=ru_RU&amp;sdk=joey&amp;show_faces=true&amp;stream=false&amp;width=190" style="border: none; visibility: visible; width: 190px; height: 130px;" class=""></iframe>
                </div>
                <div class="footer__frame text-center mb-4">
                    <iframe name="fXDffe9a" frameborder="0" src="https://vk.com/widget_community.php?app=0&amp;width=190px&amp;_ver=1&amp;gid=56225942&amp;mode=0&amp;color1=E3E5E9&amp;color2=2B587A&amp;color3=5B7FA6&amp;class_name=&amp;height=300&amp;url=http%3A%2F%2Ftrunov.com%2Fnauchnye_i_uchebno_metodicheskie_trudy%2Fnauchnye_publikacii_advokatov_kollegii%2F&amp;referrer=http%3A%2F%2Ftrunov.com%2Fsearth%2F&amp;title=%D0%AE%D1%80%D0%B8%D0%B4%D0%B8%D1%87%D0%B5%D1%81%D0%BA%D0%B0%D1%8F%20%D0%BF%D0%BE%D0%BC%D0%BE%D1%89%D1%8C.%20%D0%9C%D0%BE%D1%81%D0%BA%D0%BE%D0%B2%D1%81%D0%BA%D0%B0%D1%8F%20%D0%BA%D0%BE%D0%BB%D0%BB%D0%B5%D0%B3%D0%B8%D1%8F%20%D0%B0%D0%B4%D0%B2%D0%BE%D0%BA%D0%B0%D1%82%D0%BE%D0%B2%20%D0%A2%D1%80%D1%83%D0%BD%D0%BE%D0%B2%20%D0%90%D0%B9%D0%B2%D0%B0%D1%80%20%D0%B8%20%D0%BF%D0%B0%D1%80%D1%82%D0%BD%D0%B5%D1%80%D1%8B.%20%D0%A3%D1%81%D0%BB%D1%83%D0%B3...&amp;1789698e5f9" width="190px" height="300px" scrolling="no" id="vkwidget1" style="overflow: hidden; height: 300px;"></iframe>
                </div>
                <div class="footer__copy">
                    <p>Copyright © 2002 - 2017 Все права защищены</p>
                    <p>Коллегия адвокатов "Трунов, Айвар и партнеры"</p>
                    <p>125080, г.Москва, Волоколамское шоссе, д. 15/22, вход со стороны улицы Панфилова, 22</p>
                    <p>Эл. почта: info@trunov.com</p>
                </div>
            </div>
        </div>
    </section>
</footer>
<?php wp_footer(); ?>
</div>
</body>

</html>