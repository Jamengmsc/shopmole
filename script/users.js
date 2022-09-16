setInterval(function() {
   var userList = document.querySelector(".users_list .users");
   var xhr = new XMLHttpRequest();
      xhr.onload = function(){
         if(this.status == 200){
            userList.innerHTML = this.responseText;
         }
      }
      xhr.open("GET", "../user/chat-users.php", true);
      xhr.send();
}, 500);