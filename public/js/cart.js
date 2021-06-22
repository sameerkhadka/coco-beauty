


if(document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready();
}

function ready() {
    var cartDelete = document.querySelectorAll('.cart-del');
    for(var i=0; i < cartDelete.length; i++) {
        var delBtn = cartDelete[i];
        delBtn.addEventListener('click', removeCartBtn)
    }

    var quantityInputs = document.querySelectorAll('.qty-value');
    for(var i=0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i];
        // input.addEventListener('change', quantitychanged);
    }

    var addToCart = document.querySelectorAll('.add-to-cart');
    for(var i=0; i < addToCart.length; i++) {
        var button = addToCart[i];

        button.addEventListener('click', addToCartClicked)
    }
}

function addToCartClicked(event) {
    var button = event.target;
    var shopItem = button.parentElement;

    var title = shopItem.querySelector('.service-name').innerText;
    var type = shopItem.querySelector('.service-type').innerText;
    var price = shopItem.querySelector('.service-price').innerText

    addItemToCart(title, type, price);
    // updateCartTotal();
}

function addItemToCart(title, type, price) {
    var cartRow = document.createElement('div');
    cartRow.classList.add("cart-sing");
    var cartItems = document.querySelector('.cart-wrap');




    var cartRowContents = `
 
        <div class="cart-ser-des">
            <h5>${title}</h5>
            <p>${type} </p>
            <h6 class="cart-price">${price}</h6>
        </div>

        <div class="cart-qty">
            <input type="number" class="qty-value" value="1">
        </div>

        <div class="cart-qty">
            <h6>60 </h6>
        </div>
        

        <div class="cart-rem">
            <button class="cart-del"><i class="fas fa-times"></i></button>
        </div>

    `;

    cartRow.innerHTML = cartRowContents;
    cartItems.append(cartRow);
    cartRow.querySelector('.cart-del').addEventListener('click',removeCartBtn);
    // cartRow.querySelector('.qty-value').addEventListener('change',quantitychanged);
}

// function quantitychanged(event) {
//     var input = event.target;
//     if (isNaN(input.value) || input.value <=0 ) {
//         input.value = 1;
//     }
//     updateCartTotal();
// }

function removeCartBtn(event) {
    var delBtnClicked = event.target;
    delBtnClicked.parentElement.parentElement.parentElement.remove();
    // updateCartTotal();
}


// function updateCartTotal() {
//     var cartItemContainer = document.querySelector(".cart-wrap");
//     var cartItems = cartItemContainer.querySelectorAll('.cart-sing');
//     var total = 0;
//     for(var i=0; i < cartItems.length; i++) {
//         cartItem = cartItems[i];
//         var priceItem  = cartItem.querySelector('.cart-price');
//         var qtyItem = cartItem.querySelector('.qty-value');
//         var price = parseFloat(priceItem.innerHTML.replace('$',''));
//         var quantity = qtyItem.value;
//         total = total + (price * quantity);
//     }

//     total = Math.round(total * 100) / 100;
//     document.querySelector('.cart-total-price').innerText = '$' + total;
// }













