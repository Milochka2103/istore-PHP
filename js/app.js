var cart = {};

$('a.btn btn-primary').on('click', addToCart);

function addToCart(){
  var articul = $(this).attr('data-art');

  if (cart[articul] != undefined){
    cart[articul]++;
  }
  else{
    cart[articul] = 1;
  }

    document.getElementById('modal-basket').innerHTML= Object.values(cart);
    console.log(cart);
    showMiniCart();
}

function showMiniCart() {
    var out="";
    for (var key in cart) {
        out += key +' --- '+ cart[key]+'<br>';
    }
    $('#modal-basket').html(out);
}