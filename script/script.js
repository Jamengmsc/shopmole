// ********************* SCRIPT CODES ******************

let menu = document.querySelector('#menu-bar');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
   menu.classList.toggle("fa-times");
   navbar.classList.toggle("active");
}

$('.home-slick').slick({
   slidesToShow: 1,
   slidesToScroll: 2,
   dots: false,
   speed: 600,
   infinite: true,
});

$('.top-sells-slide').slick({
   slidesToShow: 6,
   slidesToScroll: 4,
   dots: false,
   speed: 600,
   infinite: true,
   prevArrow:'<i class="fas-fa-angle-left left_arrow">',
   nextArrow:'<i class="fas-fa-angle-right right_arrow">',
   responsive: [
      {
         breakpoint: 1200,
         settings: {
            slidesToShow: 5,
            slidesToScroll: 3,
         }
      },
      {
         breakpoint: 991,
         settings: {
            slidesToShow: 4,
            slidesToScroll: 2,
         }
      },
      {
         breakpoint: 768,
         settings: {
            slidesToShow: 3,
            slidesToScroll: 2,
         }
      },
      {
         breakpoint: 542,
         settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
         }
      },
      {
         breakpoint: 320,
         settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
         }
      },
   ],
 });

$('.recent-view-slide').slick({
   slidesToShow: 6,
   slidesToScroll: 2,
   dots: false,
   speed: 600,
   infinite: true,
   prevArrow:'<i class="fas-fa-arrow-left left_arrow">',
   nextArrow:'<i class="fas-fa-arrow-right right_arrow">',
   responsive: [
      {
         breakpoint: 1200,
         settings: {
            slidesToShow: 5,
            slidesToScroll: 3,
         }
      },
      {
         breakpoint: 991,
         settings: {
            slidesToShow: 4,
            slidesToScroll: 2,
         }
      },
      {
         breakpoint: 768,
         settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
         }
      },
      {
         breakpoint: 542,
         settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
         }
      },
      {
         breakpoint: 320,
         settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
         }
      },
   ],
 });


document.querySelector('#search-icon').onclick = () => {
   document.querySelector('#search-form').classList.toggle('active');
}

document.querySelector('#close').onclick = () => {
   document.querySelector('#search-form').classList.remove('active');
}

// display cart count if cart item > 0
var cartCount = document.querySelector('.nav-item .cart-count');
   if(cartCount.innerHTML == 0){
      // cartCount.innerHTML == 0;
      cartCount.style.display = "none";
   }

// Toggle user dropdown
window.addEventListener("mouseup", hideUserMenu);
var userAccount = document.querySelector('.user-account .account');
var userDropdown = document.querySelector('.user-dropdown');
var userSignIn = document.querySelector('.sign-in');

userAccount.onclick = () =>{
   userDropdown.classList.toggle('d-none');
   userAccount.classList.toggle("bg");
}

function hideUserMenu(ev) {
   if(ev.target !== userDropdown && ev.target.parentNode !== userDropdown) {
       userDropdown.classList.add("d-none");
   }
}

var inboxRead = document.querySelector(".inbox-unread");
 if(inboxRead.innerHTML == 0){
    inboxRead.style.display = "none";
}

