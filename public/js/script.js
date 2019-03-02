moment.locale('zh-tw');

let $momentFormatList = document.querySelectorAll('.moment-format');
for (let $momentFormat of $momentFormatList) {
	$momentFormat.innerText = formatTimestamp($momentFormat.innerText);
}

let $postForm = document.querySelector('.post-form');
$postForm.addEventListener('submit', e => {
	e.preventDefault();
	ajax('/posts', new FormData($postForm), function(data) {
		// insert new post at the start of post list
		let $postList = document.querySelector('#post-list');
		$postList.insertAdjacentHTML('afterbegin', data);

		// add event listener to new post's comment form
		$commentForm = document.querySelector('#post-list .comment-form > form');
		$commentForm.addEventListener('submit', commentFormSubmitCallback);

		// format new post's timestamp with moment.js
		$momentFormat = document.querySelector('#post-list .moment-format');
		$momentFormat.innerText = formatTimestamp($momentFormat.innerText);

		// update post count
		$count = document.querySelector('#post-count');
		$count.innerText = parseInt($count.innerText) + 1 + ' 則留言';
	});

	// clear the post form
	$postForm.querySelector('input').value = '';
	$postForm.querySelector('textarea').value = '';
});

let $commentFormList = document.querySelectorAll('.comment-form > form');
for (let $commentForm of $commentFormList) {
	$commentForm.addEventListener('submit', commentFormSubmitCallback);
}


function commentFormSubmitCallback(e) {
	e.preventDefault();
	let $commentForm = e.target;
	let $commentList = e.target.parentNode.parentNode.querySelector('.comment-list');
	ajax('/comments', new FormData($commentForm), function(data) {
		// append new comment to the end of the comment list
		$commentList.insertAdjacentHTML('beforeend', data);

		// format new comment's timestamp with moment.js
		$momentFormat = $commentList.lastChild.querySelector('.moment-format');
		$momentFormat.innerText = formatTimestamp($momentFormat.innerText);
	});
	$commentForm.querySelector('input[type="text"]').value = '';
	$commentForm.querySelector('textarea').value = '';
}

function formatTimestamp(timestamp) {
	return moment.utc(timestamp).fromNow();
}

function ajax(url, data, callback) {
	var xhr = new XMLHttpRequest();

	xhr.open('POST', url, true);
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			if (callback) {
				callback(xhr.responseText);
			}
		}
	}
	xhr.send(data);
}
