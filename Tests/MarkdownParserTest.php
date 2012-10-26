<?php

require_once __DIR__ . '/../vendor/autoload.php';

class MarkdownParserTest extends \PHPUnit_Framework_TestCase
{

    public function testHeaderSyntax()
    {
        $parser = new \MarkdownParser(new \MarkdownLexer());
        $output = $parser->parse("# Header Test");
        $this->assertEquals('<h1>Header Test</h1>', $output);
        $output = $parser->parse("## Header Test");
        $this->assertEquals('<h2>Header Test</h2>', $output);
        $output = $parser->parse("### Header Test");
        $this->assertEquals('<h3>Header Test</h3>', $output);
        $output = $parser->parse("#### Header Test");
        $this->assertEquals('<h4>Header Test</h4>', $output);
        $output = $parser->parse("##### Header Test");
        $this->assertEquals('<h5>Header Test</h5>', $output);
        $output = $parser->parse("###### Header Test");
        $this->assertEquals('<h6>Header Test</h6>', $output);
    }

    public function testMultilineInput()
    {
        $input = <<<EOF
# This is a header

Here is a paragraph
EOF;
        $parser = new \MarkdownParser(new \MarkdownLexer());
        $output = $parser->parse($input);

        $this->assertEquals("<h1>This is a header</h1>\n\nHere is a paragraph", $output);

    }

}

