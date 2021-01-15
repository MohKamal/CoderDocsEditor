<?php
namespace  Showcase\Database\Migrations {
    use \Showcase\Framework\Database\Config\Table;
    use \Showcase\Framework\Database\Config\Column;

    class TemplateSection extends Table{

        /**
         * Migration details
         * @return array of columns
         */
        function handle(){
            $this->name = 'templatesection';
            $this->column(
                Column::factory()->name('id')->autoIncrement()->primary()
            );
            $this->column(
                Column::factory()->name('template_id')->int()
            );
            $this->column(
                Column::factory()->name('section_id')->int()
            );
            $this->column(
                Column::factory()->name('user_id')->int()
            );
            $this->timespan();
        }
    }
}