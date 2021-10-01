<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailListRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Resources\EmailListResource;
use App\Http\Resources\EmailResource;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param EmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(EmailListRequest $request)
    {
        $order = $request->get('order', 'asc');

        $email = Email::select()->orderBy('created_at', $order)->paginate(10);

        return EmailListResource::collection($email);
    }

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
        $email->save();
        return response()->json($email->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $fields = $request->get('fields', false);

        if ($fields) {
            return new EmailResource(Email::select($fields)->where(['id' => $id])->first());
        } else {
            return new EmailResource(Email::select()->where(['id' => $id])->first());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
