<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
public function run() {
		$data = [
			['name' => 'user.view'],
			['name' => 'user.create'],
			['name' => 'user.update'],
			['name' => 'user.delete'],

			['name' => 'language.view'],
			['name' => 'language.create'],
			['name' => 'language.update'],
			['name' => 'language.delete'],

			['name' => 'role.view'],
			['name' => 'role.create'],
			['name' => 'role.update'],
			['name' => 'role.delete'],

		];

		$insert_data = [];
		$time_stamp = Carbon::now();
		foreach ($data as $d) {
			$d['guard_name'] = 'web';
			$d['created_at'] = $time_stamp;
			$insert_data[] = $d;
		}
		Permission::insert($insert_data);
	}
}
