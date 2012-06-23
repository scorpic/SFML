<?php
class message {
    public $array_mess=array(
        1 => array('class' => 'update', 'text' => 'Обновлено'),
        2 => array('class' => 'update', 'text' => 'Сохранено'),
        3 => array('class' => 'update', 'text' => 'Удалено'),
        4 => array('class' => 'error', 'text' => 'Произошла ошибка'),
        5 => array('class' => 'update', 'text' => 'Вопрос добавлен'),
        6 => array('class' => 'ready', 'text' => 'Тест создан.', 'small' => 'Теперь добавьте вопросы.'),
        7 => array('class' => 'ready', 'text' => 'Администратор добавлен'),
        8 => array('class' => 'ready', 'text' => 'Профиль обновлен'),
        9 => array('class' => 'ready', 'text' => 'Администратор удален'),
        10 => array('class' => 'error', 'text' => 'Нельзя удалить самого себя'),
        11 => array('class' => 'ready', 'text' => 'Категория создана'),
        12 => array('class' => 'update', 'text' => 'Вопрос удален'),
        13 => array('class' => 'update', 'text' => 'Тест удален'),
        );
    function GetError($id) {
        $id=(int)$id;
        if (isset($this->array_mess[$id])) {
            return '
                <div id="messageBox" class="'.$this->array_mess[$id]['class'].'">
                    <p>
                        <b>'.$this->array_mess[$id]['text'].'</b>
                        '.$this->array_mess[$id]['small'].'
                    </p>
                </div>';
        }
        return false;
    }
}
$m=new message();
?>
