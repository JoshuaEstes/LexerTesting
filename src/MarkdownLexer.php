<?php

class MarkdownLexer extends \Lexer
{
    const T_NONE     = 1;
    const T_NEW_LINE = 2;

    const T_HEADER = 100;

    protected function getCatchablePatterns()
    {
        return array(
            '^#{1,6}',
            '[a-z_\\\][a-z0-9_\:\\\]*[a-z0-9_]{1}',
        );
    }

    protected function getNonCatchablePatterns()
    {
        return array(
            //'\s+',
            //'(.)',
        );
    }

    protected function getType(&$value)
    {
        //var_dump($value);
        $type = self::T_NONE;
        switch(true) {
            case("\n" === $value): return self::T_NEW_LINE;
            case('#' === $value): return self::T_HEADER;
            case('##' === $value): return self::T_HEADER;
            case('###' === $value): return self::T_HEADER;
            case('####' === $value): return self::T_HEADER;
            case('#####' === $value): return self::T_HEADER;
            case('######' === $value): return self::T_HEADER;
            default:
        }
        return $type;
    }
}
