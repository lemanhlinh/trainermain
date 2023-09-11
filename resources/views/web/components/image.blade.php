<img src="{{ !empty($src) ? asset($src) : asset("images/not_picture.png") }}"
     alt="{{ !empty($title) ? $title : '' }}"
     class="img-fluid {{ !empty($class) ? $class : '' }}">
