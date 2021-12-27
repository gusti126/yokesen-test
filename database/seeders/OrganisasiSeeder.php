<?php

namespace Database\Seeders;

use App\Models\Organisasi;
use Illuminate\Database\Seeder;

class OrganisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organisasi::create([
            'nama' => 'UKM Sepakbola',
            'visi_misi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi dolore natus, aliquid ea, necessitatibus odit nostrum quod facilis voluptate minus, eos earum ipsam deserunt eaque est rerum aspernatur quas itaque?'
        ]);
        Organisasi::create([
            'nama' => 'UKM Voli',
            'visi_misi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi dolore natus, aliquid ea, necessitatibus odit nostrum quod facilis voluptate minus, eos earum ipsam deserunt eaque est rerum aspernatur quas itaque?'
        ]);
        Organisasi::create([
            'nama' => 'UKM Futsal',
            'visi_misi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi dolore natus, aliquid ea, necessitatibus odit nostrum quod facilis voluptate minus, eos earum ipsam deserunt eaque est rerum aspernatur quas itaque?'
        ]);
        Organisasi::create([
            'nama' => 'UKM Taekwondo',
            'visi_misi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi dolore natus, aliquid ea, necessitatibus odit nostrum quod facilis voluptate minus, eos earum ipsam deserunt eaque est rerum aspernatur quas itaque?'
        ]);
        Organisasi::create([
            'nama' => 'UKM Tenis Meja',
            'visi_misi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi dolore natus, aliquid ea, necessitatibus odit nostrum quod facilis voluptate minus, eos earum ipsam deserunt eaque est rerum aspernatur quas itaque?'
        ]);
        Organisasi::create([
            'nama' => 'UKM Panahan',
            'visi_misi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi dolore natus, aliquid ea, necessitatibus odit nostrum quod facilis voluptate minus, eos earum ipsam deserunt eaque est rerum aspernatur quas itaque?'
        ]);
    }
}
