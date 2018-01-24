<?php

namespace Pascal\HtmlReader\Tests;

use Pascal\HtmlReader\HtmlReader;
use PHPUnit\Framework\TestCase;

class HtmlReaderTest extends TestCase
{

    /** @test */
    public function initialize_with_empty_string() {
        $htmlReader = new HtmlReader('');
        $this->assertInstanceOf(HtmlReader::class, $htmlReader);
    }

    /** @test */
    public function initialize_with_non_empty_string() {
        $htmlReader = new HtmlReader('This is not an empty string.');
        $this->assertInstanceOf(HtmlReader::class, $htmlReader);
    }

    /** @test */
    public function filter_all_html_tags_from_given_string() {
        $htmlReader = new HtmlReader('<div>a simple element</div>');
        $this->assertEquals(['div'], $htmlReader->tags());
    }

    /** @test */
    public function filter_all_html_tags_from_given_string_self_closing_element() {
        $htmlReader = new HtmlReader('<img src="#" />');
        $this->assertEquals(['img'], $htmlReader->tags());
    }


    /** @test */
    public function filter_all_html_tags_from_given_string_nested() {
        $htmlReader = new HtmlReader('<p><a href="#">some link</a></p>');
        $this->assertEquals(['p', 'a'], $htmlReader->tags());
    }

    /** @test */
    public function filter_all_html_tags_from_given_string_in_series() {
        $htmlReader = new HtmlReader('<span>some text</span><label>some label</label>');
        $this->assertEquals(['span', 'label'], $htmlReader->tags());
    }

    /** @test */
    public function filter_all_html_tags_from_given_string_in_series_and_nested() {
        $htmlReader = new HtmlReader('<p><span>some text</span></p><p><label>some label</label></p>');
        $this->assertEquals(['p', 'span', 'p', 'label'], $htmlReader->tags());
    }

}
