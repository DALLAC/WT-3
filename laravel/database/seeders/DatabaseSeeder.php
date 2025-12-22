<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Studio;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
            // Админ
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'password',   // захешируется автоматически (cast 'password' => 'hashed')
            'is_admin' => true,
        ]);

        // Обычный пользователь 1
        $user1 = User::create([
            'name' => 'User One',
            'username' => 'user1',
            'email' => 'user1@example.com',
            'password' => 'password',
            // is_admin по умолчанию false
        ]);

        // Обычный пользователь 2
        $user2 = User::create([
            'name' => 'User Two',
            'username' => 'user2',
            'email' => 'user2@example.com',
            'password' => 'password',
        ]);
        $studios = [
            [
                'title' => 'Rockstar Toronto',
                'location' => 'Канада',
                'user_id' => $user1->id,
                'image' => '/img/Rockstar_Toronto.png',
                'founded_at' => '1999-01-01',
                'short_description' => 'Наиболее известна разработкой игры The Warriors и портированием GTA на PC.',
                'description' => <<<HTML
Rockstar Toronto (ранее Rockstar Canada) — канадская студия-разработчик. Она наиболее известна разработкой игры <a href="#" class="popover-trigger" data-bs-toggle="popover" data-bs-trigger="focus" title="The Warriors (2005)" data-bs-content="Игра в жанре beat 'em up, основанная на одноименном фильме 1979 года.">The Warriors</a>, адаптацией культового фильма.
HTML,
            ],
            [
                'title' => 'Rockstar New England',
                'location' => 'New England',
                'user_id' => $user2->id,
                'image' => '/img/Rockstar_New_England.png',
                'founded_at' => '2008-04-04',
                'short_description' => 'Прежде известная как Mad Doc Software. Ответственна за Bully: Scholarship Edition.',
                'description' => <<<HTML
Rockstar New England, основанная как <a href="#" class="popover-trigger" data-bs-toggle="popover" data-bs-trigger="focus" title="Mad Doc Software" data-bs-content="Независимая студия, основанная в 1999 году.">Mad Doc Software</a>, присоединилась к семье Rockstar. Их ключевым вкладом стала работа над <a href="#" class="popover-trigger" data-bs-toggle="popover" data-bs-trigger="focus" title="Bully: Scholarship Edition" data-bs-content="Переиздание игры Bully.">Bully: Scholarship Edition</a>.
HTML,
            ],
            [
                'title' => 'Rockstar Lincoln',
                'location' => 'Lincoln',
                'user_id' => $user1->id,
                'image' => '/img/Rockstar_Lincoln.png',
                'founded_at' => '1997-01-01',
                'short_description' => 'Студия по локализации, ранее именовавшаяся Tarantula Studios.',
                'description' => <<<HTML
Rockstar Lincoln, ранее известная как <a href="#" class="popover-trigger" data-bs-toggle="popover" data-bs-trigger="focus" title="Tarantula Studios" data-bs-content="Британская студия.">Tarantula Studios</a>. Её основная роль — это <a href="#" class="popover-trigger" data-bs-toggle="popover" data-bs-trigger="focus" title="QA и Локализация" data-bs-content="QA — обеспечение качества.">обеспечение качества (QA) и локализация</a>.
HTML,
            ],
            [
                'title' => 'Rockstar North',
                'location' => 'North',
                'user_id' => $user2->id,
                'image' => '/img/Rockstar_North.png',
                'founded_at' => '2002-01-01',
                'short_description' => 'Флагманская студия. Известна по серии игр Grand Theft Auto и Manhunt.',
                'description' => <<<HTML
Rockstar North — флагманская студия, основанная как <a href="#" class="popover-trigger" data-bs-toggle="popover" data-bs-trigger="focus" title="DMA Design" data-bs-content="Легендарная студия.">DMA Design</a>. Она подарила миру серию <a href="#" class="popover-trigger" data-bs-toggle="popover" data-bs-trigger="focus" title="Grand Theft Auto (GTA)" data-bs-content="Серия игр, ставшая культурным феноменом.">Grand Theft Auto</a> и <a href="#" class="popover-trigger" data-bs-toggle="popover" data-bs-trigger="focus" title="Manhunt" data-bs-content="Стелс-хоррор.">Manhunt</a>.
HTML,
            ],
            [
                'title' => 'Rockstar San Diego',
                'location' => 'San Diego',
                'user_id' => $admin->id,
                'image' => '/img/Rockstar_San_Diego.png',
                'founded_at' => '2002-01-01',
                'short_description' => "Создатели движка RAGE и серии Midnight Club.",
                'description' => <<<HTML
Rockstar San Diego, изначально известная как <a href="#" class="popover-trigger" data-bs-toggle="popover" data-bs-trigger="focus" title="Angel Studios" data-bs-content="Студия известная гонками.">Angel Studios</a>. Она создала движок <a href="#" class="popover-trigger" data-bs-toggle="popover" data-bs-trigger="focus" title="RAGE" data-bs-content="Rockstar Advanced Game Engine.">RAGE</a> и серию <a href="#" class="popover-trigger" data-bs-toggle="popover" data-bs-trigger="focus" title="Midnight Club" data-bs-content="Аркадные гонки.">Midnight Club</a>.
HTML,
            ]
        ];

        foreach ($studios as $data) {
            Studio::create($data);
        }
    }
}