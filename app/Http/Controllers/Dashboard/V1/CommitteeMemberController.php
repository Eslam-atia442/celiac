<?php

namespace App\Http\Controllers\Dashboard\V1;

use App\Models\Committee;
use App\Models\Member;
use App\Enums\FileEnum;
use App\Enums\MemberTypeEnum;
use App\Services\MemberService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\MemberResource;
use App\Http\Requests\CommitteeMemberRequest;
use App\Http\Controllers\BaseApiController;
/**
 * @group Dashboard
 * @subgroup Committees
 */
class CommitteeMemberController extends BaseApiController
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
        $this->relations = ['image', 'position', 'committable'];
        $this->type = FileEnum::file_type_member_avatar->value;
        $this->path = config('filesystems.upload.paths.committee_members');
        $this->middleware('permission:read-committee-member')->only(['members']);
        parent::__construct($service, MemberResource::class, 'committee-member');

    }

    /**
     * Member Lists
     *
     * @queryParam filters[keyword] Filter by name, committee name.
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
    public function members($id): mixed
    {
        \request()->merge(['type' => MemberTypeEnum::members_of_committee->value, 'committee' => $id]);
        $models = $this->service->search([], $this->relations);
        return $this->respondWithCollection($models);
    }

    /**
     * Member Store
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

    public function store(CommitteeMemberRequest $request, Committee $committee): JsonResponse
    {
        try {
            $member = $this->service->createMember($request->validated(), $this->type, $this->path);
            return $this->respondWithModel($member->load($this->relations));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Member Update
     *
     * @urlParam $committee
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
    public function update(CommitteeMemberRequest $request, Committee $committee, Member $member): JsonResponse
    {
        try {
            $member = $this->service->updateMember($member, $request->validated(), $this->type, $this->path);
            return $this->respondWithModel($member->load($this->relations));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * Member Delete
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
        //:: todo remove file attached
        try {
            $this->service->remove($member);
            return $this->respondWithSuccess(__('messages.responses.deleted'));
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

}
