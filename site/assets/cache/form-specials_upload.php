<?php

/**
 * FormBuilder render file (embed method D) for form 'specials_upload'
 * 
 * Instructions
 * ============
 * 
 * 1. If not already in place, the contents of this file should be placed in this file:
 * 
 *    /site/templates/FormBuilder/form-specials_upload.php
 * 
 *    When present, FormBuilder will always use this file for $forms->render('specials_upload'); calls, rather than 
 *    the markup that it generates at runtime.
 * 
 * 2. Move the indicated stylesheet <link> tags further-below to your document <head>, to appear when this form
 *    is rendered. You may optionally omit any or all of the stylesheets if you don't think you will need them. 
 *    In particular, remove any that duplicate stylesheets you may already be loading (like from CSS frameworks).
 * 
 * 3. Also move the indicated Javascript <script> tags below to your <head> or before closing the </body> tag,
 *    to appear when this form will be rendered. You may optionally omit any of the scripts if you don't think 
 *    you will need them. In particular, remove any that duplicate scripts you may already be loading (like jQuery 
 *    or CSS framework files). We recommend that you always keep the 'form-builder-d.js' script in place.
 * 
 * 4. Adjust the form markup below as you see fit. Keep the form field 'name' attributes in tact. Please note that
 *    removing any 'id' or 'class' attributes (or other significant changes to the markup) may interfere with or
 *    disable features provided by FormBuilder for a given field. So be sure to test any changes thoroughly.
 * 
 * 5. To render this form, place the following in a template file where you want the form to appear: 
 * 
 *    echo $forms->render('specials_upload'); 
 * 
 * Optional: Steps 2 and 3 above ask you copy <link> and <script> tags in your document <head>. We recommend that 
 * you surround them in something like if($page->id == 123) { ... }, so that you are only rendering these assets 
 * on the page where the form will be displayed (where '123' is the ID of the page).
 * 
 * Please leave the following here
 * ===============================
 * Date: 2018-09-06 14:53:47
 * Hash: 8c340c858fd0ef462ec10ee5def6ffec
 * 
 * If you get want to disable an 'out of date' warning from FormBuilder for this file, copy the 'Hash' (like seen 
 * above) from the /site/assets/cache/FormBuilder/form-specials_upload.php file, and paste to make it replace the hash 
 * value that you see above. We also recommend you update the 'Date' for your own reference.
 * 
 * 
 * Variables provided to this template
 * ===================================
 * @var InputfieldForm $form Form that is being rendered or processed
 * @var FormBuilderProcessor $processor Processor of form
 * @var array $values Existing values of field inputs, indexed by field name
 * @var array $labels Field labels indexed by field name
 * @var array $descriptions Field descriptions indexed by field name
 * @var array $notes Field notes indexed by field name
 * @var array $errors Error messages to display (populated if form had errors)
 * @var bool $submitted This is TRUE when the form has been successfully submitted
 * @var string $successMessage The success message defined with the form (populated on success)
 *
 */
?>

<!-- Move styles below to document <head> for pages where this form will appear -->
<link rel='stylesheet' type='text/css' href='<?php echo $config->urls->root; ?>site/modules/FormBuilder/FormBuilder.css' />
<link rel='stylesheet' type='text/css' href='<?php echo $config->urls->root; ?>site/modules/FormBuilder/frameworks/basic/main.css' />
<style type='text/css'> /* Optional responsive adjustments for mobile - can be removed if not using 'Column Width' for fields */ @media only screen and (max-width:479px){.InputfieldFormWidths .Inputfield{clear:both !important;width:100% !important;margin-left:0 !important;margin-bottom:1em !important;} .Inputfield .InputfieldContent,.Inputfield .InputfieldHeader{padding-left:0 !important;padding-right:0 !important;float:none !important;width:100%;} .InputfieldFormWidths .Inputfield .InputfieldHeader{margin-bottom:0;}.InputfieldFormNoWidths .Inputfield .InputfieldHeader{text-align:initial;}}</style>

