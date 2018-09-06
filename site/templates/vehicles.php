<?php
require_once("inc/functions.inc"); 
require_once("inc/header2.inc"); 
$type = $page->name;
// echo $type;

$selector = "template=fabric,collection=" . $type;
// echo $selector;
$products = $pages->find("$selector, limit=12, sort=sequence, sort=colour");

$pagination = $products->renderPager(array(
    'nextItemLabel' => "Next",
    'previousItemLabel' => "Prev",
    'listMarkup' => "<ul class='MarkupPagerNav pagination text-center'role='navigation' aria-label='Pagination'>{out}</ul>",
    'currentItemClass' => "current",
    'itemMarkup' => "<li class='{class}'>{out}</li>",
    'linkMarkup' => "<a href='{url}'><span>{out}</span></a>"  
));
?>
<div class="grid-x">
	<div class="small-12">
		<div class="callout text-center">
			<h3><?=$page->title?></h3>
			<?=$page->body_no_editor?>
		</div>
	</div>
	<div class="small-12 columns">
		<?=$pagination?>
	</div>
</div>
<div class="row">
	<?php
	foreach($products AS $product) {
	    ?>
	    <div class="small-6 medium-3 columns" itemscope itemtype="http://schema.org/Product">
	    	<?php
	    	$options = array(
                'quality' => 80,
                'upscaling' => false       
                ); 
            ?>
			<a href="<?= $product->url ?>"><img src="<?= $product->images->first()->width(330,$options)->url ?>" itemprop="image"></a>
			<div class="prod_panel callout">
				<h6 class="text-center" itemprop="name">
					<?php
					if ($page->title =="Classics") {
					 	echo substr(strstr($product->title," "), 1);
					 } else {
					 	echo $product->title;
					 }
					 ?>
				</h6>
			</div>
		</div>
		<?php
	}
	?>
	<div class="clearer">&nbsp</div>
</div>
<div class="row">
	<div class="small-12 columns">
		<?=$pagination?>
	</div>
</div>
<?php
require_once("inc/footer2.inc");