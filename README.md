# Youbou Blocks

A simple, reading-focused WordPress theme for personal blogs, articles, and tutorials. Youbou Blocks gives your writing room to breathe, with clear headings, a flexible logo and menu, and layouts that adapt to phones and larger screens.

**Version:** 1.1.0  
**Author:** Youssef Bouhlal  
**Compatibility target:** WordPress 6.0 or newer and PHP 7.4 or newer.

Youbou Blocks is a **block theme**: you can arrange its layouts using WordPress's visual Site Editor instead of editing code. Some details, such as the preview rules and copyright holder's name, are defined by the theme and require code changes to alter.

## Features at a glance

- **Ready-made layouts** for your blog, individual articles, ordinary pages, category and other archives, search results, and missing pages.
- **Formatted article previews** that can include introductory text, images, and other blocks, followed by a Read more link.
- **A responsive header** with your site logo and a menu that opens as an overlay on smaller screens.
- **A shared footer** with your local site logo, social links, and an automatically updated copyright year.
- **A reading-friendly design** with a white background, dark headings, muted body text, darker gold links, and generous spacing.
- **Comfortable typography** using fonts already available on the visitor's device, without requiring an external font service.
- **Six named colors** and text-size presets available in the editor, with regular and wider content layouts.
- **Image styling** with rounded corners and a subtle outline where custom image borders have not been chosen.
- **Code-friendly formatting** with highlighted inline code that wraps and scrollable standard code blocks and preview code samples.
- **Accessibility features** including a Skip to content link, clear page headings, keyboard focus indicators, labeled search controls, and meaningful Read more labels.
- **Editor styling** that brings the theme's typography and supplementary styles into WordPress's editing screens.
- **Translation-ready theme text**, with an included translation template and WordPress providing translations for its own search and navigation controls.

## Included page layouts

WordPress chooses the right layout automatically. You do not need to create a separate layout for each article or category.

| Layout | What visitors see |
| --- | --- |
| Blog | A Blog heading, linked article titles, previews, category links, and navigation between pages of posts. |
| Single article | The full article, its title, publication date, and category links. |
| Ordinary page | A page title and full content, without the blog's article-list layout. |
| Archive | A category or other archive title, matching posts, and pagination. |
| Search | The search phrase, a labeled search form, and matching article previews. |
| No results | A clear message and a list of recent posts to explore. |
| Missing page (404) | A short explanation, a search form, and recent posts. |

Every layout shares the header and footer and identifies its main content area for screen-reader navigation.

## How article previews work

On blog, archive, and search pages, the **Post Preview** block shows the introduction before the article's first **Heading 2**, also called an H2. It does not shorten the full article when a visitor opens it.

For example, an article containing an opening paragraph, an image, and then a Heading 2 will show the paragraph and image in its preview. The heading and everything after it remain on the full article page.

There are a few useful rules to know:

- If the first Heading 2 is inside a grouped layout, columns, or a shared block, the whole containing section is left out of the preview. This keeps the layout intact.
- If there is no recognized Heading 2, or nothing useful appears before it, the theme shows a plain-text summary of up to **55 words**.
- For that plain-text summary, your manually written excerpt is used when available; otherwise, WordPress generates one from the article.
- A manual excerpt does not replace a formatted introduction when the article has a usable introduction before a Heading 2.
- Password-protected articles show WordPress's protected-content message, not their introduction or excerpt.
- Classic HTML and headings produced by plugins or shortcodes are not recognized as the preview boundary; these use the summary fallback when no block Heading 2 is found.
- More and Page Break markers do not add extra navigation inside formatted previews. Full articles retain WordPress's usual behavior.

The Read more link opens the full article. Its screen-reader label includes the article title so visitors can tell the links apart.

## Set up your site

1. **Activate the theme.** In your WordPress dashboard, go to **Appearance > Themes** and activate Youbou Blocks. If it is not installed, upload the theme ZIP through **Add New > Upload Theme** first.
2. **Add your logo.** Open **Appearance > Editor**, edit the header, and select the Site Logo block to choose or upload an image. The footer uses the same logo at a smaller size. Without a logo, the theme does not display a broken image.
3. **Set up your menu.** Select the Navigation block in the header and add your own page links. Replace any placeholder links such as `#` with real destinations.
4. **Update social links.** Edit the footer's Social Icons block. The supplied Twitter, LinkedIn, and GitHub links point to the author's profiles; replace them with yours or remove unwanted links. They open in a new tab.
5. **Choose your homepage.** Use **Settings > Reading** to show your latest posts or select a static homepage and a separate posts page. The posts-per-page setting also controls the theme's inherited article lists.
6. **Write your introduction.** Add the opening content before your first Heading 2. For articles without that heading, write an excerpt if you want more control over the summary.
7. **Review and save.** Preview the site at desktop and phone sizes, then save your Site Editor changes.

