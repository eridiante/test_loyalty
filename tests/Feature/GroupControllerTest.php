<?php

namespace Tests\Functional;

use PHPUnit\Framework\TestCase;
use Illuminate\Http\Client\Factory as HttpClient;
use App\Controllers\GroupController;
use App\Services\UserService;
use App\Services\GroupService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;

class GroupControllerTest extends TestCase
{
    protected $groupController;
    protected $http;
    protected $apiUrl;

    public function setUp(): void
    {
        parent::setUp();

        $this->http = new HttpClient();
        $this->apiUrl = 'http://192.168.1.101:8088/api/v1/';
    }

    /** @tests */
    public function testAddUserToExistingGroup(): void 
    {
        $userId = 1;
        $groupId = 1;

        $res = $this->http->post("{$this->apiUrl}users/{$userId}/groups/{$groupId}");

        $res = $this->http->post("{$this->apiUrl}users/{$userId}/groups/{$groupId}");

        $this->assertEquals(400, $res->getStatusCode());
    }

    /** @tests */
    public function testGetUserGroups(): void 
    {
        $userId = 1;

        $res = $this->http->get("{$this->apiUrl}users/{$userId}/groups");
        
        $this->assertEquals(200, $res->getStatusCode());
    }

    /** @tests */
    public function testRemoveUserFromGroup(): void 
    {
        $userId = 1;
        $groupId = 1;

        $res = $this->http->delete("{$this->apiUrl}users/{$userId}/groups/{$groupId}");

        $this->assertEquals(200, $res->getStatusCode());

        $res = $this->http->delete("{$this->apiUrl}users/{$userId}/groups/{$groupId}");

        $this->assertEquals(400, $res->getStatusCode());

        $res = $this->http->post("{$this->apiUrl}users/{$userId}/groups/{$groupId}");
    }
}
