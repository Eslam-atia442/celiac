<?php

namespace App\Repositories\SQL;


use App\Enums\FileEnum;
use App\Models\AboutSettings;
use App\Models\AboutTheDiseaseSettings;
use App\Models\ClinicSettings;
use App\Models\File;
use App\Models\GeneralSettings;
use App\Models\InformationAboutTreatmentSettings;
use App\Repositories\Contracts\SettingContract;
use App\Services\FileService;
use App\Services\SettingService;
use Illuminate\Support\Facades\DB;

class SettingRepository implements SettingContract
{

    /**
     * @return AboutSettings
     */
    public function getAboutSetting(): AboutSettings
    {
        return new AboutSettings();
    }

    public function getGeneralSetting(): GeneralSettings
    {
        return new GeneralSettings();
    }

    public function getClinicSetting(): ClinicSettings
    {
        return new ClinicSettings();
    }


    public function updateAboutSetting($requests): AboutSettings
    {
        $aboutSetting = new AboutSettings();
        $aboutSetting->association_about_title_ar = $requests['association_about_title'] ?? '';
        $aboutSetting->association_about_title_en = $requests['association_about_title'] ?? '';

        $aboutSetting->association_about_description_ar = $requests['association_about_description'] ?? '';
        $aboutSetting->association_about_description_en = $requests['association_about_description'] ?? '';

        $aboutSetting->association_visions_ar = $requests['association_visions'] ?? '';
        $aboutSetting->association_visions_en = $requests['association_visions'] ?? '';

        $aboutSetting->association_message_ar = $requests['association_message'] ?? '';
        $aboutSetting->association_message_en = $requests['association_message'] ?? '';

        $aboutSetting->association_objectives_ar = $requests['association_objectives'] ?? '';
        $aboutSetting->association_objectives_en = $requests['association_objectives'] ?? '';

        $aboutSetting->association_values_ar = $requests['association_values'] ?? '';
        $aboutSetting->association_values_en = $requests['association_values'] ?? '';

        $aboutSetting->establishment_of_the_association_ar = $requests['establishment_of_the_association'] ?? '';
        $aboutSetting->establishment_of_the_association_en = $requests['establishment_of_the_association'] ?? '';
//        $aboutSetting->about_image = $requests['about_image']??'';
        $aboutSetting->save();

        return $aboutSetting;
    }

    public function updateGeneralSetting($requests): GeneralSettings
    {
        $generalSetting = new GeneralSettings();
        $generalSetting->email = $requests['email'] ?? '';
        $generalSetting->address = $requests['address'] ?? '';

        $generalSetting->phone = $requests['phone'] ?? '';
        $generalSetting->phone1 = $requests['phone1'] ?? '';

        $generalSetting->tiktok = $requests['tiktok'] ?? '';
        $generalSetting->twitter = $requests['twitter'] ?? '';

        $generalSetting->youtube = $requests['youtube'] ?? '';
        $generalSetting->whatsapp = $requests['whatsapp'] ?? '';

        $generalSetting->facebook = $requests['facebook'] ?? '';
        $generalSetting->save();

        return $generalSetting;
    }

    public function updateClinicSetting($requests): ClinicSettings
    {
        $setting = new ClinicSettings();
        $setting->bmi_link = $requests['bmi_link'] ?? '';
        $setting->whatsapp_group = $requests['whatsapp_group'] ?? '';
        $setting->telegram_group = $requests['telegram_group'] ?? '';
        $setting->clinic_location = $requests['clinic_location'] ?? '';
        $setting->clinic_email = $requests['clinic_email'] ?? '';
        $setting->save();

        return $setting;
    }
    public function getAboutTheDiseaseSetting(): AboutTheDiseaseSettings
    {
        return new AboutTheDiseaseSettings();
    }

    public function updateAboutTheDiseaseSetting($requests): AboutTheDiseaseSettings
    {

        $setting = new AboutTheDiseaseSettings();
        $setting->text = $requests['text'] ?? '';
        $path = config('filesystems.upload.paths.file_type_about_diesease_image');
        if ($requests['photo'] != null) {
            $photo = app(FileService::class)->updateFile(null, request()->all(), FileEnum::file_type_about_diesease_image?->value, $path, $requests['photo']);
        }


        $setting_id = DB::table('settings')->where('group', 'aboutTheDisease'
        )->where('name', 'photo')->value('id');

        $photo->update(['fileable_id' => $setting_id, 'fileable_type' => AboutTheDiseaseSettings::class]);
        $setting->photo = $photo->url ?? '';
        $setting->save();


        // delete old photos
        $oldPhoto = File::where('type', FileEnum::file_type_about_diesease_image->value)->
        where('fileable_id', $setting_id)->where('id', '!=', $photo->id)->delete();

         return $setting;
    }
    public function getInformationAboutTreatmentSetting(): InformationAboutTreatmentSettings
    {
        return new InformationAboutTreatmentSettings();
    }

    public function updateInformationAboutTreatmentSetting($requests): InformationAboutTreatmentSettings
    {

        $setting = new InformationAboutTreatmentSettings();
        $setting->text = $requests['text'] ?? '';
        $path = config('filesystems.upload.paths.file_type_information_about_treatment_image');
        if ($requests['photo'] != null) {
            $photo = app(FileService::class)->updateFile(null, request()->all(), FileEnum::file_type_information_about_treatment_image?->value, $path, $requests['photo']);
        }


        $setting_id = DB::table('settings')->where('group', 'informationAboutTreatment'
        )->where('name', 'photo')->value('id');

        $photo->update(['fileable_id' => $setting_id, 'fileable_type' => InformationAboutTreatmentSettings::class]);
        $setting->photo = $photo->url ?? '';
        $setting->save();


        // delete old photos
        $oldPhoto = File::where('type', FileEnum::file_type_information_about_treatment_image->value)->
        where('fileable_id', $setting_id)->where('id', '!=', $photo->id)->delete();

         return $setting;
    }

}
