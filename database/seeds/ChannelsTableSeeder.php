<?php

use App\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([

            'name' => 'Laravel',
            'slug' =>'Laravel',
        ]);

        Channel::create([

            'name' => 'PHP',
            'slug' =>'PHP',
        ]);


        Channel::create([

            'name' => 'HTML',
            'slug' => 'HTML',
        ]);


        Channel::create([

            'name' => 'Vue Js',
            'slug' => 'Vue Js',
        ]);



        Channel::create([

            'name' => 'Dart',
            'slug' =>'Dart',
        ]);
    }
}
