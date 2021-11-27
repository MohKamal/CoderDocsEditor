<?php
namespace  Showcase\Database\Migrations {
    use \Showcase\Framework\Database\Config\Table;
    use \Showcase\Framework\Database\Config\Column;

    class Template extends Table{

        /**
         * Migration details
         * @return array of columns
         */
        function handle(){
            $this->name = 'templates';
            $this->column(
                Column::factory()->name('id')->autoIncrement()->primary()
            );
            $this->column(
                Column::factory()->name('name')->string()
            );
            $this->column(
                Column::factory()->name('appName1')->string()
            );
            $this->column(
                Column::factory()->name('appName2')->string()
            );
            $this->column(
                Column::factory()->name('user_id')->int()
            );
            $this->column(
                Column::factory()->name('slug')->string()
            );
            $this->timespan();
        }
    }
}