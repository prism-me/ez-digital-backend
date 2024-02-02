<?php

/*
 * This file is part of Psy Shell.
 *
 * (c) 2012-2022 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy;

use PhpParser\Parser;
use PhpParser\ParserFactory as OriginalParserFactory;

/**
 * Parser factory to abstract over PHP Parser library versions.
 */
class ParserFactory
{
    /**
<<<<<<< HEAD
     * Possible kinds of parsers for the factory, from PHP parser library.
     *
     * @return array
=======
     * New parser instance.
>>>>>>> 88086bab82b35c7fcd6e586383d14a8c912c06fc
     */
    public function createParser(): Parser
    {
        $factory = new OriginalParserFactory();

<<<<<<< HEAD
    /**
     * Default kind (if supported, based on current interpreter's version).
     *
     * @return string|null
     */
    public function getDefaultKind()
    {
        return static::ONLY_PHP7;
    }

    /**
     * New parser instance with given kind.
     *
     * @param string|null $kind One of class constants (only for PHP parser 2.0 and above)
     *
     * @return Parser
     */
    public function createParser($kind = null): Parser
    {
        $originalFactory = new OriginalParserFactory();

        $kind = $kind ?: $this->getDefaultKind();

        if (!\in_array($kind, static::getPossibleKinds())) {
            throw new \InvalidArgumentException('Unknown parser kind');
=======
        if (!\method_exists($factory, 'createForHostVersion')) {
            return $factory->create(OriginalParserFactory::PREFER_PHP7);
>>>>>>> 88086bab82b35c7fcd6e586383d14a8c912c06fc
        }

        return $factory->createForHostVersion();
    }
}
