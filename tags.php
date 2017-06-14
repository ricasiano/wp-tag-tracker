<?php
namespace PH\RMN\Classes;
include_once('wp-content/themes/Newspaper/includes/wp_booster/td_module_single_base.php');
class Tags extends \td_module_single_base
{
   /**
     *
     * get just the array of tag objects, this will be used for rendering the analytics event tracker
     *
     */
    public function getTags()
    {
        if ($this->post->post_type == 'post') {
            return get_the_tags();
        }
        return false;
    }

}
