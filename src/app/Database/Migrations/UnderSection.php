<?php
namespace  Showcase\Database\Migrations {
    use \Showcase\Framework\Database\Config\Table;
    use \Showcase\Framework\Database\Config\Column;

    class UnderSection extends Table{

        /**
         * Migration details
         * @return array of columns
         */
        function handle(){
            $this->name = 'undersections';
            $this->column(
                Column::factory()->name('id')->autoIncrement()->primary()
            );
            $this->column(
                Column::factory()->name('html')->string()
            );
            $this->column(
                Column::factory()->name('title')->string()
            );
            $this->column(
                Column::factory()->name('slug')->string()->unique()
            );
            $this->column(
                Column::factory()->name('section_id')->int()
            );
            $this->column(
                Column::factory()->name('zorder')->int()
            );
            $this->timespan();
        }
    }
}