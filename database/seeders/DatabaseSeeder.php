<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // php artisan migrate:fresh --seed //Line Para correr las seeds
    public function run(): void
    {

        $user1 = new User();
        $user1->name = 'Monkey D. Luffy';
        $user1->email = 'luffy@mugiwara.com';
        $user1->password = 'Se1036251514';
        $user1->company = 'Mugiwaras';
        $user1->save();
        //----------------------------------
        $user2 = new User();
        $user2->name = 'Roronoa Zoro';
        $user2->email = 'zoro@mugiwara.com';
        $user2->password = 'Se1036251514';
        $user2->company = 'Mugiwaras';
        $user2->save();
        //----------------------------------
        $user3 = new User();
        $user3->name = 'Nami';
        $user3->email = 'nami@mugiwara.com';
        $user3->password = 'Se1036251514';
        $user3->company = 'Mugiwaras';
        $user3->save();
        //----------------------------------
        $user4 = new User();
        $user4->name = 'Usopp';
        $user4->email = 'usopp@mugiwara.com';
        $user4->password = 'Se1036251514';
        $user4->company = 'Mugiwaras';
        $user4->save();
        //----------------------------------
        $user5 = new User();
        $user5->name = 'Sanji';
        $user5->email = 'sanji@mugiwara.com';
        $user5->password = 'Se1036251514';
        $user5->company = 'Mugiwaras';
        $user5->save();
        //----------------------------------
        $user6 = new User();
        $user6->name = 'Tony Tony Chopper';
        $user6->email = 'chopper@mugiwara.com';
        $user6->password = 'Se1036251514';
        $user6->company = 'Mugiwaras';
        $user6->save();
        //----------------------------------
        $user7 = new User();
        $user7->name = 'Nico Robin';
        $user7->email = 'robin@mugiwara.com';
        $user7->password = 'Se1036251514';
        $user7->company = 'Mugiwaras';
        $user7->save();
        //----------------------------------
        $user8 = new User();
        $user8->name = 'Brook';
        $user8->email = 'brook@mugiwara.com';
        $user8->password = 'Se1036251514';
        $user8->company = 'Mugiwaras';
        $user8->save();
        //----------------------------------     
        $user9 = new User();
        $user9->name = 'Jinbe';
        $user9->email = 'jinbe@mugiwara.com';
        $user9->password = 'Se1036251514';
        $user9->company = 'Mugiwaras';
        $user9->save();
        //----------------------------------        
        Task::factory(420)->create();
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Seeder Manualmente Registro por Registro
        // $task = new Task();
        // $task->title = 'Titulo...';
        // $task->description = 'Descripcion....';
        // $task->is_important = 0;
        // $task->save();



    }
}
