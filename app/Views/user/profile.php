<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thông tin tài khoản</title>
    </head>

    <body>
        <?php include APP_DIR . '/Views/layout/header.php';?>
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Hồ sơ Tài khoản</h1>

                <form action="#" method="POST">
                    <!-- Grid for Name Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1">Tên</label>
                            <input type="text" name="first-name" id="first-name" autocomplete="given-name" value= <?php echo htmlspecialchars($user->name); ?>
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900"
                                >
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ Email</label>
                        <input type="email" name="email" id="email" autocomplete="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900"
                            placeholder="ban@example.com" value= <?php echo htmlspecialchars($user->email); ?>
                            readonly disabled aria-describedby="email-description">
                    </div>

                    <!--- Phone Number -->
                    <div class="mb-6"> 
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                        <input type="tel" name="phone" id="phone" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" autocomplete="tel" value= <?php echo htmlspecialchars($user->phone); ?> >
                    </div>
                    
                    <!-- Address -->
                     <div class="mb-6">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ</label>
                        <input type="text" name="address" id="address" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" value="<?php echo htmlspecialchars($user->address); ?>" >
                    </div>


                    <!-- Profile Picture Placeholder (Actual upload needs more) -->
                    <!-- <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ảnh đại diện</label>
                        <div class="mt-1 flex items-center">
                            <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                            <button type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Thay đổi
                            </button>
                        </div>
                    </div> -->

                    <!-- Action Buttons -->
                    <div class="pt-6 border-t border-gray-200">
                        <div class="flex justify-start">
                            <button type="button" class="w-4 mx-[10px] bg-gray-50 text-black py-2 rounded-md shadow-sm">
                                Hủy bỏ
                            </button>
                            <button type="submit" class="w-4 bg-[#06b6d4] text-black py-2 rounded-md shadow-sm">
                                Lưu thay đổi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php include APP_DIR . '/Views/layout/footer.php'; ?>
    </body>
</html>