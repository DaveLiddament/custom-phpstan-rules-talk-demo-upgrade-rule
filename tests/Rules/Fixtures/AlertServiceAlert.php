<?php

namespace DaveLiddament\CustomPhpstanRulesTalkUpgradeRule\Tests\Rules\Fixtures;

use DaveLiddament\CustomPhpstanRulesTalkDemoLibrary\AlertService;

class AlertServiceAlert
{
    public function callAlertServiceAlert(AlertService $alertService, string $aString, ?string $aNullableString): void
    {
        $alertService->alert('Test message', 'info'); // OK
        $alertService->alert('Test message', null); // ERROR
        $alertService->alert('Test message'); // ERROR
        $alertService->alert('A message', $aString); // OK
        $alertService->alert('A message', $aNullableString); // ERROR
    }


    public function callAnotherClassAlert(AnotherClass $anotherClass): void
    {
        $anotherClass->alert('Test message', 'info'); // OK
        $anotherClass->alert('Test message', null); // OK
        $anotherClass->alert('Test message'); // OK
    }
}
