<?php

abstract class Parser
{

    protected $lexer;

    abstract public function parse($input);

    public function __construct(\Lexer $lexer)
    {
        $this->lexer = $lexer;
    }

    public function getLexer()
    {
        return $this->lexer;
    }

}
