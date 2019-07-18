<html>
<head>
<meta charset="utf-8">
</head>
<body>
<style>
#image-zoom-wrapper {
  width: 100% !important;
  height: 100% !important;
  margin: 0 !important;
  background-color: #FFF !important;
}
figure {
  float: right;
  width: 100%;
  height: 80%;
  text-align: center;
  font-style: italic;
  text-indent: 0;
  margin: 0;
  padding: 0;
}
figcaption {
  margin-top: 0.5em;
}
</style>
<?php

$src = filter_input(INPUT_GET, 'src', FILTER_SANITIZE_URL);
$return_url = filter_input(INPUT_GET, 'return', FILTER_SANITIZE_URL);
$caption = filter_input(INPUT_GET, 'caption', FILTER_SANITIZE_STRING);

if ($return_url) {
    echo "<script>var return_url = '${return_url}';</script>";
}
?>

<!-- Zoomify requirements-->
<!--link rel="stylesheet" type="text/css" href="https://www.openbookpublishers.com/resources/zoomify.css" media="all" /-->
<link rel="stylesheet" type="text/css" href="./zoomify.css" media="all" />
<!--script src="https://www.openbookpublishers.com/resources/zoomify.js" async="async"></script-->
<script src="./zoomify.js" async="async"></script>

<figure>
  <div id="image-zoom-wrapper">
      <img id="image-zoom" src="<?php echo $src; ?>" alt="<?php echo $caption; ?>" />
  </div>
  <figcaption><?php echo $caption; ?></br><a href="<?php echo $src; ?>"><?php echo $src; ?></a></figcaption>
</figure>
</body>
