<?php

require_once __DIR__."/lib/FBCourseInfo.php";


class FlavorBox extends StudIPPlugin implements SystemPlugin
{
    public $fonts = array(
        "Indie Flower",
        "Playfair Display",
        "Saira Extra Condensed",
        "Cabin Sketch",
        "Unica One",
        "Chelsea Market",
        "Sedgwick Ave Display",
        "Fredericka the Great",
        "VT323",
        "Cinzel Decorative",
        "Cutive Mono"
    );
    public $backgrounds = array();

    public function __construct()
    {
        parent::__construct();
        if (Navigation::hasItem("/course")) {
            foreach (scandir(__DIR__."/backgrounds") as $file) {
                if ($file[0] !== ".") {
                    $this->backgrounds[] = $file;
                }
            }
            if ($GLOBALS['perm']->have_studip_perm("tutor", Context::get()->getId())) {
                $nav = new Navigation(_("Thema / Skinning"), PluginEngine::getURL($this, array(), "admin/edit"));
                $nav->setImage(Icon::create('visibility-visible', 'clickable'));
                Navigation::addItem("/course/admin/flavorbox", $nav);
                $nav->setDescription(_("Verändern Sie das Aussehen Ihrer Veranstaltung."));
            }
            $info = new FBCourseinfo(Context::get()->getId());
            $style = "";
            foreach ($this->fonts as $font) {
                if ($info['body_font'] === $font) {
                    PageLayout::addStylesheet("https://fonts.googleapis.com/css?family=".urlencode($font));
                    $style .= "#layout_page { font-family: '".$font."'; }\n";
                }
                if ($info['header_font'] === $font) {
                    PageLayout::addStylesheet("https://fonts.googleapis.com/css?family=".urlencode($font));
                    $style .= "#current_page_title, #layout_page h1, #layout_page h2, #layout_page h3, #layout_page h4, #layout_page h5, #layout_page h6, #tabs { font-family: '".$font."'; }\n";
                }
            }
            if ($info['background']) {
                $style .= "#layout_page, #layout_container, #page_title_container, #layout-sidebar, #layout_content { background: none; background-color: transparent;}\n";
                $style .= ".sidebar .sidebar-widget, #layout_content { background-color: rgba(255, 255, 255, 1); } \n";
                $style .= "#layout_content { margin-top: -10px; padding-top: 10px; } ";

                if (in_array($info['background'], $this->backgrounds)) {
                    $style .= "#layout_page { background: url('".htmlReady($this->getPluginURL()."/backgrounds/".$info['background'])."'); background-size: 100% auto; background-attachment: fixed;}\n";
                } else {
                    $style .= "#layout_page, .helpbar-container, .helpbar { background-color: ".htmlReady($info['background']).";}\n";
                }
            }
            if ($info['css']) {
                $style .= $info['css'];
            }
            if ($style) {
                PageLayout::addStyle($style);
            }
        }
    }
}