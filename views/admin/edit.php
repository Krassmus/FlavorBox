<form class="default" method="post" action="<?= PluginEngine::getLink($plugin, array(), "admin/edit") ?>">
    <label>
        <?= _("Überschriften") ?>
        <select name="header_font">
            <option value="">Stud.IP-Standard</option>
            <? foreach ($plugin->fonts as $font) : ?>
                <option<?= $info['header_font'] === $font ? " selected" : "" ?>><?= htmlReady($font) ?></option>
            <? endforeach ?>
        </select>
    </label>

    <label>
        <?= _("Schriften") ?>
        <select name="body_font">
            <option value="">Stud.IP-Standard</option>
            <? foreach ($plugin->fonts as $font) : ?>
                <option<?= $info['body_font'] === $font ? " selected" : "" ?>><?= htmlReady($font) ?></option>
            <? endforeach ?>
        </select>
    </label>

    <label>
        <?= _("Hintergrund") ?>
        <select name="background" onChange="jQuery('#color_picker').toggle(this.value == 'color');">
            <option value=""><?= _("Weiß") ?></option>
            <? foreach ($plugin->backgrounds as $background) : ?>
                <option value="<?= htmlReady($background) ?>"<?= $background === $info['background'] ? " selected" : "" ?>>
                    <?= htmlReady(substr($background, 0, strpos($background, "."))) ?>
                </option>
            <? endforeach ?>
            <option value="color"<?= $info['background'] && !in_array($info['background'], $plugin->backgrounds) ? " selected" : "" ?>>
                <?= _("Eigene Farbe") ?>
            </option>
        </select>
    </label>

    <label<?= !$info['background'] || in_array($info['background'], $plugin->backgrounds) ? ' style="display: none;"' : "" ?>
           id="color_picker">
        <?= _("Hintergrundfarbe") ?>
        <input type="color"
               name="color_picker"
               value="<?= !$info['background'] || in_array($info['background'], $plugin->backgrounds) ? : htmlReady($info['background']) ?>">
    </label>

    <label>
        <?= _("CSS-Änderungen") ?>
        <textarea name="css" style="min-height: 60vh; font-family: MONOSPACE;"><?= htmlReady($info['css']) ?></textarea>
    </label>

    <div data-dialog-button>
        <?= \Studip\Button::create(_("Speichern")) ?>
    </div>
</form>