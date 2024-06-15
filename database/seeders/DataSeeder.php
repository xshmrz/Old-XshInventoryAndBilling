<?php
    namespace Database\Seeders;
    use Illuminate\Database\Seeder;
    class DataSeeder extends Seeder {
        public function run() : void {
            set_time_limit(0);
            ini_set('memory_limit', '-1');
            # -> Snapshot
            # -> \Artisan::call("snapshot:load snapshot_location --drop-tables=0");
            # -> # -> Root
            # -> $user                      = User();
            # -> $user->firstname           = "Root";
            # -> $user->lastname            = "Demo";
            # -> $user->email               = \Str::slug($user->firstname)."@".\Str::slug($user->lastname).".com";
            # -> $user->phone               = fake()->numerify("+############");
            # -> $user->password            = md5(12345678);
            # -> $user->password_re         = md5(12345678);
            # -> $user->can_login_panel     = \EnumYesNo::No;
            # -> $user->can_login_dashboard = \EnumYesNo::Yes;
            # -> $user->status              = \EnumStatus::Active;
            # -> $user->gender              = \EnumUserGender::I_Dont_Want_To_Specify;
            # -> $user->role                = \EnumUserRole::Root;
            # -> $user->birthday            = now()->addYears(rand(-40, -25))->addDays(rand(100, 200))->toDateString();
            # -> $user->age                 = now()::parse($user->birthday)->age;
            # -> $user->save();

        }
    }
