<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Collection;
use DB;
use Illuminate\Support\Facades\Auth;

class FakerComposer
{
    public function fakeUsers(): Collection
    {
        $username = Auth::user();

        if($username != null || $username != ''){
            $username = $username->username;
        }

        $users = collect(\DB::select(
            "select name, email, username from users where username = :username", ["username" => $username]
        )
        );

        return $users->map(function ($user) {
            return [
                'name' => $user->name,
                'username' => $user->username,
                'gender' => $user->name,
                'email' => $user->name
            ];
        });
    }

    public function fakePhotos(): Collection
    {
        $username = Auth::user();

        if($username != null || $username != ''){
            $username = $username->username;
        }

        $photos = [];
        if (file_exists(base_path('resources/images/fakers/'.$username.'.jpg'))) {
            $photos[] = 'resources/images/fakers/'.$username.'.jpg';
        }else{
            $photos[] = 'resources/images/fakers/user2.png';
        }
        //throw new \Exception('No Existe');
        //throw new \Exception($photos[0]);
        // for ($i = 0; $i < 15; $i++) {
        //     $photos[] = 'resources/images/fakers/profile-' . rand(1, 15) . '.jpg';
        // }
        
        return collect($photos)->random(1);
    }

    public function fakeImages(): Collection
    {
        $photos = [];
        for ($i = 0; $i < 15; $i++) {
            $photos[] = 'resources/images/fakers/preview-' . rand(1, 15) . '.jpg';
        }
        return collect($photos)->random(10);
    }

    public function fakeDates(): Collection
    {
        $dates = [];
        for ($i = 0; $i < 5; $i++) {
            $dates[] = date("j F Y", intval(mt_rand(1586584776897, 1672333200000) / 1000));
        }
        return collect($dates)->random(3);
    }

    public function fakeTimes(): Collection
    {
        $times = ['01:10 PM', '05:09 AM', '06:05 AM', '03:20 PM', '04:50 AM', '07:00 PM'];
        return collect($times)->random(3);
    }

    public function fakeFormattedTimes(): Collection
    {
        $times = collect([
            rand(10, 60) . ' seconds ago',
            rand(10, 60) . ' minutes ago',
            rand(10, 24) . ' hours ago',
            rand(10, 20) . ' days ago',
            rand(10, 12) . ' months ago'
        ]);

        return collect($times)->random(3);
    }

    public function fakeTotals(): Collection
    {
        return collect([
            rand(20, 220),
            rand(20, 120),
            rand(20, 50)
        ])->shuffle();
    }

    public function fakeTrueFalse(): Collection
    {
        return collect([0, 1, 1])->random(1);
    }

    public function fakeStocks(): Collection
    {
        return collect([
            rand(50, 220),
            rand(50, 120),
            rand(50, 50)
        ])->shuffle();
    }

    public function fakeProducts(): Collection
    {
        $products = collect([
            ['name' => 'Dell XPS 13', 'category' => 'PC & Laptop'],
            ['name' => 'Apple MacBook Pro 13', 'category' => 'PC & Laptop'],
            ['name' => 'Oppo Find X2 Pro', 'category' => 'Smartphone & Tablet'],
            ['name' => 'Samsung Galaxy S20 Ultra', 'category' => 'Smartphone & Tablet'],
            ['name' => 'Sony Master Series A9G', 'category' => 'Electronic'],
            ['name' => 'Samsung Q90 QLED TV', 'category' => 'Electronic'],
            ['name' => 'Nike Air Max 270', 'category' => 'Sport & Outdoor'],
            ['name' => 'Nike Tanjun', 'category' => 'Sport & Outdoor'],
            ['name' => 'Nikon Z6', 'category' => 'Photography'],
            ['name' => 'Sony A7 III', 'category' => 'Photography']
        ]);

        return $products->shuffle();
    }

    public function fakeCategories(): Collection
    {
        $categories = collect([
            ['name' => 'PC & Laptop', 'tags' => 'Apple, Asus, Lenovo, Dell, Acer'],
            ['name' => 'Smartphone & Tablet', 'tags' => 'Samsung, Apple, Huawei, Nokia, Sony'],
            ['name' => 'Electronic', 'tags' => 'Sony, LG, Toshiba, Hisense, Vizio'],
            ['name' => 'Home Appliance', 'tags' => 'Whirlpool, Amana, LG, Frigidaire, Samsung'],
            ['name' => 'Photography', 'tags' => 'Canon, Nikon, Sony, Fujifilm, Panasonic'],
            ['name' => 'Fashion & Make Up', 'tags' => 'Nike, Adidas, Zara, H&M, Levi’s'],
            ['name' => 'Kids & Baby', 'tags' => 'Mothercare, Gini & Jony, H&M, Babyhug, Liliput'],
            ['name' => 'Hobby', 'tags' => 'Bandai, Atomik R/C, Atlantis Models, Carisma'],
            ['name' => 'Sport & Outdoor', 'tags' => 'Nike, Adidas, Puma, Rebook, Under Armour'],
        ]);

        return $categories->shuffle()->map(function ($category) {
            return [
                'name' => $category['name'],
                'tags' => $category['tags'],
                'slug' => str_replace("&", "and", str_replace(" ", "-", strtolower($category['name']))),
            ];
        });
    }

