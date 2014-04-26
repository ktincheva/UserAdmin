<?php

class UsersController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    private $rowsPerPage = 10;

    public function index() {

        $sortby = Input::get('sortby');
        $order = Input::get('order');
        if ($sortby && $order) {
            $users = Users::orderBy($sortby, $order)->paginate($this->rowsPerPage);
        } else {
            $users = Users::paginate($this->rowsPerPage);
        }
        $headers = Users::getHeaders();
        //$data = Book::where("type", $type_id)->orderBy("total")->paginate(10);
        //$users = Users::paginate(5);
        return View::make('users.index', compact('users', 'sortby', 'order', 'headers'))
                        ->with('name', 'Users Management')
                        ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
        return View::make('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
        $input = Input::all();
        $validation = Validator::make($input, Users::$rules);
        if ($validation->passes()) {
            Users::create($input);
            return Redirect::route('users.index');
        }
        return Redirect::route('users.create')
                        ->withInput()->withErrors($validation)
                        ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
        $user = Users::find($id);
        if (is_null($user)) {
            return Redirect::route('users.index');
        } return View::make('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //

        $input = Input::all();
        $validation = Validator::make($input, Users::$rules);
        if ($validation->passes()) {
            $user = Users::find($id);
            $user->update($input);
            return Redirect::route('users.index', $id);
        } return Redirect::route('users.edit', $id)
                        ->withInput()->withErrors($validation)
                        ->with('message', 'There were validation errors.');
    }

    public function saveUser($id) {
        //

        $input = Input::all();
        $validation = Validator::make($input, Users::$rules);
        if ($validation->passes()) {
            $user = Users::find($id);
            $user->update($input);
            return Redirect::route('users.show', $id);
        } return Redirect::route('users.edit', $id)
                        ->withInput()->withErrors($validation)
                        ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
        Users::find($id)->delete();
        return Redirect::route('users.index');
    }

    public function sendWelcomeEmail($id) {

        $user = Users::find($id);
        $data['user_details'] = (object) $user->toarray();

        if (is_null($user)) {
            return Redirect::route('users.index');
        } else {
            Mail::send('users.welcome', $data, function($message) use ($user) {
                $message->to($user["email"])->subject('Welcome to Users Management System!');
            });
            return Redirect::route('users.index')->with("message", "Message to user: " . $user["email"] . " was send.");
        }
    }

    public function search() {
        $input = Input::all();

        $headers = Users::getHeaders();
        $searchTermBits = array();
        foreach (array_keys($headers) as $key) {
            $key = trim($key);
            if (!empty($input[$key])) {
                $searchTermBits[] = "$key LIKE '%$input[$key]%'";
            }
        }
        $query = implode(' AND ', $searchTermBits);
        $sortby = "id";
        $order = 'asc';

        if (!empty($query)) {
            $users = Users::whereRaw($query)->paginate($this->rowsPerPage);
        } else
            $users = Users::paginate($this->rowsPerPage);
        // dd($users);
        return View::make('users.index', compact('users', 'sortby', 'order', 'headers'))
                        ->with('name', 'Users Management')
                        ->with('users', $users);
    }

}
