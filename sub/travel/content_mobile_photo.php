<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
$o_photo=new Library_Region_Photo();
$o_photo->PushWhere ( array ('&&', 'RegionId', '=',$_GET['id']) );
$o_photo->PushOrder ( array ('Id', 'A' ) );
$n_count=$o_photo->getAllCount();
$html='';
for($i=0;$i<$n_count;$i++)
{
	$html.='
	<div style="background-color:#FFFBC7" class="gallery-item" >
                    <a style="background-color:#FFFBC7" href="'.RELATIVITY_PATH.$o_photo->getImage($i).'">
                        <img src="'.RELATIVITY_PATH.$o_photo->getImage($i).'"/></a></div>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PhotoSwipe</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;"
        name="viewport" />
    <link href="js/styles.css" type="text/css" rel="stylesheet" />
    <link href="js/photoswipe.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="js/lib/simple-inheritance.min.js"></script>
    <script type="text/javascript" src="js/code-photoswipe-1.0.11.min.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            Code.photoSwipe('a', '#Gallery', {
                getImageSource: Code.PhotoSwipe.GetImageSource,
                getImageCaption: Code.PhotoSwipe.GetImageCaption,
                fadeInSpeed: 250,
                fadeOutSpeed: 500,
                slideSpeed: 250,
                swipeThreshold: 50,
                swipeTimeThreshold: 250,
                loop: true,
                slideshowDelay: 3000,
                imageScaleMethod: 'fit', // Either "fit" or "zoom"
                preventHide: true,
                zIndex: 1000,

                /* Experimental - iOS only at the moment */
                allowUserZoom: true,
                allowRotationOnUserZoom: true,

                captionAndToolbarHide: true,
                captionAndToolbarHideOnSwipe: true,
                captionAndToolbarFlipPosition: true,
                captionAndToolbarAutoHideDelay: 5000,
                captionAndToolbarOpacity: 0.8,
                captionAndToolbarShowEmptyCaptions: true
            });
            Code.PhotoSwipe.Current.show(1);
            
        }, false);
        Code.PhotoSwipe.Current.startSlideshow();
    </script>
</head>
<body style="background-color:#FFFBC7">
    <div id="MainContent" style="display: none;background-color:#FFFBC7">
        <div id="Gallery" style="background-color:#FFFBC7">
            <div class="gallery-row" style="background-color:#FFFBC7">
                <?php echo($html);?>
            </div>
        </div>
    </div>
</body>
</html>