    public function fakeNews(): Collection
    {
        $news = collect([
            [
                'title' => 'Desktop publishing software like Aldus PageMaker',
                'super_short_content' => substr('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, 30),
                'short_content' => substr('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, 150),
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'
            ],
            [
                'title' => 'Dummy text of the printing and typesetting industry',
                'super_short_content' => substr('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 0, 30),
                'short_content' => substr('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 0, 150),
                'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).'
            ],
            [
                'title' => 'Popularised in the 1960s with the release of Letraset',
                'super_short_content' => substr('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 0, 30),
                'short_content' => substr('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 0, 150),
                'content' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.'
            ],
            [
                'title' => '200 Latin words, combined with a handful of model sentences',
                'super_short_content' => substr('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 0, 50),
                'short_content' => substr('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 0, 150),
                'content' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.'
            ]
        ]);

        return $news->shuffle();
    }

    public function fakeFiles(): Collection
    {
        $files = collect([
            ['file_name' => 'Celine Dion - Ashes.mp4', 'type' => 'MP4', 'size' => '20 MB'],
            ['file_name' => 'Laravel 7', 'type' => 'Empty Folder', 'size' => '120 MB'],
            ['file_name' => $this->fakeImages()->first(), 'type' => 'Image', 'size' => '1.2 MB'],
            ['file_name' => 'Repository', 'type' => 'Folder', 'size' => '20 KB'],
            ['file_name' => 'Resources.txt', 'type' => 'TXT', 'size' => '2.2 MB'],
            ['file_name' => 'Routes.php', 'type' => 'PHP', 'size' => '1 KB'],
            ['file_name' => 'Dota 2', 'type' => 'Folder', 'size' => '112 GB'],
            ['file_name' => 'Documentation', 'type' => 'Empty Folder', 'size' => '4 MB'],
            ['file_name' => $this->fakeImages()->first(), 'type' => 'Image', 'size' => '1.4 MB'],
            ['file_name' => $this->fakeImages()->first(), 'type' => 'Image', 'size' => '1 MB']
        ]);

        return $files->shuffle();
    }

    public function fakeJobs(): Collection
    {
        $jobs = collect([
            'Frontend Engineer', 'Software Engineer', 'Backend Engineer', 'DevOps Engineer'
        ]);

        return $jobs->shuffle();
    }

    public function fakeNotificationCount(): int
    {
        return rand(1, 7);
    }

    public function fakeFoods(): Collection
    {
        $foods = collect([
            ['name' => 'Vanilla Latte', 'image' => 'resources/images/fakers/food-beverage-1.jpg'],
            ['name' => 'Milkshake', 'image' => 'resources/images/fakers/food-beverage-2.jpg'],
            ['name' => 'Soft Drink', 'image' => 'resources/images/fakers/food-beverage-3.jpg'],
            ['name' => 'Root Beer', 'image' => 'resources/images/fakers/food-beverage-4.jpg'],
            ['name' => 'Pocari', 'image' => 'resources/images/fakers/food-beverage-5.jpg'],
            ['name' => 'Ultimate Burger', 'image' => 'resources/images/fakers/food-beverage-6.jpg'],
            ['name' => 'Hotdog', 'image' => 'resources/images/fakers/food-beverage-7.jpg'],
            ['name' => 'Avocado Burger', 'image' => 'resources/images/fakers/food-beverage-8.jpg'],
            ['name' => 'Spaghetti Fettucine Aglio with Beef Bacon', 'image' => 'resources/images/fakers/food-beverage-9.jpg'],
            ['name' => 'Spaghetti Fettucine Aglio with Smoked Salmon', 'image' => 'resources/images/fakers/food-beverage-10.jpg'],
            ['name' => 'Curry Penne and Cheese', 'image' => 'resources/images/fakers/food-beverage-11.jpg'],
            ['name' => 'French Fries', 'image' => 'resources/images/fakers/food-beverage-12.jpg'],
            ['name' => 'Virginia Cheese Fries', 'image' => 'resources/images/fakers/food-beverage-13.jpg'],
            ['name' => 'Virginia Cheese Wedges', 'image' => 'resources/images/fakers/food-beverage-14.jpg'],
            ['name' => 'Fried/Grilled Banana', 'image' => 'resources/images/fakers/food-beverage-15.jpg'],
            ['name' => 'Crispy Mushroom', 'image' => 'resources/images/fakers/food-beverage-16.jpg'],
            ['name' => 'Fried Calamari', 'image' => 'resources/images/fakers/food-beverage-17.jpg'],
            ['name' => 'Chicken Wings', 'image' => 'resources/images/fakers/food-beverage-18.jpg'],
            ['name' => 'Snack Platter', 'image' => 'resources/images/fakers/food-beverage-19.jpg']
        ]);

        return $foods->shuffle();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view): void
    {
        $fakerData = [];
        for ($i = 0; $i < 20; $i++) {
            $fakerData[] = [
                'users' => $this->fakeUsers(),
                'photos' => $this->fakePhotos(),
                'images' => $this->fakeImages(),
                'dates' => $this->fakeDates(),
                'times' => $this->fakeTimes(),
                'formatted_times' => $this->fakeFormattedTimes(),
                'totals' => $this->fakeTotals(),
                'true_false' => $this->fakeTrueFalse(),
                'stocks' => $this->fakeStocks(),
                'products' => $this->fakeProducts(),
                'categories' => $this->fakeCategories(),
                'news' => $this->fakeNews(),
                'files' => $this->fakeFiles(),
                'jobs' => $this->fakeJobs(),
                'notification_count' => $this->fakeNotificationCount(),
                'foods' => $this->fakeFoods()
            ];
        }

        $view->with('fakers', $fakerData);
    }
}
