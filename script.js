let cart = []; // 🛒 เก็บสินค้าในตะกร้า

// ➕ เพิ่มสินค้า
function addCart(name, price){
  cart.push({name, price});
  updateCart();
}

// 🔄 อัปเดตตะกร้า
function updateCart(){
  let count = document.getElementById("cartCount");
  let items = document.getElementById("cartItems");
  let totalBox = document.getElementById("totalPrice");

  count.innerText = cart.length;

  let html = "";
  let total = 0;

  cart.forEach(item=>{
    total += item.price;
    html += `<p>${item.name} - ${item.price} บาท</p>`;
  });

  items.innerHTML = html;
  totalBox.innerText = total;
}

// 🛒 เปิดตะกร้า
function openCart(){
  document.getElementById("cartModal").style.display = "block";
}

// ❌ ปิดตะกร้า
function closeCart(){
  document.getElementById("cartModal").style.display = "none";
}

// 💳 ไปหน้าชำระเงิน
function goToCheckout(){
  document.getElementById("cartModal").style.display = "none";
  document.getElementById("checkoutModal").style.display = "block";
}

// ❌ ปิดหน้าชำระเงิน
function closeCheckout(){
  document.getElementById("checkoutModal").style.display = "none";
}

// 📦 ยืนยันสั่งซื้อ + สร้างเลขพัสดุ
function confirmOrder(){

  let code = "PNSL" + Math.floor(Math.random()*999999);

  let order = {
    code: code,
    name: document.getElementById("name").value,
    address: document.getElementById("address").value,
    phone: document.getElementById("phone").value,
    items: cart,
    status: "กำลังเตรียมจัดส่ง"
  };

  localStorage.setItem("order_"+code, JSON.stringify(order));

  document.getElementById("trackingCode").innerText = code;

  alert("✅ สั่งซื้อสำเร็จ\nเลขพัสดุ: " + code);

  cart = [];
  updateCart();

  closeCheckout();
}

// 🔍 ค้นหาสินค้า
document.getElementById("search").addEventListener("input", function(){

  let value = this.value.toLowerCase();
  let products = document.querySelectorAll(".product");

  products.forEach(p=>{
    let name = p.querySelector("h3").innerText.toLowerCase();
    p.style.display = name.includes(value) ? "block" : "none";
  });

});

// 📂 หมวดหมู่
function filterCategory(cat){

  let products = document.querySelectorAll(".product");

  products.forEach(p=>{
    if(cat === "all"){
      p.style.display = "block";
    }else{
      p.style.display = (p.dataset.category === cat) ? "block" : "none";
    }
  });

}
