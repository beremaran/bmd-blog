<?php
/**
 * Created by PhpStorm.
 * User: beremaran
 * Date: 26.09.2017
 * Time: 21:53
 */

function s_search($q)
{
    $out = [];
    $posts = f_getPosts("", true);

    $q = trim($q);
    if (strpos($q, " ") !== false)
        $q = explode(" ", $q);

    foreach ($posts as $post) {
        $search_fields = [
            'title', 'author', 'content', 'short_text'
        ];

        $flag = false;
        foreach ($search_fields as $search_field) {
            switch ($search_field) {
                case "author":
                    $haystack = $post[$search_field]["fullName"];
                    break;
                default:
                    $haystack = $post[$search_field];
            }

            if (is_array($q))
                $flag = $flag || s_lookup_multi($haystack, $q);
            else
                $flag = $flag || s_lookup($haystack, $q);
        }

        if ($flag)
            $out[] = $post;
    }

    return $out;
}

function s_lookup_multi($haystack, $needles)
{
    $flag = false;
    foreach ($needles as $needle)
        $flag = $flag || s_lookup($haystack, $needle);
    return $flag;
}

function s_lookup($haystack, $needle)
{
    return strpos(strtolower($haystack), strtolower($needle)) !== false;
}