<?php

require_once __DIR__ . '/../vendor/autoload.php';

class MarkdownLexerTest extends \PHPUnit_Framework_TestCase
{

    public function testHeaderSyntax()
    {
        $lexer = new \MarkdownLexer;
        $lexer->setInput('# Header');
        $lexer->moveNext();
        $token = $lexer->lookahead;
        $this->assertEquals(\MarkdownLexer::T_HEADER, $token['type']);
        $this->assertEquals('#', $token['value']);

        $lexer->setInput('## Header');
        $lexer->moveNext();
        $token = $lexer->lookahead;
        $this->assertEquals(\MarkdownLexer::T_HEADER, $token['type']);
        $this->assertEquals('##', $token['value']);
    }
}
