<?php
// actual_main.php
?>
<!-- Fixed Layout Wrapper -->
		<div class="fixed-wraper">
			<!-- Main Content -->
			<section role="main">
				<!-- Full Content Block -->
				<!-- Note that only 1st article need clearfix class for clearing -->
				<article class="full-block clearfix">
					
					<!-- Article Container for safe floating -->
					<div class="article-container">
						
						<!-- Article Content -->
						<section>
							<!-- Tab Content #tab0 -->
							<div class="tab default-tab" id="tab0">
								<table id="sort_table" cellpadding="0" cellspacing="0" border="0" class="display" summary="Adgroup performance" data-order="[[ 8, &quot;desc&quot; ]]">
									<thead>
										<tr>
											<?php
											if($level == "adg"){
												echo "<th></th>";
											}
											?>
											<th>status</th>
											<?php											
											if(!empty($ac)){
												echo "<th>acno</th>";
											}
											?>
											<th>prov</th>
											<th>cam</th>
											<?php
											if($level !== "cam"){
												echo "<th>adgroup</th>";
											}
											if($level == "kw"){
												echo "<th>keyword</th>";
											}
											?>
											<th>clicks</th>
											<?php
											if($level == "adg"){
												echo "<th class='sales_value'>sales<br/>no</th>";
											}
											else {
												echo "<th>sales<br/>no</th>";
											}
											?>
											<th>sales<br/>total</th>
											<th>comm</th>
											<th>ad<br/>cost</th>
											<th>profit</th>
											<th>profit<br/>/click</th>					
											<th>comm<br/>/click</th>
											<th>cost<br/>/click</th>
											<th>comm<br />/sale</th>
											<th>avg<br/>pos</th>
											<th>qs</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
							<!-- /Tab Content #tab0 -->
						</section>
					</div>
					<!-- /Article Container -->
				</article>
				<!-- /Full Content Block -->
			</section>
		</div>