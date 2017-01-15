<?php 
hide($content['commends']);
hide($content['links']);
if($page): ?>{
	"id": "<?php print $node->nid; ?>",
	"title": "<?php print $title; ?>",
	"content": <?php print json_encode('<div class="content clearfix" ' . $content_attributes . ">" . render($content) . "</div>") ?>
}
<?php elseif($teaser): print $node->nid . ","; endif; ?>