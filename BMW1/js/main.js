console.log("main js loaded");

// get needed elements
let theform = document.querySelector("form.comment-form");
let thecomment = document.querySelector(".comment-form textarea");
let hiddeninput = document.querySelector(".comment-form input");
let commentsdiv = document.querySelector(".comments");
let commentcard = document.querySelectorAll(".card");

// add event listener, prevent default submission and get
//textarea value

theform.addEventListener("submit", function(event) {
  event.preventDefault();
  let querystring = hiddeninput.value;
  let postid = querystring.split("=");
  let comment = thecomment.value;
  let theaction = "func/ajaxManager.php";
  console.log(comment);
  console.log(postid);
  commentAjax(comment, postid[1], theaction);
  theform.reset();
})

// commentcard.forEach((card, i) => {
//   card.addEventListener("click", function(e) {
//     e.preventDefault();
//     console.log("click");
//     if(e.target.classList.contains("delete-post")){
//       let comment_target = e.target;
//       let comment_id = e.target.getAttribute("comment-id");
//       console.log("delete:" + comment_id);
//       let par = e.target.closest(".comment-wrapper");
//       deleteCommentAjax(comment_id, par);
//
//     }
//   })
//
// });

// ajax request

function commentAjax(comment, postid, theaction) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", theaction, true);
  // to use the post method we must set the request headers
  // depending on the form data being sent
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function() {
    if(this.status == 200) {
      console.log(this.responseText);
      outputNewComment(JSON.parse(this.responseText));
    }
  }
  xhr.send("comment="+comment+"&post_id="+postid);
}



function outputNewComment(output, iscomment = true, parent = false) {
  let wrapperdiv = document.createElement('div');
  if(iscomment) {
    wrapperdiv.classList = "col-md-8 mt-2 mb-2 shrink comment-wrapper";
    let theoutput = `<div class="card"><div class="card-header">${output.username} | ${output.date_created} <button class='btn float-right btn-sm btn-outline-danger delete-post' data-comment-id='${output.comment_id}'>X</button></div>
    <div class="card-body"><p class="card-text">${output.comment_text}</p>
    </div></div>`;
    wrapperdiv.innerHTML = theoutput;
    commentsdiv.prepend(wrapperdiv);
    // theform.insertAdjacentHTML("afterend", output);
  } else {
    wrapperdiv.classList = "col-md-8 offset-md-1 mb-1 comment reply";
    let theoutput = `<div class="card"><div class="card-header" style="background:lightgrey">${output.username} | ${output.date_created} <button class='btn float-right btn-sm btn-outline-danger delete-post' data-comment-id='${output.comment_id}'>X</button></div>
    <div class="card-body"><p class="card-text">${output.comment_text}</p>
    </div></div>`;
    wrapperdiv.innerHTML = theoutput;
    parent.append(wrapperdiv);
  }
  console.log(wrapperdiv);
  setTimeout(function(){
    wrapperdiv.classList.remove("shrink");
  },10);

  setTimeout(function(){
    wrapperdiv.classList.add("grow");
  },20);
  setTimeout(function(){
    notification("New comment added", "success", "far fa-plus-square");
  },300);
}

function deleteCommentAjax(comment_id, parent_card) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "func/ajaxmanager.php", true);
  // to use the post method we must set the request headers
  // depending on the form data being sent
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function() {
    if(this.status == 200) {
      console.log(this);
      let result = JSON.parse(this.responseText)
      if(result == true) {
        parent_card.classList.add("shrinkStart");
        setTimeout(function(){
          parent_card.classList.add("shrinkFinish");
        },100);
        setTimeout(function(){
          parent_card.remove();
          notification("Comment successfully removed!", "success", "fas fa-check-circle");
        },400);
      } else {
        notification("Could not remove this comment!", "danger", "fas fa-times");
      }
    }
  }
  xhr.send("delete-comment=true&comment_id="+comment_id);
}

//Reply Comment
function replyCommentAjax(comment_id, reply_user_id, parent_card, comment_text, reply_form) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "func/ajaxManager.php", true);
  // to use the post method we must set the request headers
  // depending on the form data being sent
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function() {
    if(this.status == 200) {
      let result = JSON.parse(this.responseText);
      console.log(result.comment);
      if (result.comment.hasOwnProperty('CID')) {
        outputNewComment(result, false, parent_card);
        console.log(parent_card);
        reply_form.remove();
      } else {
        console.log("CID not found");
      }
    }
  }
  xhr.send("reply-comment=true&comment_id="+comment_id+"&reply_user_id="+reply_user_id+"&comment_text="+comment_text);
}

commentsdiv.addEventListener("click", function(e) {
  e.preventDefault();
  console.log("click");
  if(e.target.classList.contains("delete-post")){
    let comment_target = e.target;
    let comment_id = e.target.getAttribute("data-comment-id");
    console.log("delete:" + comment_id);
    let parent_card = e.target.closest(".comment-wrapper");
    deleteCommentAjax(comment_id, parent_card);
  } else if (e.target.classList.contains("reply-comment")) {
    let reply_target = e.target;
    console.log(reply_target);
    let comment_id = reply_target.getAttribute("data-comment-id");
    let reply_user_id = reply_target.getAttribute("data-comment-user-id");
    console.log("reply user id = " + reply_user_id);
    console.log("reply to:" + comment_id);
    let parent_card = e.target.closest(".comment");
    let formclone = theform.cloneNode(true);
    formclone.setAttribute("data-comment-id", comment_id);
    formclone.setAttribute("data-comment-user-id", reply_user_id);
    formclone.classList = "comment-form col-md-12 mt-2";
    parent_card.classList.add("active-reply");
    parent_card.append(formclone);
  } else if (e.target.classList.contains("comment-submit")) {
    console.log("submit clicked");
    let reply_target = e.target;
    console.log(reply_target);
    let reply_form = reply_target.closest("form")
    let comment_id = reply_form.getAttribute("data-comment-id");
    let reply_user_id = reply_form.getAttribute("data-comment-user-id");
    let comment_text = reply_form.querySelector("textarea").value;
    let parent_card = e.target.closest(".comment");
    parent_card.classList.remove("active-reply");
    replyCommentAjax(comment_id, reply_user_id, parent_card, comment_text, reply_form);
  } else if (e.target.classList.contains("thumb")) {
    let el = e.target;
    reviewPost(el)
  }

  console.log(e);
});

function reviewPost(el) {
  console.log(el);
  let parentcard = el.closest(".card");
  let comment_id = parentcard.querySelector(".reply-comment").getAttribute("data-comment-id");
  let review_value = el.getAttribute("data-review-value");
  let review_type = el.getAttribute("data-review-type");

  reviewAjax(comment_id, review_value, review_type, el);
}

function notification(msg, msgClass, icon = "") {
  let overlay = document.createElement("div");
  overlay.classList = "overlay";
  let notification = `<div class='alert alert-${msgClass}'><i class="${icon}"></i> ${msg}</div>`;
  overlay.innerHTML = notification;
  let body = document.querySelector("body");
  body.append(overlay);
  setTimeout(function() {
    overlay.style.opacity = "1";
  }, 10);
  setTimeout(function() {
    overlay.style.opacity = "0";
  }, 1500);
  setTimeout(function() {
    overlay.remove();
  }, 1800);
}
