#Wordpress Meta Data Helper Class

updating and adding hook action to wordpress for meta data is handy work.Step by Step and sometime it is easy to make error.
This class can help programmer to create meta element and updating meta values.
There are some plugin that can help to make meta elements but some of them are needed to pay.Some come with their own design and you may don't satisfy with this.
This class is not plugin and just helper class and let you do more work as you wish.

##How you use this class
It is very easy work
*First you will need to include metaData to load this helper class.
*Then instantiate a new object for a post type.
*After that call add_meta_boxes method by passing default meta values as parameter.

##Example

include\("metaData\.php"\);

$slideshow = new metaData\("slideshow"\); //"slideshow" is post type name

$slideshow\-\>add_meta_boxes\(\[

							"image_count" => 0,

							"type"        => "",

							"animation"   => ""

						  ]);

you will need to create a file with post type name in "elements" folder.
please add meta form elements with your own design.
Note: $meta_datas is ready made variable to used in this file.