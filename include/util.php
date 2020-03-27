<?php
 function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
       }
    else
        {  
		
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}
function debugout($par) {
    echo'<div>';
	echo '</br> ==================== debug start ================================= <br>';
	echo "<pre>";
	print_r($par);
	echo '</br> ==================== debug end ================================= <br>';
       
       
    echo '</div>';
 exit;
}



function createThumbs( $fullfilename,$fname, $thumbWidth )
{
   // $pathToImages='../images/photo/';
    $pathToThumbs='../images/thumbs/';
      // load image and get image size
      $img = imagecreatefromjpeg( "$fullfilename" );
      
     
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
}
