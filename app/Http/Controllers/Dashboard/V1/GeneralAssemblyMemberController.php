<?php

namespace App\Http\Controllers\Dashboard\V1;


use App\Models\Member;
use App\Enums\FileEnum;
use App\Enums\MemberTypeEnum;
use App\Services\MemberService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\MemberResource;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\GeneralAssemblyMemberRequest;

/**
 * @group Dashboard
 * @subgroup General Assembly
 */

class GeneralAssemblyMemberController extends BaseApiController
{
    public string $type;
    public string $path;
     /**
        * MemberController constructor.
        * @param MemberService $service
        */

       public function __construct(MemberService $service)
       {
           $this->service = $service;
           $this->relations = ['image', 'position'];
           $this->type = FileEnum::file_type_member_avatar->value;
           $this->path = config('filesystems.upload.paths.general_assembly_members');
           parent::__construct($service, MemberResource::class, 'general-assembly-member');
       }

    /**
     * General Assembly Member List
     *
     * @queryParam filters[keyword] Filter by name, position.
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"eman mahmoud",
     *      "position_name" :"",
     *   }
     * }
     *
     */
    public function index():mixed
   {
       \request()->merge(['type' => MemberTypeEnum::members_of_the_general_assembly->value]);
       $models = $this->service->search([], $this->relations);
       return $this->respondWithCollection($models);
   }

    /**
     * General Assembly Member Store
     *
     * @bodyParam name string required
     * @bodyParam position_id integer required
     * @bodyParam period integer required
     * @bodyParam start_date date required
     * @bodyParam end_date date required
     * @bodyParam image file required
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"eman mahmoud",
     *      "position_name" :"",
     *   }
     * }
     *
     */

    public function store(GeneralAssemblyMemberRequest $request): JsonResponse
    {
        try {
            $member = $this->service->createMember($request->validated(), $this->type, $this->path);
            return $this->respondWithModel($member->load($this->relations));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * General Assembly Member Update
     *
     *
     * @bodyParam name string required
     * @bodyParam position_id integer required
     * @bodyParam start_date date required
     * @bodyParam end_date date required
     * @bodyParam image file optional
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"eman mahmoud",
     *      "position_name" :"",
     *   }
     * }
     *
     */
    public function update(GeneralAssemblyMemberRequest $request, Member $member): JsonResponse
    {
        try {
            $member = $this->service->updateMember($member, $request->validated(), $this->type, $this->path);
            return $this->respondWithModel($member->load($this->relations));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * General Assembly Member Delete
     *
     * @urlParam $member
     *
     * @response {
     *  "status": 200,
     *  "message": "",
     *
     * }
     *
     */
    public function destroy(Member $member): JsonResponse
    {
        try {
            $this->service->remove($member);
            return $this->respondWithSuccess(__('messages.responses.deleted'));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    /**
     * General Assembly Member change status
     *
     * @urlParam $member
     * @response {
     *  "status": 200,
     *  "message": "",
     *  "data":{
     *      "id":1,
     *      "name" :"eman mahmoud",
     *      "position_name" :"",
     *   }
     * }
     *
     */
    public function changeActivation(Member $member): JsonResponse
    {
        try {
            $this->service->toggleField($member, 'is_active');
            return $this->respondWithModel($member->load($this->relations));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

}
