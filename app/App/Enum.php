<?php
    use BenSampo\Enum\Enum;
    class EnumBase extends Enum {
        public static function getAsSelect() {
            $data   = static::asArray();
            $select = [];
            foreach ($data as $value) {
                $select[$value] = static::getTranslation($value);
            }
            return $select;
        }
    }
    class EnumStatus extends EnumBase {
        const Active  = 1;
        const Passive = 2;
        public static function getTranslation($key) {
            return [
                       self::Active  => trans("app.Active"),
                       self::Passive => trans("app.Passive"),
                   ][$key];
        }
        public static function getColor($key) {
            return [
                       self::Active  => "success",
                       self::Passive => "danger",
                   ][$key];
        }
    }
    class EnumYesNo extends EnumBase {
        const Yes = 1;
        const No  = 2;
        public static function getTranslation($key) {
            return [
                       self::Yes => trans("app.Yes"),
                       self::No  => trans("app.No"),
                   ][$key];
        }
    }
    class EnumApproval extends EnumBase {
        const Waiting  = 1;
        const Approved = 2;
        const Denied   = 3;
        public static function getTranslation($key) {
            return [
                       self::Waiting  => trans("app.Waiting"),
                       self::Approved => trans("app.Approved"),
                       self::Denied   => trans("app.Denied"),
                   ][$key];
        }
        public static function getColor($key) {
            return [
                       self::Waiting  => "warning",
                       self::Approved => "success",
                       self::Denied   => "danger",
                   ][$key];
        }
    }
    # ->
    class EnumUserRole extends EnumBase {
        const Root  = 1;
        const Admin = 2;
        const User  = 3;
        public static function getTranslation($key) {
            return [
                       self::Root  => trans("app.Root"),
                       self::Admin => trans("app.Admin"),
                       self::User  => trans("app.User"),
                   ][$key];
        }
        public static function getColor($key) {
            return [
                       self::Root  => "danger",
                       self::Admin => "warning",
                       self::User  => "primary",
                   ][$key];
        }
    }
    class EnumUserGender extends EnumBase {
        const Female                 = 1;
        const Male                   = 2;
        const I_Dont_Want_To_Specify = 3;
        public static function getTranslation($key) {
            return [
                       self::Female                 => trans("app.Female"),
                       self::Male                   => trans("app.Male"),
                       self::I_Dont_Want_To_Specify => trans("app.I Do Not Want To Specify"),
                   ][$key];
        }
        public static function getColor($key) {
            return [
                       self::Female                 => "",
                       self::Male                   => "",
                       self::I_Dont_Want_To_Specify => "",
                   ][$key];
        }
    }

