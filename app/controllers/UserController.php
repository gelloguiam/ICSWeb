
<?php

class UserController extends \BaseController {

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

	/**
	 * Display a listing of the users.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $users = DB::table('accounts')->orderBy('lastName', 'asc')->get();
        if(DB::table('accounts')->count() > 0)  return View::make('pages.user.index')->with('users', $users);
        Session::flush();
        return Redirect::route('index');
	}


	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        /*Not yet able to get $regtype from includes.header view*/

		$regtype = Input::get('regtype');
        //dd($regtype);
		if($regtype=='faculty'){//if user chooses to register as faculty
			return View::make('pages.user.faculty');
		}
		else if($regtype=='student'){//else if user chooses to register as student
			return View::make('pages.user.student');
		}
        else return "Error";
	}


	/**
	 * Store a newly created user in database: icswebsite, table: accounts.
	 *
	 * @return Response
	 */
	public function store()
	{
		//

        $this->user->type = Input::get('type');
        $this->user->username = Input::get('username');
        $this->user->password = Hash::make(Input::get('password'));
        $this->user->firstName = Input::get('firstName');
        $this->user->middleName = Input::get('middleName');
        $this->user->lastName = Input::get('lastName');
        $this->user->birthdate = Input::get('birthdate');
        $this->user->sex = Input::get('sex');
        $this->user->email = Input::get('email');
        if($this->user->type == 'faculty'){
            $this->user->employeeNumber = Input::get('employeeNumber');
            $this->user->room = Input::get('room');
            $this->user->academicPosition = Input::get('academicPosition');
            $this->user->studentNumber = NULL;
        }
        else if($this->user->type=='student'){
            $this->user->employeeNumber = NULL;
            $this->user->room = NULL;
            $this->user->academicPosition = NULL;
            $this->user->studentNumber = Input::get('studentNumber');
        }

        function createUserJsonFile($name){
            // JSON file creator
            $user_groups = array(
                "groups"        => array()
            );

            $user_messages = [array(
                "sentFrom"          => "Admin",
                "dateOfMessage"     => "Forever 21, 2015",
                "messageTitle"      => "Congratulations!",
                "messageContent"    => "Congratulations user you successfully created your ICS account."
            )];

            File::put('public/JSONcontents/accounts/groups/'.$name.'_groups.json', json_encode($user_groups));
            File::put('public/JSONcontents/accounts/messages/'.$name.'_messages.json', json_encode($user_messages));
        }

        createUserJsonFile(Input::get('username'));
        $this->user->save();
        return Redirect::to('/');


	}


	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($username)
	{
		//
        $user = DB::table('accounts')->where('username', $username)->first();;
        if($user != NULL) return View::make('pages.user.show', compact('user'));
	    else return "<h1>Error! User not found!</h1>";
    }


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($username)
	{
        $student = DB::table('accounts')->where('username', $username)->first();
        //return View::make('pages.students.editStudent')->with('student', $student);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($username)
	{
		//
        /*$user = DB::table('accounts')->where('username', $username)->first();
        $input = Input::all()->except('accessCode');
        $pass = Hash::make(Input::get('password'));//encrypt password

        if(! $this->user->fill($input)->isValid()) {
            return Redirect::back()->withInput()->withErrors($this->user->messages);
        }

        $user->password = $pass;
        $user->save();

        return Redirect::route('pages.students.index');*/
	}

    public function sendMessage()
    {
        $information = Input::all();
//        dd($information);
        return View::make('pages.user.sendMessage')->with('information',$information);
    }

    public function storeMessage()
    {
//        dd(Input::all());
        $user_messages = array(
            "sentFrom"          => Input::get('sentFrom'),
            "dateOfMessage"     => date('F d, Y'),
            "messageTitle"      => Input::get('messageTitle'),
            "messageContent"    => Input::get('messageContent')
        );

        $userData = json_decode(file_get_contents('public/JSONcontents/accounts/messages/'. Input::get('sendTo') . '_messages.json'), true);
        array_push($userData,$user_messages);

//        dd($userData);
        File::put('public/JSONcontents/accounts/messages/'.Input::get('sendTo').'_messages.json', json_encode($userData));
        return Redirect::route('page.group');
    }

}
