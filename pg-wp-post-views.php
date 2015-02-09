<?php
/**
*
*@author Sayyed Jamal Ghasemi <jamal13647850@gmail.com>
*@version 1.0.0
*@copyright 2015 [PGsavis](http://www.pgsavis.com) 
*/
class pg_wp_post_views{
	/**
	*@var mixed[] $vars main variable of class
	*/
    private $vars = array() ;
    function __construct($param) {
        //isset($param['footerversion'])?$this->vars['footerversion']=$param['footerversion']:$this->vars['footerversion']='';
		// Remove issues with prefetching adding extra views
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    }
    function __set($name, $value) {
        $this->vars[$name] = $value ;
    }
    function __get($name) {
        return $this->vars[$name];
    }
    function __call($name, $arguments) {
        
    }
	/**
	*@param integer $postID id of post
	*@return integer count of post views
	*/
	function getPostViews($postID){
    	$count_key = 'post_views_count';
    	$count = get_post_meta($postID, $count_key, true);
    	if($count==''){
        	delete_post_meta($postID, $count_key);
        	add_post_meta($postID, $count_key, '0');
        	return "0";
    	}
    	return $count;
	}
	/**
	*@param integer $postID id of post
	*set count of post views
	*should use in single.php
	*/
	function setPostViews($postID) {
    	$count_key = 'post_views_count';
    	$count = get_post_meta($postID, $count_key, true);
    	if($count==''){
        	$count = 0;
        	delete_post_meta($postID, $count_key);
        	add_post_meta($postID, $count_key, '0');
    	}
		else{
        	$count++;
        	update_post_meta($postID, $count_key, $count);
    	}
	}
	/**
	*@param integer $postID id of post
	*@param integer $constnumber set all post view equal this number
	*@param integer $minnumber set all post view from this number
	*@param integer $maxnumber set all post view to this number
	*set all post views in a custom number
	*/
	function setstartPostViews($postID,$constnumber=30000,$minnumber=NULL,$maxnumber=NULL) {
    	$count_key = 'post_views_count';
    	$count = 35000;
    	if($count==''){
        	$count = 0;
        	delete_post_meta($postID, $count_key);
        	add_post_meta($postID, $count_key, '0');
    	}
		else{
        	$count++;
        	update_post_meta($postID, $count_key, $count);
    	}
	}
/**************************************************************************/
}