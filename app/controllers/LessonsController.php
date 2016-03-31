<?php


use Acme\Transformers\LessonTransformer;

class LessonsController extends ApiController {

    protected $lessonTransformer;

    function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;

        //$this->beforeFilter('auth');
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // all is bad
        $limit = Input::get('limit') ?: 3;
        $lessons = Lesson::paginate($limit);

        return $this->respondWithPagination($lessons,[
            'data'      => $this->lessonTransformer->transformCollection($lessons->all())
        ]);
    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        if( ! Input::get('title') or ! Input::get('body'))
        {
            return $this->respondValidationFailed('Validation failed for creating a new lesson.');
        }

        Lesson::create(Input::all());

        return $this->respondCreated('Lesson successfully created.');
    }


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$lesson = Lesson::find($id);

        if ( ! $lesson)
        {
            return $this->respondNotFound('Lesson does not exist');

        }

        return $this->respond([
            'data' => $this->lessonTransformer->transform($lesson)
        ]);
	}


}
