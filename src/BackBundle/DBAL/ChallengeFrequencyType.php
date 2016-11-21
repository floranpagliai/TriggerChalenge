<?php
/**
 * User: floran
 * Date: 20/11/2016
 * Time: 21:42
 */

namespace BackBundle\DBAL;


class ChallengeFrequencyType extends EnumType
{
    const DAILY = 'DAILY';
    const WEEKLY = 'WEEKLY';
    const MONTHLY = 'MONTHLY';

    protected $name = 'challengefrequency';
    protected $values = array('DAILY', 'WEEKLY', 'MONTHLY');
}