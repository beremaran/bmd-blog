<?php
/**
 * Created by PhpStorm.
 * User: beremaran
 * Date: 26.09.2017
 * Time: 19:31
 */

/**
 * @param $author string
 * @return string
 */
function a_build_author_link($author)
{
    return '<a href="https://twitter.com/' . $author['twitter'] . '">' . $author['fullName'] . '</a>';
}