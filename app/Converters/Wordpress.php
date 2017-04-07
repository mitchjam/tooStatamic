<?php

namespace App\Converters;

use Carbon\Carbon;

class Wordpress 
{
    public $exportPath;

    public function __construct($filePath)
    {
        $this->exportPath = $filePath;
    }

    public static function fromExport($exportFile)
    {        
        return new self($exportFile);
    }

    public function toStatamic() {
        $posts = collect();

        if (\File::exists($this->exportPath)) {
          $xml = simplexml_load_file($this->exportPath);
          
          foreach ($xml->channel->item as $post) {
            if ($post->children('wp', true)->post_type != 'post') {
                continue;
            }

            $title = $this->titleOf($post);

            $author = $this->creatorOf($post);

            $date = $this->dateOf($post);

            $oldLink = $this->oldLinkOf($post);

            $postContent = trim($this->contentOf($post));

            $tags = array();
            $categories = array();

            foreach($post->category as $taxonomy) {
                if ($taxonomy['domain'] == 'post_tag') {
                    $tags[] = "'".$taxonomy['nicename']."'";
                }
                if ($taxonomy['domain'] == 'category') {
                    $categories[] = "'".$taxonomy['nicename']."'";
                }
            }

            $markdown  = "---\n";
            $markdown .= "title: '" . $title ."'\n";
            if (sizeof($tags)) {
              $markdown .= "tags: [".implode(", ", $tags)."]\n";
            }
            if (sizeof($categories)) {
              $markdown .= "categories: [".implode(", ", $categories)."]\n";
            }
            $markdown .= "---\n";
            $markdown .= $postContent;
            $markdown .= "\n";

            $filename = $this->slugify($title) . '-' . Carbon::now()->toDateString() . '.md';

            $posts->put($filename, $markdown);
          }
        }
        
        return $posts;
    }

    public function titleOf($post) {
        $title = is_object($post->title) ? $post->title->__toString() :$post->title;

        return empty($title) ? "Untitled Post" : $title;
    }

    public function creatorOf($post) {
        return $post->children('dc', true)->creator;
    }

    public function studioOf($title)
    {
        preg_match('~by\s+(.*)~', strtolower($title), $matches);

        if (isset($matches[1])) {
            $match = end($matches);

            return $match;
        }

        return null;        
    }

    public function oldLinkOf($post) {
        return $post->link;
    }

    public function contentOf($post) {
       return $post->children('content', true)->encoded;
    }

    public function dateOf($post) {
        return date("Y-m-d", strtotime($post->pubDate));
    }

    public function reduce($collection, $callback, $carry) {
        foreach ($collection as $key => $value) {
            $carry = $callback($carry, $value, $key);
        }

        return $carry;
    }

    public function arrayToYaml($array, $useKeys = false) {
        return reduce($array, function($yaml, $item, $key) use ($useKeys) {
            $yaml .= "\t";

            if ($useKeys) {
                $yaml .= $key . ": ";
            } 
            else {
                $yaml .= "- ";
            }
        
            $yaml .= $item . "\n";

            return $yaml;
        }, '');
    }

    public function matchAny($patterns, $string) {
        $matches = reduce($patterns, function($carry, $pattern, $index) use ($string) {
            preg_match($pattern, $string, $matches);

            return array_merge($carry, $matches);
        }, []);

        return count($matches) ? $matches : false;
    }

    // Credit: http://sourcecookbook.com/en/recipes/8/function-to-slugify-strings-in-php
    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
     
        // trim
        $text = trim($text, '-');
     
        // transliterate
        if (function_exists('iconv'))
        {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }
     
        // lowercase
        $text = strtolower($text);
     
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
     
        if (empty($text))
        {
            return 'n-a';
        }
     
        return $text;
    }
}
