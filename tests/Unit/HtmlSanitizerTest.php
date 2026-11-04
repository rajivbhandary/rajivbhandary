<?php

namespace Tests\Unit;

use App\Support\Html;
use Tests\TestCase;

class HtmlSanitizerTest extends TestCase
{
    public function test_scripts_and_event_handlers_are_removed()
    {
        $dirty = '<p onclick="steal()">Hello <strong>world</strong></p><script>alert(1)</script>'
            . '<img src="https://example.com/a.jpg" onerror="alert(2)"><a href="javascript:alert(3)">x</a>';

        $clean = Html::clean($dirty);

        $this->assertStringContainsString('<strong>world</strong>', $clean);
        $this->assertStringNotContainsString('<script', $clean);
        $this->assertStringNotContainsString('onclick', $clean);
        $this->assertStringNotContainsString('onerror', $clean);
        $this->assertStringNotContainsString('javascript:', $clean);
    }

    public function test_text_strips_tags_for_excerpts()
    {
        $this->assertSame('Sea facing 2 BHK & garden', Html::text('<p>Sea facing <b>2 BHK</b> &amp; garden</p>'));
    }
}
