let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');

openShopping.addEventListener('click', () => {
  body.classList.add('active');
});

closeShopping.addEventListener('click', () => {
  body.classList.remove('active');
});

let products = [
  {
    id: 7,
    name: 'Chicken curry',
    image: '7chicken.jpg',
    price: 120
},
{
    id: 8,
    name: 'Mutton Curry',
    image: '8mutton.jpg',
    price: 120
},
{
    id: 9,
    name: 'Fish Plate',
    image: '9fish.jpg',
    price: 220
},
{
    id: 10,
    name: 'Prawns',
    image: '10prowns.jpg',
    price: 123
},
{
    id: 11,
    name: 'Egg curry',
    image: '11egg.jpg',
    price: 320
},
{
    id: 12,
    name: 'Tunde Kabab',
    image: '12kabab.jpg',
    price: 120
}
];

let listCards = [];

function initApp() {
  products.forEach((value, key) => {
    let newDiv = document.createElement('div');
    newDiv.classList.add('item');
    newDiv.innerHTML = `
      <img src="image/${value.image}">
      <div class="title">${value.name.toLocaleString()}</div>
      <div class="price">${value.price.toLocaleString()}</div>
      <button onclick="addToCard(${key})">Add To Card</button>`;
    list.appendChild(newDiv);
  });
}

initApp();

function addToCard(key) {
  if (listCards[key] == null) {
    listCards[key] = JSON.parse(JSON.stringify(products[key]));
    listCards[key].quantity = 1;
  }
  reloadCard();
}

function reloadCard() {
  listCard.innerHTML = '';
  let count = 0;
  let totalPrice = 0;
  listCards.forEach((value, key) => {
    totalPrice = totalPrice + value.price;
    count = count + value.quantity;
    if (value != null) {
      let newDiv = document.createElement('li');
      newDiv.innerHTML = `
        <div><img src="image/${value.image}"/></div>
        <div>${value.name}</div>
        <div>${value.price.toLocaleString()}</div>
        <div>
          <button onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
          <div class="count">${value.quantity}</div>
          <button onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
        </div>`;
      listCard.appendChild(newDiv);
    }
  });
  total.innerText = totalPrice.toLocaleString();
  quantity.innerText = count;
}

function changeQuantity(key, quantity) {
  if (quantity == 0) {
    delete listCards[key];
  } else {
    listCards[key].quantity = quantity;
    listCards[key].price = quantity * products[key].price;
  }
  reloadCard();
}

function saveToDatabase() {
  if (listCards.length === 0) {
    console.log('No items to save.');
    return;
  }

  const xhr = new XMLHttpRequest();
  const url = 'http://localhost/my_project1/connect1.php';

  const data = {
    items: listCards
  };

  const jsonData = JSON.stringify(data);

  xhr.open('POST', url, true);
  xhr.setRequestHeader('Content-type', 'application/json');

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log('Items saved successfully.');
    }
  };

  xhr.send(jsonData);
}

total.addEventListener('click', saveToDatabase);

