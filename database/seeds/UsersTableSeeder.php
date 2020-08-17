<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slackIds = [
            'UREEWEMSS',
            'UTVR20KGS',
            'USGUNAELF',
            'U017G9BL6DD',
            'UR285JW80'
        ];

        foreach ($slackIds as $key => $slackId) {
            DB::table('users')->insert([
                'name' => "test$key",
                'slack_id' => $slackId,
            ]);
        }
    }
}
