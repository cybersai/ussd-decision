<?php


namespace Cybersai\UssdDecision\tests;


use Cybersai\UssdDecision\UssdDecision;
use PHPUnit\Framework\TestCase;

class UssdDecisionTest extends TestCase
{
    public function testCanBeCreatedWithAnArgument()
    {
        $this->assertInstanceOf(UssdDecision::class, UssdDecision::using('argument'));
    }

    public function testReturnsTheOutcome()
    {
        $this->assertNull(UssdDecision::using('argument')->outcome());
    }

    public function testCanCompareArgumentUsingEqual()
    {
        $this->assertEquals('True', UssdDecision::using(1)->equal('1', 'True')
            ->outcome());
    }

    public function testCanCompareArgumentUsingStrictEqual()
    {
        $this->assertNull(UssdDecision::using(1)
            ->equal('1', 'True', true)->outcome());
    }

    public function testCanCompareArgumentUsingNumeric()
    {
        $this->assertEquals('True', UssdDecision::using('1')->numeric('True')->outcome());
    }

    public function testCanCompareArgumentUsingInteger()
    {
        $this->assertEquals('True', UssdDecision::using(1)->integer('True')->outcome());
    }

    public function testCanCompareArgumentUsingAmount()
    {
        $this->assertEquals('True', UssdDecision::using(11.2)->amount('True')->outcome());
    }

    public function testCanCompareArgumentUsingLength()
    {
        $this->assertEquals('True', UssdDecision::using('one')->length(3, 'True')
            ->outcome());
    }

    public function testCanCompareArgumentUsingPhoneNumber()
    {
        $this->assertEquals('True', UssdDecision::using('0241212123')->phoneNumber('True')
            ->outcome());
    }

    public function testCanUseYourCustomCondition()
    {
        $this->assertEquals('Custom', UssdDecision::using(['active' => true])
            ->custom(function ($argument)  {
                return $argument['active'];
            }, 'Custom')->outcome());
    }

    public function testCanCompareArgumentBetweenTwoNumbers()
    {
        $this->assertEquals('True', UssdDecision::using(3)->between(1, 10, 'True')->outcome());
    }

    public function testCanUseAnyWildCards()
    {
        $this->assertEquals('True', UssdDecision::using('5')->any('True')->outcome());
    }

    public function testDecisionCanBeChain()
    {
        $this->assertEquals('True', UssdDecision::using('45')
            ->phoneNumber('Phone')->any('True')->outcome());
    }

    public function testItIgnoresFollowingDecisionWhenConditionIsMet()
    {
        $this->assertEquals('First', UssdDecision::using('1234')
            ->numeric('First')->any('Second')->outcome());
    }

    public function testItReturnsNullWhenNoConditionIsMet()
    {
        $this->assertNull(UssdDecision::using('super')->numeric('Numeric')
            ->phoneNumber('Phone')->equal('ama', 'True')->outcome());
    }
}