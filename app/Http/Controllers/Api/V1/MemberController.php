<?php

namespace App\Http\Controllers\Api\V1;


use App\Enums\MemberTypeEnum;
use App\Services\MemberService;
use App\Http\Resources\MemberResource;
use App\Http\Controllers\BaseApiController;


/**
 * @group Api
 * @subgroup Association Member
 */

class MemberController extends BaseApiController
{
     /**
        * MemberController constructor.
        * @param MemberService $service
        */

       public function __construct(MemberService $service)
       {

           $this->service = $service;
           $this->relations = ['image', 'position'];
           request()->merge([ 'scope' =>'mini']);
           parent::__construct($service, MemberResource::class);
       }

    /**
     * Board Members Lists
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"eman",
     *   }
     * }
     *
     */
       public function getBoardDirectoryMembers()
       {
           $models = $this->service->getMembersByType(MemberTypeEnum::board_of_directors->value);
           return $this->respondWithCollection($models);
       }

     /**
     * General Assembly Members Lists
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"eman",
     *   }
     * }
     *
     */
       public function getGeneralAssemblyMembers()
       {
           $models = $this->service->getMembersByType(MemberTypeEnum::members_of_the_general_assembly->value);
           return $this->respondWithCollection($models);
       }

     /**
     * Original Structure Members Lists
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"eman",
     *   }
     * }
     *
     */
       public function getOrganizationalStructureMembers()
       {
           $models = $this->service->getMembersByType(MemberTypeEnum::members_of_the_organizational_structure->value);
           return $this->respondWithCollection($models);
       }

}
