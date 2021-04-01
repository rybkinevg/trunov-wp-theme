<?php

namespace rybkinevg\trunov;

class Images extends Transfer
{

    protected static function get()
    {
        global $wpdb;

        $query = "
            SELECT
                `post_content`,
                `ID`,
                `post_title`
            FROM
                {$wpdb->posts}
            WHERE
                `post_content`
            LIKE
                '%<img%'
        ";

        $posts = $wpdb->get_results($query);

        return $posts;
    }

    public static function set()
    {
        require(get_template_directory() . '/includes/vendor/simple_html_dom.php');

        $posts = self::get();

        global $wpdb;

        foreach ($posts as $post) {

            $html = new \simple_html_dom();

            $html->load($post->post_content);

            $imgs = $html->find('img');

            foreach ($imgs as $img) {

                $img->attr['alt'] = "";
                $img->attr['src'] = self::download_image($img->attr['src'], $post->ID);
                $img->attr['class'] = 'aligncenter';
            }

            $new_content = $html->save();

            $wpdb->update(
                $wpdb->posts,
                ['post_content' => $new_content],
                ['ID' => $post->ID]
            );
        }
    }

    protected static function download_image($url, $post_id)
    {
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        $url = str_replace('\\', '/', $url);

        $url_to_arr = explode('/', $url);

        if ($url_to_arr[0] == '..' || $url_to_arr[0] == '.' || $url_to_arr[0] == '' || $url_to_arr[0] == 'trunov.com') {

            $url_to_arr[0] = 'http://trunov.com';
        }

        $url = implode('/', $url_to_arr);

        $file_name = "post-img-{$post_id}";

        $thumb_src = media_sideload_image($url, $post_id, $file_name, 'src');

        if (is_wp_error($thumb_src)) {

            $url = 'http://trunov.com/' . $url;

            $thumb_src = media_sideload_image($url, $post_id, $file_name, 'src');

            if (is_wp_error($thumb_src)) {

                $data = get_option('trunov_not_imported_images', '');

                if (empty($data)) {

                    $data = $url;
                } else {

                    if (in_array($url, $data))
                        return;

                    array_push($data, $url);
                }

                update_option('trunov_not_imported_images', $data);
            }
        }

        return (!is_wp_error($thumb_src)) ? $thumb_src : $url;
    }
}
