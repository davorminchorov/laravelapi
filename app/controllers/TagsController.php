<?php

use Acme\Transformers\TagTransformer;

class TagsController extends ApiController {

    protected $tagTranformer;

    function __construct(TagTransformer $tagTranformer)
    {
        $this->tagTranformer = $tagTranformer;
    }


    /**
     * Display a listing of the resource.
     *
     * @param null $lessonId
     * @return Response
     */
	public function index($lessonId = null)
	{
        $tags = $this->getTags($lessonId);

		return $this->respond([
            'data' => $this->tagTranformer->transformCollection($tags->all())
        ]);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

    /**
     * @param $lessonId
     * @return mixed
     */
    public function getTags($lessonId)
    {
        return $lessonId ? Lesson::findOrFail($lessonId)->tags : Tag::all();
    }


}
