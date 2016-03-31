<?php

class DatabaseSeeder extends Seeder {

    /**
     * @var array
     */
    private $tables = [
        'lessons',
        'tags',
        'lesson_tag'
    ];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $this->cleanDatabase();

		Eloquent::unguard();

        $this->call('LessonsTableSeeder');
        $this->call('TagsTableSeeder');
        $this->call('LessonTagTableSeeder');
	}

    /**
     *
     */
    public function cleanDatabase()
    {
        DB::Statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $tableName)
        {
            DB::table($tableName)->truncate();
        }

        DB::Statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
