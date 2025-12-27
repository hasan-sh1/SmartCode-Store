<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Service;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1) مستخدمو النظام (عربي)
        User::updateOrCreate(
            ['email' => 'admin@smartcode.store'],
            [
                'name' => 'مدير النظام',
                'email' => 'admin@smartcode.store',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@smartcode.store'],
            [
                'name' => 'مستخدم عادي',
                'email' => 'user@smartcode.store',
                'password' => Hash::make('password'),
            ]
        );

        // 2) فئات وتصنيفات فرعية ومنتجات (عربي)
        $categoriesData = [
            ['name' => 'إلكترونيات', 'slug' => 'electronics'],
            ['name' => 'أزياء',     'slug' => 'fashion'],
            ['name' => 'منزل ومطبخ','slug' => 'home-kitchen'],
            ['name' => 'رياضة',     'slug' => 'sports'],
            ['name' => 'عناية شخصية','slug' => 'personal-care'],
        ];

        $subcategoriesMap = [
            'electronics' => [
                ['name' => 'هواتف',     'slug' => 'phones'],
                ['name' => 'أجهزة لابتوب','slug' => 'laptops'],
                ['name' => 'إكسسوارات',  'slug' => 'accessories'],
            ],
            'fashion' => [
                ['name' => 'رجالي', 'slug' => 'men'],
                ['name' => 'نسائي', 'slug' => 'women'],
                ['name' => 'أطفال', 'slug' => 'kids'],
            ],
            'home-kitchen' => [
                ['name' => 'أدوات مطبخ','slug' => 'kitchen-tools'],
                ['name' => 'ديكور',     'slug' => 'decor'],
                ['name' => 'تنظيم المنزل','slug' => 'home-organizing'],
            ],
            'sports' => [
                ['name' => 'معدات', 'slug' => 'equipment'],
                ['name' => 'ملابس رياضية','slug' => 'sportswear'],
                ['name' => 'إكسسوارات رياضية','slug' => 'sports-accessories'],
            ],
            'personal-care' => [
                ['name' => 'عناية بالبشرة','slug' => 'skincare'],
                ['name' => 'عناية بالشعر','slug' => 'haircare'],
                ['name' => 'عطور',        'slug' => 'perfumes'],
            ],
        ];

        $createdCategories = [];
        foreach ($categoriesData as $cat) {
            $category = Category::updateOrCreate(
                ['slug' => $cat['slug']],
                ['name' => $cat['name'], 'slug' => $cat['slug']]
            );
            $createdCategories[$cat['slug']] = $category;

            foreach ($subcategoriesMap[$cat['slug']] as $sub) {
                Subcategory::updateOrCreate(
                    ['slug' => $sub['slug'], 'category_id' => $category->id],
                    [
                        'name' => $sub['name'],
                        'slug' => $sub['slug'],
                        'category_id' => $category->id,
                    ]
                );
            }
        }

        // 3) منتجات عربية لكل تصنيف
        $arabicProducts = [
            ['name' => 'هاتف ذكي متطور', 'description' => 'شاشة AMOLED وكاميرا عالية الدقة، أداء ممتاز.', 'price' => 1999.00, 'category' => 'electronics', 'subcategory' => 'phones'],
            ['name' => 'لابتوب للأعمال', 'description' => 'معالج قوي وذاكرة كبيرة لتعدد المهام.', 'price' => 3499.00, 'category' => 'electronics', 'subcategory' => 'laptops'],
            ['name' => 'سماعات لاسلكية',  'description' => 'صوت نقي وعزل ضوضاء، بطارية طويلة.', 'price' => 399.00,  'category' => 'electronics', 'subcategory' => 'accessories'],

            ['name' => 'قميص رجالي قطن', 'description' => 'قماش مريح ومظهر أنيق.', 'price' => 149.00, 'category' => 'fashion', 'subcategory' => 'men'],
            ['name' => 'فستان نسائي أنيق','description' => 'تصميم عصري وخامة فاخرة.', 'price' => 299.00, 'category' => 'fashion', 'subcategory' => 'women'],
            ['name' => 'تيشيرت أطفال',    'description' => 'طبعات جميلة وخامة ناعمة.', 'price' => 79.00,  'category' => 'fashion', 'subcategory' => 'kids'],

            ['name' => 'طقم أدوات مطبخ',  'description' => 'مجموعة كاملة لأعمال الطبخ.', 'price' => 199.00, 'category' => 'home-kitchen', 'subcategory' => 'kitchen-tools'],
            ['name' => 'مزهرية ديكور',    'description' => 'لمسة جمالية في المنزل.', 'price' => 99.00,  'category' => 'home-kitchen', 'subcategory' => 'decor'],
            ['name' => 'منظم خزانة',      'description' => 'ترتيب أفضل ومساحة أكبر.', 'price' => 59.00,  'category' => 'home-kitchen', 'subcategory' => 'home-organizing'],

            ['name' => 'دمبل رياضي',      'description' => 'بناء العضلات في البيت.', 'price' => 129.00, 'category' => 'sports', 'subcategory' => 'equipment'],
            ['name' => 'بنطال رياضي',     'description' => 'خامة مريحة للتمارين.', 'price' => 99.00,  'category' => 'sports', 'subcategory' => 'sportswear'],
            ['name' => 'حقيبة رياضية',    'description' => 'متينة وخفيفة.', 'price' => 89.00,  'category' => 'sports', 'subcategory' => 'sports-accessories'],

            ['name' => 'مرطب بشرة',       'description' => 'نعومة وترطيب عميق.', 'price' => 79.00,  'category' => 'personal-care', 'subcategory' => 'skincare'],
            ['name' => 'زيت شعر مغذي',    'description' => 'تقوية ولمعان.', 'price' => 59.00,  'category' => 'personal-care', 'subcategory' => 'haircare'],
            ['name' => 'عطر شرقي',        'description' => 'رائحة فاخرة وثابتة.', 'price' => 249.00, 'category' => 'personal-care', 'subcategory' => 'perfumes'],
        ];

               foreach ($arabicProducts as $item) {
            $category = $createdCategories[$item['category']] ?? null;
            $subcategory = Subcategory::where('slug', $item['subcategory'])
                ->where('category_id', optional($category)->id)->first();

            $slug = Str::slug($item['name']);
            if (!$slug) {
                $slug = 'product-' . Str::random(8); // احتياط إذا فشل تحويل الاسم العربي
            }

            Product::updateOrCreate(
                ['slug' => $slug], // المفتاح الفريد
                [
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'stock' => rand(5, 30),
                    'image_path' => 'https://picsum.photos/seed/' . $slug . '/600/400',
                    'category_id' => optional($category)->id,
                    'subcategory_id' => optional($subcategory)->id,
                ]
            );
        }

        // 4) خدمات (مصادر كود) عربية مبسطة
        for ($i = 1; $i <= 8; $i++) {
            Service::updateOrCreate(
                ['slug' => 'service-' . $i],
                [
                    'title' => 'خدمة رقم ' . $i,
                    'slug' => 'service-' . $i,
                    'description' => 'وصف قصير للخدمة رقم ' . $i,
                    'price' => rand(50, 500),
                ]
            );
        }

        // 5) طلب تجريبي عربي
        $user = User::where('email', 'user@smartcode.store')->first();
        if ($user) {
            Order::updateOrCreate(
                ['user_id' => $user->id, 'status' => 'processing'],
                [
                    'total' => 499.00,
                    'status' => 'processing',
                    'shipping_address' => 'عنوان تجريبي، المدينة',
                ]
            );
        }
                // إنشاء الأدوار والأذونات
        $this->call(RoleSeeder::class);

        // إسناد الأدوار للمستخدمين
        $admin = User::where('email', 'admin@smartcode.store')->first();
        $user  = User::where('email', 'user@smartcode.store')->first();

        if ($admin) { $admin->assignRole('admin'); }
        if ($user)  { $user->assignRole('user'); }
    }
}