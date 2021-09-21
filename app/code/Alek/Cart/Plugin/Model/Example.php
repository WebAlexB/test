<?php

namespace Test\TutorialProxy2\Plugin\Model;

class Example
{
    public function aroundSayHelloWithFastObject(
        \Test\TutorialProxy1\Model\Example $example,
        $proceed,
        $name
    ) {
        //before
        if ($name == 'F') {
            return 'Привет';
        }
        $result = $proceed($name);
        //after
        return $result;
    }

    public function beforeSayHelloWithFastObject(
        \Test\TutorialProxy1\Model\Example $example,
        $name
    ) {
        return null;
    }
}
