<?php

namespace App\Repositories\SQL;

use App\Enums\AssociationTypeEnum;
use App\Enums\FileEnum;
use App\Enums\MemberTypeEnum;
use App\Models\File;
use App\Repositories\Contracts\FileContract;
use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileRepository extends BaseRepository implements FileContract
{

    use FileUploadTrait;

    /**
     * FileRepository constructor.
     * @param File $model
     */
    public function __construct(File $model)
    {
        parent::__construct($model);
    }

    public function createMany(array $attributes = []): bool|File|array|null
    {
        $files = [];
        foreach ($attributes as $attribute) {
            $files[] = $this->create($attribute);
        }
        return $files;
    }

    public function create(array $attributes = []): mixed
    {
        if(!empty($attributes["current_id"])){
            $file_obj = $this->find($attributes["current_id"]);
            if($file_obj){
                $file_obj->fill($attributes);
                $file_obj->update();
                return $file_obj;
            }
        }
        $attributes = $this->upload($attributes["file"], $attributes);
        return parent::create($attributes);
    }

    public function createFile(UploadedFile $file, $request): File
    {
        $attributes = $this->upload($file, $request);
        return parent::create($attributes);
    }

    public function updateFile($model, array $attributes = [], $newFile = null)//: mixed
    {
         if ($newFile instanceof UploadedFile) {
            $this->deleteFile($model, false);//delete old file
            $attributes = $this->upload($newFile, $attributes);
        }
        return parent::update($model, $attributes);
    }



    public function remove(Model $model): mixed
    {
        if (Storage::exists($model->url)) {
            Storage::delete($model->url);
        }
        return parent::remove($model);
    }

    public function getMeetingFilesByType($type)
    {
        $type = $this->getMeetingFileType($type);
        return $this->search([
            'active' => true,
            'type' => $type
        ], [], ['page' => false, 'limit' => false, 'order'=> ['id' => 'desc']]);
    }

    public static function getMeetingFileType($value): string
    {
        switch ($value){
            case AssociationTypeEnum::board_of_directors->value == $value:
                return FileEnum::file_type_board_of_directors_file->value;
            case AssociationTypeEnum::the_general_assembly->value == $value:
                return FileEnum::file_type_the_general_assembly_file->value;
            case AssociationTypeEnum::the_organizational_structure->value == $value:
                return FileEnum::file_type_the_organizational_structure_file->value;
            default:
                return '';
        }
    }

}
