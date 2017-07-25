<?php
namespace BitrixAdminExtension\Page
{
    /**
     * Базовый класс страницы редактирования элемента.
     */
    abstract class BaseEdit extends Base
    {
        /**
         * Создает экземпляр класса.
         * @param string $path   Адрес расширяемой страницы.
         * @param array  $params Дополнительные параметры расширяемой страницы.
         */
        public function __construct($path, $params = [])
        {
            parent::__construct($path, $params);

            $this->bind('OnAdminTabControlBegin', 'onForm');
        }



        /**
         * Список новых вкладок.
         * @var array
         */
        protected $tabs = [];

        /**
         * Добавляет новую вкладку.
         * @param \BitrixAdminExtension $tab Вкладка.
         */
        public function addTab($tab)
        {
            $this->tabs[] = $tab;
        }

        /**
         * Позволяет модифицировать существующую форму редактирования. Вирутальный метод.
         * @param  \CAdminTabControl &$form Сущность формы редактирования.
         * @return void
         * 
         * @link https://dev.1c-bitrix.ru/api_help/main/general/admin.section/classes/cadmintabcontrol/index.php
         * Документация по классу формы.
         */
        protected function editForm(&$form) {}

        

        /**
         * Обрабатывает событие построение формы редактирования элемента.
         * @internal
         * @param  array &$form Массив данных о форме.
         * @return void
         */
        public function onForm(&$form)
        {
            foreach ($this->tabs as $tab)
            {
                $item = $tab->getData();
                $form->tabs[] = $item;

                $tab->registerAssets();
            }

            $this->editForm($form);
        }

        /**
         * Обрабатывает начало отображения страницы.
         * @return void
         */
        public function onPage()
        {
            parent::onPage();
            $this->registerControlsAssets($this->tabs);
        }
    }
}