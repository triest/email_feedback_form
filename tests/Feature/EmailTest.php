<?php

namespace Tests\Feature;

use App\Models\Email;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmailTest extends TestCase
{

    use RefreshDatabase;


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_empty_email()
    {
        $response = $this->get('api/email');


        $response->assertStatus(200) ->assertJson([

                                                  ]);;
    }

    public function test_email_list(){

        Email::created(['email'=>"re@ds.co,",'name'=>"name"]);
        $response = $this->get('api/email');

        $response->assertStatus(200) ->assertJson([

                                                  ]);;
    }

    public function test_email_view()
    {
        $email = Email::factory(1)->create();
        $email = Email::select(['*'])->where(['id' => 1])->first();

        $response = $this->get('api/email/1');
        $response->assertStatus(200)->assertJson(
                [
                        'data' => [
                                'id' => $email->id,
                                "email" => $email->email,
                                "name" => $email->name,
                                "text" => $email->text,
                                "person_data_processing_agree" => false
                        ]
                ]
        );;
    }

    public function test_create_fail_validation(){
        $response=$this->postJson('api/email',[]);
        $response->assertStatus(422);
    }

    public function test_create_fail_validation2(){
        $response=$this->postJson('api/email',['name'=>"name",'email'=>"emailmailcom"]);
        $response->assertStatus(422);
    }


    public function test_create_success(){
        $response=$this->postJson('api/email',['name'=>"name",'email'=>"email@mail.com"]);
        $response->assertStatus(202) ->assertExactJson([
                                                               'result' => true,
                                                                'id'=>1
                                                       ]);
    }


}
