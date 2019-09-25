<?php

namespace App\Helpers;

class ParseTag
{
    public static function parse($string)
    {
        return ParseTag::parseYoutube(ParseTag::parseTag(ParseTag::parseUser($string)));
    }

    public static function parseUser($string)
    {
        $pattern = "/(?<= |^)@[\w\d]+/";
        preg_match_all($pattern, $string, $matches);
        $matches = collect($matches[0])->unique();
        foreach ($matches as $match) {
            $url = route("profile", substr($match, 1));
            $string = str_replace($match, "<a href='$url'>$match</a>", $string);
        }
        return $string;
    }

    public static function parseTag($string)
    {
        preg_match_all('/\B(\#[a-zA-Z]+\b)(?!;)/', $string, $matches);
        $matches = collect($matches[1])->unique();
        foreach ($matches as $match) {
            $url = route("tag", substr($match, 1));
            $string = str_replace($match, "<a href='$url'>$match</a>", $string);
        }

        return $string;
    }

    public static function parseYoutube($string)
    {
        $pattern = "/\[youtube\](?:(?:https?\:\/\/)?(?:www\.)?(?:(?:youtube\.com\/(?:(?:(?:.*?)watch\?v=)|(?:v\/)))|(?:youtu\.be\/)))?([-a-zA-Z0-9_]+?)(?:[\?\&].*?)?\[\/youtube\]/";
        preg_match($pattern, $string, $matches);

        if(!empty($matches))
        {
            $string = preg_replace($pattern, '<br><div class="box"><iframe style="height: 160px" width="240" height="160" src="https://www.youtube.com/embed/'.$matches[1].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>', $string, 1);
        }

        return $string;
    }
}


