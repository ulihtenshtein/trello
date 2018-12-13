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
<!--
	<div class='row'>
		<div class='col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2'>
			<pre>
				<? print_r($this->card); ?>
			</pre>
		</div>
	</div>
-->
	
	<div class='row'>
		<div class='col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2'>
			<div class='trello-card'>
				<div class='trello-card-desc'>
					<?= $this->card['desc'];?>
				</div>
			</div>
		</div>
	</div>
	
	<div class='row'>
		<div class='col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2'>
			<div class='trello-card'>
				<h3>Комментарии</h3>
				<div class='trello-card-comment'>
					<ul class='trello-card-comments'>
						<? foreach ($this->cardComments as $comment): ?>
							<? if ($comment['type'] != 'commentCard') continue; ?>
							<li class="trello-card-comment">
									<span> <?= $comment['data']['text'] ;?></span>
									<span>(<? echo $comment['memberCreator']['fullName'] . " " . date_format(new DateTime($comment['date']), "d.m.Y, h:i:s" );?>)</span>
									<button class='btn btn-primary btn-xs trello-card-comment-del' data-comment-id="<?=$comment['id'];?>" data-card-id="<?=$this->card['id'];?>" >удалить</button>
							</li>
						<? endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<form class="form-horizontal" role='form'>
		<input type='hidden' name='trello-card-cardId' id='trello-card-cardId' value="<?=$this->cardId;?>" />
		<div class="form-group ">
			<div class='col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2'>
				<label class='control-label'>комментарий</label>
				<textarea class="form-control" id='trello-added-comment' name='trello-added-comment'></textarea>
			</div>
		</div>
	</form>
	<div class='row'>
		<div class='col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2' align='right'>
			<button id="trello-add-comment">Добавить комментарий</button>
		</div>
	</div>
	
	<div class='row btn-back'>
		<div class='col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2' align='right'>
			<a href="/boardlist?id=<?=$this->listId;?>" class='btn btn-default'>Назад</a>
		</div>
	</div>	
	
</div>

<?= $document->render("footer", $this) ?>
