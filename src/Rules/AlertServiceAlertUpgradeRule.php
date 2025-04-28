<?php

namespace DaveLiddament\CustomPhpstanRulesTalkUpgradeRule\Rules;

use DaveLiddament\CustomPhpstanRulesTalkDemoLibrary\AlertService;
use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\Type\ObjectType;

/** @implements Rule<MethodCall> */
final class AlertServiceAlertUpgradeRule implements Rule
{

    public function getNodeType(): string
    {
        return MethodCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        // Is the call on an AlertService object?
        $objectType = new ObjectType(AlertService::class);
        if (!$objectType->isSuperTypeOf($scope->getType($node->var))->yes()) {
            return [];
        }

        // Is the method name 'alert'?
        $name = $node->name;
        if (!$name instanceof Node\Identifier) {
            return [];
        }

        if ($name->toLowerString() !== 'alert') {
            return [];
        }

        // Does the call have at least 2 argument, if so is it a string?
        if (count($node->args) >= 2) {

            $arg2 = $node->args[1];
            if (!$arg2 instanceof Node\Arg) {
                return [];
            }

            $type = $scope->getType($arg2->value);
            if ($type->isString()->yes()) {
                return [];
            }
        }

        return [
            RuleErrorBuilder::message('$type parameter must be supplied and it can not be null')
                ->identifier('DemoLibraryUpgrade.AlertService')
                ->build(),
        ];
    }
}