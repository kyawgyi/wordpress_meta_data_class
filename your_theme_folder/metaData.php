<?php
//meta data class for wordpress
class metaData
{
	private $post_type = null;
	public $meta_box_name = "Meta Datas";
	private $default_metas = [];

	function __construct($post_type)
	{
		$this->post_type = $post_type;
	}

	function add_meta_boxes($default)
	{
		//load function on edit page
		add_action("load-post.php",[$this,'meta_box_add_process']);
		//load function on add new item page
		add_action("load-post-new.php",[$this,'meta_box_add_process']);

		$this->default_metas = $default;
	}

	function meta_box_add_process()
	{			
		//add hook action to add meta boxes
		add_action( 'add_meta_boxes_'.$this->post_type, [$this,'add_custom_meta_box']);
		//
		add_action( "save_post_".$this->post_type,[$this,'save_meta_data'],10,2);
	}

	function add_custom_meta_box()
	{			
		add_meta_box("add-meta-box", 
			$this->meta_box_name, 
			[$this,'meta_box_elements'], 
			$this->post_type, 
			"normal","core");			
	}

	function meta_box_elements($object)
	{		
		$meta_datas = get_post_meta($object->ID);
		$temp = $meta_datas;
		foreach($temp as $key => $value)
		{
			if(is_array($value))
			$meta_datas[$key] = $value[0];
			else
			$meta_datas[$key] = $value;
		}
		$meta_datas = array_merge($this->default_metas,$meta_datas);
		wp_nonce_field($this->post_type.'-nonce-action', $this->post_type."-meta-box-nonce");
		include("elements/".$this->post_type.".php");
	}

	function save_meta_data($post_id, $post)
	{
		if(!isset($_POST[$this->post_type."-meta-box-nonce"]) || !wp_verify_nonce($_POST[$this->post_type."-meta-box-nonce"],$this->post_type."-nonce-action"))
		{
			echo "save meta process fail.";
			return false;
		}

		foreach($this->default_metas as $key => $value)
		{
			if(isset($_POST[$key]))
			{					
				update_post_meta($post_id,$key,$_POST[$key]);
			}
		}
		
	}
}