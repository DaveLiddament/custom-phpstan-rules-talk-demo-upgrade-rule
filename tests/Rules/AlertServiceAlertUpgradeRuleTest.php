<?php

namespace DaveLiddament\CustomPhpstanRulesTalkUpgradeRule\Tests\Rules;

use DaveLiddament\CustomPhpstanRulesTalkUpgradeRule\Rules\AlertServiceAlertUpgradeRule;
use DaveLiddament\PhpstanRuleTestHelper\AbstractRuleTestCase;
use PHPStan\Rules\Rule;

/** @extends AbstractRuleTestCase<AlertServiceAlertUpgradeRule> */
final class AlertServiceAlertUpgradeRuleTest extends AbstractRuleTestCase
{

    protected function getRule(): Rule
    {
        return new AlertServiceAlertUpgradeRule();
    }

    public function testRule(): void
    {
        $this->assertIssuesReported(
            __DIR__ . '/Fixtures/AlertServiceAlert.php'
        );
    }

    protected function getErrorFormatter(): string
    {
        return '$type parameter must be supplied and it can not be null';
    }
}