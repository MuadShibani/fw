<?php

namespace App\Support;

use League\CommonMark\GithubFlavoredMarkdownConverter;

/**
 * Renders user-authored long-form content (blog posts, page bodies, etc.)
 * into safe-ish HTML.
 *
 * Authors may enter:
 *  - Plain text with line breaks
 *  - Markdown (**bold**, lists, headings, etc.)
 *  - Raw HTML produced by a rich editor (Quill, etc.)
 *
 * GitHub-flavored Markdown handles all three. Raw HTML is preserved
 * (`html_input => allow`) so existing Quill output keeps working.
 */
class Content
{
    public static function format(?string $text): string
    {
        if ($text === null || trim($text) === '') {
            return '';
        }

        $converter = new GithubFlavoredMarkdownConverter([
            'html_input'         => 'allow',
            'allow_unsafe_links' => false,
        ]);

        return (string) $converter->convert($text);
    }
}
