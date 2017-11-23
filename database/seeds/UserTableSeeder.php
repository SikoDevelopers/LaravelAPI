<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345'),
            'tipo_users_id' => \App\Models\TipoUser::select('id')->where('designacao', '=','Comissao Cientifica')->first()->id,
        ]);
    }
}
