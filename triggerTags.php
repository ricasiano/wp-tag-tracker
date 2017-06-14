<?php 
include('analytics/tags.php');
include('analytics/analyticsHelper.php');
use PH\RMN\Classes\Tags;
use PH\RMN\Classes\AnalyticsHelper;

$tags = new Tags($post);
$analyticsHelper = new AnalyticsHelper($tags->getTags());
$analyticsTags = $analyticsHelper->getAnalyticsTags();
if(0 < count($analyticsTags)) {
	?><script type="text/javascript"><?php
		foreach($analyticsTags as $tagType => $tags){
			foreach ($tags as $tag) {
				?> 
					ga('send', 'event', '<?php echo ucfirst($tagType);?> Tag', 'View', '<?php echo $tag; ?>');
				<?php
			}
		}
	?></script><?php
}
?>
