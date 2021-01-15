<?php
namespace  Showcase\Database\Migrations {
    use \Showcase\Framework\Database\Config\Table;
    use \Showcase\Framework\Database\Config\Column;

    class PreTemplate extends Table{

        /**
         * Migration details
         * @return array of columns
         */
        function handle(){
            $this->name = 'pretemplate';
            $this->column(
                Column::factory()->name('id')->autoIncrement()->primary()
            );
            $this->column(
                Column::factory()->name('name')->string()
            );
            $this->column(
                Column::factory()->name('file_path')->string()
            );
            $this->column(
                Column::factory()->name('type')->string()
            );
            $this->timespan();
        }
    }
}