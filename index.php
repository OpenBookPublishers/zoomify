<?php
    require './process.php';

    $src = filter_input(INPUT_GET, 'src', FILTER_SANITIZE_URL);
    $return_url = filter_input(INPUT_GET, 'return', FILTER_SANITIZE_URL);
    $caption = filter_input(INPUT_GET, 'caption', FILTER_SANITIZE_STRING);
    $dir = './thumbnails';
    $allowed_domains = array("openbookpublishers.com");
    $files = array("favicon" => 32, "thumb" => 100);
    $names = array();

    // remove to allow images from any host
    allowedUrlOrDie($src, $allowed_domains);
    // make sure we are working with an image
    $image = getImageOrDie($src);
    // get image attributes
    list($width, $height, $type, $attr) = getimagesize(urlencode($src));
    $mime = image_type_to_mime_type($type);

    // generate thumbnails
    $filename = pathinfo(basename($src), PATHINFO_FILENAME);
    foreach ($files as $k => $width) {
        $outfile = getName($filename, $dir, $k);
        $names[$k] = $outfile;
        if (!file_exists($outfile)) {
            createThumbs($image, $outfile, $width);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <title><?php echo $filename; ?></title>
        <meta name="Description" content="<?php echo $caption; ?>" />
        <meta name="thumbnail" content="<?php echo $names["thumb"]; ?>" />

        <meta property="og:title" content="<?php echo $filename; ?>" />
        <meta property="og:description" content="<?php echo $caption; ?>" />
        <meta property="og:image" content="<?php echo $src; ?>" />
        <meta property="og:type" content="image" />
        <meta property="twitter:card" content="summary" />
        <meta property="twitter:title" content="<?php echo $filename; ?>" />
        <meta property="twitter:image" content="<?php echo $src; ?>" />
        <meta property="twitter:description" content="<?php echo $caption; ?>" />

        <link rel="canonical" href="<?php echo $src; ?>" />
        <link rel="shortcut icon" href="<?php echo $names["favicon"]; ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $names["favicon"]; ?>">
        <link rel="stylesheet" type="text/css" href="./zoomify.css" media="all" />

        <?php if ($return_url) { ?>
        <script>var return_url = '<?php echo $return_url; ?>';</script>
        <?php } ?>
        <script src="./zoomify.js" async="async"></script>
        <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "ImageObject",
          "representativeOfPage": true,
          "contentUrl": "<?php echo $src; ?>",
          "description": "<?php echo $caption; ?>",
          "caption": "<?php echo $caption; ?>",
          "encodingFormat": "<?php echo $mime; ?>",
          "height": "<?php echo $height; ?> px",
          "width": "<?php echo $width; ?> px",
          "thumbnailUrl": "<?php echo $names["thumb"]; ?>",
          "thumbnail": {
            "@context": "http://schema.org",
            "@type": "ImageObject",
            "contentUrl": "<?php echo $names["thumb"]; ?>"
          }
        }
        </script>
        <!-- Matomo -->
        <script type="application/javascript" src="data:application/javascript;charset=utf-8;base64,dmFyIF9wYXEgPSBfcGFxIHx8IFtdOw0KX3BhcS5wdXNoKFsic2V0Q29va2llRG9tYWluIiwgIioub3BlbmJvb2twdWJsaXNoZXJzLmNvbSJdKTsNCl9wYXEucHVzaChbJ3RyYWNrUGFnZVZpZXcnXSk7DQpfcGFxLnB1c2goWydlbmFibGVMaW5rVHJhY2tpbmcnXSk7DQooZnVuY3Rpb24oKSB7DQogIHZhciB1PSIvL2FuYWx5dGljcy5vcGVuYm9va3B1Ymxpc2hlcnMuY29tLyI7DQogIF9wYXEucHVzaChbJ3NldFRyYWNrZXJVcmwnLCB1KydwaXdpay5waHAnXSk7DQogIF9wYXEucHVzaChbJ3NldFNpdGVJZCcsICcxJ10pOw0KICB2YXIgZD1kb2N1bWVudCwgZz1kLmNyZWF0ZUVsZW1lbnQoJ3NjcmlwdCcpLCBzPWQuZ2V0RWxlbWVudHNCeVRhZ05hbWUoJ3NjcmlwdCcpWzBdOw0KICBnLnR5cGU9J2FwcGxpY2F0aW9uL2phdmFzY3JpcHQnOyBnLmFzeW5jPXRydWU7IGcuZGVmZXI9dHJ1ZTsgZy5zcmM9dSsncGl3aWsuanMnOyBzLnBhcmVudE5vZGUuaW5zZXJ0QmVmb3JlKGcscyk7DQp9KSgpOw=="></script>
        <!-- End Matomo Code -->
    </head>
<body>

<link rel="stylesheet" type="text/css" href="./zoomify.css" media="all" />
<script src="./zoomify.js" async="async"></script>

<figure>
  <div id="image-zoom-wrapper">
      <img id="image-zoom" src="<?php echo $src; ?>" alt="<?php echo $caption; ?>" />
  </div>
  <figcaption><?php echo $caption; ?></br></br>Image URL: <a href="<?php echo $src; ?>"><?php echo $src; ?></a></figcaption>
</figure>
</body>
