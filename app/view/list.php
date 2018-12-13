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
	
	<div class='trello-list-cards'>
		<? foreach ($this->cards as $card) : ?>
			<div class='row trello-card'>
				<div class='col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2'>
					<div class=''>
						<h3><a href="/card?id=<?=$card['id'];?>&listId=<?=$this->listId;?>"><?=$card['name'];?></a></h3>
						<div class='trello-card-desc'>
							<?= $card['desc'];?>
						</div>
						<div align='right'>
							<button class="btn btn-primary trello-list-card-del" data-card-id="<?=$card['id'];?>" >Удалить</button>
						</div>
					</div>
				</div>
			</div>
		<? endforeach; ?>
	</div>
	
	<form class="form-horizontal" role='form'>
		<input type='hidden' name='trello-list-listId' id='trello-list-listId' value="<?=$this->listId;?>" />
		<div class="form-group ">
			<div class='col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2'>
				<label class='control-label'>Название</label>
				<input class="form-control" id='trello-added-card-name' name='trello-added-card-name' value=''>
			</div>
		</div>
		<div class="form-group ">
			<div class='col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2'>
				<label class='control-label'>Описание</label>
				<textarea class="form-control" id='trello-added-card-desc' name='trello-added-card-desc'></textarea>
			</div>
		</div>
	</form>
	
	<div class='row'>
		<div class='col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2' align='right'>
			<button id="trello-add-card">Добавить карточку</button>
		</div>
	</div>
		
	<div class='row btn-back'>
		<div class='col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2' align='right'>
			<a href="/" class='btn btn-default'>Назад</a>
		</div>
	</div>	
	
</div>


<?= $document->render("footer", $this) ?>
