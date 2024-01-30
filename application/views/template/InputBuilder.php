<?php


if (!class_exists('InputBuilder')) {
    class InputBuilder
    {

        var $id;
        var $name;
        var $label;
        var $value = '';
        var $sm = 9;
        var $placeholder = '';
        var $unit = '';
        var $options;
        var $selectedOptIds = [];

        var $optdisplay;
        var $onkeyup;
        var $onchange;

        var $single = false;
        var $normal = false;
        var $united = false;
        var $textarea = false;
        var $select = false;
        var $required = false;
        var $readonly = false;
        var $disabled = false;
        var $hide = false;
        var $break_label = false;
        var $margin_bottom = false;
        var $unselect_administrasi = false;

        function __construct($name, $label, $sm) {
            $this->name = $name;
            $this->label = $label;
            $this->sm = $sm;
        }

        public function id($v) {
            $this->id = $v;
            return $this;
        }

        public function val($v) {
            $this->value = $v;
            return $this;
        }

        public function placeholder($v) {
            $this->placeholder = $v;
            return $this;
        }

        public function unit($v) {
            $this->unit = $v;
            return $this;
        }

        public function single() {
            $this->single = true;
            return $this;
        }

        public function normal() {
            $this->normal = true;
            return $this;
        }

        public function united() {
            $this->united = true;
            return $this;
        }

        public function textarea() {
            $this->textarea = true;
            return $this;
        }

        public function select() {
            $this->select = true;
            return $this;
        }

        public function options($v) {
            $this->options = $v;
            return $this;
        }

        public function selectedOptions($v) {
            $this->selectedOptIds = array_map(function ($d) { return $d->id; }, $v);
            return $this;
        }

        public function selectedOptionIds($v) {
            $this->selectedOptIds = $v;
            return $this;
        }

        public function display($v) {
            $this->optdisplay = $v;
            return $this;
        }

        public function onkeyup($v) {
            $this->onkeyup = $v;
            return $this;
        }

        public function onchange($v) {
            $this->onchange = $v;
            return $this;
        }

        public function required() {
            $this->required = true;
            return $this;
        }

        public function readonly() {
            $this->readonly = true;
            return $this;
        }

        public function disabled() {
            $this->disabled = true;
            return $this;
        }

        public function hide() {
            $this->hide = true;
            return $this;
        }

        public function break_label() {
            $this->break_label = true;
            return $this;
        }

        public function margin_bottom() {
            $this->margin_bottom = true;
            return $this;
        }

        public function unselect_administrasi() {
            $this->unselect_administrasi = true;
            return $this;
        }

        public function build() {
            if ($this->select) {
                $this->buildSelect();
            }
            else if ($this->united) {
                $this->buildUnited();
            }
            else {
                $this->buildTypeText();
            }
        }

        public function buildTypeText() { ?>
            <div class="form-group <?=$this->hide ? 'hidden' : ''?>">

                <?php if ($this->break_label) : ?>
                    <label for="<?= $this->name ?>" class="control-label" style="padding: 0 15px; text-align: left"><?= $this->label ?></label>
                <?php else : ?>
                    <label for="<?= $this->name ?>" class="col-sm-3 control-label"><?= $this->label ?></label>
                <?php endif; ?>

                <div class="col-sm-<?=$this->break_label ? '12' : $this->sm?>">
                    <?php if ($this->textarea) : ?>
                        <textarea
                            class="form-control"
                            name="<?= $this->name ?>"
                            id="<?= $this->id ?>"
                            <?= isset($this->onkeyup) && $this->onkeyup != '' ? 'onkeyup='.$this->onkeyup : '' ?>
                            <?= $this->required ? 'required' : '' ?>
                            <?= $this->readonly ? 'readonly' : '' ?>
                        ><?= $this->value ?></textarea>
                    <?php else : ?>
                        <input
                            type="text"
                            class="form-control <?=$this->margin_bottom ? 'margin-bottom' : ''?>"
                            name="<?= $this->name ?>"
                            id="<?= $this->id ?>"
                            value="<?= $this->value ?>"
                            <?= isset($this->onkeyup) && $this->onkeyup != '' ? 'onkeyup='.$this->onkeyup : '' ?>
                            <?= $this->required ? 'required' : '' ?>
                            <?= $this->readonly ? 'readonly' : '' ?>>
                    <?php endif; ?>
                </div>
            </div>
        <?php }

        public function buildSelect() { ?>
            <div class="form-group <?=$this->hide ? 'hidden' : ''?>">
                <label for="<?= $this->name ?>" class="col-sm-3 control-label"><?= $this->label ?></label>
                <div class="col-sm-<?=$this->sm?>">
                    <select class="form-control <?=$this->normal ? '' : 'select2'?>"
                            <?=$this->single ? '' : 'multiple="multiple"'?>
                            <?= isset($this->onchange) && $this->onchange != '' ? 'onchange='.$this->onchange : '' ?>
                            name="<?= $this->name ?>"
                            id="<?= $this->id ?>"
                            data-placeholder="<?=$this->placeholder?>"
                            style="width: 100%;"
                            <?= $this->required ? 'required' : '' ?>
                            <?= $this->disabled ? 'disabled' : '' ?>
                    >
                        <?php foreach ($this->options as $key => $value) {
                            $select = (($value->nama == "Administrasi" && !$this->unselect_administrasi) || in_array($value->id, $this->selectedOptIds)) ? 'selected' : ''; ?>
                            <option value="<?= $value->id; ?>" <?php echo $select; ?> ><?= call_user_func($this->optdisplay, $value) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        <?php }

        public function buildUnited() { ?>
            <div class="col-sm-4 col-md-4 col-lg-4 form-group <?=$this->hide ? 'hidden' : ''?>">
                <label for="<?=$this->name?>" class="col-sm-3 control-label"><?= $this->label ?></label>
                <div class="input-group col-sm-8 col-md-8 col-sm-8 col-lg-8">
                    <input
                            type="text"
                            class="form-control"
                            id="<?= $this->id ?>"
                            name="<?= $this->name ?>"
                            value="<?= $this->value ?>"
                        <?= $this->required ? 'required' : '' ?>
                        <?= $this->readonly ? 'readonly' : '' ?>
                        <?= isset($this->onkeyup) && $this->onkeyup != '' ? 'onkeyup='.$this->onkeyup : '' ?>
                    >
                    <span class="input-group-addon"><?=$this->unit?></span>
                </div>
            </div>
        <?php }
    }
}

if (!function_exists('unit')) {
    function unit($name, $label) {
        $i = new InputBuilder($name, $label, 9);
        $i->united();
        return $i;
    }
}

if (!function_exists('sel')) {
    function sel($name, $label) {
        $i = new InputBuilder($name, $label, 9);
        $i->select();
        return $i;
    }
}

if (!function_exists('sm4')) {
    function sm4($name, $label) {
        return new InputBuilder($name, $label, 4);
    }
}

if (!function_exists('sm9')) {
    function sm9($name, $label) {
        return new InputBuilder($name, $label, 9);
    }
}

if (!function_exists('odontogram')) {
    function odontogram() {
        $src = base_url().'/assets/img/odontogram.png';
        echo '<center><img src="'.$src.'" width="400px;"></center>';
    }
}

if (!function_exists('br')) {
    function br() {
        echo '<br>';
    }
}

if (!function_exists('hasil_penunjang')) {
function hasil_penunjang($pemeriksaan = null) {
    if ($pemeriksaan) {
        if (is_array($pemeriksaan)) {
            $hasil_penunjang = $pemeriksaan && isset($pemeriksaan['hasil_penunjang']) ? json_decode($pemeriksaan['hasil_penunjang']) : [];
        }
        else {
            $hasil_penunjang = $pemeriksaan && isset($pemeriksaan->hasil_penunjang) ? json_decode($pemeriksaan->hasil_penunjang) : [];
        }
    }
    else {
        $hasil_penunjang = [];
    }

    echo '
        <div class="form-group">
            <label for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
                Hasil Penunjang
            </label>
        </div>
        <div class="form-group">
            <label for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
                Laboratorium
            </label>
            <div class="col-sm-9">
                <textarea class="form-control" name="hasil_penunjang_laboratorium" id="hasil_penunjang_laboratorium">'.($hasil_penunjang->laboratorium ?? '').'</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
                EKG
            </label>
            <div class="col-sm-9">
                <textarea class="form-control" name="hasil_penunjang_ekg" id="hasil_penunjang_ekg">'.($hasil_penunjang->ekg ?? '').'</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="hasil_penunjang_laboratorium" class="col-sm-3 control-label">
                Spirometri
            </label>
            <div class="col-sm-9">
                <textarea class="form-control" name="hasil_penunjang_spirometri" id="hasil_penunjang_spirometri">'.($hasil_penunjang->spirometri ?? '').'</textarea>
            </div>
        </div>
    ';
}} ?>