Editor labels can differ slightly between WordPress versions and languages.

## Personalize the design

The Site Editor lets you rearrange blocks, edit shared header and footer layouts, and adjust the styles WordPress exposes for each block. Shared header and footer changes apply across the theme's page layouts.

The built-in palette includes **Heading**, **Text**, **Link**, **Dark Background**, **Light Background**, and **White**. The standard reading area is 800px wide, while supported wide-aligned blocks can use a 1200px layout. Both fit within the available screen space.

Headings and spacing become more compact on small screens. The default gold link color has approximately **5.3:1 contrast on white**. If you change colors, check that links and text remain easy to read on their actual backgrounds. These features do not guarantee that every customized page meets all accessibility requirements.

### The copyright line

The **Copyright** block updates its year automatically using the site's timezone. You do not need to change it every January, although a page cache may need clearing after the year changes.

The holder's name is currently **YOUSSEF BOUHLAL** and is defined in the theme code, not an editor setting. To use a different name without editing code, replace the Copyright block with a Paragraph block containing your own text; that paragraph's year will need updating manually.

## Updating an existing site

Back up your site before updating the theme. The update does not erase your posts, navigation, or saved Site Editor customizations.

WordPress gives your saved layouts and styles priority over the theme's defaults. This protects your changes, but it can also mean that an updated default does not appear immediately.

- If article lists still show full content, edit the list's Post Template and replace its **Post Content** block with **Post Preview**. Keep Post Content in individual article and page layouts.
- If the footer still shows a fixed year, replace its old copyright paragraph with the **Copyright** block.
- Previously saved colors, templates, and footer content may need reviewing manually. Compare them with the new defaults before resetting anything.
- Patterns already inserted and saved in a layout are copies; later theme updates do not automatically replace those copies.

## Languages

The theme includes a [translation template](languages/youboublocks.pot) containing the theme text available for translation. This POT file is a starting point for translators, not a completed translation into another language.

To add a language, use the template to create and translate a language-specific PO file, then export an MO file for WordPress to load. The editor's custom block labels also need JSON translation files. The developer notes below explain how to generate those files.

Changing the site language alone does not supply theme translations that have not been installed. WordPress handles translations of its built-in controls separately.

Text copied from a pattern into a saved layout does not automatically change when you switch languages. You can edit that saved text in the Site Editor.

## Compatibility and testing

The theme targets **WordPress 6.0+** and **PHP 7.4+**. It uses built-in WordPress blocks alongside its two custom blocks, Post Preview and Copyright. No separate page-builder plugin or external font service is required.

Checks have been completed on **WordPress 7.1.3**, including preview tests on **PHP 7.4.30**. The local site now runs **Apache with PHP 8.2.27**; linked styles and scripts load correctly, and mobile navigation opens, closes with Escape, and restores focus. Responsive checks covered narrow phone and desktop layouts.

A complete WordPress 6.0 installation and the full signed-in Site Editor workflow have not yet been tested. Minimum-version support remains a compatibility target, not a claim of complete testing on every supported version.

## Developer notes

- Theme configuration uses `theme.json` version 2, with shared CSS for styling that older WordPress versions do not support through that configuration.
- The editor script needs no build step. Custom blocks use API version 3 on WordPress 6.3 and newer, and version 2 on older supported installations.
- Preview rendering selects complete blocks from the original content instead of cutting rendered HTML. It checks shared-block references with depth and cycle protection, and falls back to plain text for unsafe references.
- Post context is restored after preview rendering. Full post content is not modified by a global truncation filter.
- Available checks include PHP syntax, WordPress coding standards, JavaScript and CSS linting, configuration schema checks, native block serialization, and editor render endpoints. Use in-memory preview fixtures rather than creating temporary test posts or files.
- The earlier Local asset-delivery problem was resolved on October 13, 2026 by gracefully stopping a stale site-level nginx process after the switch to Apache. No server configuration changes were necessary.

The translation text domain is `youboublocks`. The generated POT template is included at [languages/youboublocks.pot](languages/youboublocks.pot). After adding or changing translatable theme text, refresh it from the theme directory with WP-CLI:

```sh
wp i18n make-pot . languages/youboublocks.pot
```

Install translated MO files in WordPress's theme-language location or the theme's `languages` directory. Generate editor JSON catalogs from translated PO files with `wp i18n make-json`.

Run the available checks and `git diff --check` before releasing changes. Test older WordPress versions in a separate environment rather than downgrading an existing site.

## License

Youbou Blocks is licensed under the **GNU General Public License, version 2.0 or later**.