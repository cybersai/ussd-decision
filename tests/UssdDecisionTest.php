<?php


namespace Cybersai\UssdDecision\tests;


use Cybersai\UssdDecision\UssdDecision;
use PHPUnit\Framework\TestCase;

class UssdDecisionTest extends TestCase
{
    public function testCanBeCreatedWithAnArgument()
    {
        $this->assertInstanceOf(UssdDecision::class, UssdDecision::input('argument'));
    }

    public function testReturnsTheOutcome()
    {
        $this->assertNull(UssdDecision::input('argument')->outcome());
    }

    public function testCanCompareArgumentinputEqual()
    {
        $this->assertEquals('True', UssdDecision::input(1)->isEqual('1', 'True')
            ->outcome());
    }

    public function testCanCompareArgumentinputStrictEqual()
    {
        $this->assertNull(UssdDecision::input(1)
            ->isEqual('1', 'True', true)->outcome());
    }

    public function testCanCompareArgumentinputNumeric()
    {
        $this->assertEquals('True', UssdDecision::input('1')->numeric('True')->outcome());
    }

    public function testCanCompareArgumentinputInteger()
    {
        $this->assertEquals('True', UssdDecision::input(1)->isInteger('True')->outcome());
    }

    public function testCanCompareArgumentinputAmount()
    {
        $this->assertEquals('True', UssdDecision::input(11.2)->amount('True')->outcome());
    }

    public function testCanCompareArgumentinputLength()
    {
        $this->assertEquals('True', UssdDecision::input('one')->length(3, 'True')
            ->outcome());
    }

    public function testCanCompareArgumentinputPhoneNumber()
    {
        $this->assertEquals('True', UssdDecision::input('0241212123')->isPhoneNumber('True')
            ->outcome());
    }

    public function testCanUseYourCustomCondition()
    {
        $this->assertEquals('Custom', UssdDecision::input(['active' => true])
            ->custom(function ($argument)  {
                return $argument['active'];
            }, 'Custom')->outcome());
    }

    public function testCanCompareArgumentBetweenTwoNumbers()
    {
        $this->assertEquals('True', UssdDecision::input(3)->between(1, 10, 'True')->outcome());
    }

    public function testCanUseAnyWildCards()
    {
        $this->assertEquals('True', UssdDecision::input('5')->default('True')->outcome());
    }

    public function testDecisionCanBeChain()
    {
        $this->assertEquals('True', UssdDecision::input('45')
            ->isPhoneNumber('Phone')->default('True')->outcome());
    }

    public function testItIgnoresFollowingDecisionWhenConditionIsMet()
    {
        $this->assertEquals('First', UssdDecision::input('1234')
            ->numeric('First')->default('Second')->outcome());
    }

    public function testItReturnsNullWhenNoConditionIsMet()
    {
        $this->assertNull(UssdDecision::input('super')->numeric('Numeric')
            ->isPhoneNumber('Phone')->isEqual('ama', 'True')->outcome());
    }
}