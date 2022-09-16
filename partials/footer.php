</div>

<!-- Footer section starts -->
<section class="footer">
   <div class="box-container">
      <div class="box">
         <h3>locations</h3>
         <a href="#">nigeria</a>
         <a href="#">united states of america</a>
         <a href="#">china</a>
         <a href="#">south korea</a>
         <a href="#">japan</a>
      </div>

      <div class="box">
         <h3>quick links</h3>
         <a href="#">home</a>
         <a href="#">dishes</a>
         <a href="#">about</a>
         <a href="#">menu</a>
         <a href="#">review</a>
         <a href="#">order</a>
      </div>

      <div class="box">
         <h3>contact information</h3>
         <a href="#">+2348171668988</a>
         <a href="#">+2349060277675</a>
         <a href="#">jamengmsc@gmail.com</a>
         <a href="#">www.quatrainsolution.com</a>
         <a href="#">6, obazur street, gbagada, lagos</a>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#">facebook</a>
         <a href="#">twitter</a>
         <a href="#">instagram</a>
         <a href="#">linkedIn</a>
      </div>
   </div>

   <div class="credit">copyright @ 2021 by <span>concept wed designer</span></div>
</section>
<!-- Footer section ends -->




<!-- Slick JS link -->
<script src="../script/slick.min.js"></script>
<script src="../script/script.js"></script>
<script src="../script/users.js"></script>
<script src="../script/chats.js"></script>
<script src="../script/chat-wall.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>


<script>
   document.querySelector(".open_chat").onclick = () =>{
      var chatUsers = document.querySelector(".chat_users");
      document.querySelector(".open_chat").style.bottom = "-40px";
      chatUsers.style.display = "block";
      chatUsers.style.transition = "all .3s linear";
      chatUsers.style.bottom = "10px";
   };

   document.getElementById("close_users_chat").onclick = () =>{
      var chatArea = document.querySelector(".chat_users");
      document.querySelector(".open_chat").style.transition = "all .3s linear";
      document.querySelector(".open_chat").style.bottom = "10px";
      chatArea.style.transition = "all .3s linear";
      chatArea.style.bottom = "-510px";
   };

   function closeChat(){
      document.querySelector(".chat_area").style.bottom = "-510px";
      document.querySelector(".chat_users").style.transition = "all .3s linear";
      document.querySelector(".chat_users").style.bottom = "10px";
      // chatArea.style.transition = "all .3s linear";
   };


   // Search Users to chat with
   function searchUser(event){
      event.preventDefault();
      
      var searchUser = document.querySelector(".chat_users .header form input");
      var xhr = new XMLHttpRequest();
      xhr.onload = function(){
         if(this.status == 200){
            // console.log(this.responseText);
            document.querySelector(".users_list .users").innerHTML = this.responseText;

            searchUser.value = "";
            searchUser.focus();
         }
      }
      xhr.open("GET", "search-chat-user.php?q="+searchUser.value, true);
      xhr.send();
   }
   

   // Popular products from product-search.php in user folder
   var popular = document.querySelector("#popular");
      popular.onclick = function(){
         var popularDropDown = document.querySelector(".popularity_dropdown");
         var popularIcon = document.querySelector("#popular i");
         popularIcon.classList.toggle("fa-chevron-up");
         popularDropDown.classList.toggle("d-none");
      }
   
   
</script>