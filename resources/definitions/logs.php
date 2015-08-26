<?php

return array(

    'db' => array(
        'table' => 'logs',
            'order' => array(
            'id' => 'ASC',
        ),
        'pagination' => array(
            'per_page' => [
                12 => 12, 
                24 => 24, 
                50 => 50
            ],
        ),
    ),
    'options' => array(
        'caption' => 'Логи приложения', 
    ),
    
    'position' => array(
        'tabs' => array(
            'Инфо' => array(['first_name', 'last_name'], 'email', 'pattern.user_password'),
            'Права' => array('pattern.user_permissions'),
            'Активность' => array('pattern.user_activation'),
        )
    ),
    
    'fields' => array(
        'id' => array(
            'caption' => '#',
            'type' => 'readonly',
            'class' => 'col-id',
            'width' => '1%',
            'is_sorting' => true,
            'hide' => true,
        ),
        'first_name' => array(
            'caption' => 'Имя',
            'type'    => 'text',
            'filter' => 'text',
            'validation' => array(
                'server' => array(
                    'rules' => 'required'
                ),
                'client' => array(
                    'rules' => array(
                        'required' => true
                    ),
                    'messages' => array(
                        'required' => 'Обязательно к заполнению'
                    )
                )
            ),
        ),
    ),
    
    'actions' => array(
        'search' => array(
            'caption' => 'Поиск',
        ),
        'insert' => array(
            'caption' => 'Добавить',
        ),
        'update' => array(
            'caption' => 'Редактировать',
        ),
        'delete' => array(
            'caption' => 'Удалить',
        ),
    ),
    
);