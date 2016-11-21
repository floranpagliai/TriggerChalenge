<?php
/**
 * User: floran
 * Date: 20/11/2016
 * Time: 17:06
 */

namespace BackBundle\DBAL;


class ChallengeSubjectType extends EnumType
{
    const PORTRAIT = 'PORTRAIT';
    const LANDSCAPE = 'LANDSCAPE';
    const ARTISTIC = 'ARTISTIC';
    const NATURE = 'NATURE';
    const ARCHITECTURE = 'ARCHITECTURE';
    const STREET = 'STREET';

    protected $name = 'challengesubject';
    protected $values = array('PORTRAIT', 'LANDSCAPE', 'ARTISTIC', 'NATURE', 'ARCHITECTURE', 'STREET');
}