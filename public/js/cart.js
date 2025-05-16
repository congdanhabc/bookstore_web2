document.addEventListener('DOMContentLoaded', function() {
    const cartItemsContainer = document.getElementById('cart-items');
    const emptyCart = document.getElementById('empty-cart');
    const cartContainer = document.getElementById('cart-container');

    function formatPrice(number) {
        return Number(number).toLocaleString('vi-VN');
    }

    // Tính toán tổng tiền
    function calculateSubtotal() {
        return cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
    }
    // Tính phí vận chuyển
    function calculateShipping(totalPrice) {
        return (totalPrice < 300000) ? 30000 : 0;
    }
    // Cập nhật tổng tiền
    function updateTotals(totalPrice) {
        const shipping = calculateShipping(totalPrice);
        const total = totalPrice + shipping;

        document.getElementById('subtotal').textContent = formatPrice(totalPrice);

        const shippingElement = document.getElementById('shipping');
        const shippingNote = document.getElementById('shipping-note');

        if (shipping > 0) {
            shippingElement.textContent = formatPrice(shipping);
            shippingNote.classList.remove('hidden');
        } else {
            shippingElement.innerHTML = '<span class="text-green-600">Miễn phí</span>';
            shippingNote.classList.add('hidden');
        }

        document.getElementById('total').textContent = formatPrice(total);
    }

    function RenderCart(cartItems, totalPrice) {
        //Giỏ hàng trống
        if (!cartItems || cartItems.length === 0) {
            emptyCart.classList.remove('hidden');
            cartContainer.classList.add('hidden');
            return;
        }

        //Giỏ hàng có sản phẩm
        emptyCart.classList.add('hidden');
        cartContainer.classList.remove('hidden');
        // Xóa tất cả sản phẩm cũ
        cartItemsContainer.innerHTML = '';

        // Tạo HTML cho mỗi sản phẩm
        cartItems.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'p-4 flex flex-col sm:flex-row';
            itemElement.innerHTML = `
                <!-- Hình ảnh sản phẩm -->
                <div class="sm:w-24 h-24 flex-shrink-0 mr-4 mb-4 sm:mb-0">
                    <img src="/images/books/${item.image}" alt="${item.name}" class="w-full h-full object-cover rounded-md">
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-gray-800">${item.name}</h3>
                        <p class="text-gray-600">${item.author}</p>
                        <p class="text-blue-600 font-medium mt-1">${formatPrice(item.sale_price)}</p>
                    </div>

                    <!-- Số lượng và tổng tiền -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mt-4">
                        <div class="cart-quantity flex mt-3 w-fit items-center rounded-full text-base border border-gray-300 overflow-hidden">
                            <button type="button" class="cart-decrement px-1.5 py-1 text-gray-600 hover:text-gray-700 hover:bg-gray-100 focus:outline-none">
                                -
                            </button>
                            <input type="text" data-cart-item-id="${item.id}" class="cart-numberInput w-16 text-center focus:outline-none border-none appearance-none" value="${item.quantity}"/>
                            <button type="button" class="cart-increment px-1.5 py-1 text-gray-600 hover:text-gray-700 hover:bg-gray-100 focus:outline-none">
                                +
                            </button>
                        </div>

                        <div class="flex items-center justify-between w-full sm:w-auto">
                            <span class="font-medium text-gray-800 mr-4">
                                ${formatPrice(item.sale_price * item.quantity)}
                            </span>
                            <a href="/cart/remove/${item.id}" class="text-red-500 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            `;
            cartItemsContainer.appendChild(itemElement);
            });

        // Cập nhật tổng tiền
        updateTotals(totalPrice);
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
                loadCart();
            })
        })
    }

    function loadCart() {
        const apiUrl = '/cart/read'

        fetch(apiUrl)
            .then(response => response.ok ? response.json() : Promise.reject(response))
            .then(data => {
                if (data.success) {
                    console.log(data.cartItems);
                    RenderCart(data.cartItems, data.totalPrice);
                    addQuantityEvent();
                } else {
                   console.error("API Logic Error:", data.message);
                   
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                RenderCart([]);
            })
    }

    loadCart();
});
