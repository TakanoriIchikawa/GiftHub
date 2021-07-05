<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;



use Tests\TestData\CreateTestData;
use Tests\TestData\GetTestData;

use Tests\TestData\UserTestData;
use Tests\TestData\FriendTestData;
use Tests\TestData\ChatMessageTestData;
use Tests\TestData\GiftItemTestData;
use Tests\TestData\GiftCategoryTestData;
use Tests\TestData\GrantPointTestData;
use Tests\TestData\GivePointTestData;
use Tests\TestData\ExchangePointTestData;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use UserTestData;
    use FriendTestData;
    use ChatMessageTestData;
    use GiftItemTestData;
    use GiftCategoryTestData;
    use GrantPointTestData;
    use GivePointTestData;
    use ExchangePointTestData;
}
