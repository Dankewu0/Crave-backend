<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        $shops = [
            [
                "name" => "Crave Central",
                "city" => "Москва",
                "address" => "ул. Кибернетиков, д. 404",
                "phone" => "+7 (495) 777-00-01",
                "work_time" => "10:00 - 22:00",
                "is_active" => true,
            ],
            [
                "name" => "Crave Север",
                "city" => "Санкт-Петербург",
                "address" => "пр. Неоновый, д. 77",
                "phone" => "+7 (812) 555-12-34",
                "work_time" => "10:00 - 21:00",
                "is_active" => true,
            ],
            [
                "name" => "Crave Сибирь",
                "city" => "Новосибирск",
                "address" => "ул. Квантовая, корп. 3",
                "phone" => "+7 (383) 222-33-44",
                "work_time" => "09:00 - 20:00",
                "is_active" => true,
            ],
            [
                "name" => "Crave Урал",
                "city" => "Екатеринбург",
                "address" => "ул. Стального Потока, д. 12",
                "phone" => "+7 (343) 999-88-77",
                "work_time" => "10:00 - 22:00",
                "is_active" => true,
            ],
            [
                "name" => "Crave Волга",
                "city" => "Казань",
                "address" => "ул. Цифровая Слобода, д. 5",
                "phone" => "+7 (843) 111-22-33",
                "work_time" => "10:00 - 22:00",
                "is_active" => true,
            ],
            [
                "name" => "Crave Юг",
                "city" => "Краснодар",
                "address" => "пер. Солнечных Панелей, д. 1",
                "phone" => "+7 (861) 444-55-66",
                "work_time" => "09:00 - 23:00",
                "is_active" => true,
            ],
            [
                "name" => "Crave Дальний Восток",
                "city" => "Владивосток",
                "address" => "Океанский тупик, д. 99",
                "phone" => "+7 (423) 777-88-99",
                "work_time" => "10:00 - 20:00",
                "is_active" => true,
            ],
            [
                "name" => "Crave Центр",
                "city" => "Нижний Новгород",
                "address" => "ул. Технологическая, д. 13",
                "phone" => "+7 (831) 333-44-55",
                "work_time" => "10:00 - 21:00",
                "is_active" => true,
            ],
            [
                "name" => "Crave Степь",
                "city" => "Омск",
                "address" => "пр. Процессоров, д. 256",
                "phone" => "+7 (3812) 66-77-88",
                "work_time" => "10:00 - 21:00",
                "is_active" => true,
            ],
            [
                "name" => "Crave Самара",
                "city" => "Самара",
                "address" => "ул. Виртуальная, д. 8",
                "phone" => "+7 (846) 555-44-33",
                "work_time" => "10:00 - 22:00",
                "is_active" => true,
            ],
        ];

        foreach ($shops as $shop) {
            Shop::create($shop);
        }
    }
}
