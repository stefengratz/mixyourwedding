<?php 

global $share_page_url;
if(empty($share_page_url))
{
    $share_page_url = esc_url(get_permalink());
}

?>
<div id="fb-social-share">
    <div class="fb-like" data-href="<?php echo $share_page_url; ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
    <div class="fb-send" data-href="<?php echo $share_page_url; ?>"></div>
</div>