<?php
/**
 * Created by PhpStorm.
 * User: beremaran
 * Date: 26.09.2017
 * Time: 18:14
 */

/**
 * @param null|string $dir
 * @param string $extension
 * @return array|null
 */
function f_getFileList($dir = null, $extension = "*")
{
    global $DATA_DIR;

    if ($dir === null)
        return null;

    return glob($DATA_DIR . '/' . $dir . '/*.' . $extension);
}

function f_getAuthors()
{
    $out = [];
    $f_list = f_getFileList('authors', 'json');

    foreach ($f_list as $f) {
        $f = file_get_contents($f);
        $f = json_decode($f, true);
        unset($f['password']);

        $out[] = $f;
    }

    return $out;
}

/**
 * @param $nickname string
 * @return mixed|null
 */
function f_getAuthor($nickname)
{
    $authors = f_getAuthors();
    foreach ($authors as $author)
        if ($author['nickname'] === $nickname)
            return $author;

    return null;
}

function f_getPosts($category = "", $with_content = false)
{
    $out = [];
    $f_list = f_getFileList('posts', 'md');

    foreach ($f_list as $f) {
        $fMeta = p_extractMeta($f);
        if ($category !== "" && u_clear_str($fMeta['category']) !== $category)
            continue;

        if ($with_content)
            $fMeta['content'] = f_getPost($fMeta['file'], true)['content'];

        $out[] = $fMeta;
    }

    usort($out, "p_cmp");
    return $out;
}

function f_getPost($fileName, $build_path = false)
{
    global $DATA_DIR;

    if ($build_path) {
        $fileName = $DATA_DIR . '/posts/' . $fileName . '.md';
    }

    $out = [
        'meta' => p_extractMeta($fileName)
    ];

    $f = fopen($fileName, "r");
    for ($i = 0; $i < 2; $i++)
        fgets($f);

    $out['content'] = "";
    while (($line = fgets($f)) !== false)
        $out['content'] .= $line;

    $out['content'] = p_render($out['content']);

    return $out;
}

function f_readLines($fileName = "", $count = -1, $f = null)
{
    $out = [];

    if ($f === null)
        $f = fopen($fileName, "r");

    if ($f) {
        for ($i = 0; $i < $count; $i++) {
            $r = fgets($f);
            if ($r === false)
                return null;

            $out[] = $r;
        }

        return $out;
    } else
        return null;
}

function f_extractName($fileName)
{
    $fileName = explode('/', $fileName);
    $fileName = explode('.', $fileName[count($fileName) - 1]);
    return $fileName[count($fileName) - 2];
}

/**
 * @param $fh
 * @param $c int
 */
function f_skiplines($fh, $c)
{
    for ($i = 0; $i < $c; $i++)
        fgets($fh);
}