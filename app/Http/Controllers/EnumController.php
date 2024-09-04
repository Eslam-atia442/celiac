<?php

namespace App\Http\Controllers;

use App\Enums\AssociationTypeEnum;
use Illuminate\Support\Facades\File;

/**
 * @group Enums
 *
 */
class EnumController extends Controller
{


    /**
     *
     * Enums
     * @return array
     */
    public function enums() : array
     {
         $enumClasses = collect(File::files(app_path('Enums')))->map(function ($file) {
            return basename($file, '.php');
        });
        $index = array_search('FileEnum', $enumClasses->toArray());
        unset($enumClasses[$index]);
        $data = [];

        foreach ($enumClasses as $enumClass) {

//            $enumClass = 'App\\Enums' . '\\' . $enumClass;
//            $data[$enumClass] = (new $enumClass)->getLabels();
            $data[$enumClass] = call_user_func(['App\\Enums' . '\\' . $enumClass, 'getLabels']);

        }
        return $data;
    }
}
