<?php

$link = carbon_get_post_meta(get_the_ID(), 'publications-url') ?: null;

?>

<article class="single__item">
    <h2 class="single__title mb-4"><?= get_the_title(); ?></h2>

    <?php

    if ($link) {

    ?>

        <p>
            Материал доступен по <a style="text-decoration: underline;" href="<?= $link ?>">ссылке</a>
        </p>

    <?php


    } else {

    ?>

        <p>
            К сожалению, материал недоступен
        </p>

    <?php

    }

    ?>

    <div class="single__content">
        <?php the_content(); ?>
    </div>

</article>