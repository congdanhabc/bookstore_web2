document.addEventListener('DOMContentLoaded', function() {
    // Lấy DOM elements...
    const homeProduct = document.getElementById('home-product');
    const paginationContainer = document.getElementById('pagination-container');
    const homeFilter = document.getElementById('home-filter');
    const categoryList = document.getElementById('category-list');
    const priceFilter = document.getElementById('price-filter');
    const searchInput = document.getElementById('search-input');
    const searchBtn = document.getElementById('search-btn');


    let currentFilters = {
        page: 1,
        category_id: ' ',
        sort: 'name',
        ascending: true,
        price_min: ' ',
        price_max: ' ',
        search: ''
    };

    function formatPrice(number) {
        return Number(number).toLocaleString('vi-VN');
    }

    function renderBooks(books) {
        homeProduct.innerHTML = ''; // Xóa cũ
        if (!books || books.length === 0) {
            homeProduct.innerHTML = '<p>Không tìm thấy sách.</p>';
            return;
        }
        // Tạo HTML mới từ mảng books và thêm vào homeProduct
        let html = '<div class="grid__row">';
        books.forEach(book => {
            const salePriceFormatted = formatPrice(book.sale_price);
            const priceFormatted = book.price && book.sale_price != book.price ? formatPrice(book.price) : '';

            html += `
                <div class="grid__column-2-2">
                    <div class="home-product-item">
                        <a href="/books/${book.id}">
                           <img class="image-2" src="/images/books/${book.image}" alt="${book.name}">
                        </a>
                        <div class="text-product">
                            <h1 class="text-product-1">${book.name}</h1>
                            <p class="text-product-2"><a href="#">${book.author}</a></p>
                        </div>
                        <div class="price-product">
                            <p class="price-product-1">${salePriceFormatted} đ</p>
                            ${priceFormatted ? `<p class="price-product-2">${priceFormatted} đ</p>` : ''}
                        </div>
                    </div>
                </div>
            `;
        });
        html += '</div>';
        homeProduct.innerHTML = html;
    }

    function renderPagination(pagination) {
        paginationContainer.innerHTML = ''; // Xóa cũ
        const maxVisiblePage = 5;
        if (!pagination || pagination.totalPages <= 1) return;

        const { currentPage, totalPages } = pagination;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePage / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePage - 1);
        if (endPage - startPage + 1 < maxVisiblePage) {
            startPage = Math.max(1, endPage - maxVisiblePage + 1);
        }

        let html = '<div class="pagination-1">';
        // Tạo nút Previous
        if (currentPage > 1) {
        html += `<a href="#" data-page="${currentPage - 1}">«</a>`;
        }
        for (let i = startPage; i <= endPage; i++) { 
             html += `<a href="#" data-page="${i}" class="${i === currentPage ? 'active' : ''}">${i}</a>`;
        }
        // Tạo nút Next
        if (currentPage < totalPages) {
        html += `<a href="#" data-page="${currentPage + 1}">»</a>`;
        }
        html += '</div>';
        paginationContainer.innerHTML = html;
    }

    function updateActiveFiltersUI() {
        // --- Cập nhật Danh mục ---
        categoryList.querySelectorAll('.category-list-btn').forEach(btn => {
            if (btn.dataset.categoryid === currentFilters.category_id) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });

        // --- Cập nhật Nút Sắp xếp ---
        homeFilter.querySelectorAll('.home-filter__btn').forEach(btn => {
            // So sánh data-sort của nút với currentFilters.sort
            if (btn.dataset.sort === currentFilters.sort) {
                // Có thể thêm nhiều class để thay đổi kiểu dáng
                btn.classList.add('active');
                btn.classList.remove('inactive');
            } else {
                btn.classList.add('inactive');
                btn.classList.remove('active');
            }
        });

        homeFilter.querySelectorAll('.filter-sort-btn').forEach(btn => {
            if (btn.dataset.sort === currentFilters.sort) {
                if (currentFilters.ascending) {
                    btn.classList.remove('sort-desc');
                    btn.classList.add('sort-asc');
                    btn.dataset.ascending = false;
                } else {
                    btn.classList.remove('sort-asc');
                    btn.classList.add('sort-desc');
                    btn.dataset.ascending = true;
                }
            } else {
                btn.classList.remove('sort-asc');
                btn.classList.remove('sort-desc');
                btn.dataset.ascending = true;
            }
        });
    
        // --- Cập nhật Bộ lọc Giá ---
        priceFilter.querySelectorAll('.select-input__link').forEach(link => {
            const min = link.dataset.price_min; 
            const max = link.dataset.price_max; 
            // So sánh cả min và max với giá trị trong currentFilters
            if (min === currentFilters.price_min && max === currentFilters.price_max) {
                link.classList.add('active');
                link.classList.remove('inactive');
            } else {
                link.classList.add('inactive');
                link.classList.remove('active');
            }
        });
    }

    // Trong hàm loadBooks(filters)
    function loadBooks(filters) {
        const params = new URLSearchParams(filters).toString();
        const apiUrl = `/books/ajax?${params}`; // URL MỚI trỏ đến route đã định nghĩa

        fetch(apiUrl)
            .then(response => response.ok ? response.json() : Promise.reject(response))
            .then(data => {
                if (data.success) {
                    updateActiveFiltersUI();
                    renderBooks(data.books);
                    renderPagination(data.pagination);
                } else {
                    console.error("API Logic Error:", data.message);
                    homeProduct.innerHTML = `<p>Lỗi: ${data.message || 'Không thể tải sách.'}</p>`;
                    paginationContainer.innerHTML = '';
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                homeProduct.innerHTML = '<p>Đã có lỗi xảy ra khi kết nối.</p>';
                paginationContainer.innerHTML = '';
            })
    }


    // --- Event Listeners (dùng delegation) ---
    // Ví dụ cho phân trang:
    paginationContainer.addEventListener('click', function(e) {
        if (e.target.tagName === 'A' && e.target.dataset.page && !e.target.classList.contains('active')) {
            e.preventDefault();
            currentFilters.page = parseInt(e.target.dataset.page);
            loadBooks(currentFilters);
        }
    });

    homeFilter.addEventListener('click', function(e) {
        const targetButton = e.target.closest('.home-filter__btn');
        if (targetButton) {
            currentFilters.sort = targetButton.dataset.sort;
            currentFilters.ascending = targetButton.dataset.ascending === 'true' ? true : false;
            loadBooks(currentFilters);
        }
    });

    categoryList.addEventListener('click', function(e) {
        const targetButton = e.target.closest('.category-list-btn');
        if (targetButton && !e.target.classList.contains('active')) {
            currentFilters.category_id = targetButton.dataset.categoryid;
            loadBooks(currentFilters);
        }
    });

    priceFilter.addEventListener('click', function(e) {
        const targetButton = e.target.closest('.select-input__link');
        if (targetButton && targetButton.classList.contains('inactive')) {
            e.preventDefault();
            currentFilters.price_min = targetButton.dataset.price_min;
            currentFilters.price_max = targetButton.dataset.price_max;
            loadBooks(currentFilters);
        }
    });

    searchBtn.addEventListener('click', function() {
        if(searchInput.value != currentFilters.search)
        {
            currentFilters.search = searchInput.value;
            loadBooks(currentFilters);
        }
    });


    // --- Initial Load ---
    loadBooks(currentFilters);

});