<!-- Move scripts below to document <head> or before </body> for pages where this form will appear -->
<script type="text/javascript">var _pwfb={ config:<?php echo json_encode(array_merge($config->js(),array("urls"=>array("root"=>$config->urls->root),"debug" => $config->debug)));?>};if(typeof ProcessWire=="undefined"){var ProcessWire=_pwfb;}else{for(var _pwfbkey in _pwfb.config) ProcessWire.config[_pwfbkey] = _pwfb.config[_pwfbkey];}if(typeof config=="undefined"){var config=ProcessWire.config;}_pwfb=null;</script>
<script src='<?php echo $config->urls->root; ?>wire/modules/Jquery/JqueryCore/jquery-1.11.1.js'></script>
<script src='<?php echo $config->urls->root; ?>wire/templates-admin/scripts/inputfields.min.js'></script>
<!-- This next script (form-builder-d.js) must go either in the document head or somewhere before the <form> -->
<script src='<?php echo $config->urls->FormBuilder; ?>form-builder-d.js'></script>

<?php if($submitted): /* When form submitted, show success message */ ?>

	<div id="FormBuilderSubmitted">
		<h3><?php echo $successMessage; ?></h3>
	</div>

<?php else: /* Render the form markup */ ?>
<!-- ProcessWire Form Builder - Copyright 2018 by Ryan Cramer Design, LLC -->
<form id="FormBuilder_specials_upload" class="FormBuilderFrameworkBasic FormBuilder InputfieldNoFocus InputfieldFormWidths InputfieldForm" name="specials_upload" method="post" action="./" data-colspacing="0">

	<?php 
	// output error messages
	if(count($errors)) {
		$form->getErrors(true); // reset
		foreach($errors as $error) {
			echo '<p class="error">' . $error . '</p>';
		}
	}
	?>

	<div class="Inputfields">
		<div class="Inputfield Inputfield_cap_id InputfieldInteger" id="wrap_Inputfield_cap_id">
			<label class="InputfieldHeader" for="Inputfield_cap_id">
				<?php echo $labels['cap_id']; ?><!-- CAP id -->
			</label>
			<div class="InputfieldContent">
				<p class="description"><?php echo $descriptions['cap_id']; ?></p>
				<input id="Inputfield_cap_id" name="cap_id" type="text" size="10" />
			</div>
		</div>
		<div class="Inputfield Inputfield_cap_code InputfieldText" id="wrap_Inputfield_cap_code">
			<label class="InputfieldHeader" for="Inputfield_cap_code">
				<?php echo $labels['cap_code']; ?><!-- CAP code -->
			</label>
			<div class="InputfieldContent">
				<input id="Inputfield_cap_code" name="cap_code" type="text" maxlength="2048" />
			</div>
		</div>
		<div class="Inputfield Inputfield_source InputfieldText" id="wrap_Inputfield_source">
			<label class="InputfieldHeader" for="Inputfield_source">
				<?php echo $labels['source']; ?><!-- Source -->
			</label>
			<div class="InputfieldContent">
				<input id="Inputfield_source" name="source" type="text" maxlength="2048" />
			</div>
		</div>
		<div class="Inputfield Inputfield_manufacturer InputfieldText" id="wrap_Inputfield_manufacturer">
			<label class="InputfieldHeader" for="Inputfield_manufacturer">
				<?php echo $labels['manufacturer']; ?><!-- Manufacturer -->
			</label>
			<div class="InputfieldContent">
				<input id="Inputfield_manufacturer" name="manufacturer" type="text" maxlength="2048" />
			</div>
		</div>
		<div class="Inputfield Inputfield_model InputfieldText" id="wrap_Inputfield_model">
			<label class="InputfieldHeader" for="Inputfield_model">
				<?php echo $labels['model']; ?><!-- Model -->
			</label>
			<div class="InputfieldContent">
				<input id="Inputfield_model" name="model" type="text" maxlength="2048" />
			</div>
		</div>
		<div class="Inputfield Inputfield_description_1 InputfieldText" id="wrap_Inputfield_description_1">
			<label class="InputfieldHeader" for="Inputfield_description_1">
				<?php echo $labels['description_1']; ?><!-- Description -->
			</label>
			<div class="InputfieldContent">
				<input id="Inputfield_description_1" name="description_1" type="text" maxlength="2048" />
			</div>
		</div>
		<div class="Inputfield Inputfield_term InputfieldText" id="wrap_Inputfield_term">
			<label class="InputfieldHeader" for="Inputfield_term">
				<?php echo $labels['term']; ?><!-- Term -->
			</label>
			<div class="InputfieldContent">
				<input id="Inputfield_term" name="term" type="text" maxlength="2048" placeholder="Needs to be in this form 24M 36M 48M etc" />
			</div>
		</div>
		<div class="Inputfield Inputfield_mileage InputfieldText" id="wrap_Inputfield_mileage">
			<label class="InputfieldHeader" for="Inputfield_mileage">
				<?php echo $labels['mileage']; ?><!-- Mileage -->
			</label>
			<div class="InputfieldContent">
				<input id="Inputfield_mileage" name="mileage" type="text" maxlength="2048" placeholder="Just the digits no apostrophes or symbols" />
			</div>
		</div>
		<div class="Inputfield Inputfield_vehicle_list_price InputfieldInteger" id="wrap_Inputfield_vehicle_list_price">
			<label class="InputfieldHeader" for="Inputfield_vehicle_list_price">
				<?php echo $labels['vehicle_list_price']; ?><!-- Vehicle List Price -->
			</label>
			<div class="InputfieldContent">
				<p class="description"><?php echo $descriptions['vehicle_list_price']; ?></p>
				<input id="Inputfield_vehicle_list_price" name="vehicle_list_price" type="text" size="10" />
			</div>
		</div>
		<div class="Inputfield Inputfield_vehicle_otr_price InputfieldInteger" id="wrap_Inputfield_vehicle_otr_price">
			<label class="InputfieldHeader" for="Inputfield_vehicle_otr_price">
				<?php echo $labels['vehicle_otr_price']; ?><!-- Vehicle OTR Price -->
			</label>
			<div class="InputfieldContent">
				<p class="description"><?php echo $descriptions['vehicle_otr_price']; ?></p>
				<input id="Inputfield_vehicle_otr_price" name="vehicle_otr_price" type="text" size="10" />
			</div>
		</div>
		<div class="Inputfield Inputfield_p11d_price InputfieldInteger" id="wrap_Inputfield_p11d_price">
			<label class="InputfieldHeader" for="Inputfield_p11d_price">
				<?php echo $labels['p11d_price']; ?><!-- P11D Price -->
			</label>
			<div class="InputfieldContent">
				<input id="Inputfield_p11d_price" name="p11d_price" type="text" size="10" />
			</div>
		</div>
		<div class="Inputfield Inputfield_co2 InputfieldInteger" id="wrap_Inputfield_co2">
			<label class="InputfieldHeader" for="Inputfield_co2">
				<?php echo $labels['co2']; ?><!-- CO2 -->
			</label>
			<div class="InputfieldContent">
				<input id="Inputfield_co2" name="co2" type="text" size="10" />
			</div>
		</div>
		<div class="Inputfield Inputfield_deal_notes InputfieldTextarea" id="wrap_Inputfield_deal_notes">
			<label class="InputfieldHeader" for="Inputfield_deal_notes">
				<?php echo $labels['deal_notes']; ?><!-- Deal Notes -->
			</label>
			<div class="InputfieldContent">
				<textarea id="Inputfield_deal_notes" name="deal_notes" maxlength="2048" placeholder="Only specific information relating to this deal" rows="5" data-maxlength="2048"></textarea>
			</div>
		</div>
		<div class="Inputfield Inputfield_specials_upload_submit InputfieldSubmit" id="wrap_specials_upload_submit">
			<div class="InputfieldContent">
				<button type="submit" name="specials_upload_submit" value="<?php echo $labels['specials_upload_submit']; ?><!-- Submit -->">
					<?php echo $labels['specials_upload_submit']; ?><!-- Submit -->
				</button>
			</div>
		</div>
	</div>
	<?php echo $session->CSRF->renderInput(); ?>
</form>

<?php 
if(count($values)) {
	// populate existing values to fields
	echo "<script>FormBuilderD.populate('$form->id', " . json_encode($values) . ");</script>";
}

endif;
?>