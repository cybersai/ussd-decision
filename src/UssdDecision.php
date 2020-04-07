<?php

namespace Cybersai\UssdDecision;

class UssdDecision
{
    protected $decided;
    protected $argument;
    protected $output;

    private function __construct($argument = null)
    {
        $this->decided = false;
        $this->argument = $argument;
        $this->output = null;
    }

    private function guardAgainstReDeciding()
    {
        return !$this->decided;
    }

    private function setOutput($output)
    {
        $this->output = $output;
        $this->decided = true;
    }

    private function setOutputForCondition($condition, $output)
    {
        if ($this->guardAgainstReDeciding()) {
            if ($condition()) {
                $this->setOutput($output);
            }
        }
        return $this;
    }

    public static function input($argument)
    {
        return new self($argument);
    }

    public function outcome()
    {
        return $this->output;
    }

    public function isEqual($argument, $output, $strict = false)
    {
        return $this->setOutputForCondition(function () use ($argument, $strict) {
            if ($strict) {
                return $argument === $this->argument;
            }
            return $argument == $this->argument;
        }, $output);
    }

    public function numeric($output)
    {
        return $this->setOutputForCondition(function () {
            return is_numeric($this->argument);
        }, $output);
    }

    public function isInteger($output)
    {
        return $this->setOutputForCondition(function () {
            return is_integer($this->argument);
        }, $output);
    }

    public function amount($output)
    {
        return $this->setOutputForCondition(function () {
            return preg_match("/^[0-9]+(?:\.[0-9]{1,2})?$/", $this->argument);
        }, $output);
    }

    public function length($argument, $output)
    {
        return $this->setOutputForCondition(function () use ($argument) {
            return strlen($this->argument) === $argument;
        }, $output);
    }

    public function isPhoneNumber($output)
    {
        return $this->setOutputForCondition(function () {
            return preg_match("/^[0][0-9]{9}$/", $this->argument);
        }, $output);
    }

    public function between($start, $end, $output)
    {
        return $this->setOutputForCondition(function () use ($start, $end) {
            return $this->argument >= $start && $this->argument <= $end;
        }, $output);
    }

    public function in($array, $output, $strict = false)
    {
        return $this->setOutputForCondition(function () use ($array, $strict) {
            return in_array($this->argument, $array, $strict);
        }, $output);
    }

    public function custom($function, $output)
    {
        $func = function () use ($function) { return $function($this->argument); };
        return $this->setOutputForCondition($func, $output);
    }

    public function default($output)
    {
        return $this->setOutputForCondition(function () {
            return true;
        }, $output);
    }
}