<?php
use tests\helpers\Factory;

/**
 * Class LessonsTest
 */
class LessonsTest extends ApiTester {

    use Factory;

    /** @test */
    public function it_fetches_lessons()
    {
       $this->times(5)->make('Lesson');

        $this->getJson('api/lessons');

        $this->assertResponseOk();
    }

    /** @test */
    public function it_fetches_a_single_lesson()
    {
        $this->make('Lesson');

        $lesson = $this->getJson('api/lessons/1')->data;

        $this->assertResponseOk();

        $this->assertObjectHasAttributes($lesson, 'body', 'active');
    }

    /** @test */
    public function it_404s_if_a_lesson_is_not_found()
    {
       $json = $this->getJson('api/lessons/x');

        $this->assertResponseStatus(404);

        $this->assertObjectHasAttributes($json, 'error');
    }

    /** @test */
    public function it_creates_a_new_lesson_given_valid_parameters()
    {
        $this->getJson('api/lessons', 'POST', $this->getStub());

        $this->assertResponseStatus(201);

    }

    /** @test */
    public function it_throws_a_422_if_a_new_lesson_request_fails_validation()
    {
        $this->getJson('api/lessons', 'POST');

        $this->assertResponseStatus(422);
    }
    
    /**
     * @return array
     */
    protected function getStub()
    {
         return [
            'title' => $this->fake->sentence,
            'body' => $this->fake->paragraph,
            'some_bool' => $this->fake->boolean
         ];
    }



}
