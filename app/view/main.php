<?php
	$document = Document::getInstance();
	$document->render("header", $this) 
?>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
			<h1><?=$document->getTitle();?></h1>
		</div
	</div>
	
	<div class="row">
		<div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
			<div id="trello-board">
				<div class="">
					<?=$document->render('board', $this);?>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $document->render("footer", $this) ?>
