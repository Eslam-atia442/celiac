<?php

namespace App\Http\Controllers\Api\V1;


use App\Enums\MemberTypeEnum;
use App\Services\FileService;
use App\Http\Resources\FileResource;
use App\Http\Controllers\BaseApiController;

/**
 * @group Api
 * @subgroup Meetings Files
 */

class FileController extends BaseApiController
{
     /**
      * FileController constructor.
      * @param FileService $service
      */


    public function __construct(FileService $service)
    {
       $this->service = $service;
       parent::__construct($service, FileResource::class);
    }

    /**
     * Board Directory Files List
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "custom_name" :"test",
     *      "name" :"test",
     *      "url" :"test",
     *   }
     * }
     *
     */
    public function getBoardDirectoryFiles()
    {
        $models = $this->service->getMeetingFilesByType(MemberTypeEnum::board_of_directors->value);
        return $this->respondWithCollection($models);
    }

    /**
     * General Assembly Files
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "custom_name" :"test",
     *      "name" :"test",
     *      "url" :"test",
     *   }
     * }
     *
     */
    public function getGeneralAssemblyFiles()
    {
        $models = $this->service->getMeetingFilesByType(MemberTypeEnum::members_of_the_general_assembly->value);
        return $this->respondWithCollection($models);
    }

    /**
     * Organizational Structure Meeting Files
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "custom_name" :"test",
     *      "name" :"test",
     *      "url" :"test",
     *   }
     * }
     *
     */
    public function getOrganizationalStructureFiles()
    {
        $models = $this->service->getMeetingFilesByType(MemberTypeEnum::members_of_the_organizational_structure->value);
        return $this->respondWithCollection($models);
    }
}
