// Display chat window between users
function chatUser(event, recID, senderID){
   event.preventDefault();

   var chatWindow = document.querySelector(".chat_area");
   var chatUsers = document.querySelector(".chat_users");
   chatWindow.style.display = "block";
   chatUsers.style.bottom = "-500px";
   chatWindow.style.bottom = "10px";
   chatWindow.style.transition = "all .3s linear";
   chatUsers.style.transition = "all .3s linear";

   // Create a server request................
   var xhr = new XMLHttpRequest();
   xhr.onload = function(){
      if(this.status == 200){
         // console.log(this.responseText);
         document.querySelector(".chat_area").innerHTML = this.responseText;
      }
   }
   xhr.open("GET", "../customer/chat-area.php?q="+recID+"&r="+senderID, true);
   xhr.send();



   // Get chats
   setInterval(function() {
      var chatMsg = document.querySelector(".chat_body");
      var xhr = new XMLHttpRequest();
         xhr.open("GET", "../user/get-chats.php?q="+recID+"&r="+senderID, true);
         xhr.onload = function(){
            if(this.status == 200){
               chatMsg.innerHTML = this.responseText;
            }
         }
         xhr.send();
   }, 500);
}