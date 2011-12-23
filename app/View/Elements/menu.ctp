<ul class="<?php echo $class; ?>">
<?php
    $out = array();
    foreach ($menu as $title => $v) {
        if (is_string($v)) {
            if ($v === substr($this->here, strlen($this->base))) {
                $out[] = '<li class="active">' . $this->Html->link($title, $v) . '</li>';
            } else {
                $out[] = '<li>' . $this->Html->link($title, $v) . '</li>';
            }
        } else if (is_array($v)) {
            $i = 0;
            $match = false;
            $matches = $v['matches'];
            while ($i < count($matches)) {
                if (preg_match('/' . preg_quote($matches[$i], '/') .'/', substr($this->here, strlen($this->base)))) {
                    $match = true;
                }
                $i++;
            }
            if (isset($v['onLogin'])) {
                if ($v['onLogin'] === 'on' && isset($authUser)) {
                    if ($match === true) {
                        $out[] = '<li class="active">' . $this->Html->link($title, $v['url']) . '</li>';
                    } else {
                        $out[] = '<li>' . $this->Html->link($title, $v['url']) . '</li>';
                    }
                } else if ($v['onLogin'] === 'off' && !isset($authUser)) {
                    if ($match === true) {
                        $out[] = '<li class="active">' . $this->Html->link($title, $v['url']) . '</li>';
                    } else {
                        $out[] = '<li>' . $this->Html->link($title, $v['url']) . '</li>';
                    }
                }
            } else {
                if ($match === true) {
                    $out[] = '<li class="active">' . $this->Html->link($title, $v['url']) . '</li>';
                } else {
                    $out[] = '<li>' . $this->Html->link($title, $v['url']) . '</li>';
                }
            }
        }
    }

    echo join("\n", $out);
?>
</ul>