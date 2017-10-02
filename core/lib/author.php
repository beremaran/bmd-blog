<?php
/**
 * Created by PhpStorm.
 * User: beremaran
 * Date: 26.09.2017
 * Time: 19:31
 */

/**
 * @param $author array
 * @return string
 */
function a_build_author_link($author)
{
    $url = strlen($author['twitter']) > 0 ? 'https://twitter.com/' . $author['twitter'] : '#';
    $url = '<a href="' . $url . '">' . $author['fullName'] . '</a>';
    return $url;
}