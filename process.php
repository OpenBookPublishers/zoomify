<?php

// https://www.php.net/manual/en/function.imagecreatefromjpeg.php#110547
function imageCreateFromAny($filepath) {
    $type = getimagesize($filepath)["mime"];
    $allowedTypes = array("image/gif", "image/jpeg", "image/png", "image/bmp");

    if (!in_array($type, $allowedTypes)) {
        return false;
    }

    switch ($type) {
        case "image/gif":
            $im = imageCreateFromGif($filepath);
            break;
        case "image/jpeg":
            $im = imageCreateFromJpeg($filepath);
            break;
        case "image/png":
            $im = imageCreateFromPng($filepath);
            break;
        case "image/bmp":
            $im = imageCreateFromBmp($filepath);
            break;
    }
    return $im;
}

// http://webcheatsheet.com/php/create_thumbnail_images.php
function createThumbs($image, $outfile, $thumb_width) {
    $width = imagesx($image);
    $height = imagesy($image);

    $thumb_height = floor($height * ($thumb_width / $width));
    $tmp_img = imagecreatetruecolor($thumb_width, $thumb_height);
    imagecopyresized($tmp_img, $image, 0, 0, 0, 0, $thumb_width, $thumb_height,
                     $width, $height);
    imagepng($tmp_img, $outfile);
}

function getName($filename, $dir, $type) {
    $name = "${type}_${filename}.png";
    return $dir . DIRECTORY_SEPARATOR . $name;
}

function getImageOrDie($src) {
    try {
        $image = imageCreateFromAny($src);
        if (!$image) {
            throw new Exception();
        }
    } catch (Exception $e) {
        http_response_code(400);
        die("Invalid image provided.");
    }
    return $image;
}

// https://www.codexworld.com/how-to/get-domain-name-from-url-php/
function getDomainFromUrl($url) {
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)){
        return $regs['domain'];
    }
    return false;
}

function allowedUrlOrDie($src, $allowed_domains) {
    try {
        $domain = getDomainFromUrl($src);
        if (!in_array($domain, $allowed_domains)) {
            throw new Exception();
        }
    } catch (Exception $e) {
        http_response_code(400);
        die("Cannot display URLs from unrecognised domains.");
    }
    return true;
}
