document.addEventListener('DOMContentLoaded', function() {
    const miniCartList = document.getElementById('miniCartList');
    const miniCartTotal = document.getElementById('miniCartTotal');
    const cartCount = document.getElementById('cart_toggle');

    function formatPrice(number) {
        return Number(number).toLocaleString('vi-VN');
    }

    function RenderMiniCart(cartItems, totalPrice) {
        miniCartList.innerHTML = ''; // Xóa cũ
        if(document.getElementById('cartCount'))
            cartCount.removeChild(document.getElementById('cartCount'));

        if (!cartItems || cartItems.length === 0) {
            miniCartList.innerHTML = `
                <div id="empty-cart" class="bg-white rounded-lg shadow-md p-6 mb-6 text-center hidden">
                    <div class="text-gray-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <p class="text-xl">Giỏ hàng của bạn đang trống</p>
                    </div>
                    <p class="text-gray-600 mb-6">Hãy tiếp tục mua sắm để tìm sách bạn yêu thích!</p>
                    <a href="index.html" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 inline-block">Tiếp tục mua sắm</a>
                </div>
            `;
            miniCartTotal.innerHTML = `
                <span>
                    Tổng tiền
                </span>
                <span class="text-red-500 font-bold text-xl">
                    0 đ
                </span>
            `;
            cartCount.insertAdjacentHTML('beforeend',`
                <span id="cartCount" class="count_holder">
                        <span class="count">0</span>
                </span>
            `);
            return;
        }

        let cartCountValue = 0;
        let html = '<ul class="mb-6 divide-y divide-gray-200 max-h-[369px] overflow-y-auto pr-2">';
        cartItems.forEach(item => {
            cartCountValue += 1;
            html += `
                <li class="flex py-6 cart-item border-b-1 border-gray-400" data-cart-item-id="1">
                    <div class="h-30 w-fit flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                        <img src="/images/books/${item.image}" alt="Tên sách 1" class="h-30 w-20 object-cover object-center">
                    </div>

                    <div class="ml-4 flex flex-1 flex-col">
                        <div>
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <h3>
                                    <a href="/books/${item.product_id}">${item.name}</a>
                                </h3>
                                <p class="ml-4 whitespace-nowrap text-[#06b6d4]">${formatPrice(item.sale_price)} đ</p> 
                            </div>
                            <p class="mt-1 text-sm text-gray-700">${item.author}</p>
                        </div>
                        <div class="cart-quantity flex mt-3 w-fit items-center rounded-full text-base border border-gray-300 overflow-hidden">
                            <button type="button" class="cart-decrement px-1.5 py-1 text-gray-600 hover:text-gray-700 hover:bg-gray-100 focus:outline-none">
                                -
                            </button>
                            <input type="text" data-cart-item-id="${item.id}" class="cart-numberInput w-16 text-center focus:outline-none border-none appearance-none" value="${item.quantity}"/>
                            <button type="button" class="cart-increment px-1.5 py-1 text-gray-600 hover:text-gray-700 hover:bg-gray-100 focus:outline-none">
                                +
                            </button>
                        </div>
                        <div class="">
                            <a href="/cart/remove/${item.id}" class="text-[#f39f09] text-base font-bold hover:text-red-600 duration-75">
                                Xóa sản phẩm
                            </a>
                        </div>
                    </div>                     
                </li>
            `;
        });
        html += '</ul>';
        miniCartList.innerHTML = html;

        miniCartTotal.innerHTML = `
            <span>
                Tổng tiền
            </span>
            <span class="text-red-500 font-bold text-xl">
                ${formatPrice(totalPrice)} đ
            </span>
        `;
        cartCount.insertAdjacentHTML('beforeend',`
            <span id="cartCount" class="count_holder">
                    <span class="count">${cartCountValue}</span>
            </span>
        `);
    }

    function addQuantityEvent(){
        const cartQuantity = document.querySelectorAll('.cart-quantity');
        cartQuantity.forEach(quantity => {

            const numberInput = quantity.querySelector('.cart-numberInput');
            const incrementButton = quantity.querySelector('.cart-increment');
            const decrementButton = quantity.querySelector('.cart-decrement');

            incrementButton.addEventListener('click', function() {
                let currentValue = parseInt(numberInput.value);
                numberInput.value = currentValue + 1;
                numberInput.dispatchEvent(new Event('change'));
            })

            decrementButton.addEventListener('click', function() {
                let currentValue = parseInt(numberInput.value);
                if (currentValue > 1) {
                    numberInput.value = currentValue - 1;
                }
                numberInput.dispatchEvent(new Event('change'));
            })

            numberInput.addEventListener('change', function() {
                const inputElement = this;
                const itemID = inputElement.dataset.cartItemId;
                let value = inputElement.value;
                // Remove non-numeric characters
                value = value.replace(/[^0-9]/g, '');
                // Ensure value is not less than 1
                if (parseInt(value) < 1 || value === '') {
                    value = '1';
                }
                inputElement.value = value;

                const url = `/cart/update`;
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        itemID: itemID,
                        quantity: value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Cập nhật giỏ hàng thành công:', data);

                    } else {
                        console.error('Lỗi cập nhật giỏ hàng');
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                });
                loadminiCart();
            })
        })
    }

    function loadminiCart() {
        const apiUrl = '/cart/read'

        fetch(apiUrl)
            .then(response => response.ok ? response.json() : Promise.reject(response))
            .then(data => {
                if (data.success) {
                    console.log(data.cartItems);
                    RenderMiniCart(data.cartItems, data.totalPrice);
                    addQuantityEvent();
                } else {
                   console.error("API Logic Error:", data.message);
                   
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                RenderMiniCart([]);
            })
    }

    loadminiCart();
});
