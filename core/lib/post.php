<?php
/**
 * Created by PhpStorm.
 * User: beremaran
 * Date: 26.09.2017
 * Time: 18:20
 */

function p_cmp($meta1, $meta2)
{
    $meta1['date'] = intval($meta1['date']);
    $meta2['date'] = intval($meta2['date']);

    if ($meta1['date'] === $meta2['date'])
        return 0;

    return ($meta1['date'] > $meta2['date']) ? -1 : 1;
}

function p_cmp_category($cat1, $cat2)
{
    return strcmp($cat1['short_name'], $cat2['short_name']);
}

/**
 * @param $fileName string
 * @return array
 */
function p_extractMeta($fileName)
{
    global $app;
    $default_category = $app->getContainer()->get('settings')['default_category'];

    $meta = f_readLines($fileName, 3);

    $meta[0] = trim($meta[0]);
    $meta[0] = preg_replace('/\s\s+/', "", $meta[0]);
    $meta[0] = explode(",", $meta[0]); // 0 -> author, 1 -> date, 2 -> category
    for ($i = 0; $i < count($meta[0]); $i++)
        $meta[0][$i] = trim($meta[0][$i]);

    $meta[1] = trim($meta[1]);

    $meta[2] = str_replace("#", "", $meta[2], $a = 1);
    $meta[2] = trim($meta[2]);

    return [
        'file' => f_extractName($fileName),
        'title' => $meta[2],
        'short_text' => $meta[1],
        'author' => f_getAuthor($meta[0][0]),
        'date' => strtotime($meta[0][1]),
        'category' => count($meta[0]) < 3 ? $default_category : $meta[0][2]
    ];
}

function p_render($raw_content)
{
    $pd = Parsedown::instance();
    return $pd->text($raw_content);
}

function p_categories()
{
    $out = [
        'general' => [
            'post_count' => 0,
            'name' => 'General',
            'short_name' => 'general'
        ]
    ];
    $posts = f_getPosts();

    foreach ($posts as $post) {
        if ($post['category'] === null) {
            $out['general']['post_count']++;
            continue;
        }

        $category = u_clear_str($post['category']);
        if (!isset($out[$category]))
            $out[$category] = [
                'post_count' => 0,
                'name' => $post['category'],
                'short_name' => $category
            ];

        $out[$category]['post_count']++;
    }

    usort($out, "p_cmp_category");
    return $out;
}