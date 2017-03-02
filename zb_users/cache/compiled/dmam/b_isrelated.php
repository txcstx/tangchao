<?php  /* Template Name:相关文章 */  ?>

<?php 
$relatedpad = '';
$relatedtxt = '';
$numm = '';
if ($zbp->Config('dmam')->article_relevant == 2 ||$zbp->Config('dmam')->article_relevant == 4){
	$numm = 8;
}else{
	$numm = 4;
}
if(count (GetList($numm,null,null,null,null,null,array('is_related'=>$article->ID)))){
	$array = GetList($numm,null,null,null,null,null,array('is_related'=>$article->ID));
}else{
	$array = Getlist($numm,$article->Category->ID);
}
foreach ($array as $related) {
	$img_cover = '';
	$img_cover = $zbp->host.'zb_users/theme/'.$zbp->theme.'/style/images/covers/'.rand(1,20).'.jpg';
	if ($zbp->CheckPlugin('dm_tools')) {
		dm_tools_thumb::getPics($related,400,250,4);
		if ($related->dm_tools_thumb_COUNT>0){
			$img_cover = $related->dm_tools_thumb[0];
			if ($related->Metas->post_style_order && $related->Metas->post_style_order > 1 && !strpos($related->Metas->post_style_order,',')){
			$img_cover = $related->dm_tools_thumb[$related->Metas->post_style_order-1];
			}
		}
			$img_cover = $related->Metas->thumbnail?dm_tools_thumb::getPicUrlBy($related->Metas->thumbnail,400,250,4):$img_cover;
	}
	$relatedpad .= '<li><a href="'.$related->Url.'" title="'.$related->Title.'"><img '.dmam_islasy('',$img_cover).' class="thumb"/><h4>'.$related->Title.'</h4><time>'.$related->Category->Name.'</time></a></li>';
	$relatedtxt .= '<li><a href="'.$related->Url.'" title="'.$related->Title.'">'.$related->Title.'</a></li>';
}
 ?>
	<div class="am-titlebar am-titlebar-multi">
	  <div class="am-titlebar-title am-icon-thumb-tack"> 相关推荐</div>
	</div>
<?php if ($zbp->Config('dmam')->article_relevant == '3'||$zbp->Config('dmam')->article_relevant == '4') { ?>
<div class="pads">
<ul id="tags_related">
<?php  echo $relatedpad;  ?>
</ul>
</div>
<?php } ?>
<?php if ($zbp->Config('dmam')->article_relevant == '1'||$zbp->Config('dmam')->article_relevant == '2') { ?>
<div class="relates">
<ul>
<?php  echo $relatedtxt;  ?>
</ul>
</div>
<?php } ?>