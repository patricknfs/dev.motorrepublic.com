<?php
// post_main.php template
?>
<div class="row firstrow">
	<div class="large-12 columns blog" itemscope itemtype="http://schema.org/BlogPosting">
		<?php
		if($page->date){
			echo "<p><small>" . $page->date . "</small></p>";
		}
		?>
		<h1 itemprop='name'><?=$page->title?></h1>
		<img class="floatright" src="<?=$page->images->first()->url?>" />
		<span itemprop='articleBody'><?=$page->body_md?></span>
	</div>
	<?php 
	if(count($page->images) > 1){
		foreach ($page->images as $id => $image) {
			?>
			<div class="small-6 medium-4 columns blog_img">
				<img src="<?=$image->url?>" alt="<?=$image->description?>" title="<?=$image->description?>">
			</div>
			<?php
		}
	}
	?>
	<hr />
	<div class="large-12 columns">
		<?=$page->comments->renderForm(array('requireSecurityField' => 'security_field'))?>
		<?=$page->comments->render()?>
	</div>
</div>