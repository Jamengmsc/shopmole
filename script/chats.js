   var form = document.querySelector(".typing_area form");
   // console.log(form);

   
   // Send chat message to selected user
   function sendChat(event){
      event.preventDefault();
      
      var form = document.querySelector(".typing_area form"),
      chatTxt = form.querySelector(".typing_area form .txt");

      xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function(){
         if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);

            chatTxt.value = "";
            chatTxt.focus();
         }
      }
      xhr.open("POST", "../partials/messages.php", true);
      // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      // Create a new form data object
      var formData = new FormData(form);
      xhr.send(formData);
   };