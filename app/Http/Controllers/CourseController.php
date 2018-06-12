<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Lesson;
use App\Tag;
use App\TagCourse;
use App\CourseCategory;
use Storage;
class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except'=> ['index','show','showLesson']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::where('course_active',0)
        ->orderBy('created_at')->paginate(9);
    
        return view('pages.course')->with('courses',$courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>'required|max:255',
            'body' => 'required',
            'tags' => 'required',
            'category'=> 'required',
            'image' => 'image|nullable|max:1999'
        ]);
        if($request->hasFile('image')){
            //E MERR FILENAME ME EXTENSION
            $imageExt = $request->file('image')->getClientOriginalName();
            // E MERR EMRIN  E FILE
            $imageName = pathinfo($imageExt, PATHINFO_FILENAME);
            // E MERR VETEM EXTENSION TE FILE
            $extension = $request->file('image')->getClientOriginalExtension();
            // ADD TIME PER MU KAN UNIK EMRI I IMAGES
            $imageNameStore = $imageName.'_'.time().'.'.$extension;
            // UPLOAD IMAGE
            $path = $request->file('image')->storeAs('public/course_covers',$imageNameStore);
        }else{
            // NESE SKA SELEKTU 
            $imageNameStore = 'photo.jpg';
        }
        //KRIJIMI I PYTJES
        $cours = new Course;

        $cours->course_title = $request->input('title');
        $cours->course_description = $request->input('body');
        $cours->course_active = 0;
        $cours->user_id = auth()->user()->id;
        $cours->image = $imageNameStore;
        $cours->save();

        //MERR ID E PYTJES TE KRIJUAR
        $last_id = $cours->course_id;
        
        $tags = $request->input('tags');
        $tags = explode(",",$tags);

        $new_tag =1;
		foreach($tags as $t){
            $search_t = Tag::where('tag_name','=',strtolower($t));
        
            if($search_t->first()==null){
                
                $new_tag = new Tag;
                $new_tag->tag_name = strtolower($t);
                $new_tag->createdBy = auth()->user()->id;
                $new_tag->save();
                $last_tag_id =$new_tag->tag_id;
            }else{
                $last_tag_id = $search_t->first()->tag_id;
            }
            $conn = new TagCourse;
            $conn->course_id = $last_id;
            $conn->tag_id = $last_tag_id; 
            $conn->save();
            
            
        }
        $category = $request->input('category');
            
            $newLink = new CourseCategory;
            $newLink->course_id = $last_id;
            $newLink->category_id = $category;
            $newLink->save(); 
        return redirect('/courses')->with('success','Course Created');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$name)
    {
        if(!is_numeric($id))
            abort(404);
        //$lesson = Lesson::find($id);
  //      $course_id = Course::find($id);
        $course =  Course::find($id);

        $lesson = $course->firstLesson($id);
       // return $lesson;
        if(count($course)==0)
          abort(404);
        
        $data = [
            'lesson' => $lesson,
            'course' => $course
        ];

        return view('courses.showC')->with('data',$data);

    }
    
    public function showLesson($id,$name,$l_id)
    {
        if(!is_numeric($id))
            abort(404);
            
        if(!is_numeric($l_id))
          abort(404);
        //$lesson = Lesson::find($id);
  //      $course_id = Course::find($id);
        $course =  Course::find($id);

        $lesson = Lesson::find($l_id);

        if(count($course)==0)
          abort(404);
        
        $data = [
            'lesson' => $lesson,
            'course' => $course
        ];

        return view('courses.showC')->with('data',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        if(auth()->user()->id !== $course->user_id){
            return redirect('/course');
        }
     

        return view('courses.create')->with('course',$course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' =>'required|max:255',
            'body' => 'required',
            'tags' => 'required',
            'category'=> 'required',
            'image' => 'image|nullable|max:1999'
        ]);
        $course = Course::find($id);

        if($request->hasFile('image')){
            //E MERR FILENAME ME EXTENSION
            $imageExt = $request->file('image')->getClientOriginalName();
            // E MERR EMRIN  E FILE
            $imageName = pathinfo($imageExt, PATHINFO_FILENAME);
            // E MERR VETEM EXTENSION TE FILE
            $extension = $request->file('image')->getClientOriginalExtension();
            // ADD TIME PER MU KAN UNIK EMRI I IMAGES
            $imageNameStore = $imageName.'_'.time().'.'.$extension;
            // UPLOAD IMAGE
            $path = $request->file('image')->storeAs('public/course_covers',$imageNameStore);
           
            
            if($course->image != 'photo.jpg') {
                Storage::delete('public/course_covers/' . $course->image);
            }
            $course->image = $imageNameStore;

        }
        //KRIJIMI I PYTJES
        
        if(auth()->user()->id !== $course->user_id){
            return redirect('/courses');
        }

        $course->course_title = $request->input('title');
        $course->course_description = $request->input('body');
        $course->save();

        //MERR ID E PYTJES TE KRIJUAR
        $last_id = $course->course_id;
        
        $tags = $request->input('tags');
        $tags = explode(",",$tags);

        TagCourse::where('course_id','=', $last_id)
        ->delete();
		foreach($tags as $t){
            $search_t = Tag::where('tag_name','=',strtolower($t));
        
            if($search_t->first()==null){
                
                $new_tag = new Tag;
                $new_tag->tag_name = strtolower($t);
                $new_tag->createdBy = auth()->user()->id;
                $new_tag->save();
                $last_tag_id =$new_tag->tag_id;
            }else{
                $last_tag_id = $search_t->first()->tag_id;
            }
            $conn = new TagCourse;
            $conn->course_id = $last_id;
            $conn->tag_id = $last_tag_id; 
            $conn->save();
            
            
        }
        CourseCategory::where('course_id','=', $last_id)
        ->delete();
        $category = $request->input('category');
            
            $newLink = new CourseCategory;
            $newLink->course_id = $last_id;
            $newLink->category_id = $category;
            $newLink->save(); 
        return redirect('/courses')->with('success','Course Created');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        if(auth()->user()->id !== $course->user_id){
            return redirect('/questions');
            //OR PAGE NOT FOUND
        }
        $course->course_active = 1;

        $course->save();

        return redirect('/courses')->with('success','Course Deleted');
    }
}
