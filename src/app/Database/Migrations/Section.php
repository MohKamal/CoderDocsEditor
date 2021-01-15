<?php
namespace  Showcase\Database\Migrations {
    use \Showcase\Framework\Database\Config\Table;
    use \Showcase\Framework\Database\Config\Column;

    class Section extends Table{

        /**
         * Migration details
         * @return array of columns
         */
        function handle(){
            $this->name = 'sections';
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
                Column::factory()->name('type')->string()->default("section")
            );
            $this->column(
                Column::factory()->name('zorder')->int()
            );
            $this->timespan();
        }
    }
}