<?php

class AdminController extends PluginController {

    public function edit_action() {
        if (!$GLOBALS['perm']->have_studip_perm("tutor", Context::get()->getId())) {
            throw new AccessDeniedException();
        }
        Navigation::activateItem("/course/admin/flavorbox");
        $this->info = new FBCourseinfo(Context::get()->getId());
        if (Request::isPost()) {
            $this->info['css'] = Request::get("css");
            $this->info['header_font'] = Request::get("header_font");
            $this->info['body_font'] = Request::get("body_font");
            $this->info['background'] = Request::get("background") !== "color"
                ? Request::get("background")
                : Request::get("color_picker");
            $this->info->store();
            PageLayout::postSuccess(_("Erfolgreich gespeichert."));
            $this->redirect("admin/edit");
        }
    }

}