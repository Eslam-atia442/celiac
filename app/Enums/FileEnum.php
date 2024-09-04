<?php

namespace App\Enums;

use App\Traits\ConstantsTrait;

enum FileEnum: int
{
    use ConstantsTrait;

    case file_type_user_avatar = 1;
    case file_type_user_cover = 2;
    case file_type_member_avatar = 3;
    case file_type_board_of_directors_file = 4;
    case file_type_the_general_assembly_file = 5;
    case file_type_the_organizational_structure_file = 6;
    case file_type_governance_attachments = 7;
    case file_type_committee_main_icon = 8;
    case file_type_committee_icon = 9;
    case file_type_banner_image = 10;
    case file_type_donation_type_main_icon = 11;
    case file_type_donation_type_icon = 12;
    case file_type_post_image = 13;
    case file_type_partner_image = 14;
    case file_type_donation_image = 15;
    case file_type_health_library_image = 16;
    case file_type_health_library_file = 17;
    case file_type_patient_awareness_image = 18;
    case file_type_patient_awareness_pdf = 19;
    case file_type_about_diesease_image = 20;
    case file_type_information_about_treatment_image = 21;
    case file_type_celiac_card_medical_report = 22;
    case file_type_job_request_cv = 23;
    case file_type_hajj_request = 24;
    case file_type_news_image = 25;
    case file_type_medical_center_image = 26;
    case file_type_medical_center_pdf = 27;


    public static function fileableTypes(): array
    {
        return [
            'User'
        ];
    }
}
