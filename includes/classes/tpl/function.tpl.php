<?php
/*
* Developer: Matthew Donald Auld (Lycrios)
* File started: 9/7/2016 2:03:53 AM
* File: function.tpl.php
*/
global $document,$parameters;


$func = $document->getFunction($parameters["function"]);
?>
<div class="row">
	<div class="col-md-12">
		<h2><?=ucwords(preg_replace("/_/"," ",$func["name"])).(isset($func["short-desc"]) ? (" - ".$func["short-desc"]) : "" )?></h2>
		<p>
			<?=isset($func["description"]) ? $func["description"] : "&nbsp;" ?>
		</p>
	</div>
</div>
<?
$get_params = "";

if(count($func["parameters"]["get"]) > 0){
	foreach ($func["parameters"]["get"] as $key => $value) {
		$get_params .= "&amp;".$value["name"]."=[$value[name]]";
	}
}
?>
<div class="row">
	<div class="col-md-12">
		<?if(isset($func["parameters"]["get"]) && count($func["parameters"]["get"]) > 0){?>
		<span class="label label-success mb5">GET</span>
		<?}?>
		<?if(isset($func["parameters"]["post"]) && count($func["parameters"]["post"]) > 0){?>
		<span class="label label-primary mb5">POST</span>
		<?}?>
		<pre class="mt5 uri"><code><?=$document->base_url.$func["url"].$get_params?></code></pre>
	</div>
</div>
<?
if(isset($func["parameters"]["get"]) && count($func["parameters"]["get"]) > 0){
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">GET Parameters</h1>
			</div>
			<table class="table table-striped table-bordered">
				<tr>
					<th width="20%">Field</th>
					<th width="10%">Type</th>
					<th>Description</th>
				</tr>
			<?
			foreach ($func["parameters"]["get"] as $key => $value) {
			?>
				<tr<?=isset($value["deprecated"]) && $value["deprecated"] ? " class=\"deprecated\"" : ""?>>
					<td>
						<?=$value["name"]?>
						<?=isset($value["deprecated"]) && $value["deprecated"] ? "<b class=\"pull-right\">(deprecated)</b>" : ""?>
					</td>
					<td>
						<?=isset($value["type"]) ? parseTypes(ucwords($value["type"])) : "N/A"?>
					</td>
					<td>
						<?=isset($value["description"]) ? $document->parseCode($value["description"]) : "N/A"?>
					</td>
				</tr>
			<?
			}
			?>
			</table>
		</div>
	</div>
</div>
<?
}

if(isset($func["parameters"]["post"]) && count($func["parameters"]["post"]) > 0){
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">POST Parameters</h1>
			</div>
			<table class="table table-striped table-bordered">
				<tr>
					<th width="20%">Field</th>
					<th width="10%">Type</th>
					<th>Description</th>
				</tr>
			<?
			foreach ($func["parameters"]["post"] as $key => $value) {
			?>
				<tr<?=isset($value["deprecated"]) && $value["deprecated"] ? " class=\"deprecated\"" : ""?>>
					<td>
						<?=$value["name"]?>
						<?=isset($value["deprecated"]) && $value["deprecated"] ? "<b class=\"pull-right\">(deprecated)</b>" : ""?>
					</td>
					<td>
						<?=isset($value["type"]) ? parseTypes(ucwords($value["type"])) : "N/A"?>
					</td>
					<td>
						<?=isset($value["description"]) ? $document->parseCode($value["description"]) : "N/A"?>
					</td>
				</tr>
			<?
			}
			?>
			</table>
		</div>
	</div>
</div>
<?
}
if(isset($func["success"])){
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Success <?=isset($func["success"]["code"]) ? $func["success"]["code"] : "" ?></h1>
			</div>
			<table class="table table-striped table-bordered">
				<tr>
					<th width="20%">Field</th>
					<th width="10%">Type</th>
					<th>Description</th>
				</tr>
				<?
				if(isset($func["success"]["results"]) && count($func["success"]["results"]) > 0){
					foreach ($func["success"]["results"] as $key => $value) {
				?>
				<tr>
					<td>
						<?=$value["name"]?>
					</td>
					<td>
						<?=isset($value["example"]) ? getTypes($value["example"]) : "<i>N/A</i>"?>
					</td>
					<td>
						<?=isset($value["description"]) ? $document->parseCode($value["description"]) : "<i>N/A</i>"?>
					</td>
				</tr>
				<?
					}
				}
				?>
			</table>
		</div>
		<span class="label label-default">Success Response Example:</span>
		<pre class="mt5 uri"><code><?=$document->generateSuccessExample($func["name"])?></code></pre>
	</div>
</div>
<?
}
if(isset($func["failure"])){
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Failure <?=isset($func["failure"]["code"]) ? $func["failure"]["code"] : "" ?></h1>
			</div>
			<table class="table table-striped table-bordered">
				<tr>
					<th width="20%">Field</th>
					<th width="10%">Type</th>
					<th>Description</th>
				</tr>
				<?
				if(isset($func["failure"]["results"]) && count($func["failure"]["results"]) > 0){
					foreach ($func["failure"]["results"] as $key => $value) {
				?>
				<tr>
					<td>
						<?=$value["name"]?>
					</td>
					<td>
						<?=isset($value["example"]) ? getTypes($value["example"]) : "<i>N/A</i>"?>
					</td>
					<td>
						<?=isset($value["description"]) ? $document->parseCode($value["description"]) : "<i>N/A</i>"?>
					</td>
				</tr>
				<?
					}
				}
				?>
			</table>
		</div>
	</div>
</div>
<?
if(isset($func["failure"]["errors"])){
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Errors</h1>
			</div>
			<table class="table table-striped table-bordered">
				<tr>
					<th width="20%">Number</th>
					<th>Message</th>
				</tr>
				<?
				if(isset($func["failure"]["errors"]) && count($func["failure"]["errors"]) > 0){
					foreach ($func["failure"]["errors"] as $key => $value) {
				?>
				<tr>
					<td>
						<?=$value["code"]?>
					</td>
					<td>
						<?=isset($value["error"]) ? $document->parseCode($value["error"]) : "<i>N/A</i>"?>
					</td>
				</tr>
				<?
					}
				}
				?>
			</table>
		</div>
	</div>
</div>
<?
}
?>
<div class="row">
	<div class="col-md-12">
		<span class="label label-default">Failure Response Example:</span>
		<pre class="mt5 uri"><code><?=$document->generateFailureExample($func["name"])?></code></pre>
	</div>
</div>
<?
}
?>