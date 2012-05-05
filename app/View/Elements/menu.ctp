<ul class="nav <?php echo $class; ?>">
<?php
    $out = array();
    $activeLi = '<li class="active">';
    foreach ($menu as $title => $val) {
        $match = false;
        if (is_string($val)) {
            $match = ($val === substr($this->here, strlen($this->base)));
            $link = $this->Html->link($title, $val);
            $out[] = (($match === true) ? $activeLi : '<li>') . $link . '</li>';
        } else if (is_array($val)) {
            $i = 0;
            $matches = (isset($val['matches']) ? $val['matches'] : array($val['url']));
            $link = $this->Html->link($title, $val['url']);
            while ($i < count($matches)) {
                //pr(substr($this->here, strlen($this->base)));//
                if (preg_match('/' . preg_quote($matches[$i], '/') .'/', substr($this->here, strlen($this->base)))) {
                //if (preg_match('/' . str_replace('/', '\/', $matches[$i]) .'/', substr($this->here, strlen($this->base)))) {    
                //if (preg_match($matches[$i], substr($this->here, strlen($this->base)))) {
                    $match = true;
                }
                $i++;
            }
            if (isset($val['visibleTo']) && $val['visibleTo'] != 'all') {
                $v2 = $val['visibleTo'];
                if ($v2 === 'admin' && isset($isAdmin) && $isAdmin) {
                    $out[] = (($match === true) ? $activeLi : '<li>') . $link . '</li>';
                } else if ($v2 === 'auth' && isset($authUser)) {
                    $out[] = (($match === true) ? $activeLi : '<li>') . $link . '</li>';
                } else if ($v2 === 'guests' && !isset($authUser)) {
                    $out[] = (($match === true) ? $activeLi : '<li>') . $link . '</li>';
                }
            } else {
                $out[] = (($match === true) ? $activeLi : '<li>') . $link . '</li>';
            }
        }
    }

    echo join("\n", $out);
    /*$out[] = (
        (($match === true) ? $activeLi : '<li>') .
            $this->Html->link($title, $val['url']) . '</li>'
        );*/
?>
</ul>
