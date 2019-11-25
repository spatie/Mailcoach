<?php

namespace Tests\Unit\Support\MailConfiguration;

use App\Support\MailConfiguration\Drivers\SmtpConfigurationDriver;
use App\Support\MailConfiguration\MailConfigurationDriverRepository;
use Tests\TestCase;

class MailConfigurationDriverRepositoryTest extends TestCase
{
    /** @test */
    public function it_can_find_a_driver_for_the_given_string()
    {
        $repository = new MailConfigurationDriverRepository();

        $this->assertInstanceOf(SmtpConfigurationDriver::class, $repository->getForDriver('smtp'));

        $this->assertNull($repository->getForDriver('invalid-driver'));
    }
}
