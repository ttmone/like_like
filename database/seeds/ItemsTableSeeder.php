<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $foods = array(
            1 => 'カレー',
            'ラーメン',
            '焼肉',
            '寿司',
            'ピザ'
        );

        $artists = array(
            1 => '米津玄師',
            'あいみょん',
            'Official髭男dism',
            'RADWINPS',
            '嵐'
        );

        $hobbies = array(
            1 => 'ゲーム',
            '映画鑑賞',
            'カラオケ',
            'Youtube鑑賞',
            '筋トレ'
        );

        $themes = array(1 => $foods, $artists, $hobbies);

        foreach ($themes as $themeId => $theme) {
            foreach ($theme as $userId => $item) {
                DB::table('items')->insert([
                    'content' => $item,
                    'user_id' => $userId,
                    'theme_id' => $themeId,
                ]);
            }

            DB::table('themes')
                ->where('id', $themeId)
                ->update(['announced_count' => 1]);
        }
    }
}
