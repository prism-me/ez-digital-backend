<?php declare(strict_types=1);

namespace PhpParser;

<<<<<<< HEAD
class ParserFactory
{
    const PREFER_PHP7 = 1;
    const PREFER_PHP5 = 2;
    const ONLY_PHP7 = 3;
    const ONLY_PHP5 = 4;

=======
use PhpParser\Parser\Php7;
use PhpParser\Parser\Php8;

class ParserFactory {
>>>>>>> 88086bab82b35c7fcd6e586383d14a8c912c06fc
    /**
     * Create a parser targeting the given version on a best-effort basis. The parser will generally
     * accept code for the newest supported version, but will try to accommodate code that becomes
     * invalid in newer versions or changes in interpretation.
     */
    public function createForVersion(PhpVersion $version): Parser {
        if ($version->isHostVersion()) {
            $lexer = new Lexer();
        } else {
            $lexer = new Lexer\Emulative($version);
        }
        if ($version->id >= 80000) {
            return new Php8($lexer, $version);
        }
        return new Php7($lexer, $version);
    }
<<<<<<< HEAD
=======

    /**
     * Create a parser targeting the newest version supported by this library. Code for older
     * versions will be accepted if there have been no relevant backwards-compatibility breaks in
     * PHP.
     */
    public function createForNewestSupportedVersion(): Parser {
        return $this->createForVersion(PhpVersion::getNewestSupported());
    }

    /**
     * Create a parser targeting the host PHP version, that is the PHP version we're currently
     * running on. This parser will not use any token emulation.
     */
    public function createForHostVersion(): Parser {
        return $this->createForVersion(PhpVersion::getHostVersion());
    }
>>>>>>> 88086bab82b35c7fcd6e586383d14a8c912c06fc
}
