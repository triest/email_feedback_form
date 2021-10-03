<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailListRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\EmailViewRequest;
use App\Http\Resources\EmailListResource;
use App\Http\Resources\EmailResource;
use App\Models\Email;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class EmailController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/email",
     *     tags={"email"},
     *     description="Get email list",
     *     @OA\Parameter (name="order",in="query",description="Order by date, value asc or desc",required=false),
     *     @OA\Response(response="default", description="Email list")
     *         *
     *
     * )
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param EmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(EmailListRequest $request)
    {
        $order = $request->get('order', 'asc');

        $email = Email::select(['id','name','email'])->orderBy('created_at', $order)->paginate(10);

        return EmailListResource::collection($email);
    }


    /**
     * @OA\Post (
     *     path="/api/email",
     *     tags={"email"},
     *     description="Create new email",

     *     @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *
     *               @OA\Property(property="email", type="string",),
     *               @OA\Property(property="name", type="string"),
     *               @OA\Property(property="person_data_processing_agree", type="boolean"),
     *               @OA\Property(property="text", type="string"),
     *                 )
     *        )
     *    ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pet not found",
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception",
     *     ),
     *     security={{"petstore_auth":{"write:pets", "read:pets"}}}
     * )
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param EmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EmailRequest $request)
    {
        $email = new Email();
        $email->fill($request->post());
        try {
            $email->save();
            return response()->json(['result'=>true,'id'=>$email->id])->setStatusCode(202);
        } catch (QueryException  $e) {
            return response()->json(['result'=>false,$e->getMessage()])->setStatusCode(400);
       }
    }


    /**
     * @OA\Get(
     *     path="/api/email/{id}",
     *     tags={"email"},
     *     @OA\Parameter (name="id",in="path",description="Email id",required=true),
     *     description="Create new email",
     *     @OA\Response(response="default", description="Email description")
     *         *
     *
     * )
     */
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, EmailViewRequest $request)
    {
        $fields = $request->get('fields', "*");
        $email=Email::select($fields)->where(['id' => $id])->first();
        if(!$email){
            return  response()->json()->setStatusCode(200);
        }

        if ($fields) {
            return new EmailResource($email);
        } else {
            return new EmailResource($email);
        }
    }


}
