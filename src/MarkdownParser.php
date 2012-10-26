<?php

class MarkdownParser extends \Parser
{

    public function parse($input)
    {
        $output = '';
        $this->getLexer()->setInput($input);
        $this->getLexer()->moveNext();
        while($this->getLexer()->lookahead !== null) {
            $token = $this->getLexer()->lookahead;
            if ($token['type'] === \MarkdownLexer::T_HEADER) {
                $headerLevel = strlen($token['value']);
                $output .= '<h'.$headerLevel.'>';
                $this->getLexer()->moveNext();
                $this->getLexer()->moveNext();
                while(null !== $this->getLexer()->lookahead) {
                    $token = $this->getLexer()->lookahead;
                    $output .= $token['value'];
                    $this->getLexer()->moveNext();
                    if ($this->getLexer()->lookahead['type'] === \MarkdownLexer::T_NEW_LINE) {
                        break;
                    }
                }
                $output .= '</h'.$headerLevel.'>';
            }

            $token = $this->getLexer()->lookahead;
            $output .= $token['value'];

            $this->getLexer()->moveNext();
        }

        return $output;
    }

    public function match($token)
    {
        $lookaheadType = $this->lexer->lookahead['type'];

        if ($lookaheadType !== $token && $token !== \MarkdownLexer::T_NONE && $lookaheadType <= \MarkdownLexer::T_NONE) {
            throw new \Exception('Syntax Error');
        }

        $this->getLexer()->moveNext();
    }

}
