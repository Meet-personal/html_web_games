<?php

use App\Models\Cms;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

if (!function_exists('get_category_image')) {
    /**
     * Format a number as currency.
     *
     * @param  float  $amount
     * @return string
     */
    function get_category_image($image)
    {
        if (!empty($image)) {
            return asset('storage/' . $image);
        }
        return get_no_image();
    }
}

if (!function_exists('get_no_image')) {
    /**
     * Format a number as currency.
     *
     * @param  float  $amount
     * @return string
     */
    function get_no_image()
    {
        return asset('/assets/images/no-image.png');
    }
}

if (!function_exists('common_image')) {
    /**
     * Format a number as currency.
     *
     * @param  float  $amount
     * @return string
     */
    function common_image($cImage)
    {
        if (!empty($cImage)) {
            return asset('storage/' . $cImage);
        }
        return get_no_image();
    }
}


if (!function_exists('generate_slug')) {
    /**
     * Generate a URL slug from a string.
     *
     * @param  string  $string
     * @return string
     */
    function generate_slug($string)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    }
}



if (!function_exists('generate_unique_slug')) {
    function generate_unique_slug($title, $model)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while ($model::withTrashed()->where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}

if (!function_exists('generate_random_string')) {
    /**
     * Generate a URL slug from a string.
     *
     * @param  string  $string
     * @return string
     */
    function generate_random_string($length = '8')
    {
        // Define the set of characters to use
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';

        // Build the random string
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}


if (!function_exists('unique_game_keywords')) {
    /**
     * Get unique keywords
     *
     * @param  array
     * @return string
     */
    function unique_game_keywords($arrayGameKeywords)
    {
        $preparedArray = [];
        foreach ($arrayGameKeywords as $keyword) {
            $finalData = explode(',', $keyword);
            if (!empty($finalData)) {
                $finalData = array_filter($finalData, function ($value) {
                    return !empty($value);
                });
                array_push($preparedArray, $finalData);
            }
        }
        $flattenedArray = flatten_array($preparedArray);
        // $collection = new Collection($preparedArray);
        // $flattenedCollection = $collection->collapse()->flatten()->toArray();
        $unqKeywords = array_unique($flattenedArray);
        return $unqKeywords;
    }
}




if (!function_exists('flatten_array')) {
    function flatten_array($array)
    {
        $result = [];
        array_walk_recursive($array, function ($item) use (&$result) {
            $result[] = $item;
        });
        return $result;
    }
}
if (!function_exists('get_cms')) {
    /**
     * Format a number as currency.
     *
     * @param  float  $amount
     * @return string
     */
    function get_cms()
    {
        return Cms::get();
    }
}
