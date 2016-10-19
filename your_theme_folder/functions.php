<?php
	include("metaData.php");

	$slideshow = new metaData("slideshow");
	$slideshow->add_meta_boxes([
								"image_count" => 0,
								"type"        => '',
								"animation"   => ''
							  ]);

?>