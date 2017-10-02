<?php
/**
 * Created by PhpStorm.
 * User: beremaran
 * Date: 28.09.2017
 * Time: 00:10
 */

function p_get_pages()
{
    global $DATA_DIR;

    $out = [];
    $page_files = glob($DATA_DIR . '/pages/*.md');

    foreach ($page_files as $page_file) {
        $out[] = p_extract_meta($page_file);
    }

    usort($out, "p_sort_pages");

    return $out;
}

function p_sort_pages($a, $b)
{
    if ($a['order'] === $b['order'])
        return 0;

    return ($a['order'] > $b['order']) ? 1 : -1;
}

/**
 * @param $page_file string
 * @return array
 */
function p_extract_meta($page_file)
{
    $out = [];
    $f = fopen($page_file, "r");
    $line = fgets($f);
    $line = explode(',', $line);
    for ($i = 0; $i < count($line); $i++)
        $line[$i] = trim($line[$i]);

    if ($line[0] === 'show') {
        $title = fgets($f);
        $title = trim(str_replace("#", "", $title, $a = 1));

        $out = [
            'name' => $title,
            'short_name' => u_clear_str($title),
            'order' => $line[1],
            'file' => $page_file
        ];
    }

    fclose($f);
    return $out;
}

function p_get_page($short_name)
{
    $pages = p_get_pages();

    $out = [];
    foreach ($pages as $page) {
        if ($page['short_name'] !== $short_name)
            continue;

        $out = $page;
        $f = file_get_contents($page['file']);
        $f = substr($f, strpos($f, '#'));
        $out['content'] = p_render($f);
    }

    return $out;
}