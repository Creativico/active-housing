<?php

namespace Tests\Unit;

use Api\ReqresUser;
use PHPUnit\Framework\TestCase;

class ReqresTest extends TestCase
{

    /** @test */
    public function get_user(): void
    {
        // given that we have a user ID test do we get json
        $ReqsresUser = new ReqresUser();

        $response = $ReqsresUser->getUser(5);
        $response = json_encode($response);
        $expected = '{"data":{"id":5,"email":"charles.morris@reqres.in","first_name":"Charles","last_name":"Morris","avatar":"https://reqres.in/img/faces/5-image.jpg"},"support":{"url":"https://reqres.in/#support-heading","text":"To keep ReqRes free, contributions towards server costs are appreciated!"}}';

        $this->assertJsonStringEqualsJsonString($expected, $response);
    }

}