<?php
/**
 * DokuWiki Default Template 2012
 *
 * @link     http://dokuwiki.org/template
 * @author   Anika Henke <anika@selfthinker.org>
 * @author   Clarence Lee <clarencedglee@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
header('X-UA-Compatible: IE=edge,chrome=1');

$hasSidebar = page_findnearest($conf['sidebar']);
$showSidebar = $hasSidebar && ($ACT=='show');

$hasMenubar = page_findnearest(tpl_getConf('menubar'));
$showMenubar = $hasMenubar && (true || ($ACT=='show'));
$siteClasses = 'site ' . tpl_classes();
if ($hasSidebar) $siteClasses = $siteClasses . ' hasSidebar ';
if ($showSidebar) $siteClasses = $siteClasses . ' showSidebar ';
if ($hasMenubar) $siteClasses = $siteClasses . ' hasMenubar ';
if ($showMenubar) $siteClasses = $siteClasses . ' showMenubar ';

?><!DOCTYPE html>
<html lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="utf-8" />
    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <?php tpl_metaheaders() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Mono&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
    <style>
body { font: normal 93.75%/1.4 Ubuntu, sans-serif; }
p { margin-bottom: 1em; }
ul, ol, dl { margin-bottom: 1em; }
p + ul, p + ol { margin-top: -0.5em; }
li { margin-bottom: .33em; }
pre, table, hr, blockquote, figure, details, fieldset, address { margin-bottom: 0.33em; }
h1 { margin: 3em 0 1.5em 0; }
h2, h3 { margin: 2em 0 1em 0; }
h4, h5 { margin: 1em 0 0 0; }
div.plugin_fastwiki_marker + h1 { margin-top:0; }
div.plugin_fastwiki_marker + h2 { margin-top:0; }
div.plugin_fastwiki_marker + h3 { margin-top:0; }
h1:first-child, h2:first-child, h3:first-child, h4:first-child, h5:first-child { margin-top:0; }
#dokuwiki__header .headings, #dokuwiki__header .tools { margin-bottom: 0; }
#dokuwiki__header { padding: 0; }
#dokuwiki__header h1 span { font-size:1.5em; font-weight:bold; }
.dokuwiki textarea.edit { font-family: 'Ubuntu Mono', monospace; }
pre, code, samp, kbd { font-family: 'Ubuntu Mono', monospace; }
pre { padding: .33em .33em; }
/*____________ menubar ____________*/
nav.menubar { right: 0; margin-bottom: -10px; text-align:left; font-weight:bold; width: 100%; }
/**
nav.menubar a.wikilink1 { color: __text__ !important; text-decoration: none; }
nav.menubar a.wikilink1:link:hover, nav.menubar a.wikilink1:visited:hover { text-decoration: underline; }
/**/
/*____________ footer ____________*/
footer { padding-top: 0em; font-size: 0.714em; /* 10px (base: 14px) */ width: 100%; text-align: center; }
footer nav.footer_actions_left { float: left; margin-right: 1.5em; }
footer nav.footer_actions_right { float: right; }
/*____________ golden wrap _______*/
.wrap_padcolumn {float:left; margin-right:1%; }
.wrap_goldwide { width:60%; margin-right:1%; }
.wrap_goldslim { width:38%; margin-right:1%; }
.wrap_goldhalf { width:49%; margin-right:1%; }
.wrap_todocolumn {float:left; margin-right:1%; }
.wrap_todocolumn ul { margin:0; padding:0 }
.wrap_todocolumn ul li { margin:0; list-style:none; padding:.2em 0 .1em 0; border-bottom:1px dotted #ccc; }
.wrap_todocolumn table { border:0; }
.wrap_todocolumn tr { border:0; }
.wrap_todocolumn td { border-top:0; border-left:0; border-right:0; border-bottom:1px dotted #ccc; padding:.2em 0 .1em 0; }
.wrap_todotaskhead { border-top:2px dotted #cccc; margin-top:1em; }
    </style>
</head>

<body>
    <div id="dokuwiki__site"><div id="dokuwiki__top" class="site <?php echo $siteClasses; ?>">

        <?php include('tpl_header.php') ?>

        <div class="wrapper group" style="margin-bottom:0;">

            <?php if($showSidebar): ?>
                <!-- ********** ASIDE ********** -->
                <div id="dokuwiki__aside"><div class="pad aside include group">
                    <h3 class="toggle"><?php echo $lang['sidebar'] ?></h3>
                    <div class="content"><div class="group">
                        <?php tpl_flush() ?>
                        <?php tpl_includeFile('sidebarheader.html') ?>
                        <?php tpl_include_page($conf['sidebar'], true, true) ?>
                        <?php tpl_includeFile('sidebarfooter.html') ?>
                    </div></div>
                </div></div><!-- /aside -->
            <?php endif; ?>

            <!-- ********** CONTENT ********** -->
            <div id="dokuwiki__content"><div class="pad group">
                <?php html_msgarea() ?>

                <div class="pageId"><span><?php echo hsc($ID) ?></span></div>

                <div class="page group">
                    <?php tpl_flush() ?>
                    <?php tpl_includeFile('pageheader.html') ?>
                    <!-- wikipage start -->
                    <?php tpl_content() ?>
                    <!-- wikipage stop -->
                    <?php tpl_includeFile('pagefooter.html') ?>
                </div>
<!--
                <div class="docInfo"><?php tpl_pageinfo() ?></div>
-->
                <?php tpl_flush() ?>
            </div></div><!-- /content -->

            <hr class="a11y" />

            <!-- PAGE ACTIONS -->
            <div id="dokuwiki__pagetools">
                <h3 class="a11y"><?php echo $lang['page_tools']; ?></h3>
                <div class="tools">
                    <ul>
                        <?php
                            $data = array(
                                'view'  => 'main',
                                'items' => array(
                                    'edit'      => tpl_action('edit',      true, 'li', true, '<span>', '</span>'),
                                    'revert'    => tpl_action('revert',    true, 'li', true, '<span>', '</span>'),
                                    'revisions' => tpl_action('revisions', true, 'li', true, '<span>', '</span>'),
                                    'backlink'  => tpl_action('backlink',  true, 'li', true, '<span>', '</span>'),
                                    'subscribe' => tpl_action('subscribe', true, 'li', true, '<span>', '</span>'),
                                    'top'       => tpl_action('top',       true, 'li', true, '<span>', '</span>')
                                )
                            );

                            // the page tools can be amended through a custom plugin hook
                            $evt = new Doku_Event('TEMPLATE_PAGETOOLS_DISPLAY', $data);
                            if($evt->advise_before()){
                                foreach($evt->data['items'] as $k => $html) echo $html;
                            }
                            $evt->advise_after();
                            unset($data);
                            unset($evt);
                        ?>
                    </ul>
                </div>
            </div>
        </div><!-- /wrapper -->

        <?php include('tpl_footer.php') ?>
    </div></div><!-- /site -->

    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
    <div id="screen__mode" class="no"></div><?php /* helper to detect CSS media query in script.js */ ?>
</body>
</html>
