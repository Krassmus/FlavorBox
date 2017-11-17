<?php

require_once __DIR__."/lib/FBCourseInfo.php";


class FlavorBox extends StudIPPlugin implements SystemPlugin
{
    public function __construct()
    {
        parent::__construct();
        if (Navigation::hasItem("/course")) {
            if ($GLOBALS['perm']->have_studip_perm("tutor", Context::get()->getId())) {
                $nav = new Navigation(_("Thema / Skinning"), PluginEngine::getURL($this, array(), "admin/edit"));
                $nav->setImage(Icon::create('visibility-visible', 'clickable'));
                $nav->setDescription(_("Verändern Sie das Aussehen Ihrer Veranstaltung."));
                Navigation::addItem("/course/admin/flavorbox", $nav);
            }
            $info = new FBCourseinfo(Context::get()->getId());
            if ($info['css']) {
                PageLayout::addStyle($info['css']);
            }
        }
    }
}