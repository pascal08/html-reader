<?php

namespace Pascal\HtmlReader;

class HtmlReader
{

    /**
     * Html to read.
     *
     * @var string
     */
    protected $html;

    /**
     * Constructs a HtmlReader instance.
     *
     * @param string $html
     */
    public function __construct(string $html)
    {
        $this->html = $html;
    }

    /**
     * @return array
     */
    public function tags()
    {
        $matches = [];
        preg_match_all('/<\s*(\w+)[^>]*>/', $this->html, $matches, PREG_SET_ORDER, 0);

        return array_column($matches, 1);
    }
}