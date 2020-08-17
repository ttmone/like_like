<?php

use Illuminate\Database\Seeder;

class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $themes = [
            '好きな食べ物',
            '好きな歌手',
            '最近のマイブーム'
        ];

        foreach ($themes as $theme) {
            DB::table('themes')->insert(['content' => $theme]);
        }
    }
}
