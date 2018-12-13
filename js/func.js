$(document).ready(function()
{
	Auth.key = '1811d64047505714232f8c94679a96ae';
	Auth.token = '62d37398f8d7b2ddcdc625a4cde3cf4fa7b4958cd12a29ca83587d0e5e1366ae';
	
	$("#trello-get-all-boards").on('click', function()
	{
			Trello.members.get("me", function(member)
			{
				
		        $("#fullName").text(member.fullName);
		        
		        $.each(member.idBoards, function(ix, board)
		        {
					showBoard(board);
					
				});
			});
	});
	
	$("#trello-add-comment").on('click', function()
	{
		var comment = $("#trello-added-comment");
		var cardId = $("#trello-card-cardId");
		
		if (comment.val() != '')
		{
			addComment(cardId.val(), comment.val());
		}
		comment.val('');
		
	});
	
	$("#trello-add-card").on('click', function()
	{
		var listId = $("#trello-list-listId");
		var name = $("#trello-added-card-name");
		var desc = $("#trello-added-card-desc");
		//~ alert("list id:" + listId.val() + ", name: " + name.val() + " , desc: " + desc.val());
		if ( name.val() != '')
		{
			addCard({
				"name"   : name.val(),
				"desc"   : desc.val(),
				"idList" : listId.val() 
			});
		}
		name.val('');
		desc.val('');
	});
	
	$(".trello-card-comment-del").on('click', function()
	{
		var commentId = this.dataset.commentId;
		var cardId = this.dataset.cardId;
		
		deleteComment(cardId,commentId, $(this).parent());
	});
	
	$(".trello-list-card-del").on('click', function()
	{
		var cardId = this.dataset.cardId;
		deleteCard(cardId, $(this).closest(".trello-card"));
	});
});

function Auth(){};

function showLists(data)
{
	var ul = $("<ul></ul>");
	$.each(data, function(ix, list)
	{
		var a = $("<a></a>");
		a.attr('href',"/boardlist?id=" + list.id);
		a.text(list.name);
		$('<li></li>').append(a).appendTo(ul);
		Trello.lists.get(list.id + '/cards/', function(data)
		{
			showCards(list.name, data);
		});
	});
	$("#board-lists").append(ul);
}

function showCards(listName, data)
{
	var ul = $("<ul></ul>");
	
	$.each (data, function(ix, card)
	{
		ul.append('<li>' + card.name + '</li>');
	});
	
	var cards  = $("<div></div>").text(listName);
	$("#list-cards").append(cards).append(ul);
}

function showBoard(id)
{
	var boards = $("#boards-id");
	var ul = $("<ul></ul>");
	Trello.boards.get(id, function(data)
	{
		ul.append("<li>naem: " + data.name + ", id: " + id + "</li>");
	});
					
	boards.append(ul);
					
	Trello.boards.get(id + '/lists/', function(data)
	{
		showLists(data);
	});
}

function addComment(id, comment)
{
	var formatter = new Intl.DateTimeFormat("ru", {
		year   :"numeric",
		month  :"numeric",
		day    :"numeric",
		hour   :"numeric",
		minute :"numeric",
		second :"numeric"
	});
	
	var param = $.param({
		"text" :comment
		//"key"  :Auth.key,
		//"token":Auth.token
		});
	Trello.post('/cards/' + id + '/actions/comments?' + param, function(data)
	{
		//~ console.log('success');
		//~ console.dir(data);
		$(".trello-card-comments").prepend("<li class='trello-card-comment'><span>" + data.data.text + "</span><span>(" + data.memberCreator.fullName + " " + formatter.format(new Date(data.date)) + ")</span><button class='btn btn-primary btn-xs trello-card-comment-del' data-comment-id='" + data.id + "' data-card-id='" + id + "'>удалить</button></li>");
	},
	function(data)
	{
		console.log('error');
		//~ console.dir(data);
		//~ console.log(data.responseText);
	});
}

function addCard(data)
{
	var param = $.param(data);
	
	Trello.post('/cards?' + param, function(data)
	{
		//~ console.log('success');
		//~ console.dir(data);
		id = data.id;
		name = data.name;
		desc = data.desc;
		
		template = "<div class='row'>\
						<div class='col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2'>\
							<div class='trello-card'>\
								<h3><a href='/card?id=" + id + "'>" + name + "</a></h3>\
								<div class='trello-card-desc'>\
									" + desc + "\
								</div>\
								<div align='right'>\
									<button class='btn btn-primary trello-list-card-del' data-card-id='" + id + "' >Удалить</button>\
								</div>\
							</div>\
						</div>\
					</div>";
		$(".trello-list-cards").append(template);
		
	},
	function(data)
	{
		console.log('error');
		console.dir(data);
	});
	
}

function deleteComment(cardId, commentId, parent)
{
	Trello.delete('/cards/' + cardId + '/actions/' + commentId + '/comments', function(data)
	{
		//~ console.dir(data);
		parent.remove();
	}); 
}

function deleteCard(cardId, parent)
{
	Trello.delete('/cards/' + cardId, function(data)
	{
		parent.remove();
	});
}
