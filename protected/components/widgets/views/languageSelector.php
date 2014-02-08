<div id="language-select">
    <?php
    if(sizeof($languages) < 4) { // если языков меньше четырех - отображаем в строчку
        // Если хотим видить в виде флагов то используем этот код
        foreach($languages as $key=>$lang) {
            if($key != $currentLang) {
                echo CHtml::link(
                    '<img src="/images/'.$key.'.jpg" title="'.$lang.'" style="padding: 1px;" width=26 height=15>',
                    $this->getOwner()->createMultilanguageReturnUrl($key));                };
        }
        // Если хотим в виде текста то этот код
        /*
        $lastElement = end($languages);
        foreach($languages as $key=>$lang) {
            if($key != $currentLang) {
                echo CHtml::link(
                     $lang, 
                     $this->getOwner()->createMultilanguageReturnUrl($key));
            } else echo '<b>'.$lang.'</b>';
            if($lang != $lastElement) echo ' | ';
        }
        */
    }
    else {
        // Render options as dropDownList
        echo CHtml::form();
        foreach($languages as $key=>$lang) {
            echo CHtml::hiddenField(
                $key,
                $this->getOwner()->createMultilanguageReturnUrl($key));
        }
        echo CHtml::dropDownList('language', $currentLang, $languages,
            array(
                'submit'=>'',
            )
        );
        echo CHtml::endForm();
    }
    ?>
</div>