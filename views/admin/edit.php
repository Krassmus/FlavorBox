<form class="default" method="post" action="<?= PluginEngine::getLink($plugin, array(), "admin/edit") ?>">
    <label>
        <?= _("CSS-Änderungen") ?>
        <textarea name="css" style="min-height: 80vh; font-family: MONOSPACE;"><?= htmlReady($info['css']) ?></textarea>
    </label>

    <div data-dialog-button>
        <?= \Studip\Button::create(_("Speichern")) ?>
    </div>
</form>