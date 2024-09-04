<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Models\Member;
use App\Enums\FileEnum;
use App\Enums\MemberTypeEnum;
use App\Services\MemberService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\MemberResource;
use App\Http\Requests\BoardMemberRequest;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\OrganizationalStructureMemberRequest;
/**
 * @group Dashboard
 * @subgroup Organizational Structure
 */
class OrganizationalStructureMemberController extends BaseApiController
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
        $this->path = config('filesystems.upload.paths.organizational_structure_members');
        parent::__construct($service, MemberResource::class, 'organizational-structure-member');
    }

    /**
     * Organizational Structure member Lists
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
    public function index(): mixed
    {
        \request()->merge(['type' => MemberTypeEnum::members_of_the_organizational_structure->value]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }

    /**
     * Organizational Structure member Store
     *
     * @bodyParam name string required
     * @bodyParam position_id integer required
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

    public function store(OrganizationalStructureMemberRequest $request): JsonResponse
    {
        try {
            $member = $this->service->createMember($request->validated(), $this->type, $this->path);
            return $this->respondWithModel($member->load($this->relations));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Organizational Structure member Update
     *
     * @urlParam $member
     * @bodyParam name string required
     * @bodyParam position_id integer required
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
    public function update(OrganizationalStructureMemberRequest $request, Member $member): JsonResponse
    {
        try {
            $member = $this->service->updateMember($member, $request->validated(), $this->type, $this->path);
            return $this->respondWithModel($member->load($this->relations));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Organizational Structure member Delete
     *
     * @urlParam $member
     *
     * @response {
     *  "status": 200,
     *  "message": "",
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
     * change status
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
